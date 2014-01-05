<?php

class Modele {

	/**
	 * Identifiant du mod&egrave;le
	 * 
	 * @access private
	 * @var integer
	 */
	private $id;
	
	/**
	 * Nom du mod&egrave;le
	 * @access private
	 * @var varchar
	 */
	private $nom;
	
	/**
	 * Identifiant du mod&egrave;le
	 * @var integer
	 */
	private $idsscat;
	
	/**
	 * Image li&eacute; au mod&egrave;le
	 * @var varchar
	 */
	private $img;
	
	/**
	 * Statut du mod&egrave;le
	 * @var integer
	 */
	private $actif;
	
	/**
	 * Ordre d'affichage
	 */
	private $order;
	private $title;
	private $meta_keyword;
	private $meta_description;
	
	
	
	
	
	/**
	 * Constructeur
	 * 
	 * @access public
	 * @return void
	 */
    function __construct($filtre = null ) {
    
    	try{
    		
    		$sql_type = ($filtre == null)?'':' AND modeles_id = \''.$filtre.'\'';
    		
    		$db=DB::get();
    		$sql = 'SELECT * 
					FROM t_modeles 
					WHERE modeles_supprime =\'0\' '.$sql_type;
			$result = $db->query($sql);
			while($row = $db->fetch_assoc($result)){
				$this->id	= $row['modeles_id'];
				$this->nom	= $row['modeles_nom'];
				$this->idsscat= $row['modeles_idsscat'];
				$this->img	= $row['modeles_img'];
				$this->order= $row['modeles_order'];
				$this->actif= $row['modeles_actif'];
				$this->title= $row['modeles_title'];
				$this->meta_keyword= $row['modeles_meta_keyword'];
				$this->meta_description= $row['modeles_meta_description'];
			}
    	}
    	catch(Exception $e){}
    }
    
    /**
     * Retourne les infos sur les categories
     * 
     * @access public
     * @return array
     */
    public function getId(){
	    return $this->id;
    }
    
    /**
     * Retourne le nom
     * @return varchar
     */
    public function getNom(){
    	return stripslashes($this->nom);
    }
    
    /**
     * Retourne l'identifiant de la cat&eacute;gorie
     * @access public
     * @return varchar
     */
    public function getIdSsCat(){
    	return $this->idsscat;
    }
    
    /**
     * Retourne l'image associ&eacute; &agrave; la ss cat
     * @return varchar
     */
    public function getImg(){
    	return $this->img;
    }
    
    /**
     * Retourne l'&eacute;tat hors ligne/En ligne de la sous cat&eacute;gorie
     * @access public
     * @return integer
     */
    public function getActif(){
    	return $this->actif;
    }
    
    /**
     * Retourne l'ordre d'affichage
     */
    public function getOrder(){
    	return $this->order;
    }
	public function getTitle(){
    	return stripslashes($this->title);
    }
	public function getMetaKeyword(){
    	return stripslashes($this->meta_keyword);
    }
	public function getMetaDescription(){
    	return stripslashes($this->meta_description);
    }

    /**
     * Modifieur de la variable idcat
     * @param $idcat
     * @return void
     */
    public function setIdSsCat($idsscat){
    	$this->idsscat = $idsscat;
    }
    
    /**
     * Modifieur de la variable du nom de la sous cat&eacute;gorie
     * @param $nom
     * @return void
     */
    public function setNom($nom){
    	$this->nom = $nom;
    }
    
    /**
     * Modifieur de l'&eacute;tat de la sous cat&eacute;gorie
     * @param etat
     * @return void
     */
    public function setActif($actif){
    	$this->actif = $actif;
    }
    public function setTitle($title){
    	$this->title = $title;
	}
	public function setMetaKeyword($meta_keyword){
    	$this->meta_keyword = $meta_keyword;
	}
	public function setMetaDescription($meta_description){
    	$this->meta_description = $meta_description;
	}	
   /**
    * Fonction d'ajout d'une sous cat&eacute;gorie
    * @access public
    * @return integer
    */
   public function insert(){
   		try{
   			$db = DB::get();
   			$sql = 'INSERT INTO t_modeles  
   					SET modeles_nom=\''.$db->escape($this->nom).'\',
   					modeles_idsscat = \''.$this->idsscat.'\',
					modeles_title = \''.$this->title.'\',
					modeles_meta_keyword = \''.$this->meta_keyword.'\',
					modeles_meta_description = \''.$this->meta_description.'\',	
   					modeles_actif = \''.$this->actif.'\' ';
   			$result = $db->query($sql);
   			$this->id = $db->last_insert_id();
   			return $this->id;
   		}
   		catch(Exception $e){
   			var_dump($e->getMessage());
   		}
   } 
   
   /**
    * Fonction d'ajout d'une sous cat&eacute;gorie
    * @access public
    * @return integer
    */
   public function update(){
   		try{
   			$db = DB::get();
   			$sql = 'UPDATE t_modeles  
   					SET modeles_nom=\''.$db->escape($this->nom).'\',
   					modeles_idsscat = \''.$this->idsscat.'\' ,
					modeles_title = \''.$this->title.'\',
					modeles_meta_keyword = \''.$this->meta_keyword.'\',
					modeles_meta_description = \''.$this->meta_description.'\',	
   					modeles_actif = \''.$this->actif.'\'
   					WHERE modeles_id = \''.$this->id.'\' ';
   			$result = $db->query($sql);
   			
   		}
   		catch(Exception $e){
   			var_dump($e->getMessage());
   		}
   } 
   
   /**
    * Mise en hors ligne d'une sous cat&eacute;gorie
    * @access public
    * @return void
    */ 
   public function delete(){
   		try{
   			$db = DB::get();
   			$sql = 'UPDATE t_modeles  
   					SET modeles_supprime=\'1\'  
   					WHERE modeles_id = \''.$this->id.'\' ';
   			$result = $db->query($sql);
   		}
   		catch(Exception $e){
   			var_dump($e->getMessage());
   		}
   }
   
   /**
    * Fonction qui permet de v&eacute;rifier si une ss cat&eacute;gorie du mm nom existe d&eacute;j&agrave;
    * @param $nom
    * @param $id optionnel : id du produit en cours
    * @param idcat optionnel : id de la cat&eacute;gorie
    * @return string
    */
   public static function verif_existe($nom,$id = null,$idsscat = null){
   	
   		try{
   			$search_clause = ($id == null )?'':' AND modeles_id <> \''.$id.'\' ';	
   			$search_clause .= ($idsscat == null )?'':' AND modeles_idsscat = \''.$idsscat.'\' ';	
   			$db = DB::get();
   			$sql = 'SELECT modeles_id
   					FROM t_modeles  
   					WHERE modeles_supprime=\'0\'  
   					AND modeles_nom = \''.$db->escape($nom).'\' ';
   			
   			$sql.= $search_clause;
   			
   			$result = $db->query($sql);
   			$nbres	= $db->num_rows($result);
   			return $nbres;
   		}
   		catch(Exception $e){
   			var_dump($e->getMessage());
   		}
   	
   }
    
}
?>
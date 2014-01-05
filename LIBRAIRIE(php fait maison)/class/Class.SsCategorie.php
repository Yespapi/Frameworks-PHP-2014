<?php

class SsCategorie {

	/**
	 * Identifiant de la cat&eacute;gorie
	 * 
	 * @access private
	 * @var integer
	 */
	private $id;
	
	/**
	 * Nom de la sous cat&eacute;gorie
	 * @access private
	 * @var varchar
	 */
	private $nom;
	
	/**
	 * Identifiant de la cat&eacute;gorid
	 * @var integer
	 */
	private $idcat;
	
	/**
	 * Image li&eacute; &agrave; la sous cat&eacute;gorie pour les looks tendances
	 * @var varchar
	 */
	private $img;
	
	/**
	 * Statut de la sous cat&eacute;gorie
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
    		
    		$sql_type = ($filtre == null)?'':' AND sscategories_id = \''.$filtre.'\'';
    		
    		$db=DB::get();
    		$sql = 'SELECT * 
					FROM t_sscategories 
					WHERE sscategories_supprime =\'0\' '.$sql_type;
			$result = $db->query($sql);
			while($row = $db->fetch_assoc($result)){
				$this->id	= $row['sscategories_id'];
				$this->nom	= $row['sscategories_nom'];
				$this->idcat= $row['sscategories_idcat'];
				$this->img	= $row['sscategories_img'];
				$this->order= $row['sscategories_order'];
				$this->actif= $row['sscategories_actif'];
				$this->title= $row['sscategories_title'];
				$this->meta_keyword= $row['sscategories_meta_keyword'];
				$this->meta_description= $row['sscategories_meta_description'];
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
    public function getIdCat(){
    	return $this->idcat;
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
    	return $this->title;
    }
	public function getMetaKeyword(){
    	return $this->meta_keyword;
    }
	public function getMetaDescription(){
    	return $this->meta_description;
    }

    /**
     * Modifieur de la variable idcat
     * @param $idcat
     * @return void
     */
    public function setIdCat($idcat){
    	$this->idcat = $idcat;
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
   			$sql = 'INSERT INTO t_sscategories  
   					SET sscategories_nom=\''.$db->escape($this->nom).'\',
   					sscategories_idcat = \''.$this->idcat.'\',
   					sscategories_title = \''.$this->title.'\',
					sscategories_meta_keyword = \''.$this->meta_keyword.'\',
					sscategories_meta_description = \''.$this->meta_description.'\',
   					sscategories_actif = \''.$this->actif.'\' ';
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
   			$sql = 'UPDATE t_sscategories  
   					SET sscategories_nom=\''.$db->escape($this->nom).'\',
   					sscategories_idcat = \''.$this->idcat.'\' ,
					sscategories_title = \''.$this->title.'\',
					sscategories_meta_keyword = \''.$this->meta_keyword.'\',
					sscategories_meta_description = \''.$this->meta_description.'\',
   					sscategories_actif = \''.$this->actif.'\'
   					WHERE sscategories_id = \''.$this->id.'\'';
					
   			$result = $db->query($sql);
   			$this->id = $db->last_insert_id();
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
   			$sql = 'UPDATE t_sscategories  
   					SET sscategories_supprime=\'1\'  
   					WHERE sscategories_id = \''.$this->id.'\' ';
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
   public static function verif_existe($nom,$id = null,$idcat = null){
   	
   		try{
   			$search_clause = ($id == null )?'':' AND sscategories_id <> \''.$id.'\' ';	
   			$search_clause .= ($idcat == null )?'':' AND sscategories_idcat = \''.$idcat.'\' ';	
   			$db = DB::get();
   			$sql = 'SELECT sscategories_id
   					FROM t_sscategories  
   					WHERE sscategories_supprime=\'0\'  
   					AND sscategories_nom = \''.$db->escape($nom).'\' ';
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
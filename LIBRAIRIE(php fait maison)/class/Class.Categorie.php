<?php

class Categorie {

	/**
	 * tableau contenant la liste des cat&eacute;gories
	 * 
	 * @access private
	 * @return array
	 */
	private $id;
	
	/**
	 * Nom de la cat&eacute;gorie
	 * @access public
	 * @var varchar
	 */
	private $nom;
	
	/**
	 * image
	 * @access public
	 * @var varchar
	 */
	private $visuel;
	
	
	/**
	 * Constructeur
	 * 
	 * @access public
	 * @return void
	 */
	 private $title;
	 private $meta_keyword;
	 private $meta_description;
	 private $actif;
    function __construct($filtre = null ) {
    
    	try{
    		
    		$sql_type = ($filtre == null)?'':' AND categories_id = \''.$filtre.'\' ';
    		
    		$db=DB::get();
    		$sql = 'SELECT * 
					FROM t_categories 
					WHERE categories_supprime =\'0\' '.$sql_type;
			$result = $db->query($sql);
			while($row = $db->fetch_assoc($result)){
				$this->id 	= $row['categories_id'];
				$this->nom	= $row['categories_nom'];
				$this->visuel = $row['categories_visuel'];
				$this->title = $row['categories_title'];
				$this->meta_keyword = $row['categories_meta_keyword'];
				$this->meta_description = $row['categories_meta_description'];
				$this->actif = $row['categories_actif'];
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
    
    public function getVisuel(){
    	return $this->visuel;
    }
    public function getNom(){
    	return stripslashes($this->nom);
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
	public function getActif(){
    	return $this->actif;
    }	
	public function setNom($nom){
    	$this->nom = $nom;
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
	public function setActif($actif){
    	$this->actif = $actif;
    }
	
	public function insert(){
   		try{
   			$db = DB::get();
   			$sql = 'INSERT INTO t_categories  
   					SET categories_nom=\''.$db->escape($this->nom).'\',
   					categories_title = \''.$this->title.'\',
					categories_meta_keyword = \''.$this->meta_keyword.'\',
					categories_meta_description = \''.$this->meta_description.'\',					
   					categories_actif = \''.$this->actif.'\' ';
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
   			$sql = 'UPDATE t_categories  
   					SET categories_nom=\''.$db->escape($this->nom).'\',
   					categories_title = \''.$this->title.'\',
					categories_meta_keyword = \''.$this->meta_keyword.'\',
					categories_meta_description = \''.$this->meta_description.'\',
   					categories_actif = \''.$this->actif.'\'
   					WHERE categories_id = \''.$this->id.'\'';
					
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
	
	public static function verif_existe($nom,$id = null,$idcat = null){
   	
   		try{
   			$search_clause = ($id == null )?'':' AND categories_id <> \''.$id.'\' ';   			
   			$db = DB::get();
   			$sql = 'SELECT categories_id
   					FROM t_categories  
   					WHERE categories_supprime=\'0\'  
   					AND categories_nom = \''.$db->escape($nom).'\' ';
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
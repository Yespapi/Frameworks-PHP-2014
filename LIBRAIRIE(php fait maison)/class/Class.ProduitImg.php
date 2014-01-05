<?php
class ProduitImg{
	
	
	/**
	 * Identifiant de la cat&Eacute;gorie
	 * 
	 * @access private
	 * @var integer
	 */
	private $id;
	
	/**
	 * Nom de la sous cat&Eacute;gorie
	 * @access private
	 * @var varchar
	 */
	private $nom;
	
	/**
	 * Indique s'il s'agit de la photo principale
	 * @var integer
	 */
	private $principale;
	
	/**
	 * Cl&Eacute; secondaire pour la table t_produits
	 * @var varchar
	 */
	private $idproduit;
	
	
/**
	 * Constructeur
	 * 
	 * @access public
	 * @return void
	 */
    function __construct($filtre = null ) {
    
    	try{
    		
    		$sql_type = ($filtre == null)?'':' AND produits_img_id = \''.$filtre.'\'';
    		
    		$db=DB::get();
    		$sql = 'SELECT * 
					FROM t_produits_img 
					WHERE produits_img_supprime =\'0\' '.$sql_type;
			$result = $db->query($sql);
			while($row = $db->fetch_assoc($result)){
				$this->id			= $row['produits_img_id'];
				$this->nom			= $row['produits_img_nom'];
				$this->idproduit	= $row['produits_img_idproduit'];
				$this->principale	= $row['produits_img_principale'];
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
     * Retourne la cl&Eacute; secondaire
     * @return varchar
     */
    public function getIdProduit(){
    	return $this->idproduit;
    }
    
    /**
     * Retourne 0 ou 1 si photo principale
     * @return integer
     */
    public function getPrincipale(){
    	return $this->principale;
    }
    
    
	/**
     * Modifieur de la variable du nom de la photo
     * @param $nom
     * @return void
     */
    public function setNom($nom){
    	$this->nom = $nom;
    }
    
    /**
     * Modifieur de l'&Eacute;tat principale de la photo
     * @param $principale
     * @return void
     */
    public function setPrincipale($principale){
    	$this->principale;
    }
    
    /**
     * Modifieur de la cl&Eacute; secondaire
     * @param $idproduit
     * @return void
     */
    public function setIdProduit($idproduit){
    	$this->idproduit = $idproduit;
    }
    
    /**
     * Retourne l'info permettant de savoir s'il y a d&Eacute;j&Agrave; une photo principale
     * @param varchar $idproduit
     * @return boolean
     */
    public static function existe_principale($idproduit){
    
    	try{
   			$db = DB::get();
   			$sql = 'SELECT *
   					FROM t_produits_img  
   					WHERE produits_img_idproduit = \''.$idproduit.'\' 
   					AND produits_img_supprime = \'0\' ';
   			   			   			
   			$result = $db->query($sql);
   			$nbres 	= $db->num_rows($result);
   			return $nbres;
   		}
   		catch(Exception $e){
   			var_dump($e->getMessage());
   		}
    }
    
    /**
    * Fonction d'ajout d'une photo
    * @access public
    * @return integer
    */
   public function insert(){
   		try{
   			$db = DB::get();
   			$sql = 'INSERT INTO t_produits_img  
   					SET produits_img_nom=\''.$db->escape($this->nom).'\',
   					produits_img_idproduit = \''.$this->idproduit.'\'  ';
   			$sql.=(self::existe_principale($this->idproduit))?',produits_img_principale = \'0\' ':',produits_img_principale = \'1\'';
   			   			
   			$result = $db->query($sql);
   			$this->id = $db->last_insert_id();
   			return $this->id;
   		}
   		catch(Exception $e){
   			var_dump($e->getMessage());
   		}
   } 
   
   
 /**
    * Permet de d&Eacute;finir une image comme image principale
    * @access public
    * @return integer
    */
   public function update(){
   		try{
   			$db = DB::get();
   			
   			$sql = 'UPDATE t_produits_img  
   					SET produits_img_principale = \'0\'
  					WHERE produits_img_idproduit = \''.$this->idproduit.'\' ';
   			$result = $db->query($sql);
   			
   			$sql2 = 'UPDATE t_produits_img  
   					SET produits_img_principale = \'1\'
  					WHERE produits_img_id = \''.$this->id.'\' ';
   			$result2 = $db->query($sql2);
   			
   		}
   		catch(Exception $e){
   			var_dump($e->getMessage());
   		}
   } 
   
   /**
    * Mise en hors ligne d'une photo
    * @access public
    * @return void
    */ 
   public function delete(){
   		try{
   			$db = DB::get();
   			$sql = 'UPDATE t_produits_img  
   					SET produits_img_supprime=\'1\'  
   					WHERE produits_img_id = \''.$this->id.'\' ';
   			$result = $db->query($sql);
   		}
   		catch(Exception $e){
   			var_dump($e->getMessage());
   		}
   }
   
   
}
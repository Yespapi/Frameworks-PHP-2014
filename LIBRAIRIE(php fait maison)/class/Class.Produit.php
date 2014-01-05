<?php
class Produit{
	
	/**
	 * Identifiant unique
	 * @access private
	 * @var integer
	 */
	private $id;
	
	/**
	 * Cl&eacute; secondaire
	 * @access private
	 * @var varchar
	 */
	private $idproduit;
	
	/**
	 * Cat&eacute;gorie 
	 * @var integer
	 */
	private $idcat;
	
	/**
	 * Marque du v&eacute;hicule
	 * @var integer
	 */	
	private $idmarque;
	
	/**
	 * Mod&egrave;le du v&eacute;hicule
	 * @var integer
	 */
	private $idmodele;
	/**
	 * Ann&eacute;e du v&eacute;hicule
	 * @var integer
	 */
	private $idyear;
	
	/**
	 * Nombre de miles
	 * @var integer
	 */
	private $miles;
	
	/**
	 * Description courte
	 * @var varchar
	 */
	private $description;
	
	/**
	 * Type de v&eacute;hicule
	 * @var integer voir table t_types
	 */
	private $idtype;
	
	/**
	 * Motorisation du v&eacute;hicule
	 * @var integer voir table t_motorisation
	 */
	private $idmotorisation;
	
	/**
	 * Couleur du v&eacute;hicule
	 * @var varchar
	 */
	private $couleur;
	
	/**
	 * Prix TTC
	 * @var decimal 10,2
	 */
	private $prixTTC;
	
	/**
	 * Montant de la mensualit&eacute;
	 * @var decimal 10,2
	 */
	private $mensualite;
	
	/**
	 * Tableau Contenant les images
	 * @var array
	 */
	private $img = array();
	
	/**
	 * Fiche technique
	 * @var text
	 */
	private $fichtech;
	
	/**
	 * Statut d'affichage Vendue ou non
	 * @var varchar
	 */
	private $publication;
	
	/**
	 * Statut de publication En ligne /Hors ligne 
	 * @var tinyint
	 */
	private $statut;
	
	/**
	 * Pr&eacute;sence dans la rubrique Promotion 1 : OUI - 0 : NON
	 * @var integer
	 */
	private $promotion;
	
	
	/**
	 * Id du v&eacute;hicule &agrave; afficher en page d'accueil
	 * @var integer
	 */
	private $accueil;
	private $title;
	private $meta_keyword;
	private $meta_description;
	
	/**
	 * Constructeur du v&eacute;hicule 
	 * @param integer $id
	 * @return void
	 */
	public function __construct($id = null){
		
	try{
    		
    		$sql_type = ($id == null)?'':' AND produits_id = \''.$id.'\'';
    		
    		$db=DB::get();
    		$sql = 'SELECT * 
					FROM t_produits 
					WHERE produits_supprime =\'0\' '.$sql_type;
			
    		$result = $db->query($sql);
			while($row = $db->fetch_assoc($result)){
				$this->id				= $row['produits_id'];
				$this->idproduit		= $row['produits_idproduit'];
				$this->idcat			= $row['produits_idcat'];
				$this->idmarque			= $row['produits_idmarque'];
				$this->idmodele 		= $row['produits_idmodele'];
				$this->idyear 		    = $row['produits_idyear'];
				$this->mensualite 		= $row['produits_mensualite'];
				$this->miles 			= $row['produits_miles'];
				$this->idmotorisation 	= $row['produits_idmotorisation'];
				$this->description		= $row['produits_description'];
				$this->fichtech			= $row['produits_fichtech'];
				$this->idtype 			= $row['produits_idtype'];
				$this->prixTTC 			= $row['produits_prix'];
				$this->couleur 			= $row['produits_couleur'];
				$this->publication 		= $row['produits_publication'];
				$this->statut			= $row['produits_statut'];
				$this->promotion 		= $row['produits_promotion'];
				$this->accueil			= $row['produits_accueil'];
				$this->title			= $row['produits_title'];
				$this->meta_keyword			= $row['produits_meta_keyword'];
				$this->meta_description			= $row['produits_meta_description'];
			}
    	}
    	catch(Exception $e){
    		var_dump($e->getMessage());
    	}
		
	}
	
	// ACCESSEUR
	
	public function getId(){
		return $this->id;
	}
	
	public function getIdProduit(){
		return $this->idproduit;
	}
	
	public function getIdCat(){
		return $this->idcat;
	}
	
	public function getCat(){
		return SelectNomFromTable('categories',$this->idcat);
	}
	
	public function getIdMarque(){
		return $this->idmarque;
	}
	
	public function getMarque(){
		return SelectNomFromTable('sscategories',$this->idmarque);
	}
	
	public function getIdModele(){
		return $this->idmodele;
	}
	
	public function getModele(){
		return SelectNomFromTable('modeles',$this->idmodele);
	}
	
	public function getIdYear(){
		return $this->idyear;
	}
	
	public function getYear(){
		return SelectNomFromTable('year',$this->idyear);
	}
	
	public function getMiles(){
		return $this->miles;
	}
	
	public function getDescription($nbcar = null){
		if($nbcar == null){
			return stripslashes($this->description);
		}
		else{
			return Tronquer_Texte(stripslashes($this->description),$nbcar);
		}
	}
	
	public function getIdType(){
		return $this->idtype;
	}
	
	public function getType(){
		return SelectNomFromTable('types',$this->idtype);
	}
	
	public function getIdMotorisation(){
		return $this->idmotorisation;
	}
	
	public function getMotorisation(){
		return SelectNomFromTable('motorisations',$this->idmotorisation);
	}
	
	public function getCouleur(){
		return $this->couleur;
	}
	
	public function getPrixTTC(){
		return $this->prixTTC;
	}
	
	public function getMensualite(){
		return $this->mensualite;
	}
	
	public function getFichTech($nbcar = null){
		if($nbcar == null){
			return stripslashes($this->fichtech);
		}
		else{
			return Tronquer_Texte(stripslashes($this->fichtech),$nbcar);
		}
	}
	
	public function getPublication(){
		return $this->publication;
	}
	
	public function getStatut(){
		return $this->statut;
	}
	
	public function getPromotion(){
		return $this->promotion;
	}
	
	public function getAccueil(){
		return $this->accueil;
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
	
	// MODIFIEUR
	
	public function setId($id){
		$this->id = $id;
	}
	
	public function setIdProduit($idproduit){
		$this->idproduit = $idproduit;
	}
	
	public function setIdCat($idcat){
		$this->idcat = $idcat;
	}
	
	public function setIdMarque($idmarque){
		$this->idmarque = $idmarque;
	}
	
	public function setIdModele($idmodele){
		$this->idmodele = $idmodele;
	}

	public function setIdYear($idyear){
		$this->idyear = $idyear;
	}
	public function setMiles($miles){
		$this->miles = $miles;
	}
	
	public function setDescription($description){
		$this->description = $description;
	}
	
	public function setIdType($type){
		$this->idtype = $type;
	}
	
	public function setIdMotorisation($motorisation){
		$this->idmotorisation = $motorisation;
	}
	
	public function setCouleur($couleur){
		$this->couleur = $couleur;
	}
	
	public function setPrixTTC($prix){
		$this->prixTTC = $prix;
	}
	
	public function setMensualite($mensualite){
		$this->mensualite = $mensualite;
	}
	
	public function setFichTech($fiche){
		$this->fichtech = $fiche;
	}
	
	public function setPublication($publication){
		$this->publication = $publication;
	}
	
	public function setStatut($statut){
		$this->statut = $statut;
	}
	

	
	public function setPromotion($promotion){
		$this->promotion = $promotion;
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
	 * Fonction d'ajout d'un v&eacute;hicule
	 * @return integer
	 */
	
	public function insert(){
	
		try{
    		
    		    		
    		$db=DB::get();
    		$sql = ' INSERT INTO t_produits 
    				 SET produits_idproduit 	= \''.$db->escape($this->idproduit).'\',
    				 produits_idcat 			= \''.$this->idcat.'\',
    				 produits_idmarque 			= \''.$db->escape($this->idmarque).'\',
    				 produits_idmodele 			= \''.$db->escape($this->idmodele).'\',
					 produits_idyear 			= \''.$db->escape($this->idyear).'\',
    				 produits_mensualite 		= \''.$db->escape($this->mensualite).'\',
    				 produits_miles 			= \''.$db->escape($this->miles).'\',
    				 produits_idmotorisation 	= \''.$this->idmotorisation.'\',
    				 produits_description 		= \''.$db->escape($this->description).'\',
    				 produits_fichtech 			= \''.$db->escape($this->fichtech).'\',
    				 produits_idtype			= \''.$this->idtype.'\',
    				 produits_prix 				= \''.$this->prixTTC.'\',
    				 produits_couleur 			= \''.$db->escape($this->couleur).'\',
    				 produits_statut 			= \''.$this->statut.'\',
    				 produits_publication 		= \''.$this->publication.'\',
					 produits_title 		= \''.$this->title.'\',
					 produits_meta_keyword 		= \''.$this->meta_keyword.'\',
					 produits_meta_description 		= \''.$this->meta_description.'\',
    				 produits_promotion 		= \''.$this->promotion.'\'  ';
			//echo $sql;
			$result 				= $db->query($sql);
			$this->id 				= $db->last_insert_id();
			return $this->id;
			
    	}
    	catch(Exception $e){
    		var_dump($e->getMessage());
    	}
	}
	
	/**
	 * Fonction permettant de mettre &agrave; jour le v&eacute;hicule
	 * @access public
	 * @return void
	 */
	public function update(){
	
		try{
    		
    		    		
    		$db=DB::get();
    		$sql = ' UPDATE t_produits 
    				 SET produits_idcat = \''.$this->idcat.'\',
    				 produits_idmarque = \''.$db->escape($this->idmarque).'\',
    				 produits_idmodele = \''.$db->escape($this->idmodele).'\',
					 produits_idyear = \''.$db->escape($this->idyear).'\',
    				 produits_mensualite = \''.$db->escape($this->mensualite).'\',
    				 produits_miles = \''.$db->escape($this->miles).'\',
    				 produits_idmotorisation = \''.$this->idmotorisation.'\',
    				 produits_description = \''.$db->escape($this->description).'\',
    				 produits_fichtech = \''.$db->escape($this->fichtech).'\',
    				 produits_idtype = \''.$this->idtype.'\',
    				 produits_prix = \''.$this->prixTTC.'\',
    				 produits_couleur = \''.$db->escape($this->couleur).'\',
    				 produits_statut = \''.$this->statut.'\',
    				 produits_publication = \''.$this->publication.'\',
					 produits_title 		= \''.$this->title.'\',
					 produits_meta_keyword 		= \''.$this->meta_keyword.'\',
					 produits_meta_description 		= \''.$this->meta_description.'\',
    				 produits_promotion = \''.$this->promotion.'\'  
    				 WHERE produits_id = \''.$this->id.'\' ';
			//echo $sql;			
			$result = $db->query($sql);
						
    	}
    	catch(Exception $e){
    		var_dump($e->getMessage());
    	}
	}
	
	/**
	 * Permet de supprimer un v&eacute;hicule
	 * @access public
	 * @return void
	 */
	public function delete(){
		
		try{
    		    		
    		$db=DB::get();
    		$sql = ' UPDATE t_produits 
    				 SET produits_supprime = \'1\' 
    				 WHERE produits_id = \''.$this->id.'\' ';
						
			$result = $db->query($sql);
						
    	}
    	catch(Exception $e){
    		var_dump($e->getMessage());
    	}
	}
	
	/**
	 * Permet de mettre &agrave; jour le statut promotion
	 * @param integer $promo
	 * @return void
	 */
	public function updatePromo($promo){
		try{
    		    		
    		$db=DB::get();
    		$sql = ' UPDATE t_produits 
    				 SET produits_promotion = \''.$promo.'\' 
    				 WHERE produits_id = \''.$this->id.'\' ';
						
			$result = $db->query($sql);
						
    	}
    	catch(Exception $e){
    		var_dump($e->getMessage());
    	}
	}
	
	/**
	 * Retourne le nom de l'image principale
	 * @access public
	 * @return varchar
	 */
	public function getFirstImg(){
		
		try{
    		$db=DB::get();
    		$sql = ' SELECT produits_img_nom
    				 FROM t_produits_img
    				 WHERE produits_img_supprime = \'0\' 
    				 AND produits_img_idproduit = \''.$this->idproduit.'\' 
    				 AND produits_img_principale = \'1\' ';
			$result = $db->query($sql);
			$row	= $db->fetch_assoc($result);
			$img	= $row['produits_img_nom'];
			return $img;
			
    	}
    	catch(Exception $e){
    		var_dump($e->getMessage());
    	}
		
	}
	
	
	/**
	 * V&eacute;rifie l'existence d'un mod&egrave;le
	 * @static
	 * @param idmodele : identifiant du mod&egrave;le
	 * @param idcat : identifiant de la cat&eacute;gorie
	 * @param idmarque : identifiant de la marque
	 * @param idproduit : cl&eacute; secondaire
	 * @return boolean
	 */
	public static function existe($idproduit){
		try{
    		    		
    		$db=DB::get();
    		$sql = 'SELECT produits_id 
    				FROM t_produits  
    				WHERE produits_idproduit=\''.$idproduit.'\'
    				AND produits_supprime = \'0\' ';
    		$result = $db->query($sql);
    		$nbres 	= $db->num_rows($result);
    		if($nbres == ''){
    			return false;
    		}
    		else{
    			return true;
    		}
		}
		catch(Exception $e){
			var_dump($e->getMessage);
		}
	}
	
/**
	 * Retourne le nom de l'image principale
	 * @access public
	 * @return varchar
	 */
	public static function existeImg($idproduit){
		
		try{
    		$db=DB::get();
    		$sql = ' SELECT produits_img_nom
    				 FROM t_produits_img
    				 WHERE produits_img_supprime = \'0\' 
    				 AND produits_img_idproduit = \''.$idproduit.'\' 
    				 AND produits_img_principale = \'1\' ';
			$result = $db->query($sql);
			
			$row	= $db->fetch_assoc($result);
			$img	= $row['produits_img_nom'];
			return $img;
			
    	}
    	catch(Exception $e){
    		var_dump($e->getMessage());
    	}
		
	}
	
	/**
	 * Modifie le produits en page d'accueil
	 * @access public
	 * @return void
	 */
	public static function updatePromoAccueil($id){
	
		try{
    		$db=DB::get();
    		$sql = ' UPDATE t_produits
    				 SET produits_accueil = \'0\' ';
			$result = $db->query($sql);
					
			$sql2 = 'UPDATE t_produits
    				 SET produits_accueil = \'1\'  
    				 WHERE produits_id = \''.$id.'\' ';
			$result2 = $db->query($sql2);
    	}
    	catch(Exception $e){
    		var_dump($e->getMessage());
    	}
		
		
	}
}
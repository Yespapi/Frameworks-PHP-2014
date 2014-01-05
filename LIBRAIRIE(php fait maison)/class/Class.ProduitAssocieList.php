<?php

/**
 * usage:
 * $product_list = new ProduitList(array($my_product, $my_procduct2));
 * 
 * foreach($product_list as $key => $val) {
 *  	echo $key.' : '. $val->getCompulsoryCriteria().'<br/>';
 * }
 */

class ProduitAssocieList extends Lister {

	/**
     * Crit&Egrave;res r&Eacute;dhibitoires (champs texte ouvert)
     *
     * @access private
     * @var array
     */
    private $items = array();

	/**
     * Constructeur
     * 	- nouveau
     * 	- ou &Agrave; partir d'un tableau d'objets Produit
     *
     * @access public
     * @param  produits array of Item objects
     */
 	public function __construct($items = null) {
		$all_items = true;
		if (!is_null($items)) {
			// each element must be an Ad object
			foreach ($items as $product) {
				$all_items &= $product instanceof Item;
			}
			if ($all_items) {
				$this->setItems($items);
				parent::__construct($items);
			}
		}
		
		if (is_null($items) || !$all_items) {
			parent::__construct(array());
		}
	}

 	/**
     * Liste les produits par &Eacute;tat de mod&Eacute;ration (0: en attente, 1: en ligne, 2: refus&Eacute;)
     * et pagination
     *
     * @access public
     * @param  array moderation_state
     * @param  integer compte_id
     */
	public function getTotalListSize($moderation_state = null,$limit_state = null) {
		try {
			$db 	= DB::get();
   			$addsql = '';			
   			
			if(!is_null($moderation_state) && is_array($moderation_state)){
				
				foreach($moderation_state as $key=>$critere){
					
					if(($key == 'idprod') && ($critere != '') ){
						$addsql .= ' AND associes_idprod1 = '.$critere;
						$addsql .= ' AND associes_idprod2 <> '.$critere;
					}
					
					if(($key == 'categorie') && ($critere != '') ){
						$addsql .= ' AND  produits_idcat = \''.$critere.'\'  ';
					}
					if( ($key == 'marque') && ($critere != '') ){
						$addsql .= ' AND produits_idmarque = \''.$critere.'\' ';
					}
					if( ($key == 'modele') && ($critere != '') ){
						$addsql .= ' AND produits_idmodele = \''.$critere.'\' ';
					}
					if( ($key == 'promotion') && ($critere != '') ){
						$addsql .= ' AND  produits_promotion = \''.$critere.'\' ';
					}
					if( ($key == 'statut') && ($critere != '') ){
						$addsql .= ' AND produits_statut = \''.$critere.'\' ';
					}
					if( ($key == 'etat') && ($critere != '') ){
						$addsql .= ' AND  produits_etat = \''.$critere.'\' ';
					}
					if( ($key == 'key_search') && ($critere != '') ){
						$addsql .= ' AND  ( produits_desc LIKE \'%'.$critere.'%\' OR produits_fichtech LIKE \'%'.$critere.'%\'  ) ';
					}
					
					
					
				}
			}
   			
   			
   			$limit_state = ($limit_state == null)?'':' LIMIT '.$limit_state;
			$query = '	SELECT associes_idprod1
			   			FROM t_produits LEFT JOIN t_associes ON (associes_idprod2 = produits_id )
   						WHERE produits_supprime = \'0\' 
   						'.$addsql;
   			$query .= ' AND produits_supprime=0
   						GROUP BY produits_id
						ORDER BY produits_id DESC';
   			$query.=$limit_state;
			//echo $query;
			$result = $db->query($query);
			return $db->num_rows($result);
		}
		catch (Exception $e) {
			 var_dump($e->getMessage());
		}
	}

    /**
     * Permet de setter les menus en dehors du constructeur
     *
     * @access public
     * @param  items array of Item objects
     */
	public function setItems($items) {
		$all_items = true;
		foreach ($items as $product) {
			$all_items &= $product instanceof Item;
		}
		if ($all_items) {
			$this->items = $items;
			parent::setCollection($items);
		}
	}
	
	
	
	/**
	 * Renvoie le nombre d'annonces correspondant &Agrave; cette liste
	 * 
	 * @return integer
	 */
	public function getListSize() {
		return sizeof($this->items);
	}
	
	
	/**
	 * Retourne les formules associ&Eacute;es &Agrave; la cat&Eacute;gorie pass&Eacute;e en param&Egrave;tre
	 * 
	 * @access public
	 * @param integer cat
	 * @return array
	 */
	public function getSearchResults($moderation_state = null, $tri = null, $limit_state = null){
		$items = array();
		try{
			
			$db = DB::get();
		$addsql = '';			
   			
			if(!is_null($moderation_state) && is_array($moderation_state)){
				
				foreach($moderation_state as $key=>$critere){
					
					if(($key == 'idprod') && ($critere != '') ){
						$addsql .= ' AND associes_idprod1 = '.$critere;
						$addsql .= ' AND associes_idprod2 <> '.$critere;
					}
					
					if(($key == 'categorie') && ($critere != '') ){
						$addsql .= ' AND  produits_idcat = \''.$critere.'\'  ';
					}
					if( ($key == 'marque') && ($critere != '') ){
						$addsql .= ' AND produits_idmarque = \''.$critere.'\' ';
					}
					if( ($key == 'modele') && ($critere != '') ){
						$addsql .= ' AND produits_idmodele = \''.$critere.'\' ';
					}
					if( ($key == 'promotion') && ($critere != '') ){
						$addsql .= ' AND  produits_promotion = \''.$critere.'\' ';
					}
					if( ($key == 'statut') && ($critere != '') ){
						$addsql .= ' AND produits_statut = \''.$critere.'\' ';
					}
					if( ($key == 'etat') && ($critere != '') ){
						$addsql .= ' AND  produits_etat = \''.$critere.'\' ';
					}
					if( ($key == 'key_search') && ($critere != '') ){
						$addsql .= ' AND  ( produits_desc LIKE \'%'.$critere.'%\' OR produits_fichtech LIKE \'%'.$critere.'%\'  ) ';
					}
					
					
					
				}
			}
			$limit_state = ($limit_state == null)?'':' LIMIT '.$limit_state;
			$query = '	SELECT associes_idprod2
			   			FROM t_produits LEFT JOIN t_associes ON (associes_idprod2 = produits_id )
   						WHERE produits_supprime = \'0\' 
   						'.$addsql;
   			$query .= ' AND produits_supprime=0
   						GROUP BY associes_idprod2
						ORDER BY produits_id DESC';
   			//echo $query;
   			$query.=$limit_state;
	
			$result = $db->query($query);
			while($row = $db->fetch_assoc($result)){
				$items[] = new Produit($row['associes_idprod2']);
			}		
			$this->setItems($items);
			return $items;
		}
		catch (Exception $e) {
			var_dump($e->getMessage());
		}
		
		
	}
	
	
	/**
	 * Verifie l'existence de l'association
	 * @param integer $id1
	 * @param integer $id2
	 * @return boolean
	 */
	public static function verif_existe($id1,$id2){
	
		try{
    		
    		$db = DB::get();
    		$sql = "SELECT * FROM t_associes WHERE associes_idprod1='".$id1."' AND " .
														 "associes_idprod2='".$id2."' ";
			$result = $db->query($sql);
			//echo $sql;
			$exist = $db->num_rows($result);
			if($exist!=''){
				$lALERTE = "ATTENTION : Cette association a d&Eacute;j&Agrave; &Eacute;t&Eacute; r&Eacute;alis&Eacute;e !!!";
			}
			return $lALERTE;
		}
		catch(Exception $e){
    		var_dump($e->getMessage());
    	}
		
	}

	
	public static function Verif_dest($id, $id2)
	{
    	try{
    		
    		$db = DB::get();
    		$sql = "SELECT associes_id from t_associes where associes_idprod1=" .
        			$id . " AND associes_idprod2=" . $id2;
    		$result = $db->query($sql);
    		$count 	= $db->num_rows($result);
    		//echo $sql;
		if ($count != '')
    	{
        	return true;
    	} else
    	{
        	return false;
    	}
    	}catch(Exception $e){
    		var_dump($e->getMessage());
    	}
}
	
	
	
}
?>
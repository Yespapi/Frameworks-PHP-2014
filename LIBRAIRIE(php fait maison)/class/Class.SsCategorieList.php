<?php

/**
 * usage:
 * $product_list = new ProduitList(array($my_product, $my_procduct2));
 * 
 * foreach($product_list as $key => $val) {
 *  	echo $key.' : '. $val->getCompulsoryCriteria().'<br/>';
 * }
 */

class SsCategorieList extends Lister {

	/**
     * Crit&egrave;res r&eacute;dhibitoires (champs texte ouvert)
     *
     * @access private
     * @var array
     */
    private $items = array();

	/**
     * Constructeur
     * 	- nouveau
     * 	- ou &agrave; partir d'un tableau d'objets Produit
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
     * Liste les annonces par &eacute;tat de mod&eacute;ration (0: en attente, 1: en ligne, 2: refus&eacute;)
     * et pagination
     *
     * @access public
     * @param  array moderation_state
     * @param  integer compte_id
     */
	public function getTotalListSize($moderation_states = null) {
		try {
			$join_clause	= '';
			$search_clause 	= '';
			$group_clause	= '';
			$db = DB::get();
			if(!empty($moderation_states)){
				
				foreach($moderation_states as $key=>$val){
					
					//$search_clause .= ( ($key == 'idcat') && ($val != '') )?' AND sscategories_idcat = \''.$db->escape($val).'\'':'';
					$search_clause .= ( ($key == 'nom') && ($val != '') )?' AND sscategories_nom LIKE \'%'.$db->escape($val).'%\'':'';
					$search_clause .= ( ($key == 'actif') && ($val != '') )?' AND sscategories_actif LIKE \'%'.$db->escape($val).'%\'':'';
				
					if( ($key == "session_cat") && (!empty($val)) ){
						if( (is_array($val)) && (count($val)>0) && ($val[0] != '' ) ) {
							
							$search_clause.=" AND  ( ";
								
							for($i=0;$i<count($val);$i++){
								$keysql = "";
								$keysql .= ($i == 0)?'':' OR ';
								$search_clause .=$keysql. ' sscategories_idcat = \''.$val[$i].'\'  ';
							}
							$search_clause.=" ) ";
							
						}	
					}
					// On v&eacute;rifie si il y a des v&eacute;hicules dans la cat&eacute;gorie concern&eacute;
					
					if( ($key == 'idcat') && ($val != '') ){
						$join_clause  .= ' LEFT JOIN t_produits ON (produits_idmarque = sscategories_id) ';
						$search_clause.=' AND produits_idcat = \''.$db->escape($val).'\' AND produits_supprime = \'0\' AND produits_statut = \'En ligne\' ';
						$group_clause .= ' GROUP BY sscategories_id ';
					}
					
					
				}
			}
							
			$limit_sql = ( $limit == null)?'':' LIMIT '.$limit;
			
			
			$query = '	SELECT sscategories_id
			   			FROM t_sscategories '.$join_clause.'
   						WHERE sscategories_supprime = \'0\' ';
			$query .= $search_clause;
   			$query .= ' AND sscategories_supprime=0
   			 		  '.$group_clause.' 
					  ORDER BY sscategories_id DESC';
	
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
	 * Renvoie le nombre d'annonces correspondant &agrave; cette liste
	 * 
	 * @return integer
	 */
	public function getListSize() {
		return sizeof($this->items);
	}
	
	
	/**
	 * Retourne les formules associ&eacute;es &agrave; la cat&eacute;gorie pass&eacute;e en param&egrave;tre
	 * 
	 * @access public
	 * @param integer cat
	 * @return array
	 */
	public function getSearchResults($moderation_states = '',$order = null){
		$items = array();
		try{
			
			$join_clause	= '';
			$search_clause 	= '';
			$group_clause	= '';
			$db = DB::get();
			if(!empty($moderation_states)){
				
				foreach($moderation_states as $key=>$val){
					
					//$search_clause .= ( ($key == 'idcat') && ($val != '') )?' AND sscategories_idcat = \''.$db->escape($val).'\'':'';
					$search_clause .= ( ($key == 'nom') && ($val != '') )?' AND sscategories_nom LIKE \'%'.$db->escape($val).'%\'':'';
					$search_clause .= ( ($key == 'actif') && ($val != '') )?' AND sscategories_actif LIKE \'%'.$db->escape($val).'%\'':'';
					
					if( ($key == "session_cat") && (!empty($val)) ){
						if( (is_array($val)) && (count($val)>0) && ($val[0] != '' ) ) {
							
							$search_clause.=" AND  ( ";
								
							for($i=0;$i<count($val);$i++){
								$keysql = "";
								$keysql .= ($i == 0)?'':' OR ';
								$search_clause .=$keysql. ' sscategories_idcat = \''.$val[$i].'\'  ';
							}
							$search_clause.=" ) ";
							
						}	
					}
					
					
					
					// Cas sp&eacute;cial pour le menu
					// On v&eacute;rifie si il y a des v&eacute;hicules dans la cat&eacute;gorie concern&eacute;
					if( ($key == 'idcat') && ($val != '') ){
						$join_clause  .= ' LEFT JOIN t_produits ON (produits_idmarque = sscategories_id) ';
						$search_clause.=' AND produits_idcat = \''.$db->escape($val).'\' AND produits_supprime = \'0\' AND produits_statut = \'En ligne\' ';
						$group_clause .= ' GROUP BY sscategories_id ';
					}
				}
			}
							
			$limit_sql = ( $limit == null)?'':' LIMIT '.$limit;
			
						
			$order_by = ($order == null)?' ORDER BY sscategories_nom ASC':' ORDER BY sscategories_'.$order.' ASC';
			
			
			$query = ' SELECT *  
					   FROM t_sscategories '.$join_clause.'
					   WHERE sscategories_supprime=\'0\' '.$search_clause.'
					   '.$group_clause.'
					    '.$order_by.' ';
			//InsertTest($query);
			$result = $db->query($query);
			//echo $query.' <br />';
			while($row = $db->fetch_assoc($result)){
				$items[] = new SsCategorie($row['sscategories_id']);
			}		
			$this->setItems($items);
			return $items;
		
		}
		catch (Exception $e) {
			 var_dump($e->getMessage());
		}
		
		
	}
	

}
?>
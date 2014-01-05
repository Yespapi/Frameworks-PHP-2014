<?php

/**
 * usage:
 * $product_list = new ProduitList(array($my_product, $my_procduct2));
 * 
 * foreach($product_list as $key => $val) {
 *  	echo $key.' : '. $val->getCompulsoryCriteria().'<br/>';
 * }
 */

class YearList extends Lister {

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
     * Liste les annonces par &Eacute;tat de mod&Eacute;ration (0: en attente, 1: en ligne, 2: refus&Eacute;)
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
										
					$search_clause .= ( ($key == 'nom') && ($val != '') )?' WHERE year_nom LIKE \'%'.$db->escape($val).'%\'':'';			
								
								//Addddd like SsCategoriesList  
									/*if( ($key == "session_year") && (!empty($val)) ){
						if( (is_array($val)) && (count($val)>0) && ($val[0] != '' ) ) {
							
							$search_clause.=" AND  ( ";
								
							for($i=0;$i<count($val);$i++){
								$keysql = "";
								$keysql .= ($i == 0)?'':' OR ';
								$search_clause .=$keysql. ' year_nom = \''.$val[$i].'\'  ';//a voir (il faut avoir un cle etrangere
							}
							$search_clause.=" ) ";
							
						}	
					}
					// On v&eacute;rifie si il y a des v&eacute;hicules dans la cat&eacute;gorie concern&eacute;
					
					if( ($key == 'idcat') && ($val != '') ){
						$join_clause  .= ' LEFT JOIN t_produits ON (produits_idyear = year_nom) ';
						$search_clause.=' AND produits_idyear = \''.$db->escape($val).'\' AND produits_supprime = \'0\' AND produits_statut = \'En ligne\' ';
						$group_clause .= ' GROUP BY year_id ';
					}*/
					//Enddddddddd like SsCAtegorieList
								
								
								
								
				}
			}
							
			$limit_sql = ( $limit == null)?'':' LIMIT '.$limit;
			
			//avant cete year_nom pour les 2 suivant
			$query = '	SELECT year_id
			   			FROM t_year ';
			$query .= 	$search_clause;
   			$query .= ' ORDER BY year_id DESC';
	
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
	public function getSearchResults($moderation_states = '',$order = null){
		$items = array();
		try{
			
			$join_clause	= '';
			$search_clause 	= '';
			$group_clause	= '';
			$db = DB::get();
			if(!empty($moderation_states)){
				
				foreach($moderation_states as $key=>$val){
									
					$search_clause .= ( ($key == 'nom') && ($val != '') )?' WHERE year_nom LIKE \'%'.$db->escape($val).'%\'':'';
					
					//add like SsCategorieList
						if( ($key == "session_year") && (!empty($val)) ){
						if( (is_array($val)) && (count($val)>0) && ($val[0] != '' ) ) {
							
							$search_clause.=" AND  ( ";
								
							for($i=0;$i<count($val);$i++){
								$keysql = "";
								$keysql .= ($i == 0)?'':' OR ';
								$search_clause .=$keysql. ' year_nom = \''.$val[$i].'\'  ';
							}
							$search_clause.=" ) ";
							
						}	
					}
					
					
					
					// Cas sp&eacute;cial pour le menu
					// On v&eacute;rifie si il y a des v&eacute;hicules dans la cat&eacute;gorie concern&eacute;
					if( ($key == 'nom') && ($val != '') ){
						$join_clause  .= ' LEFT JOIN t_produits ON (produits_idyear = year_id) ';
						$search_clause.=' AND produits_idyear = \''.$db->escape($val).'\' AND produits_supprime = \'0\' AND produits_statut = \'En ligne\' ';
						$group_clause .= ' GROUP BY year_id ';
					}
					//End like SsCategorieList
					
					
				}
			}
							
			$limit_sql = ( $limit == null)?'':' LIMIT '.$limit;
			
						
			$order_by = ($order == null)?' ORDER BY year_nom DESC':' ORDER BY year_'.$order.' DESC';
			
			
			$query = ' SELECT *  
					   FROM t_year 
					   '.$search_clause.'
					   '.$group_clause.'
					   '.$order_by.' ';
			
			$result = $db->query($query);
			//echo $query.' <br />';
			while($row = $db->fetch_assoc($result)){
				$items[] = new Year($row['year_id']);
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
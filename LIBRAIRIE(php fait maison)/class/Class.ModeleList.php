<?php

/**
 * usage:
 * $product_list = new ProduitList(array($my_product, $my_procduct2));
 * 
 * foreach($product_list as $key => $val) {
 *  	echo $key.' : '. $val->getCompulsoryCriteria().'<br/>';
 * }
 */

class ModeleList extends Lister {

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
				$all_items &= $product instanceof Modele;
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
			$search_clause = '';
			$db = DB::get();
			if(!empty($moderation_states)){
				
				foreach($moderation_states as $key=>$val){
					
					$search_clause .= ( ($key == 'idsscat') && ($val != '') )?' AND modeles_idsscat = \''.$db->escape($val).'\'':'';
					$search_clause .= ( ($key == 'nom') && ($val != '') )?' AND modeles_nom LIKE \'%'.$db->escape($val).'%\'':'';
					$search_clause .= ( ($key == 'actif') && ($val != '') )?' AND modeles_actif LIKE \'%'.$db->escape($val).'%\'':'';
				}
			}
							
			$limit_sql = ( $limit == null)?'':' LIMIT '.$limit;
			
			
			$query = '	SELECT modeles_id
			   			FROM t_modeles
   						WHERE modeles_supprime = \'0\' ';
			$query .= $search_clause;
   			$query .= ' AND modeles_supprime=0
						ORDER BY modeles_id DESC';
	
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
			$all_items &= $product instanceof Modele;
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
			
			
			$search_clause = '';
			$db = DB::get();
			if(!empty($moderation_states)){
				
				foreach($moderation_states as $key=>$val){
					
					if( ($key == "session_sscat") && (!empty($val)) ){
						if( (is_array($val)) && (count($val)>0) && ($val[0] != '' ) ) {
							
							$search_clause.=" AND  ( ";
								
							for($i=0;$i<count($val);$i++){
								$keysql = "";
								$keysql .= ($i == 0)?'':' OR ';
								$search_clause .=$keysql. ' modeles_idsscat = \''.$val[$i].'\'  ';
							}
							$search_clause.=" ) ";
							
						}	
					}
					
					$search_clause .= ( ($key == 'idsscat') && ($val != '') )?' AND modeles_idsscat = \''.$db->escape($val).'\'':'';
					$search_clause .= ( ($key == 'nom') && ($val != '') )?' AND modeles_nom LIKE \'%'.$db->escape($val).'%\'':'';
					$search_clause .= ( ($key == 'actif') && ($val != '') )?' AND modeles_actif LIKE \'%'.$db->escape($val).'%\'':'';
				}
			}
							
			$limit_sql = ( $limit == null)?'':' LIMIT '.$limit;
			
						
			$order_by = ($order == null)?' ORDER BY modeles_nom ASC':' ORDER BY modeles_'.$order.' ASC';
			
			
			$query = ' SELECT *  
					   FROM t_modeles 
					   WHERE modeles_supprime=\'0\' '.$search_clause.'
					    '.$order_by.' ';
			
			$result = $db->query($query);
			while($row = $db->fetch_assoc($result)){
				$items[] = new Modele($row['modeles_id']);
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
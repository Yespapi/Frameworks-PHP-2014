<?php

/**
 * usage:
 * $product_list = new ProduitList(array($my_product, $my_procduct2));
 * 
 * foreach($product_list as $key => $val) {
 *  	echo $key.' : '. $val->getCompulsoryCriteria().'<br/>';
 * }
 */

class ProduitImgList extends Lister {

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
			$search_clause = '';
			$db = DB::get();
			if(!empty($moderation_states)){
				
				foreach($moderation_states as $key=>$val){
					
					$search_clause .= ( ($key == 'idproduit') && ($val != '') )?' AND produits_img_idproduit = \''.$db->escape($val).'\'':'';
					$search_clause .= ( ($key == 'principale') && ($val != '') )?' AND produits_img_principale = \''.$db->escape($val).'\'':'';
				
				}
			}
							
			$limit_sql = ( $limit == null)?'':' LIMIT '.$limit;
			
			
			$query = '	SELECT produits_img_id
			   			FROM t_produits_img
   						WHERE produits_img_supprime = \'0\' ';
			$query .= $search_clause;
   			$query .= ' ORDER BY produits_img_id DESC';
	
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
			
			
			$search_clause = '';
			$db = DB::get();
		if(!empty($moderation_states)){
				
				foreach($moderation_states as $key=>$val){
					
					$search_clause .= ( ($key == 'idproduit') && ($val != '') )?' AND produits_img_idproduit = \''.$db->escape($val).'\'':'';
					$search_clause .= ( ($key == 'principale') && ($val != '') )?' AND produits_img_principale = \''.$db->escape($val).'\'':'';
				
				}
			}
							
			$limit_sql = ( $limit == null)?'':' LIMIT '.$limit;
			
						
			$order_by = ($order == null)?' ORDER BY produits_img_principale DESC, produits_img_id ASC ':' ORDER BY produits_img_'.$order.' ASC';
			
			
			$query = ' SELECT *  
					   FROM t_produits_img 
					   WHERE produits_img_supprime=\'0\' '.$search_clause.'
					    '.$order_by.' ';
			
			$result = $db->query($query);
			while($row = $db->fetch_assoc($result)){
				$items[] = new ProduitImg($row['produits_img_id']);
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
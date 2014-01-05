<?php

/**
 * usage:
 * $product_list = new ProduitList(array($my_product, $my_procduct2));
 * 
 * foreach($product_list as $key => $val) {
 *  	echo $key.' : '. $val->getCompulsoryCriteria().'<br/>';
 * }
 */

class CategorieList extends Lister {

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
			$db = DB::get();
   			$query = '	SELECT categories_id
			   			FROM t_categories
   						WHERE categories_supprime = \'0\' ';
   			$query .= ' AND categories_supprime=0
						ORDER BY categories_id DESC';
	
			$result = $db->query($query);
			return $db->num_rows($result);
		}
		catch (Exception $e) {
			 //echo $e->getMessage();
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
	public function getSearchResults($moderation_states = null){
		$items = array();
		
		
		try{
			$search_clause = ($moderation_states == null)?'':'';			
			$db = DB::get();
			$query = ' SELECT *  
					   FROM t_categories 
					   WHERE categories_supprime=\'0\'
					   '.$search_clause.'
					   ORDER BY categories_id ASC ';
			$result = $db->query($query);
			
			while($row = $db->fetch_assoc($result)){
				$items[] = new Categorie($row['categories_id']);
			}		
			$this->setItems($items);
			return $items;
		
		}
		catch (Exception $e) {
			 //echo $e->getMessage();
		}
		
		
	}
	
	
	
	
}
?>
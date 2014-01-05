<?php

/**
 * usage:
 * $product_list = new ProduitList(array($my_product, $my_procduct2));
 * 
 * foreach($product_list as $key => $val) {
 *  	echo $key.' : '. $val->getCompulsoryCriteria().'<br/>';
 * }
 */

class FaqList extends Lister {

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
			$db = DB::get();
			$search_clause = ($moderation_states == null)?'':'AND produits_questions_produit_id = \''.$moderation_states.'\' ';
   			$query = '	SELECT produits_questions_id
			   			FROM t_produits_questions
   						WHERE produits_questions_supprime = \'0\' ';
   			$query .= $search_clause.' ORDER BY produits_questions_id DESC';
	
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
	public function getSearchResults($moderation_states = null,$limit = null){
		$items = array();
		
		
		try{
			
			$limit_sql = ($limit == null)?'':' LIMIT '.$limit;
			
			$db = DB::get();
			$search_clause = ($moderation_states == null)?'':'AND produits_questions_produit_id = \''.$moderation_states.'\' ';
			$query = '	SELECT produits_questions_id
			   			FROM t_produits_questions
   						WHERE produits_questions_supprime = \'0\' ';
   			$query .= $search_clause.' ORDER BY produits_questions_id DESC';
			$query.=$limit_sql;
			$result = $db->query($query);
			//echo $query;
			while($row = $db->fetch_assoc($result)){
				$items[] = new Faq($row['produits_questions_id']);
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
<?php

/**
 * usage:
 * $product_list = new ProduitList(array($my_product, $my_procduct2));
 * 
 * foreach($product_list as $key => $val) {
 *  	echo $key.' : '. $val->getCompulsoryCriteria().'<br/>';
 * }
 */

class ClientList extends Lister {

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
				$all_items &= $product instanceof Client;
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
										
					$search_clause .= ( ($key == 'nom') && ($val != '') )?' AND comptes_nom LIKE \'%'.$db->escape($val).'%\'':'';
					$search_clause .= ( ($key == 'news') && ($val != '') )?' AND comptes_newsletter = \''.$db->escape($val).'\'':'';
					$search_clause .= ( ($key == 'part') && ($val != '') )?' AND comptes_newsletter3 = \''.$db->escape($val).'\'':'';
					$search_clause .= ( ($key == 'actif') && ($val != '') )?' AND comptes_actif = \''.$db->escape($val).'\'':'';
				}
			}
							
			$limit_sql = ( $limit == null)?'':' LIMIT '.$limit;
						
			$query = '	SELECT comptes_id
			   			FROM t_comptes
   						WHERE comptes_supprime = \'0\' ';
			$query .= 	$search_clause;
   			$query .= ' ORDER BY comptes_id DESC';
	
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
	 * Renvoie le nombre d'annonces correspondant &Agrave; cette liste
	 * 
	 * @return integer
	 */
	public function getListSize() {
		return sizeof($this->items);
	}
	
	
	/**
	 * Retourne la liste des clients
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
										
					$search_clause .= ( ($key == 'nom') && ($val != '') )?' AND comptes_nom LIKE \'%'.$db->escape($val).'%\'':'';
					$search_clause .= ( ($key == 'news') && ($val != '') )?' AND comptes_newsletter = \''.$db->escape($val).'\'':'';
					$search_clause .= ( ($key == 'part') && ($val != '') )?' AND comptes_newsletter2 = \''.$db->escape($val).'\'':'';
					$search_clause .= ( ($key == 'club') && ($val != '') )?' AND comptes_newsletter3 = \''.$db->escape($val).'\'':'';
					$search_clause .= ( ($key == 'actif') && ($val != '') )?' AND comptes_actif = \''.$db->escape($val).'\'':'';
				}
			}
							
			$limit_sql = ( $limit == null)?'':' LIMIT '.$limit;
									
			$order_by = ($order == null)?' ORDER BY comptes_nom ASC':' ORDER BY comptes_'.$order.' ASC';
			
			
			$query = ' SELECT *  
					   FROM t_comptes 
					   WHERE comptes_supprime=\'0\' 
					   AND ( comptes_newsletter = 1 OR comptes_newsletter2 = 1 OR comptes_newsletter3 = 1 ) 
					   '.$search_clause.'
					    '.$order_by.' ';
			
			$result = $db->query($query);
			while($row = $db->fetch_assoc($result)){
				$items[] = new Client($row['comptes_id']);
			}		
			$this->setItems($items);
			return $items;
		
		}
		catch (Exception $e) {
			 var_dump($e->getMessage());
		}
		
		
	}
	

}


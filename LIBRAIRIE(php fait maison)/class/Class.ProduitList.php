<?php

/**
 * usage:
 * $product_list = new ProduitList(array($my_product, $my_procduct2));
 * 
 * foreach($product_list as $key => $val) {
 *  	echo $key.' : '. $val->getCompulsoryCriteria().'<br/>';
 * }
 */

class ProduitList extends Lister {

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
     * Liste les produits par &eacute;tat de mod&eacute;ration (0: en attente, 1: en ligne, 2: refus&eacute;)
     * et pagination
     *
     * @access public
     * @param  array moderation_state
     * @param  integer compte_id
     */
	public function getTotalListSize($moderation_state = null,$limit = null) {
		try {
			$db = DB::get();
   			$join_clause = "";
   			$addsql = "";
		if(!is_null($moderation_state) && is_array($moderation_state)){
				foreach($moderation_state as $key=>$critere){
					
					if(($key == 'accueil') && ($critere != '') ){
						$addsql .= ' AND  produits_accueil = \''.$critere.'\'  ';
					}
					if(($key == 'idprod') && ($critere != '') ){
						$addsql .= ' AND  produits_id <> \''.$critere.'\'  ';
					}
					if(($key == 'categorie') && ($critere != '') ){
						$addsql .= ' AND  produits_idcat = \''.$critere.'\'  ';
					}
					
					if( ($key == 'session_categorie') ){ // Pour le front
						if( (is_array($critere)) && (count($critere)>0) ) {
							if($critere[0] != ''){
								$addsql.=" AND  ( ";
								
								for($i=0;$i<count($critere);$i++){
									$keysql = "";
									$keysql .= ($i == 0)?'':' OR '; //Remplacement du "OR" par le "AND"
									$addsql .=$keysql. '  produits_idcat = \''.$critere[$i].'\'  ';
								}
								$addsql.=" ) ";
							}
						}
						else{
							if($critere != ''){
								$addsql .= ' AND  produits_idcat = \''.$critere.'\'  ';
							}
						}
					}
					
					
					if( ($key == 'marque') && ($critere != '') ){
						$addsql .= ' AND produits_idmarque = \''.$critere.'\' ';
					}
					
					if( ($key == 'session_marque') && (!empty($critere)) ){ // Pour le front
						if( (is_array($critere)) && (count($critere)>0) ) {
							
							if($critere[0] != ''){
								$addsql.=" AND  ( ";
								
								for($i=0;$i<count($critere);$i++){
									$keysql = "";
									$keysql .= ($i == 0)?'':' OR '; //Remplacement du "OR" par le "AND"
									$addsql .=$keysql. '  produits_idmarque = \''.$critere[$i].'\'  ';
								}
								$addsql.=" ) ";
							}
						}
						else{
							if($critere != ''){
								$addsql .= ' AND  produits_idmarque = \''.$critere.'\'  ';
							}
						}
					}
					
					
					if( ($key == 'modele') && ($critere != '') ){
						$addsql .= ' AND produits_idmodele = \''.$critere.'\' ';
					}
					
					if( ($key == 'session_modele') && (!empty($critere)) ){ // Pour le front
						if( (is_array($critere)) && (count($critere)>0) ) {
							
							if($critere[0] != ''){
								$addsql.=" AND  ( ";
								
								for($i=0;$i<count($critere);$i++){
									$keysql = "";
									$keysql .= ($i == 0)?'':' OR '; //Remplacement du "OR" par le "AND"
									$addsql .=$keysql. '  produits_idmodele = \''.$critere[$i].'\'  ';
								}
								$addsql.=" ) ";
							}
						}
						else{
							if($critere != ''){
								$addsql .= ' AND  produits_idmodele = \''.$critere.'\'  ';
							}
						}
					}
					
					
					if( ($key == 'type') && ($critere != '') ){
						$addsql .= ' AND produits_idtype = \''.$critere.'\' ';
					}
					
					if( ($key == 'session_type')   ){ // Pour le front
						
						if( (is_array($critere)) && (count($critere)>0) ) {
							
							if($critere[0] != ''){
							
									$addsql.=" AND  ( ";
									
									for($i=0;$i<count($critere);$i++){
										$keysql = "";
										$keysql .= ($i == 0)?'':' OR '; //Remplacement du "OR" par le "AND"
										$addsql .=$keysql. '  produits_idtype = \''.$critere[$i].'\'  ';
									}
									$addsql.=" ) ";
							}
						}
						else{
							if($critere != ''){
								$addsql .= ' AND  produits_idtype = \''.$critere.'\'  ';
							}
						}
					}
					
					//Add of year
					
					if( ($key == 'year') && ($critere != '') ){
						$addsql .= ' AND produits_idyear = \''.$critere.'\' ';
					}
					
					if( ($key == 'session_year')   ){ // Pour le front
						
						if( (is_array($critere)) && (count($critere)>0) ) {
							
							if($critere[0] != ''){
							
									$addsql.=" AND  ( ";
									
									for($i=0;$i<count($critere);$i++){
										$keysql = "";
										$keysql .= ($i == 0)?'':' OR '; //Remplacement du "OR" par le "AND"
										$addsql .=$keysql. '  produits_idyear = \''.$critere[$i].'\'  ';
									}
									$addsql.=" ) ";
							}
						}
						else{
							if($critere != ''){
								$addsql .= ' AND  produits_idyear = \''.$critere.'\'  ';
							}
						}
					}
					
					//End of year
					
					if( ($key == 'promotion') && ($critere != '') ){
						$addsql .= ' AND  produits_promotion = \''.$critere.'\' ';
					}
					if( ($key == 'statut') && ($critere != '') ){
						$addsql .= ' AND produits_statut = \''.$critere.'\' ';
					}
					
					if( ($key == 'motorisation') && ($critere != '') ){
						$addsql .= ' AND  produits_idmotorisation = \''.$critere.'\' ';
					}
					
					if( ($key == 'session_motorisation') && (!empty($critere)) ){ // Pour le front
						if( (is_array($critere)) && (count($critere)>0) ) {
							if($critere[0] != ''){
								$addsql.=" AND  ( ";
								
								for($i=0;$i<count($critere);$i++){
									$keysql = "";
									$keysql .= ($i == 0)?'':' OR '; //Remplacement du "OR" par le "AND"
									$addsql .=$keysql. '  produits_idmotorisation = \''.$critere[$i].'\'  ';
								}
								$addsql.=" ) ";
							}
						}
						else{
							if($critere != ''){
								$addsql .= ' AND  produits_idmotorisation = \''.$critere.'\'  ';
							}
						}
					
					}
					
					
					if( ($key == 'session_prix1') && ($critere != '') ){ // Pour le front
						
						if( (is_array($critere)) && (count($critere)>0) ) {
							
							if($critere[0] != ''){
								$addsql .= ' AND  produits_prix >= \''.$critere[0].'\' ';
							}
						}
					}
					
					if( ($key == 'session_prix2') && ($critere != '') ){ // Pour le front
						
						if( (is_array($critere)) && (count($critere)>0) ) {
							
							if($critere[0] != ''){
								$addsql .= ' AND  produits_prix <= \''.$critere[0].'\' ';
							}
						}
					}
					
					if( ($key == 'session_miles1') && ($critere != '') ){ // Pour le front
						
						if( (is_array($critere)) && (count($critere)>0) ) {
							
							if($critere[0] != ''){
								$addsql .= ' AND  produits_miles >= \''.$critere[0].'\' ';
							}
						}
					}
					
					if( ($key == 'session_miles2') && ($critere != '') ){ // Pour le front
						
						if( (is_array($critere)) && (count($critere)>0) ) {
							
							if($critere[0] != ''){
								$addsql .= ' AND  produits_miles <= \''.$critere[0].'\' ';
							}
						}
					}
					
					if( ($key == 'session_promotion') && ($critere != '') ){ // Pour le front
						
						if( (is_array($critere)) && (count($critere)>0) ) {
							
							if($critere[0] != ''){
								$addsql .= ' AND  produits_promotion = \''.$critere[0].'\' ';
							}
						}
					}
					
					
					if( ($key == 'etat') && ($critere != '') ){
						$addsql .= ' AND  produits_etat = \''.$critere.'\' ';
					}
					if( ($key == 'key_search') && ($critere != '') ){
						$addsql .= ' AND  ( produits_nom LIKE  \'%'.$critere.'%\' OR produits_desc LIKE \'%'.$critere.'%\' OR produits_fichtech LIKE \'%'.$critere.'%\'  ) ';
					}
					
					if( ($key == 'session_key') && ($critere != '') ){ // Pour le front
						
						if( (is_array($critere)) && (count($critere)>0) ) {
							
							if($critere[0] != ''){
								$join_clause .= ' LEFT JOIN t_modeles ON (modeles_id = produits_idmodele) ';
								$join_clause .= ' LEFT JOIN t_sscategories ON (sscategories_id = produits_idmarque ) ';
								//add of year
								$join_clause .= ' LEFT JOIN t_year ON (year_id = produits_idyear ) ';
								//End of year
								$addsql .= ' AND  ( produits_description LIKE \'%'.$db->escape($critere[0]).'%\' ';
								$addsql .= ' OR  produits_fichtech LIKE \'%'.$db->escape($critere[0]).'%\' ';
								$addsql .= ' OR  produits_couleur LIKE \'%'.$db->escape($critere[0]).'%\' ';
								$addsql .= ' OR  modeles_nom LIKE \'%'.$db->escape($critere[0]).'%\' ';
								$addsql .= ' OR  sscategories_nom LIKE \'%'.$db->escape($critere[0]).'%\' ';//sscategories_nom
								$addsql .= ' ) ';
							}
						}
					}
					
					
				}
			}
			
			$limit_clause = ($limit == null)?'':' LIMIT '.$limit;
			$query = '	SELECT produits_id
			   			FROM t_produits '.$join_clause.'
   						WHERE produits_supprime = \'0\' ';
   			$query .= $addsql;
   			$query .= ' ORDER BY produits_id DESC '.$limit_clause;
			//echo $query;
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
	public function getSearchResults($moderation_state = null, $tri = null, $nb_page = null,$limit = null){
		$items = array();
		try{
			
			$join_clause	= '';
			$search_clause 	= '';
			$group_clause	= '';
			$db = DB::get();
			if(!is_null($moderation_state) && is_array($moderation_state)){
				foreach($moderation_state as $key=>$critere){
					
					if(($key == 'accueil') && ($critere != '') ){
						$addsql .= ' AND  produits_accueil = \''.$critere.'\'  ';
					}
					if(($key == 'idprod') && ($critere != '') ){
						$addsql .= ' AND  produits_id <> \''.$critere.'\'  ';
					}
					if(($key == 'categorie') && ($critere != '') ){
						$addsql .= ' AND  produits_idcat = \''.$critere.'\'  ';
					}
					
					if( ($key == 'session_categorie') ){ // Pour le front
						
						//InsertTest('key : '.$key.' - critere : '.$critere);
						if( (is_array($critere)) && (count($critere)>0) ) {
							if($critere[0] != ''){
								$addsql.=" AND  ( ";
								
								for($i=0;$i<count($critere);$i++){
									$keysql = "";
									$keysql .= ($i == 0)?'':' OR '; //Remplacement du "OR" par le "AND"
									$addsql .=$keysql. '  produits_idcat = \''.$critere[$i].'\'  ';
								}
								$addsql.=" ) ";
							}
						}
						else{
							if($critere != ''){
								$addsql .= ' AND  produits_idcat = \''.$critere.'\'  ';
							}
						}
					}
					
					
					if( ($key == 'marque') && ($critere != '') ){
						$addsql .= ' AND produits_idmarque = \''.$critere.'\' ';
					}
					
					if( ($key == 'session_marque') && (!empty($critere)) ){ // Pour le front
						if( (is_array($critere)) && (count($critere)>0) ) {
							
							if($critere[0] != ''){
								$addsql.=" AND  ( ";
								
								for($i=0;$i<count($critere);$i++){
									$keysql = "";
									$keysql .= ($i == 0)?'':' OR  '; //Remplacement du "OR" par le "AND"
									$addsql .=$keysql. '  produits_idmarque = \''.$critere[$i].'\'  ';
								}
								$addsql.=" ) ";
							}
						}
						else{
							if($critere != ''){
								$addsql .= ' AND  produits_idmarque = \''.$critere.'\'  ';
							}
						}
					}
					
					
					if( ($key == 'modele') && ($critere != '') ){
						$addsql .= ' AND produits_idmodele = \''.$critere.'\' ';
					}
					
					if( ($key == 'session_modele') && (!empty($critere)) ){ // Pour le front
						if( (is_array($critere)) && (count($critere)>0) ) {
							
							if($critere[0] != ''){
								$addsql.=" AND  ( ";
								
								for($i=0;$i<count($critere);$i++){
									$keysql = "";
									$keysql .= ($i == 0)?'':' OR '; //Remplacement du "OR" par le "AND"
									$addsql .=$keysql. '  produits_idmodele = \''.$critere[$i].'\'  ';
								}
								$addsql.=" ) ";
							}
						}
						else{
							if($critere != ''){
								$addsql .= ' AND  produits_idmodele = \''.$critere.'\'  ';
							}
						}
					}
					
					if( ($key == 'type') && ($critere != '') ){
						$addsql .= ' AND produits_idtype = \''.$critere.'\' ';
					}
					
					if( ($key == 'session_type')   ){ // Pour le front
						
						if( (is_array($critere)) && (count($critere)>0) ) {
							
							if($critere[0] != ''){
							
									$addsql.=" AND  ( ";
									
									for($i=0;$i<count($critere);$i++){
										$keysql = "";
										$keysql .= ($i == 0)?'':' OR '; //Remplacement du "OR" par le "AND"
										$addsql .=$keysql. '  produits_idtype = \''.$critere[$i].'\'  ';
									}
									$addsql.=" ) ";
							}
						}
						else{
							if($critere != ''){
								$addsql .= ' AND  produits_idtype = \''.$critere.'\'  ';
							}
						}
					}
					
					//Add of year
					
					if( ($key == 'year') && ($critere != '') ){
						$addsql .= ' AND produits_idyear = \''.$critere.'\' ';
					}
					
					if( ($key == 'session_year')   ){ // Pour le front
						
						if( (is_array($critere)) && (count($critere)>0) ) {
							
							if($critere[0] != ''){
							
									$addsql.=" AND  ( ";
									
									for($i=0;$i<count($critere);$i++){
										$keysql = "";
										$keysql .= ($i == 0)?'':' OR '; //Remplacement du "OR" par le "AND"
										$addsql .=$keysql. '  produits_idyear = \''.$critere[$i].'\'  ';
									}
									$addsql.=" ) ";
							}
						}
						else{
							if($critere != ''){
								$addsql .= ' AND  produits_idyear = \''.$critere.'\'  ';
							}
						}
					}
					
					//End of year
					
					if( ($key == 'promotion') && ($critere != '') ){
						$addsql .= ' AND  produits_promotion = \''.$critere.'\' ';
					}
					if( ($key == 'statut') && ($critere != '') ){
						$addsql .= ' AND produits_statut = \''.$critere.'\' ';
					}
					
					if( ($key == 'motorisation') && ($critere != '') ){
						$addsql .= ' AND  produits_idmotorisation = \''.$critere.'\' ';
					}
					
					if( ($key == 'session_motorisation') && (!empty($critere)) ){ // Pour le front
						if( (is_array($critere)) && (count($critere)>0) ) {
							if($critere[0] != ''){
								$addsql.=" AND  ( ";
								
								for($i=0;$i<count($critere);$i++){
									$keysql = "";
									$keysql .= ($i == 0)?'':' OR '; //Remplacement du "OR" par le "AND"
									$addsql .=$keysql. '  produits_idmotorisation = \''.$critere[$i].'\'  ';
								}
								$addsql.=" ) ";
							}
						}
						else{
							if($critere != ''){
								$addsql .= ' AND  produits_idmotorisation = \''.$critere.'\'  ';
							}
						}
					
					}
					
					
					if( ($key == 'session_prix1') && ($critere != '') ){ // Pour le front
						
						if( (is_array($critere)) && (count($critere)>0) ) {
							
							if($critere[0] != ''){
								$addsql .= ' AND  produits_prix >= \''.$critere[0].'\' ';
							}
						}
					}
					
					if( ($key == 'session_prix2') && ($critere != '') ){ // Pour le front
						
						if( (is_array($critere)) && (count($critere)>0) ) {
							
							if($critere[0] != ''){
								$addsql .= ' AND  produits_prix <= \''.$critere[0].'\' ';
							}
						}
					}
					
					
					if( ($key == 'session_miles1') && ($critere != '') ){ // Pour le front
						
						if( (is_array($critere)) && (count($critere)>0) ) {
							
							if($critere[0] != ''){
								$addsql .= ' AND  produits_miles >= \''.$critere[0].'\' ';
							}
						}
					}
					
					if( ($key == 'session_miles2') && ($critere != '') ){ // Pour le front
						
						if( (is_array($critere)) && (count($critere)>0) ) {
							
							if($critere[0] != ''){
								$addsql .= ' AND  produits_miles <= \''.$critere[0].'\' ';
							}
						}
					}
					
					if( ($key == 'session_promotion') && ($critere != '') ){ // Pour le front
						
						if( (is_array($critere)) && (count($critere)>0) ) {
							
							if($critere[0] != ''){
								$addsql .= ' AND  produits_promotion = \''.$critere[0].'\' ';
							}
						}
					}
					
					
					if( ($key == 'etat') && ($critere != '') ){
						$addsql .= ' AND  produits_etat = \''.$critere.'\' ';
					}
					if( ($key == 'key_search') && ($critere != '') ){
						$addsql .= ' AND  ( produits_nom LIKE  \'%'.$critere.'%\' OR produits_desc LIKE \'%'.$critere.'%\' OR produits_fichtech LIKE \'%'.$critere.'%\'  ) ';
					}
					
					if( ($key == 'session_key') && ($critere != '') ){ // Pour le front
						
						if( (is_array($critere)) && (count($critere)>0) ) {
							
							if($critere[0] != ''){
								$join_clause .= ' LEFT JOIN t_modeles ON (modeles_id = produits_idmodele) ';
								$join_clause .= ' LEFT JOIN t_sscategories ON (sscategories_id = produits_idmarque ) ';
								//add year
								$join_clause .= ' LEFT JOIN t_year ON (year_id = produits_idyear) ';
								//end year
								$addsql .= ' AND  ( produits_description LIKE \'%'.$db->escape($critere[0]).'%\' ';
								$addsql .= ' OR  produits_fichtech LIKE \'%'.$db->escape($critere[0]).'%\' ';
								$addsql .= ' OR  produits_couleur LIKE \'%'.$db->escape($critere[0]).'%\' ';
								$addsql .= ' OR  modeles_nom LIKE \'%'.$db->escape($critere[0]).'%\' ';
								$addsql .= ' OR  sscategories_nom LIKE \'%'.$db->escape($critere[0]).'%\' ';//sscategories_nom
								$addsql .= ' ) ';
							}
						}
					}
					
					
				}
			}
			
			$cpt_tri = 0;
			if(!empty($tri)){
				foreach($tri as $v){
					if($v != ''){
						$cpt_tri++;
					}
				}
			}
			
			
			$order_by = ' ORDER BY ';
			// Gestion du tri
			if( (!is_null($tri)) && (is_array($tri)) && ($cpt_tri > 0)){
				$cpt = 0;
				foreach($tri as $cle_tri=>$sens){
					if($sens != ''){
						if($cpt>0){
							$order_by .=',';
						}
						
						$order_by .= 'produits_'.$cle_tri. ' '.$sens;					 
					
						$cpt++;
					}
				}
			}
			else{
				$order_by .= 'produits_prix ASC';
			}		
			$limit_clause = ($limit == null)?'':' LIMIT '.$limit;
			$query = ' SELECT *  
					   FROM t_produits '.$join_clause.'
					   WHERE produits_supprime=\'0\' 
					   '.$addsql.' 
					   '.$group_clause.'
					   '.$order_by;
			//InsertTest($query);   
			if($limit_clause!=""){
				$query.=$limit_clause;
			} else {
			if (!is_null($nb_page)) {
				$query .= ' LIMIT ' . $_SESSION['nbparpage'] . ' OFFSET ' . (($nb_page - 1) * $_SESSION['nbparpage']);
			}	
			}
			
			$result = $db->query($query);
			//echo $query;
			while($row = $db->fetch_assoc($result)){
				$items[] = new Produit($row['produits_id']);
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
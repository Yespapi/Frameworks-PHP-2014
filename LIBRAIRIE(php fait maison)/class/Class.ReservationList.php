<?php

/**
 * usage:
 * $product_list = new reservationList(array($my_product, $my_procduct2));
 * 
 * foreach($product_list as $key => $val) {
 *  	echo $key.' : '. $val->getCompulsoryCriteria().'<br/>';
 * }
 */

class ReservationList extends Lister
{

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
     * 	- ou &Agrave; partir d'un tableau d'objets reservation
     *
     * @access public
     * @param  reservationarray of Item objects
     */
    public function __construct($items = null)
    {
        $all_items = true;
        if (!is_null($items)) {
            // each element must be an Ad object
            foreach ($items as $product) {
                $all_items &= $product instanceof Reservation;
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
    public function getTotalListSize($moderation_states = null)
    {
        try {
            $db = DB::get();
            $query = '	SELECT reservation_id
			   			FROM t_reservation
   						WHERE reservation_supprime = \'0\' ';

            if (!is_null($moderation_states))
                $query .= $moderation_states;

            $query .= ' ORDER BY reservation_id DESC';
            
           // echo $query;
           

            $result = $db->query($query);
            return $db->num_rows($result);
        }
        catch (exception $e) {
            //echo $e->getMessage();
        }
    }

    /**
     * Permet de setter les menus en dehors du constructeur
     *
     * @access public
     * @param  items array of Item objects
     */
    public function setItems($items)
    {
        $all_items = true;
        foreach ($items as $product) {
            $all_items &= $product instanceof Reservation;
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
    public function getListSize()
    {
        return sizeof($this->items);
    }


    /**
     * Retourne les formules associ&Eacute;es &Agrave; la cat&Eacute;gorie pass&Eacute;e en param&Egrave;tre
     * 
     * @access public
     * @param integer cat
     * @return array
     */
    public function getSearchResults($moderation_states = null,$limit=null)
    {
        $items = array();


        try {

            $db = DB::get();
            
            if(!is_null($limit))
                $limit_clause = ' LIMIT '.$limit;
                
            $query = ' SELECT *  
					   FROM t_reservation
					   WHERE reservation_supprime=\'0\'';
                       
            if (!is_null($moderation_states))
                $query .= $moderation_states;
                
            $query .= ' ORDER BY reservation_id DESC '.$limit_clause;
            
        
           // echo $query;
            
            $result = $db->query($query);

            while ($row = $db->fetch_assoc($result)) {
                $items[] = new Reservation($row['reservation_id']);
            }
            $this->setItems($items);
            return $items;

        }
        catch (exception $e) {
            //echo $e->getMessage();
        }


    }


}
?>
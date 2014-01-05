<?php

/**
 * usage:
 * 
 * $lister1 = new Lister(array('maison', 'apt', 'studio'));
 * 
 * while ($lister1->valid()) {
 *     $currentElement = $lister1->current();
 *     echo "fichier trouve: ".$lister1->key()." => ".$currentElement."<br>";
 *     $lister1->next();
 * } 
 *    
 * foreach($lister1 as $key => $val) {
 * 	echo $key,' : ',$val, '<br/>';
 * }
 */
 
/**
 * Permet l'utilisation de la boucle foreach
 *
 * @access public
 * @author Alexis Ulrich <alexis@arpedia.com>
 */
class Lister implements Iterator {

    /**
     * Short description of attribute n
     *
     * @access protected
     * @var Integer
     */
    protected $n = 0;

    /**
     * Short description of attribute collection
     *
     * @access private
     * @var Array
     */
    private $collection = array();

    // --- OPERATIONS ---

    /**
     * Short description of method __construct
     *
     * @access public
     * @param  collection array
     * @return mixed
     */
    public function __construct($collection)
    {
        $this->collection = $collection;
    }

    /**
     * Short description of method setCollection
     *
     * @access public
     * @param  collection array
     * @return mixed
     */
	public function setCollection($collection,$test="") {
		$this->collection = $collection;
		if($test==1)
			print_r($this->collection);
	}

    /**
     * Short description of method rewind
     *
     * @access public
     * @return void
     */
    public function rewind()
    {
         $this->n = 0;
    }

    /**
     * Short description of method key
     *
     * @access public
     * @return void
     */
    public function key()
    {
        return $this->n+1;
    }

    /**
     * Short description of method current
     *
     * @access public
     * @return void
     */
    public function current()
    {
        return $this->collection[$this->n];
    }

    /**
     * Short description of method next
     *
     * @access public
     * @return void
     */
    public function next()
    {
    	$this->n++;
    	if($this->valid()) return $this->collection[$this->n];
    }

    /**
     * Short description of method valid
     *
     * @access public
     * @return Boolean
     */
    public function valid()
    {
        return ($this->n < sizeof($this->collection));
    }

	
	/**
	 * Donne le rang de l'item dans la liste (commence &Agrave; 1)
	 * 
	 * @param integer $id item identifier in DB
	 * @return integer
	 */
	public function getItemRank($id) {
		foreach ($this->collection as $rank => $item) {
			if ($item->getId() == $id) {
				return ($rank + 1);
			}
		}
		return 0;
	}
	
	/**
	 * Renvoie l'identifiant de l'item pr&Eacute;c&Eacute;dent l'item donn&Eacute; dans la liste
	 * en fonction de son rang
	 * renvoie null si pas d'item pr&Eacute;c&Eacute;dent
	 * 
	 * @param integer $item_rank	rang de l'item dans la liste (commence &Agrave; 1)
	 * @return FeedItem
	 */
	public function getPreviousItemId($item_rank) {
		if (isset($this->collection[$item_rank-2])) {
			$previous_item = $this->collection[$item_rank-2];
			return $previous_item->getId();
		}
		else {
			return null;
		}
	}
	
	/**
	 * Renvoie l'identifiant de l'item suivant l'item donn&Eacute; dans la liste
	 * en fonction de son rang
	 * renvoie null si pas d'item suivant
	 * 
	 * @param integer $item_rank	rang de l'item dans la liste (commence &Agrave; 1)
	 * @return FeedItem
	 */
	public function getNextItemId($item_rank) {
		if (isset($this->collection[$item_rank])) {
			$next_item = $this->collection[$item_rank];
			return $next_item->getId();
		}
		else {
			return null;
		}
	}

} /* end of class List */

?>
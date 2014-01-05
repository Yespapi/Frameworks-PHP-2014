<?php
/**
 *	Singleton for DB connection
 *
 * @access public
 * @author Alexis Ulrich <alexis@arpedia.com>
 */
/**
 * usage:
try {
	$db = DB::get();
	$queries = array();
	$result = $db->query($query);
	$row = $db->fetch_row($result);
}
catch (Exception $e) {
	 echo $e->getMessage();
}
*/
class DB {
	
	static private $instance = null;
	private $connection;
	private $db;
	private $server;
	private $username;
	private $password;
	
	static public function get() {
		if (self::$instance == null){
			self::$instance = new self();
		}
		return self::$instance;
	}
	
	private function __construct(){
		$this->server   = $GLOBALS['_data_']['DB']['server'];
		$this->username = $GLOBALS['_data_']['DB']['username'];
		$this->password = $GLOBALS['_data_']['DB']['password'];

		if (!($this->connection = mysql_connect($this->server, $this->username, $this->password))) {
			//throw new Exception(mysql_error());
			throw new Exception('Erreur de connexion &Agrave; la base de donn&Eacute;es');
			exit();
		}
		if (!($this->db = mysql_select_db($GLOBALS['_data_']['DB']['database']))) {
			//throw new Exception(mysql_error());
			throw new Exception('Erreur lors de la s&Eacute;lection de la base de donn&Eacute;es');
			exit();
		}
	}
	
	public function query($sql) {
		return mysql_query($sql, $this->connection);
	}
	
	public function fetch_assoc($result) {
		return mysql_fetch_assoc($result);
	}
	public function fetch_array($result) {
		return mysql_fetch_array($result);
	}
	
	public function fetch_row($result) {
		return mysql_fetch_row($result);
	}
	
	public function fetch_object($result) {
		return mysql_fetch_object($result);
	}
	
	public function last_insert_id() {
		return mysql_insert_id();
	}
	
	public function num_rows($result) {
		return mysql_num_rows($result);
	}
	
	public function affected_rows() {
		return mysql_affected_rows();
	}
	
	public function escape($str){
		return mysql_real_escape_string($str, $this->connection);
	}
	
	
	/**
	 * V&Eacute;rifie que la date correspond bien au type date d&Eacute;fini dans la base de donn&Eacute;e
	 * Ici le format est AAAA-MM-JJ
	 * 
	 * @access public
	 * @return date
	 */
	public function datedb($date){
		if(eregi('-',$date)) // La date est s&Eacute;par&Eacute; par un '-'
			$tab = explode('-',$date);
		
		elseif(eregi('/',$date)) // La date est s&Eacute;par&Eacute; par un '/'
			$tab = explode('/',$date);
					
			if(	(strlen($tab[2])==4) && (is_numeric($tab[2])) ) // la date est du type JJ-MM-AAAA
				return $tab[2].'-'.$tab[1].'-'.$tab[0]; // On inverse le jour et l'ann&Eacute;e
			else
				return $date; // La date est d&Eacute;j&Agrave; au bon format		
	
	}
	
	/**
	 * Retourne la date version JJ/MM/AAAA
	 * 
	 * @access public
	 * @return date
	 */
	public function inversedatedb($date){
		if(eregi('-',$date)) // La date est s&Eacute;par&Eacute; par un '-'
			$tab = explode('-',$date);
		
		elseif(eregi('/',$date)) // La date est s&Eacute;par&Eacute; par un '/'
			$tab = explode('/',$date);

		if(	(strlen($tab[0])==4) && (is_numeric($tab[2])) ) // la date est du type JJ-MM-AAAA
				return $tab[2].'/'.$tab[1].'/'.$tab[0]; // On inverse le jour et l'ann&Eacute;e
			else
				return $date; // La date est d&Eacute;j&Agrave; au bon format		
	}
	
	function __destruct() {}

}

?>

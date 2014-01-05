<?php

class TauxChange{
	
	/**
	 * Valeur du taux de change
	 * @var decimal
	 */
	private $taux;
	
	
	public function __construct(){
		try{
			$db = DB::get();
			$sql = 'SELECT tauxchange_nom 
					FROM t_tauxchange 
					LIMIT 1';
			$result = $db->query($sql);
			$row = $db->fetch_assoc($result);
			$this->taux = $row['tauxchange_nom'];
		}
		catch(Exception $e){}
	}
	
	public function update(){
		try{
			$db = DB::get();
			$sql = 'UPDATE t_tauxchange  
					SET tauxchange_nom = \''.$this->taux.'\' 
					LIMIT 1';
			$result = $db->query($sql);
		}
		catch(Exception $e){}
	}
	
	public function getTaux(){
		return $this->taux;
	}
	
	public function setTaux($taux){
		$this->taux = $taux;
	}
	
}
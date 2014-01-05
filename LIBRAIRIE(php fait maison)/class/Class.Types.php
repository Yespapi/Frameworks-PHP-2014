<?php
class Types{
	
	
	private $id;
	
	private $nom;
	
	
	public function __construct($id){
		
		try{
			$db = DB::get();
			$sql = 'SELECT * 
					FROM t_types  
					WHERE types_id = \''.$id.'\'  
					LIMIT 1';
			$result = $db->query($sql);
			$row = $db->fetch_assoc($result);
			$this->id 	= $row['types_id'];
			$this->nom	=	$row['types_nom'];
			
		}
		catch(Exception $e){
			var_dump($e->getMessage());
		}
	}
	
	public function getId(){
		return $this->id;
	}
	
	public function getNom(){
		return $this->nom;
	}
	
}
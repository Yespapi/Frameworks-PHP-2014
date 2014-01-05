<?php

class Faq{
	
	/**
	 * Identifiant unique de la question/r&Eacute;ponse
	 * @access private
	 * @var integer
	 */
	private $id;
	
	/**
	 * Identifiant du produit associ&Eacute; &Agrave; la question
	 * @access private
	 * @var varchar
	 */
	private $idproduit;
	
	/**
	 * Question de la faq
	 * @access private
	 * @var varchar
	 */
	private $question;
	
	/**
	 * R&Eacute;ponse &Agrave; la question
	 * @access private
	 * @var text
	 */
	private $reponse;
	
	
	/**
	 * Retourne l'identifiant de la question
	 * @access public
	 * @return integer
	 */
	public function getId(){
		return $this->id;
	}
	
	/**
	 * Retourne l'identifiant du produit associ&Eacute; &Agrave; la question
	 * @access public
	 * @return varchar
	 */
	public function getIdProduit(){
		return $this->idproduit;
	}
	
	/**
	 * Retourne la question
	 * @access public
	 * @return varchar
	 */
	public function getQuestion(){
		return $this->question;
	}
	
	/**
	 * Retourne la r&Eacute;ponse
	 * @access public
	 * @return text
	 */
	public function getReponse(){
		return $this->reponse;
	}
	
	
	public function __construct($id){
		
		try{
			
			$db = DB::get();
			$sql = "SELECT * 
					FROM t_produits_questions 
					WHERE produits_questions_id = '$id' 
					AND produits_questions_supprime = '0' ";
			$result = $db->query($sql);
			while($row = $db->fetch_assoc($result)){
				
				$this->id			= 	$row['produits_questions_id'];
				$this->idproduit	= 	$row['produits_questions_produit_id'];
				$this->question		=	$row['produits_questions_questions'];
				$this->reponse 		=	$row['produits_questions_reponse'];
				
			}		
			
		}
		catch(Exception $e){}
	}
	
}
 
?>

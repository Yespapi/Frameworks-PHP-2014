<?php
/*
 * Created on 9 juil. 07
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
class LiverCrypt{
	
		var $CLE_CRYPT="klf9+8hfmzr.fkv64321s5df";	//Cl&Eacute; de cryptage &Agrave; modifier sur chaque site
	
		//function getCle(){return LiverCrypt::$this->CLE_CRYPT;}
		
		function GenerationCle($Texte,$CleDEncryptage)
		  {
		  $CleDEncryptage = md5($CleDEncryptage);
		  $Compteur=0;
		  $VariableTemp = "";
		  for ($Ctr=0;$Ctr<strlen($Texte);$Ctr++)
		    {
		    if ($Compteur==strlen($CleDEncryptage))
		      $Compteur=0;
		    $VariableTemp.= substr($Texte,$Ctr,1) ^ substr($CleDEncryptage,$Compteur,1);
		    $Compteur++;
		    }
		  return $VariableTemp;
		  }

		function Crypte($Texte)
		  {
		  //$Cle=$this->Cle_crypt;
		  srand((double)microtime()*1000000);
		  $CleDEncryptage = md5(rand(0,32000) );
		  $Compteur=0;
		  $VariableTemp = "";
		  for ($Ctr=0;$Ctr<strlen($Texte);$Ctr++)
		    {
		    if ($Compteur==strlen($CleDEncryptage))
		      $Compteur=0;
		    $VariableTemp.= substr($CleDEncryptage,$Compteur,1).(substr($Texte,$Ctr,1) ^ substr($CleDEncryptage,$Compteur,1) );
		    $Compteur++;
		    }
		  return base64_encode(LiverCrypt::GenerationCle($VariableTemp,"klf9+8hfmzr.fkv64321s5df") );
		  }

		function Decrypte($Texte)
		  {
		   //$Cle=$this->Cle_crypt;
		  $Texte = LiverCrypt::GenerationCle(base64_decode($Texte),"klf9+8hfmzr.fkv64321s5df");//Penser &Agrave; modifier la valeur ici aussi
		  $VariableTemp = "";
		  for ($Ctr=0;$Ctr<strlen($Texte);$Ctr++)
		    {
		    $md5 = substr($Texte,$Ctr,1);
		    $Ctr++;
		    $VariableTemp.= (substr($Texte,$Ctr,1) ^ $md5);
		    }
		  return $VariableTemp;
		  } 
	
	
}

?>

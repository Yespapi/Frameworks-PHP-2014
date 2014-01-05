<?php
class IControl
	{
		
		
	function renvoi_var(){
		
		foreach($_POST as $cle=>$element){
		$CORPS.=$cle." : ".$element." <br />";
		}
		
		return $CORPS;
	}	
	
	function verifChamp ($nom_base,$nom_champ,$email)
	{
		$REQ="SELECT * FROM ".$nom_base." WHERE ".$nom_champ." =\"".$email."\" ";
		if($REQ_EXEC=mysql_query($REQ)){
			if(mysql_num_rows($REQ_EXEC)==0){return true;}
			else{return false;}	
		}
	
	}
	
	 function checkMail ($email)
	{
		
		if (eregi('^[_a-z0-9-]+(.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)+$',$email)) 
    			{$tampons=split("@",$email);
    			 if (count($tampons) == 2)
    			 	{return true;}
    			 else
    			 	{return false;}
    			}
    	 else
    			{return false;}
	}

	 function checkCreerMail ($email)
	{
		
		if (eregi('^[_a-z0-9-]+(.[_a-z0-9-]+)+@(wineasapmarket.com)$',$email)) 
    			{return true;}
    			 else
    			 	{return false;}
    }

	function check_seq ($seq,$taille)
			{if (ereg('^([0-9]{'.$taille.'})$',$seq))
				{return true;}
			 else
				{return false;}
			}
	function check_couvert($seq)
			{if (ereg('^([0-9]{1,3})$',$seq))
				{return true;}
			 else
				{return false;}
			}
	function checkString($nom)
		{$test_nom=eregi('^[^]+*}{#|\$!"\'?\/^]+[[:alnum:]]*[^]+*}{#|\$!"\'?\/^]*[[:alnum:]]*[^]+*}{#|\$!"\'?\/^]+$',$nom);
		 if ($test_nom)
			{return true;}
		else
			{return false;}
	}
/*	function checkCar($nom)
		{
		$apos=chr(39);	
		$test_nom=eregi("^(([[:alpha:]]|$apos|\'|'|&Eacute;|&Egrave;|&Agrave;)([[:blank:]]*))+$",$nom);
		 if ($test_nom)
			{return true;}
		else
			{return false;}
	}*/
	function checkCar($nom)
		{
		
		$test_nom=eregi("[^\d]",$nom);
		 if ($test_nom)
			{return true;}
		else
			{return false;}
	}
	function checkInt($numero)
		{$test_numero=is_Numeric($numero);
		 if ($test_numero)
			{return true;}
		else
			{return false;}
	}
	function check_date($date)
		{list( $day, $month, $year ) = split( '[/.-]', $date );
		 return checkdate($month,$day,$year);
		}

	function ConvertDateEnFr($DateUS)
		{$Date=split("[/.-]",$DateUS);
         $Date2=$Date[2]."/".$Date[1]."/".$Date[0];
         return $Date2;
		}

	function ConvertDateEnUs($DateFR)
		{$Date=split("[/.-]",$DateFR);
	     $Date2=$Date[2]."-".$Date[1]."-".$Date[0];
         return $Date2;
		}
	
	function CompareDates($Date1, $Date2)
		{$Tab_Date1=split("[/.-]",$Date1);
	     $D1=mktime(0 , 0 , 0 , $Tab_Date1[1] , $Tab_Date1[0] , $Tab_Date1[2]);
         $Tab_Date2=split("[/.-]",$Date2);
         $D2=mktime(0 , 0 , 0 , $Tab_Date2[1] , $Tab_Date2[0] , $Tab_Date2[2]);
         if ($D1<$D2)
        	return TRUE;
         else
    	  	return FALSE;
		 }

	}
?>

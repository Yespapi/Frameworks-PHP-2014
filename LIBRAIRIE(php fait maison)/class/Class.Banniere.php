<?php

class Banniere
{

    public $Id;
    public $IdTypeban;
    public $Nom;
    public $Img;
    public $Url;
    public $Datedeb;
    public $DateFin;


    protected function set()
    {
        try{
	    	$db = DB::get();
        	$Req = "SELECT * FROM t_bannieres WHERE bannieres_id = '" . $this->Id . "' ";
	        $Exec = $db->query($Req);
	        $Item = $db->fetch_object($Exec);
	        $this->Nom = stripslashes($Item->bannieres_nom);
	        $this->IdTypeban = $Item->bannieres_idtypesbans;
	        $this->Img = $Item->bannieres_img;
	        $this->Url = $Item->bannieres_url;
	        $this->Datedeb = $Item->bannieres_datedeb;
	        $this->DateFin = $Item->bannieres_datefin;
        }
        catch(Exception $e){}
    }

    public function InitBanniere($typeban, $i = '')
    {
        try{
    	    $db = DB::get();
        	$sql = "SELECT typesbans_defaut,typesbans_width,typesbans_height from t_typesbans WHERE  typesbans_id='$typeban' LIMIT 1";
	    	$Query = $db->query($sql);

	        $val = $db->fetch_array($Query);
	        
	        $Req = "SELECT bannieres_id FROM t_bannieres WHERE bannieres_idtypesbans = '$typeban' AND CURDATE() BETWEEN bannieres_datedeb AND bannieres_datefin AND bannieres_supprime='0'";
	       
	        $result = $db->query($Req);
	        $count = $db->num_rows($result);
	        if ($count == 0)
	        {
	
	            //on va chercher l'image par defaut
	            $Image = $val[0];
	            $rep = '/defaut';
	
	        } else
	        {
	            list($id) = $db->fetch_row($result);
	            $Ban = new Banniere($id);
	            
	           
	            
	            if ($Ban->Url != "")
	            {
	                $deburl = '<a href="http://' . $Ban->Url . '" >';
	                $finurl = '</a>';
	            }
	            $Image = $Ban->Img;
	        }
	
	        $width = $val[1];
	        $height = $val[2];
	        return $deburl . afficheImgOrFlash($Image, 'bannieres'.$rep, $i, $width, $height) . $finurl;
        }
        catch(Exception $e){}
    }

    public function __construct($id)
    {
        $this->Id = $id;
        $this->set();
    }


}
?>

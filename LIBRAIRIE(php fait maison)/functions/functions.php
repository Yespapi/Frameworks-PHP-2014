<?php

/* FICHIER DES FUNCTIONS */

function washmot($chaine)
{
	$chaine = trim($chaine);
	$chaine = stripslashes($chaine);
	$chaine = ereg_replace("–", "", $chaine);
	$chaine = ereg_replace("%E2%80%99", "-", $chaine);
	$chaine = ereg_replace("’", "-", $chaine);
	$chaine = ereg_replace("&#131;", "a", $chaine);
    $chaine = ereg_replace("&Ecirc;", "e", $chaine);
    $chaine = ereg_replace("&acirc;", "a", $chaine);
    $chaine = ereg_replace("&aacute;", "a", $chaine);
    $chaine = ereg_replace("&auml;", "a", $chaine);
    $chaine = ereg_replace("&agrave;", "a", $chaine);
    $chaine = ereg_replace("&Acirc;", "a", $chaine);
    $chaine = ereg_replace("д", "a", $chaine);
    $chaine = ereg_replace("&Agrave;", "a", $chaine);
    $chaine = ereg_replace("&igrave;", "i", $chaine);
    $chaine = ereg_replace("&iacute;", "i", $chaine);
    $chaine = ereg_replace("&iuml;", "i", $chaine);
    $chaine = ereg_replace("&icirc;", "i", $chaine);
    $chaine = ereg_replace("п", "i", $chaine);
    $chaine = ereg_replace("о", "i", $chaine);
    $chaine = ereg_replace("&egrave;", "e", $chaine);
    $chaine = ereg_replace("&eacute;", "e", $chaine);
    $chaine = ereg_replace("&euml;", "e", $chaine);
    $chaine = ereg_replace("&ecirc;", "e", $chaine);
    $chaine = ereg_replace("&Egrave;", "e", $chaine);
    $chaine = ereg_replace("&Eacute;", "e", $chaine);
    $chaine = ereg_replace("&Euml;", "e", $chaine);
    $chaine = ereg_replace("&Ecirc;", "e", $chaine);
    $chaine = ereg_replace("&Ugrave;", "u", $chaine);
    $chaine = ereg_replace("&ugrave;", "u", $chaine);
    $chaine = ereg_replace("&uacute;", "u", $chaine);
    $chaine = ereg_replace("&uuml;", "u", $chaine);
    $chaine = ereg_replace("&ucirc;", "u", $chaine);
    $chaine = ereg_replace("&oacute;", "o", $chaine);
    $chaine = ereg_replace("&ograve;", "o", $chaine);
    $chaine = ereg_replace("&ouml;", "o", $chaine);
    $chaine = ereg_replace("&ocirc;", "o", $chaine);
    $chaine = ereg_replace("ц", "o", $chaine);
    $chaine = ereg_replace("ф", "o", $chaine);
    $chaine = ereg_replace("&#230;", "ae", $chaine);
    $chaine = ereg_replace("&amp;", " ", $chaine);
    $chaine = ereg_replace("з", "c", $chaine);
    $chaine = ereg_replace("&ccedil;", "c", $chaine);
    $chaine = ereg_replace("&#231;", "c", $chaine);
    $chaine = ereg_replace("\+", " ", $chaine);
    $chaine = ereg_replace("-", " ", $chaine);
    $chaine = ereg_replace(",", " ", $chaine);
    $chaine = ereg_replace("/", " ", $chaine);
    $chaine = ereg_replace("\|", " ", $chaine);
    $chaine = ereg_replace("\*", " ", $chaine);
    $chaine = ereg_replace("{", " ", $chaine);
    $chaine = ereg_replace("}", " ", $chaine);
    $chaine = ereg_replace("\[", " ", $chaine);
    $chaine = ereg_replace("\]", " ", $chaine);
    $chaine = ereg_replace("@", " ", $chaine);
    $chaine = ereg_replace("`", " ", $chaine);
    $chaine = ereg_replace("'", " ", $chaine);
    $chaine = ereg_replace("&#39;", " ", $chaine);
    $chaine = ereg_replace("&#175;", " ", $chaine);
    $chaine = ereg_replace("&apos;", " ", $chaine);
    $chaine = ereg_replace("&#140;", " ", $chaine);
    $chaine = ereg_replace("&#146;", " ", $chaine);
    $chaine = ereg_replace("#", " ", $chaine);
    $chaine = ereg_replace("~", " ", $chaine);
    $chaine = ereg_replace("%", " ", $chaine);
    $chaine = ereg_replace("$", " ", $chaine);
    $chaine = ereg_replace("!", " ", $chaine);
    $chaine = ereg_replace("\?", " ", $chaine);
    $chaine = ereg_replace(":", " ", $chaine);
    $chaine = ereg_replace(";", " ", $chaine);
    $chaine = ereg_replace("\"", " ", $chaine);
    $chaine = ereg_replace("\.", " ", $chaine);
    $chaine = ereg_replace("\(", " ", $chaine);
    $chaine = ereg_replace("\)", " ", $chaine);
    $chaine = ereg_replace("_", " ", $chaine);
    $chaine = ereg_replace("\^", " ", $chaine);
    $chaine = ereg_replace("\=", " ", $chaine);
    $chaine = ereg_replace("<", " ", $chaine);
    $chaine = ereg_replace(">", " ", $chaine);
    $chaine = ereg_replace("&", " ", $chaine);
    $chaine = ereg_replace(" {2,}", " ", $chaine);
    $chaine = trim($chaine);
    $chaine = ereg_replace(" ", "-", $chaine);

    return $chaine;
}
function translate($texte){
		
	$datas_formatted = $texte;

	// Conversion des caract&Egrave;res sp&Eacute;ciaux

	$datas_formatted = str_replace( ";", " ", $datas_formatted );
	$datas_formatted = str_replace( ".", " ", $datas_formatted );
	$datas_formatted = str_replace( ",", " ", $datas_formatted );
	$datas_formatted = str_replace( "\n", " ", $datas_formatted );
	$datas_formatted = str_replace( "\t", " ", $datas_formatted );
	$datas_formatted = str_replace( "\r", " ", $datas_formatted );
	$datas_formatted = str_replace( "\r\n", " ", $datas_formatted );
	$datas_formatted = str_replace( "<br />", " ", $datas_formatted );
	$datas_formatted = str_replace( "<br>", " ", $datas_formatted );
	$datas_formatted = str_replace( "<br/>", " ", $datas_formatted );
	// Conversion des accents pour les minuscules

	$datas_formatted = str_replace( "&Agrave;", "a", $datas_formatted );
	$datas_formatted = str_replace( "б", "a", $datas_formatted );
	$datas_formatted = str_replace( "&Acirc;", "a", $datas_formatted );
	$datas_formatted = str_replace( "г", "a", $datas_formatted );
	$datas_formatted = str_replace( "д", "a", $datas_formatted );
	$datas_formatted = str_replace( "з", "c", $datas_formatted );
	$datas_formatted = str_replace( "&Egrave;", "e", $datas_formatted );
	$datas_formatted = str_replace( "&Eacute;", "e", $datas_formatted );
	$datas_formatted = str_replace( "&Ecirc;", "e", $datas_formatted );
	$datas_formatted = str_replace( "&Euml;", "e", $datas_formatted );
	$datas_formatted = str_replace( "м", "i", $datas_formatted );
	$datas_formatted = str_replace( "н", "i", $datas_formatted );
	$datas_formatted = str_replace( "о", "i", $datas_formatted );
	$datas_formatted = str_replace( "п", "i", $datas_formatted );
	$datas_formatted = str_replace( "с", "n", $datas_formatted );
	$datas_formatted = str_replace( "т", "o", $datas_formatted );
	$datas_formatted = str_replace( "у", "o", $datas_formatted );
	$datas_formatted = str_replace( "ф", "o", $datas_formatted );
	$datas_formatted = str_replace( "х", "o", $datas_formatted );
	$datas_formatted = str_replace( "ц", "o", $datas_formatted );
	$datas_formatted = str_replace( "&Ugrave;", "u", $datas_formatted );
	$datas_formatted = str_replace( "ъ", "u", $datas_formatted );
	$datas_formatted = str_replace( "&Ucirc;", "u", $datas_formatted );
	$datas_formatted = str_replace( "&Uuml;", "u", $datas_formatted );
	$datas_formatted = str_replace( "э", "y", $datas_formatted );

	// Conversion des accents pour les majuscules

	$datas_formatted = str_replace( "&Agrave;", "A", $datas_formatted );
	$datas_formatted = str_replace( "Б", "A", $datas_formatted );
	$datas_formatted = str_replace( "&Acirc;", "A", $datas_formatted );
	$datas_formatted = str_replace( "Г", "A", $datas_formatted );
	$datas_formatted = str_replace( "Д", "A", $datas_formatted );
	$datas_formatted = str_replace( "З", "C", $datas_formatted );
	$datas_formatted = str_replace( "&Egrave;", "E", $datas_formatted );
	$datas_formatted = str_replace( "&Eacute;", "E", $datas_formatted );
	$datas_formatted = str_replace( "&Ecirc;", "E", $datas_formatted );
	$datas_formatted = str_replace( "&Euml;", "E", $datas_formatted );
	$datas_formatted = str_replace( "М", "I", $datas_formatted );
	$datas_formatted = str_replace( "Н", "I", $datas_formatted );
	$datas_formatted = str_replace( "О", "I", $datas_formatted );
	$datas_formatted = str_replace( "П", "I", $datas_formatted );
	$datas_formatted = str_replace( "С", "N", $datas_formatted );
	$datas_formatted = str_replace( "Т", "O", $datas_formatted );
	$datas_formatted = str_replace( "У", "O", $datas_formatted );
	$datas_formatted = str_replace( "Ф", "O", $datas_formatted );
	$datas_formatted = str_replace( "Х", "O", $datas_formatted );
	$datas_formatted = str_replace( "Ц", "O", $datas_formatted );
	$datas_formatted = str_replace( "&Ugrave;", "U", $datas_formatted );
	$datas_formatted = str_replace( "Ъ", "U", $datas_formatted );
	$datas_formatted = str_replace( "&Ucirc;", "U", $datas_formatted );
	$datas_formatted = str_replace( "&Uuml;", "U", $datas_formatted );
	$datas_formatted = str_replace( "Э", "Y", $datas_formatted );

	return( $datas_formatted );
}

// Conversion d'un moi num&Eacute;rique en lettre

function moisfr($num_mois)
{
	switch ($num_mois) 
	{
		case 1: $fr_mois = 'Janvier'; break;
		case 2: $fr_mois = 'F&eacute;vrier'; break;
		case 3: $fr_mois = 'Mars'; break;
		case 4: $fr_mois = 'Avril'; break;
		case 5: $fr_mois = 'Mai'; break;
		case 6: $fr_mois = 'Juin'; break;
		case 7: $fr_mois = 'Juillet'; break;
		case 8: $fr_mois = 'Ao&ucirc;t'; break;
		case 9: $fr_mois = 'Septembre'; break;
		case 10: $fr_mois = 'Octobre'; break;
		case 11: $fr_mois = 'Novembre'; break;
		case 12: $fr_mois = 'D&eacute;cembre'; break;		
	}
	
	return $fr_mois;
}

//redimensionnement d'une image
function image_redi($img_src, $dst_w, $dst_h)
{
    // Lit les dimensions de l'image
    $size = GetImageSize($img_src);
    $src_w = $size[0];
    $src_h = $size[1];
    // Teste les dimensions tenant dans la zone
    $test_h = round(($dst_w / $src_w) * $src_h);
    $test_w = round(($dst_h / $src_h) * $src_w);
    // Si Height final non pr&Eacute;cis&Eacute; (0)
    if (!$dst_h)
        $dst_h = $test_h;
    // Sinon si Width final non pr&Eacute;cis&Eacute; (0)
    elseif (!$dst_w)
        $dst_w = $test_w;
    // Sinon teste quel redimensionnement tient dans la zone
    elseif ($test_h > $dst_h)
        $dst_w = $test_w;
    else
        $dst_h = $test_h;

    // Affiche les dimensions optimales
    return "WIDTH=" . $dst_w . " HEIGHT=" . $dst_h;
}
// retourne ne nombre d'enregistrement dans une table
function num_data($table, $where = "")
{
	try{

		$db = DB::get();
   		$requete = "SELECT * From $table $where";
    	$resultat = $db->query($requete);
    	$row = $db->num_rows($resultat);

    return $row;
	}
	catch(Exception $e){}

}


function recup($type)
{
    $i = 0;
    $liste = "";

    if ($handle = opendir($type . "/"))
    {

        while (false !== ($file = readdir($handle)))
        {
            if ((!eregi('effects', $file)) && ($file != ".") && ($file != "..") && (!is_dir
                ($file)))
            {
                $i = $i + 1;
                if ($liste == '')
                {
                    $liste .= $type . "/" . $file;
                } else
                {
                    $liste .= "," . $type . "/" . $file;
                }

            }
        }
        closedir($handle);
        return $liste;

    }

}

function affiche_photo_gene($file,$img, $parametre = "",$id="",$type="")
{
	$chemin = $GLOBALS['_data_']['chemin_images'].'/'.$file.'/'.$type.$img;
	
	if($id!="")
		$id = ' id="'.$id.'" ';

	$url = $GLOBALS['_data_']['url_images'].''.$file.'/'.$type.$img;
    if ((file_exists($chemin)) && ($img!="")) {
        $img = '<img src="' . $url . '"  ' . $parametre . '  '.$id.'>';
    } else {

        $img = '<img src="'.$GLOBALS['_data_']['url_images'].'/'.$file.'/'.$type.'img_indisponible.jpg" alt="Illustration" ' . $parametre .
            ' >';

    }
    return $img;
}
function construct_photo_gene($file,$img,$type="")
{
	$chemin = $GLOBALS['_data_']['chemin_images'].$file.'/'.$type.$img;
	
//	echo $chemin.'<br>';
	

	$url = $GLOBALS['_data_']['url_images'].''.$file.'/'.$type.$img;
//	echo $url;
    if ((file_exists($chemin)) && ($img!="")) {
        $img = $url;
    } else {

        $img = $GLOBALS['_data_']['url_images'].$type.'img_indisponible.jpg';

    }
    return $img;
}

function afficheImgOrFlash($Image, $chemin, $end_div=1,$width,$height,$parametre = "")
{
    if ($Image != "")
    {
       
        $tab = explode(".", $Image);
        $extension = $tab[1];
        $extension = strtolower($extension);
        
        
		
        if ($extension == "swf"){
			$suite = '<script language="JavaScript" type="text/javascript" src="' . $GLOBALS['_data_']['url_common'] .'js/flashobject.js"></script>';
            $suite .= '<div id="flash_index' . $end_div . '">
										
										<script type="text/javascript">
										var fo = new FlashObject("'.$GLOBALS['_data_']['url_images'].$chemin.'/'. $Image .
                '", "anim", "'.$width.'", "'.$height.'", "8", "", true);
										fo.addParam("quality", "high");
										fo.addParam("wmode", "transparent");
										fo.write("flash_index' . $end_div . '");
										// ]]>
										</script>
									</div>';

        } else
        {
        	
        	$ImageComplet = $GLOBALS['_data_']['url_images'] .''.$chemin.'/'.  $Image;
        	$CheminComplet = $GLOBALS['_data_']['chemin_images'].''.$chemin.'/'.  $Image;
       
        	
        	if(is_file($CheminComplet))
        	
        {
        		if($parametre!="")
    		$param = image_redi($CheminComplet,$parametre,$parametre);
    		
            $suite = '<img src="' . $ImageComplet . '" ' . $param . '/>';
        }
        }
    } else
    {
    	if($parametre!="")
    		$param = ' style="width:'.$parametre.'px;" ';
    		
        $suite = '<img src="'.$GLOBALS['_data_']['url_images'].'img_indisponible.jpg" alt="Illustration" '.$param.' >';
    }
    return $suite;
}

/******************************* DATE ********************************************/


function date_inverse($d)
{
    $t = explode("-", $d);
    return $t[2] . "-" . $t[1] . "-" . $t[0];

}

function reverse($d)
{
    
    
    $t = explode("-", $d);
    
    return $t[2] . "/" . $t[1] . "/" . $t[0];

}

/**********************************************************************************/


/******************************** IMAGE ********************************************/


function creation_carre($dest_temp, $file, $taille, $dest,$extension)
{
	/*
	$explode = explode($file,'.');
	$extension = strtoupper($explode[1]);
	*/
	
    $source_file = stripslashes($file);

    $img_array = getimagesize($source_file);
    $ratio = $img_array[0] / $img_array[1];

	if( $img_array[0]<230)
    	$taille = 230;

    $res_copy = copy($file, $dest_temp);
 

    if ($img_array[1] > $img_array[0])
    {
        $hauteurDestination = $taille;
        $largeurDestination = $taille * $ratio;
    } else
    {
        $largeurDestination = $taille;
        $hauteurDestination = $largeurDestination / $ratio;
    }
    $hauteurDestination = $largeurDestination / $ratio;

    $im = ImageCreatetruecolor($largeurDestination, $hauteurDestination) or die("Erreur lors de la cr&Eacute;ation de l'image") ; 
    $im1 = ImageCreatetruecolor($taille, $taille) or die("Erreur lors de la cr&Eacute;ation de l'image") ; 
    
    switch($extension){
    	case 'JPG' : 	$source = ImageCreateFromJPEG($dest_temp);
    	break;
    	case 'JPEG' : 	$source = ImageCreateFromJPEG($dest_temp);
    	break;
    	case 'GIF' : 	$source = ImageCreateFromGIF($dest_temp);
    	break;
    	case 'PNG' : 	$source = ImageCreateFromPNG($dest_temp);
    	break;
    	default : 		$source = ImageCreateFromJPEG($dest_temp);

    }
    /* Dimension de la source */
 	$largeurSource = imagesx($source);
    $hauteurSource = imagesy($source);
       		
    /* Cr&Eacute;ation du fond */
    $destination = ImageCreate($taille, $taille);

    /* ImageColorAllocate alloue un fond blanc &Agrave; l'image */
    $white = ImageColorAllocate($destination, 255, 255, 255);

    $largeurDestin = imagesx($destination);
    $hauteurDestin = imagesy($destination);
   
    $positionV = ($taille - $largeurDestination) / 2;
    $positionH = ($taille - $hauteurDestination) / 2;

    ImageCopyResampled($im1, $destination, 0, 0, 0, 0, $taille, $taille, $largeurDestin,
        $hauteurDestin);
    ImageCopyResampled($im, $source, 0, 0, 0, 0, $largeurDestination, $hauteurDestination,
        $largeurSource, $hauteurSource);
    imagecopymerge($im1, $im, $positionV, $positionH, 0, 0, $largeurDestination, $hauteurDestination,
        100);
    $miniature = "$dest_temp";
    switch($extension){
    	case 'JPG' : ImageJPEG($im1, $miniature);
    	break;
    	case 'JPEG' : ImageJPEG($im1, $miniature);
    	break;
    	case 'GIF' : ImageGIF($im1, $miniature);
    	break;
    	case 'PNG' : ImagePNG($im1, $miniature);
    	break;
    	default : ImageJPEG($im1, $miniature);

    }
    
    $res_resize = copy($miniature, $dest);
}



function creation_rectangle($dest_temp, $file, $largeur, $hauteur, $dest, $extension)
{
    //$source_file = stripslashes($file);
    $source_file = $file;
    $img_array = getimagesize($source_file);
    $ratio_destination = $largeur / $hauteur;
    $ratio_source = $img_array[0] / $img_array[1];

    $res_copy = copy($file, $dest_temp);

    if ($ratio_source < $ratio_destination)
    {
        $hauteurDestination = $hauteur;
        $largeurDestination = $hauteurDestination * $ratio_source;
    } else
    {
        $largeurDestination = $largeur;
        $hauteurDestination = $largeurDestination / $ratio_source;
    }

    $im = ImageCreatetruecolor($largeurDestination, $hauteurDestination) or die("Erreur lors de la cr&Eacute;ation de l'image");
    $im1 = ImageCreatetruecolor($largeur, $hauteur) or die("Erreur lors de la cr&Eacute;ation de l'image");
 	switch($extension){
    	case 'JPG' : 	$source = ImageCreateFromJPEG($dest_temp);
    	break;
    	case 'JPEG' : 	$source = ImageCreateFromJPEG($dest_temp);
    	break;
    	case 'GIF' : 	$source = ImageCreateFromGIF($dest_temp);
    	break;
    	case 'PNG' : 	$source = ImageCreateFromPNG($dest_temp);
    	break;
    	default : 		$source = ImageCreateFromJPEG($dest_temp);

    }

    /* Cr&Eacute;ation du fond */
    $destination = ImageCreate($largeur, $hauteur);

    /* ImageColorAllocate alloue un fond blanc &Agrave; l'image */
    $white = ImageColorAllocate($destination,255,255,255);

    $largeurDestin = imagesx($destination);
    $hauteurDestin = imagesy($destination);
    $largeurSource = imagesx($source);
    $hauteurSource = imagesy($source);
    $positionV = ($largeur - $largeurDestination) / 2;
    $positionH = ($hauteur - $hauteurDestination) / 2;

    ImageCopyResampled($im1, $destination, 0, 0, 0, 0, $largeur, $hauteur, $largeurDestin,
        $hauteurDestin);
    ImageCopyResampled($im, $source, 0, 0, 0, 0, $largeurDestination, $hauteurDestination,
        $largeurSource, $hauteurSource);
    imagecopymerge($im1, $im, $positionV, $positionH, 0, 0, $largeurDestination, $hauteurDestination,
        100);
    $miniature = "$dest_temp";
    
 	switch($extension){
    	case 'JPG' : ImageJPEG($im1, $miniature);
    	break;
    	case 'JPEG' : ImageJPEG($im1, $miniature);
    	break;
    	case 'GIF' : ImageGIF($im1, $miniature);
    	break;
    	case 'PNG' : ImagePNG($im1, $miniature);
    	break;
    	default : ImageJPEG($im1, $miniature);

    }
   
    $res_resize = copy($miniature, $dest);


}




/***********************************************************************************/


function Tronquer_Texte($texte, $longeur_max)
{

    if (strlen($texte) > $longeur_max)
    {
        $texte = substr($texte, 0, $longeur_max);
        $dernier_espace = strrpos($texte, " ");
        $texte = substr($texte, 0, $dernier_espace) . " ...";
    }

    return stripslashes($texte);
}
function CleanChaine($nom, $type = "")
{
    switch ($type)
    {
        case '1':
            $valeur = $_POST[$nom];
            break;
        case '2':
            $valeur = $_GET[$nom];
            break;
        case '3':
            $valeur = $_SESSION[$nom];
            break;
        case '4':
            $valeur = $_REQUEST[$nom];
            break;
        default:
            $valeur = $nom;
    }
    $valeur = trim($valeur);
    
    return $valeur;
}
function AccesInterdit()
{
    echo "<script type='application/javascript'>window.location='" . $GLOBALS['_data_']['url_principale'] . "index.php?errcd=44F010" ."'</script>";
}

function SelectNomFromTable($table, $id, $AddSql="")
{
	try{
		
		$db = DB::get();
    	$val = $db->fetch_array($db->query("SELECT " . $table . "_nom from t_" . $table .
        " WHERE " . $table . "_id='" . $id . "' $AddSql LIMIT 1"));
    	return stripslashes($val[0]);
	}
	catch(Exception $e){}

}

function SelectFieldFromTable($table, $field, $id)
{
	try{
		
		$db = DB::get();
    	$val = $db->fetch_array($db->query("SELECT " . $table . "_".$field." from t_" . $table .
        " WHERE " . $table . "_id='" . $id . "' LIMIT 1"));
    	return stripslashes($val[0]);
	}
	catch(Exception $e){}
}
function random($var="MDM")
{

    $chaine = rand(1256958, 454646546548484);
    return $var."-" . time() . $chaine;
}

function Identification($email, $pw)
{
    
    try{
		$db = DB::get();
    	$email = trim($email);
		$req = "SELECT comptes_pass,comptes_id from t_comptes WHERE comptes_email='" .
        $db->escape($email) . "' AND comptes_supprime='0' AND comptes_basenewsletter='0' AND comptes_actif = '1' LIMIT 1";
	
	    $query = $db->query($req);
	    $val = $db->fetch_array($query);
	    $count = $db->num_rows($query);
	    if ($count == 0)
	    {
	        return '0';
	    } else
	    {
	        $Password = new LiverCrypt();
	        $pass = $Password->Decrypte($val[0]);
			
	        if ($pass == $pw)
	        {
	            return $val[1];
	            
	        } else
	        {
	            return '0';
	        }
	    }
    }catch(Exception $e){}

}

function IsConnect($redirect=""){
	try{
		$db = DB::get();
		$Req = "SELECT comptes_id from t_comptes WHERE comptes_id='" .$_SESSION[$GLOBALS['_data_']['session_idclient']] . "' AND comptes_id>'0' AND  comptes_supprime='0' AND comptes_basenewsletter='0' AND comptes_actif = '1' LIMIT 1";
	//echo $Req.'<br>';
	 	$query = $db->query($Req);
    	$count = $db->num_rows($query);	
    	
		if($count=='' || $count==0){
  			if($redirect!=""){
				header("location:".$redirect."");
  				exit();
  			}
  			else{
  				return false;
  			}
  		}
  		else{
  			return true;
  		} 	
	}
	catch(Exception $e){}
}

function IsEnSession($redirect=""){
	if(empty($_SESSION[$GLOBALS['_data_']['session_navig']])){
		
		if($redirect!=""){
  			echo "<script type='application/javascript'>window.location='".$redirect.".php" ."'</script>";

  		}
  		else{
  			return false;
  		}
		
	}
	else{
		return true;
	}
}

function calcul_remise($montant,$taux){
		$remise = 0;
		$remise = ($montant*$taux)/100;
		return $remise;
}

function NoVirgule($val){
	$val = str_replace(',','.',$val);
	//$val = number_format($val,2,'.','');
	return $val;
}
function Division($num1,$num2){
	(($num1<=0) ||($num2<=0))?$val=0:$val=($num1/$num2);
	return Format_nombre($val);
}
function Format_nombre($nombre,$val=2){
	return number_format($nombre,$val,'.','');
}

function dateFr($date) {
	$tab1 = array("Mon" => "Lundi", "Tue" => "Mardi", "Wed" => "Mercredi", "Thu" =>
												"Jeudi", "Fri" => "Vendredi", "Sat" => "Samedi", "Sun" => "Dimanche");
	$tab2 = array("01" => "Janvier", "02" => "F&Eacute;vrier", "03" => "Mars", "04" =>
												"Avril", "05" => "Mai", "06" => "Juin", "07" => "Juillet", "08" => "Ao&Ucirc;t", "09" =>
												"Septembre", "10" => "Octobre", "11" => "Novembre", "12" => "D&Eacute;cembre");
	$d1 = explode("-", $date);
	$timestamp = mktime(0, 0, 0, $d1[1], $d1[2], $d1[0]);
	

	$newdate = $tab1[date("D",$timestamp)] . " " . date("d",$timestamp) . " " . $tab2[date("m",$timestamp)] . " " .
												date("Y",$timestamp);
										
	return $newdate;
}
function ConvertMonth($mois){
    $tab2 = array("01" => "Janvier", "02" => "F&Eacute;vrier", "03" => "Mars", "04" =>
												"Avril", "05" => "Mai", "06" => "Juin", "07" => "Juillet", "08" => "Ao&Ucirc;t", "09" =>
												"Septembre", "10" => "Octobre", "11" => "Novembre", "12" => "D&Eacute;cembre");
    return $tab2[$mois];
}
function stripallslashes($chaine)
{
				$chaine = str_replace("\\", "", $chaine);
				return $chaine;
}


function GenerateListeNumerique($vardepard, $vararrive , $test="")
{
	$i = $vardepard;
	while ($i <= $vararrive)
	{
		$options .= '<option value="'.$i.'" ';if($test == $i){$options.='selected="selected"';}$options.= ' >'.$i.'</option>';
		$i++;
	}
	return $options;
}

function GenerateListeNumeriqueInv($vardepard, $vararrive , $test="")
{
	$i = $vararrive;
	while ($i > $vardepard)
	{
		$options .= '<option value="'.$i.'" ';if($test == $i){$options.='selected="selected"';}$options.= ' >'.$i.'</option>';
		$i--;
	}
	return $options;
}


function GenerateListMonth($lang="Fr",$test=""){
	if($lang==""){$lang="Fr";}
	
	$tab = array();
	$tab['Fr'] = array('Janvier','F&eacute;vrier','Mars','Avril','Mai','Juin','Juillet','Ao&ucirc;t','Septembre','Octobre','Novembre','D&eacute;cembre');
	$tab['En'] = array('January','Febrary','March','April','May','June','July','August','September','October','November','D&eacute;cember');
	$tab['Es'] = array('Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre');
	$tab['De'] = array('Januar','Februar','M&auml;rz','April','Mai','Juni','Juli','August','September','Oktober','November','Dezember');
	
	$select="";
	for($i=1;$i<13;$i++){
		$select.='<option value="'.$i.'" ';if($i==$test){$select.='selected="selected"';}$select.='>'.$tab[$lang][$i-1].'</option>';
	}
	return $select;
}


function JoursEnMoins($nbjour){
	
	try{
		$db = DB::get();
		$Req = "SELECT DATE_SUB( '".date('Y-m-d')."', INTERVAL $nbjour )";
		$Exec = $db->query($Req);
		list($nbjour) = $db->fetch_row($Exec);
		return $nbjour;
	}
	catch(Exception $e){}
}

function JoursEnPlus($nbjour){
	
	try{
		$db = DB::get();
		$Req = "SELECT DATE_ADD( '".date('Y-m-d')."', INTERVAL $nbjour )";
		$Exec = $db->query($Req);
		list($nbjour) = $db->fetch_row($Exec);
		return $nbjour;
	}
	catch(Exception $e){}
}
function ConstructChaineforSearch($chaine){
	$chaine = trim($chaine);
	$explode = explode(' ',$chaine);
	foreach($explode as $Cle=>$valeur){
		$suite.=$valeur.'* ';
	}
	return '>('.$chaine.') <('.$suite.')';
}

function listing($repertoire){
	$fichier = array();
	if (is_dir($repertoire)){
		$dir = opendir($repertoire); //ouvre le repertoire courant d&Eacute;sign&Eacute; par la variable
		while(false!==($file = readdir($dir))){ //on lit tout et on r&Eacute;cupere tout les fichiers dans $file
			if(!in_array($file, array('.','..'))){ //on eleve le parent et le courant '. et ..'
				$page = $file; //sort l'extension du fichier
				$page = explode('.', $page);
				$nb = count($page);
				$nom_fichier = $page[0];
				for ($i = 1; $i < $nb-1; $i++){
					$nom_fichier .= '.'.$page[$i];
				}
				if($ext_fichier != 'php' and $ext_fichier != 'html') { //utile pour exclure certains types de fichiers &Agrave; ne pas lister
					array_push($fichier, $file);
					//echo $file.'<br>';
				}
			}
		}
	}
	natcasesort($fichier); //la fonction natcasesort( ) est la fonction de tri standard sauf qu'elle ignore la casse
	foreach($fichier as $value) {
		

		
		
			$timestamp1 = filemtime($repertoire.$value);
			$timestamp2 = time();
			//echo $timestamp1.' - '.$timestamp2.'<br>';
			$diff = $timestamp2 - $timestamp1;
			//echo $diff.'<br>';
	if($diff>259200) { 
	//echo $repertoire.$value.'<br>';
	@unlink($repertoire.$value); 
	
	}
	}
}
function OptimizeImagesProduits($id){
	
	
	try{
		$db = DB::get();
		$Request = $db->query("SELECT produits_img1,produits_img2,produits_img3,produits_img4 from t_produits WHERE produits_id='$id'  LIMIT 1 ");
		$i = 0;
		while(list($img1,$img2,$img3,$img4) = $db->fetch_array($Request)){
			for($init=1;$init<=4;$init++){
				$Name = 'img'.$init;
			if($$Name!=""){
				$tab[$i] = $$Name;
				$i++;
			}
			}
		}
		foreach($tab as $cle=>$valeur){
			
			$namefield = 'produits_img'.($cle+1);
			//echo "UPDATE t_produits SET ".$namefield."='".$valeur."' WHERE produits_id='$id'  LIMIT 1 <br>";
			$Update = $db->query("UPDATE t_produits SET ".$namefield."='".$valeur."' WHERE produits_id='$id'  LIMIT 1");
		}
	}
	catch(Exception $e){}
	
}

function getTva($ht,$taxe ){
	
	$tva = $ht * ( $taxe / 100) ;
		
	return $tva;	
}

function metas($keywords="",$description="") {
	if($description==""){
		$description = htmlentities("");
	}
$metas = array ("description"=>$description,"keywords"=>$keywords.htmlentities(" "),"identifier-url"=>$GLOBALS['_data_']['url_principale'],"author"=>"Arpedia.com","copyright"=>NOM_SITE,"ROBOTS"=>"INDEX,FOLLOW,ALL","revisit-after"=>"7 days","Reply-to"=>EMAIL_PRINC,"Language"=>"FR");
return $metas ;

}
function metas_nofollow() {
$metas = array ("robots"=>"noindex, follow");
return $metas ;

}
function AddFiles($rep)
{
	$chemin = $GLOBALS['_data_']['chemin_site'].$rep.'/';
    if ($handle = opendir($chemin))
    {

        while (false !== ($file = readdir($handle)))
        {
            if (($file != ".") && ($file != "..") && (!is_dir($file)))
            {
                include ($chemin.$file);

            }
        }
        closedir($handle);
        return $liste;

    }

}
function SuiteLink($cat,$sscat,$marque,$taille,$saison,$publi,$idvp=""){

	
		if($cat>0){$link = '&cat='.$cat ;}
		if($sscat>0){$link .= '&sscat='.$sscat ;}
    	if($marque>0){ $link .= '&marque='.$marque ; }
    	if($taille>0){ $link .= '&taille='.$taille ; }
    	if($saison>0){ $link .= '&saison='.$saison ; }
    	if($publi>0) { $link.='&id='.$publi;}
    	if($idvp>0) { $link.='&idvp='.$idvp;}

		return $link;
}
function MiseEnSessionRecherche($cat,$sscat,$marque,$couleur_nom,$tranche,$motcle,$saison){
		if($cat>0){$_SESSION['session_cat'] = $cat ;}
		if($sscat>0){$_SESSION['session_sscat'] = $sscat ;}
    	if($marque>0){ $_SESSION['session_marque'] = $marque ; }
    	if($couleur_nom!=""){$_SESSION['session_couleur_nom'] = $couleur_nom ;}
    	if($tranche>0){ $_SESSION['session_tranche'] = $tranche ; }
		if($motcle!=""){$_SESSION['session_motcle'] = $motcle ;}
		if($saison>0){$_SESSION['session_saison'] = $saison ;}


}
function AfficheVirgule($prix){
	
	//$prix = str_replace(".",",",$prix);
	$prix = number_format($prix,2,',','');
	return $prix;
}
function InsertTest($txt){
	try {
          
        	$db = DB::get();
            $req = "INSERT INTO t_test SET test_nom='".$db->escape($txt)."'";
        	$exec = $db->query($req);

            
        }
        catch (exception $e) {
        }
}
function Dear($civ){
	$tab = array("M."=>"Ch&egrave;r","Mme"=>"Ch&egrave;r","Melle"=>"Ch&egrave;r");
	return $tab[$civ];
}
function replacement($nom_produit)
{
				$nom_produit = str_replace("'", "", $nom_produit);
				$nom_produit = strtr($nom_produit, " &Agrave;&Eacute;&Egrave;&Ecirc;оф&Ucirc;&Ugrave;з'", "_aeeeiouuc_");
				return $nom_produit;
}


/*************************************************************************/
/******************************** ADMIN **********************************/
/*************************************************************************/

function AfficheMenu()
{
    $Niveau_admin = CleanChaine('niveau_admin', '3');
    if ($Niveau_admin != "") {
        
    	
    	try{

    		$db = DB::get();
    		$QUERYMENU = $db->query("select * from t_menu  WHERE menu_niveau >= '" . $Niveau_admin .
            "' order by menu_ordre ASC");
        $MENU_NAV = "";
        $MENU_NAV .= '<div id="navigation_in">';
        $init_menu = "1";
        $open = '';

        while ($valmenu = $db->fetch_object($QUERYMENU)) {
            $init_link = "";

            // Permet de laisser visible le sous menu de la rubrique
    
            //if (eregi($valmenu->menu_file, $_SERVER['PHP_SELF'])) { Prob avec cette fct dans le backoffice
			if (mb_eregi($valmenu->menu_file, $_SERVER['PHP_SELF'])) {
                $open = 'open_at_load';
                       // echo $valmenu->menu_file.' '.$_SERVER['PHP_SELF'].'<br>';
            } else {
                $open = '';
            }

            $MENU_NAV .= '<div class="toggleSubMenu" ><h1>' . $valmenu->menu_titre . '</h1>
			<div class="subMenu ' . $open . '" >';

            $IDCAT = $valmenu->idmenu;
            $QUERYSOUSMENU = $db->query("select * from t_ssmenu where ssmenu_idmenu='" . $IDCAT .
                "' AND ssmenu_niveau >= '" . $Niveau_admin . "' order by idssmenu ASC");
            while ($valsousmenu = $db->fetch_object($QUERYSOUSMENU)) {
            
					if($valsousmenu->ssmenu_index!=""){
						$init_link = $valsousmenu->ssmenu_index;
					}
                $MENU_NAV .= '<p id="menu' . $init_menu . '" onmouseover="getElementById(\'menu' .
                    $init_menu . '\').style.background=\'#EBEBEB\'" onmouseout="getElementById(\'menu' .
                    $init_menu . '\').style.background=\'#FFFFFF\'">&nbsp;&nbsp;
							<a href="' . $GLOBALS['_data_']['url_back']  . 'modules/' . $valmenu->menu_file . '/index' . $init_link .
                    '.php">' . $valsousmenu->ssmenu_titre . '</a>
						</p>';


                $init_menu++;
                $init_link++;
            }
            $MENU_NAV .= '</div></div>';

        }
        $MENU_NAV .= '</div>';
    	}
    	catch(Exception $e){    		
    		var_dump($e->getMessage());
    	}
    }
    return $MENU_NAV;
}

function countondate($date, $table, $prefixe, $where)
{
    try{
		$db = DB::get();
    	$requete = "select * from " . $table . " where " . $prefixe . "date = '" . $date .
        "' " . $where;
    	
    	$result  	=	$db->query($requete);
    	$sql 		= 	$db->num_rows($result);
    	return $sql;
    }
    catch(Exception $e){ 
    	var_dump($e->getMessage());
    
    }
  
}

function GenerateNumCmd(){
	
	try{
		$db = DB::get();
		$Insert = $db->query("INSERT INTO t_numcmd SET numcmd_id=''");
		$id = $db->last_insert_id();
		return $id;
	}
	catch(Exception $e){}
}



function NbArticlesVendus($Adddate){
	
	$db = DB::get();
	
	$Req1 = $db->query("SELECT reservation_id from t_reservation WHERE  reservation_etat IN('Valide','Livr&Eacute;e') AND reservation_supprime ='0' ".$Adddate);
	$total = 0;
	while(list($quantite)=$db->fetch_array($Req1)){
		$total += $quantite;
	}
	
	return $total;
}


function separateur_mille($prix){
	return number_format($prix,0,',',' ');
	
}

function tiret($texte){
		
	$datas_formatted = $texte;

	
	$datas_formatted = str_replace( "--", "-", $datas_formatted );	
	
	$texte = $datas_formatted;

	return ($texte);
}	

function string2url($texte){
		
	$datas_formatted = $texte;

	// Conversion des caract&Egrave;res sp&Eacute;ciaux
	$datas_formatted = str_replace( "&#039;", " ", $datas_formatted );
	$datas_formatted = str_replace( " ", "-", $datas_formatted );
	$datas_formatted = str_replace( "_", "-", $datas_formatted );
	$datas_formatted = str_replace( "%", "", $datas_formatted );
	$datas_formatted = str_replace( "$", "", $datas_formatted );
	$datas_formatted = str_replace( "Ђ", "", $datas_formatted );
	$datas_formatted = str_replace( "&amp;", "", $datas_formatted );
	$datas_formatted = str_replace( "&sect;", "", $datas_formatted );
	$datas_formatted = str_replace( "&deg;", "", $datas_formatted );
	$datas_formatted = str_replace( "&quot;", "", $datas_formatted );
	$datas_formatted = str_replace( "*", "", $datas_formatted );
	$datas_formatted = str_replace( ",", "", $datas_formatted );
	$datas_formatted = str_replace( ".", "", $datas_formatted );
	$datas_formatted = str_replace( "@", "", $datas_formatted );
	$datas_formatted = str_replace( "#", "", $datas_formatted );
	$datas_formatted = str_replace( "+", "", $datas_formatted );
	$datas_formatted = str_replace( "=", "", $datas_formatted );
	$datas_formatted = str_replace( ":", "", $datas_formatted );
	$datas_formatted = str_replace( "/", "", $datas_formatted );
	$datas_formatted = str_replace( "(", "", $datas_formatted );
	$datas_formatted = str_replace( ")", "", $datas_formatted );
	$datas_formatted = str_replace( "{", "", $datas_formatted );
	$datas_formatted = str_replace( "}", "", $datas_formatted );
	$datas_formatted = str_replace( "[", "", $datas_formatted );
	$datas_formatted = str_replace( "]", "", $datas_formatted );
	$datas_formatted = str_replace( "!", "", $datas_formatted );
	$datas_formatted = str_replace( "?", "", $datas_formatted );
    $datas_formatted = str_replace( "?", "", $datas_formatted );
	
	// Conversion des accents pour les minuscules
	$datas_formatted = str_replace( "&Agrave;", "a", $datas_formatted );
	$datas_formatted = str_replace( "б", "a", $datas_formatted );
	$datas_formatted = str_replace( "&Acirc;", "a", $datas_formatted );
	$datas_formatted = str_replace( "г", "a", $datas_formatted );
	$datas_formatted = str_replace( "д", "a", $datas_formatted );
	$datas_formatted = str_replace( "з", "c", $datas_formatted );
	$datas_formatted = str_replace( "&Egrave;", "e", $datas_formatted );
	$datas_formatted = str_replace( "&Eacute;", "e", $datas_formatted );
	$datas_formatted = str_replace( "&Ecirc;", "e", $datas_formatted );
	$datas_formatted = str_replace( "&Euml;", "e", $datas_formatted );
	$datas_formatted = str_replace( "м", "i", $datas_formatted );
	$datas_formatted = str_replace( "н", "i", $datas_formatted );
	$datas_formatted = str_replace( "о", "i", $datas_formatted );
	$datas_formatted = str_replace( "п", "i", $datas_formatted );
	$datas_formatted = str_replace( "с", "n", $datas_formatted );
	$datas_formatted = str_replace( "т", "o", $datas_formatted );
	$datas_formatted = str_replace( "у", "o", $datas_formatted );
	$datas_formatted = str_replace( "ф", "o", $datas_formatted );
	$datas_formatted = str_replace( "х", "o", $datas_formatted );
	$datas_formatted = str_replace( "ц", "o", $datas_formatted );
	$datas_formatted = str_replace( "&Ugrave;", "u", $datas_formatted );
	$datas_formatted = str_replace( "ъ", "u", $datas_formatted );
	$datas_formatted = str_replace( "&Ucirc;", "u", $datas_formatted );
	$datas_formatted = str_replace( "&Uuml;", "u", $datas_formatted );
	$datas_formatted = str_replace( "э", "y", $datas_formatted );
	
	// Conversion des accents pour les minuscules (code html)
	$datas_formatted = str_replace( "&agrave;", "a", $datas_formatted );
	$datas_formatted = str_replace( "&aacute;", "a", $datas_formatted );
	$datas_formatted = str_replace( "&acirc;", "a", $datas_formatted );
	$datas_formatted = str_replace( "&auml;", "a", $datas_formatted );
	$datas_formatted = str_replace( "&ccedil;", "c", $datas_formatted );
	$datas_formatted = str_replace( "&egrave;", "e", $datas_formatted );
	$datas_formatted = str_replace( "&eacute;", "e", $datas_formatted );
	$datas_formatted = str_replace( "&ecirc;", "e", $datas_formatted );
	$datas_formatted = str_replace( "&euml;", "e", $datas_formatted );
	$datas_formatted = str_replace( "&icirc;", "i", $datas_formatted );
	$datas_formatted = str_replace( "&iuml;", "i", $datas_formatted );
	$datas_formatted = str_replace( "&ograve;", "o", $datas_formatted );
	$datas_formatted = str_replace( "&oacute;", "o", $datas_formatted );
	$datas_formatted = str_replace( "&ocirc;", "o", $datas_formatted );
	$datas_formatted = str_replace( "&otilde;", "o", $datas_formatted );
	$datas_formatted = str_replace( "&ugrave;", "u", $datas_formatted );
	$datas_formatted = str_replace( "&uacute;", "u", $datas_formatted );
	$datas_formatted = str_replace( "&ucirc;", "u", $datas_formatted );
	$datas_formatted = str_replace( "&uuml;", "u", $datas_formatted );
	$datas_formatted = str_replace( "&ouml;", "o", $datas_formatted );
	
	// Conversion des majuscules pour des minuscules
	$datas_formatted = str_replace( "A", "a", $datas_formatted );
	$datas_formatted = str_replace( "B", "b", $datas_formatted );
	$datas_formatted = str_replace( "C", "c", $datas_formatted );
	$datas_formatted = str_replace( "D", "d", $datas_formatted );
	$datas_formatted = str_replace( "E", "e", $datas_formatted );
	$datas_formatted = str_replace( "F", "f", $datas_formatted );
	$datas_formatted = str_replace( "G", "g", $datas_formatted );
	$datas_formatted = str_replace( "H", "h", $datas_formatted );
	$datas_formatted = str_replace( "I", "i", $datas_formatted );
	$datas_formatted = str_replace( "J", "j", $datas_formatted );
	$datas_formatted = str_replace( "K", "k", $datas_formatted );
	$datas_formatted = str_replace( "L", "l", $datas_formatted );
	$datas_formatted = str_replace( "M", "m", $datas_formatted );
	$datas_formatted = str_replace( "N", "n", $datas_formatted );
	$datas_formatted = str_replace( "O", "o", $datas_formatted );
	$datas_formatted = str_replace( "P", "p", $datas_formatted );
	$datas_formatted = str_replace( "Q", "q", $datas_formatted );
	$datas_formatted = str_replace( "R", "r", $datas_formatted );
	$datas_formatted = str_replace( "S", "s", $datas_formatted );
	$datas_formatted = str_replace( "T", "t", $datas_formatted );
	$datas_formatted = str_replace( "U", "u", $datas_formatted );
	$datas_formatted = str_replace( "V", "v", $datas_formatted );
	$datas_formatted = str_replace( "W", "w", $datas_formatted );
	$datas_formatted = str_replace( "X", "x", $datas_formatted );
	$datas_formatted = str_replace( "Y", "y", $datas_formatted );
	$datas_formatted = str_replace( "Z", "z", $datas_formatted );
	
	$texte = $datas_formatted;

	return ($texte);
}

function string2file($texte){
		
	$datas_formatted = $texte;

	// Conversion des caractиres spйciaux
	$datas_formatted = str_replace( " ", "-", $datas_formatted );
	$datas_formatted = str_replace( "_", "-", $datas_formatted );
	$datas_formatted = str_replace( "%", "", $datas_formatted );
	$datas_formatted = str_replace( "*", "", $datas_formatted );
	$datas_formatted = str_replace( ",", "", $datas_formatted );
	$datas_formatted = str_replace( "@", "", $datas_formatted );
	$datas_formatted = str_replace( "#", "", $datas_formatted );
	$datas_formatted = str_replace( "+", "", $datas_formatted );
	$datas_formatted = str_replace( "=", "", $datas_formatted );
	$datas_formatted = str_replace( ":", "", $datas_formatted );
	$datas_formatted = str_replace( "/", "", $datas_formatted );
	$datas_formatted = str_replace( "(", "", $datas_formatted );
	$datas_formatted = str_replace( ")", "", $datas_formatted );
	$datas_formatted = str_replace( "{", "", $datas_formatted );
	$datas_formatted = str_replace( "}", "", $datas_formatted );
	$datas_formatted = str_replace( "[", "", $datas_formatted );
	$datas_formatted = str_replace( "]", "", $datas_formatted );
	$datas_formatted = str_replace( "!", "", $datas_formatted );
	$datas_formatted = str_replace( "?", "", $datas_formatted );
    $datas_formatted = str_replace( "?", "", $datas_formatted );
	
	// Conversion des accents pour les minuscules
	$datas_formatted = str_replace( "а", "a", $datas_formatted );
	$datas_formatted = str_replace( "б", "a", $datas_formatted );
	$datas_formatted = str_replace( "в", "a", $datas_formatted );
	$datas_formatted = str_replace( "г", "a", $datas_formatted );
	$datas_formatted = str_replace( "д", "a", $datas_formatted );
	$datas_formatted = str_replace( "з", "c", $datas_formatted );
	$datas_formatted = str_replace( "и", "e", $datas_formatted );
	$datas_formatted = str_replace( "й", "e", $datas_formatted );
	$datas_formatted = str_replace( "к", "e", $datas_formatted );
	$datas_formatted = str_replace( "л", "e", $datas_formatted );
	$datas_formatted = str_replace( "м", "i", $datas_formatted );
	$datas_formatted = str_replace( "н", "i", $datas_formatted );
	$datas_formatted = str_replace( "о", "i", $datas_formatted );
	$datas_formatted = str_replace( "п", "i", $datas_formatted );
	$datas_formatted = str_replace( "с", "n", $datas_formatted );
	$datas_formatted = str_replace( "т", "o", $datas_formatted );
	$datas_formatted = str_replace( "у", "o", $datas_formatted );
	$datas_formatted = str_replace( "ф", "o", $datas_formatted );
	$datas_formatted = str_replace( "х", "o", $datas_formatted );
	$datas_formatted = str_replace( "ц", "o", $datas_formatted );
	$datas_formatted = str_replace( "щ", "u", $datas_formatted );
	$datas_formatted = str_replace( "ъ", "u", $datas_formatted );
	$datas_formatted = str_replace( "ы", "u", $datas_formatted );
	$datas_formatted = str_replace( "ь", "u", $datas_formatted );
	$datas_formatted = str_replace( "э", "y", $datas_formatted );
	
	// Conversion des accents pour les majuscule
	$datas_formatted = str_replace( "А", "A", $datas_formatted );
	$datas_formatted = str_replace( "Б", "A", $datas_formatted );
	$datas_formatted = str_replace( "В", "A", $datas_formatted );
	$datas_formatted = str_replace( "Г", "A", $datas_formatted );
	$datas_formatted = str_replace( "Д", "A", $datas_formatted );
	$datas_formatted = str_replace( "З", "C", $datas_formatted );
	$datas_formatted = str_replace( "И", "E", $datas_formatted );
	$datas_formatted = str_replace( "Й", "E", $datas_formatted );
	$datas_formatted = str_replace( "К", "E", $datas_formatted );
	$datas_formatted = str_replace( "Л", "E", $datas_formatted );
	$datas_formatted = str_replace( "М", "I", $datas_formatted );
	$datas_formatted = str_replace( "Н", "I", $datas_formatted );
	$datas_formatted = str_replace( "О", "I", $datas_formatted );
	$datas_formatted = str_replace( "П", "I", $datas_formatted );
	$datas_formatted = str_replace( "С", "N", $datas_formatted );
	$datas_formatted = str_replace( "Т", "O", $datas_formatted );
	$datas_formatted = str_replace( "У", "O", $datas_formatted );
	$datas_formatted = str_replace( "Ф", "O", $datas_formatted );
	$datas_formatted = str_replace( "Х", "O", $datas_formatted );
	$datas_formatted = str_replace( "Ц", "O", $datas_formatted );
	$datas_formatted = str_replace( "Щ", "U", $datas_formatted );
	$datas_formatted = str_replace( "Ъ", "U", $datas_formatted );
	$datas_formatted = str_replace( "Ы", "U", $datas_formatted );
	$datas_formatted = str_replace( "Ь", "U", $datas_formatted );
	$datas_formatted = str_replace( "Э", "Y", $datas_formatted );
	
	$texte = $datas_formatted;

	return ($texte);
}

//for vate ratings....
function rating_bar($id,$product_id,$units='',$static='') { 

 // get the db connection info
	
//set some variables
$ip = $_SERVER['REMOTE_ADDR'];
if (!$units) {$units = 10;}
if (!$static) {$static = FALSE;}
$rating_unitwidth     = 30;

// get votes, values, ips for the current rating bar
$query=mysql_query("SELECT * FROM t_ratings WHERE starid='".$id."' AND product_id='".$product_id."' ")or die(" Error: ".mysql_error());
//print_r(mysql_num_rows($query));die();

// insert the id in the DB if it doesn't exist already
// see: http://www.masugadesign.com/the-lab/scripts/unobtrusive-ajax-star-rating-bar/#comment-121
if (mysql_num_rows($query) == 0) {
$sql = "INSERT INTO t_ratings (`id`,`starid`,`total_votes`, `total_value`, `used_ips`,`product_id`) VALUES ('','$id', '0', '0', '','$product_id')";
$result = mysql_query($sql);
}

$numbers=mysql_fetch_assoc($query);


if ($numbers['total_votes'] < 1) {
	$count = 0;
} else {
	$count=$numbers['total_votes']; //how many votes total
}
$current_rating=$numbers['total_value']; //total number of rating added together and stored
$tense=($count==1) ? "vote" : "votes"; //plural form votes/vote

// determine whether the user has voted, so we know how to draw the ul/li
$voted=mysql_num_rows(mysql_query("SELECT used_ips FROM t_ratings WHERE used_ips LIKE '%".$ip."%' AND starid='".$id."' AND product_id='".$product_id."' ")); 

// now draw the rating bar
$rating_width = @number_format($current_rating/$count,2)*$rating_unitwidth;
$rating1 = @number_format($current_rating/$count,1);
$rating2 = @number_format($current_rating/$count,2);


if ($static == 'static') {

		$static_rater = array();
		$static_rater[] .= "\n".'<div class="ratingblock">';
		$static_rater[] .= '<div id="unit_long'.$id.'">';
		$static_rater[] .= '<ul id="unit_ul'.$id.'" class="unit-rating" style="width:'.$rating_unitwidth*$units.'px;">';
		$static_rater[] .= '<li class="current-rating" style="width:'.$rating_width.'px;">Currently '.$rating2.'/'.$units.'</li>';
		$static_rater[] .= '</ul>';
		$static_rater[] .= '<p class="static">'.$id.'. Rating: <strong> '.$rating1.'</strong>/'.$units.' ('.$count.' '.$tense.' cast) <em>This is \'static\'.</em></p>';
		$static_rater[] .= '</div>';
		$static_rater[] .= '</div>'."\n\n";

		return join("\n", $static_rater);


} else {

      $rater ='';
      $rater.='<div class="ratingblock">';

      $rater.='<div id="unit_long'.$id.'">';
      $rater.='  <ul id="unit_ul'.$id.'" class="unit-rating" style="width:'.$rating_unitwidth*$units.'px;">';
      $rater.='     <li class="current-rating" style="width:'.$rating_width.'px;">Currently '.$rating2.'/'.$units.'</li>';

      for ($ncount = 1; $ncount <= $units; $ncount++) { // loop from 1 to the number of units
           if(!$voted) { // if the user hasn't yet voted, draw the voting stars
              $rater.='<li><a href="'.$GLOBALS['_data_']['url_principale'].'product_vote/db.php?j='.$ncount.'&amp;q='.$id.'&amp;p='.$product_id.'&amp;t='.$ip.'&amp;c='.$units.'" title="'.$ncount.' out of '.$units.'" class="r'.$ncount.'-unit rater" rel="nofollow">'.$ncount.'</a></li>';
           }
      }
      $ncount=0; // resets the count

      $rater.='  </ul>';
      $rater.='  <p';
      if($voted){ $rater.=' class="voted"'; }
      $rater.='><div itemprop="aggregateRating" itemscope itemtype="http://schema.org/AggregateRating">
	  			 Rating: <strong> <span itemprop="ratingValue">'.$rating1.'</span></strong>/<span itemprop="bestRating">'.$units.'</span> (<span itemprop="reviewCount">'.$count.' '.$tense.'</span> cast)</div>';
      $rater.='  </p>';
      $rater.='</div>';
      $rater.='</div>';
      return $rater;
 }
}

?>
<?php

if ((!empty($_POST['action'])))
{ // Soumission du formulaire depuis la page indentification

    $ident_action = $_POST['action'];
    $email_ident = $_POST['ident_email'];
    $pass_ident = $_POST['ident_pass'];
    $type_ident = 1;
} elseif ((!empty($_POST['action_haut'])))
{ // Soumission du formulaire depuis l'entete

    $ident_action = $_POST['action_haut'];
    $email_ident = $_POST['ident_emailhaut'];
    $pass_ident = $_POST['ident_passhaut'];
    $type_ident = 2;
}
elseif ((!empty($_POST['action_pied'])))
{ // Soumission du formulaire depuis la pop up identification

    $ident_action = $_POST['action_pied'];
    $email_ident = $_POST['ident_emailpied'];
    $pass_ident = $_POST['ident_passpied'];
    $type_ident = 3;
}



if ((!empty($_POST)) && ($ident_action == 'ident_me'))
{

    if (($ses_client_id = Identification($email_ident, $pass_ident)) )
    {
        // Membre identifi&Eacute;
        
       
            session_register($GLOBALS['_data_']['session_idclient']);
			$_SESSION[$GLOBALS['_data_']['session_idclient']] = $ses_client_id;
        $ident_connex = '1';
        
        if($_SESSION[$GLOBALS['_data_']['session_idproduit']]>0){
            echo "<script type='application/javascript'>window.location='procedure_reservation.php'</script>";

        } else {
           echo "<script type='application/javascript'>window.location='moncompte.php'</script>";

        }
       	
                if($type_ident==1){
            $ok_ident = 1;
        }
        
       
        
    	$style_identification = 'none';
    } else
    {
        $ALERTE['ident_pass'] = 'Vos identifiants de connexion sont incorrects';
		$style_identification = 'block';
        $ident_error = '<p style="color:#016D5C;font-weight:bold" >Vos identifiants de connexion sont incorrects</p>
						<p>Si vous ne vous souvenez plus de vos acc&Egrave;s utiliser le lien <a href="javascript:PopupCentrer(\'popup_motpasse.php\',360,300,\'\')"><strong>suivant</strong></a></p>';
        if ($type_ident == 2){
	        $ALERTE['ident_pass_haut'] = '_error';
        }
        elseif($type_ident==3){
        	$style2_pied = ' style="border-color:#FF0000"';
        }
     
    }

}
else{
	$style_identification = 'none';
}

 
?>
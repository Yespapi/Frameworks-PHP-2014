<?php
    $action = $_POST['action'];
 	if( $action == "lost_pass" ) {
 		$style_lost = 'block';
 		if($_POST['email_lost']==""){$lost_alerte=htmlentities("Cette adresse email n'est pas enregistr&Eacute;e chez ").$GLOBALS['_data_']['nom_site'];}
		if(Form::VerifierAdresseMail($_POST['email_lost'])){}else{$lost_alerte=htmlentities("La syntaxe de l'adresse email est incorrecte");}
	
		if($lost_alerte == ''){
			$result_lost = Client::lost_pass($_POST['email_lost']);
	 		if($result_lost == "ok"){
	 			$lost_alerte 		= 'Votre mot de passe vous a &eacute;t&eacute; renvoy&eacute; &agrave; l&rsquo;adresse mail que vous venez de renseigner.';

	 		}else{
	 		$lost_alerte 	= 	htmlentities("Cette adresse email n'est pas enregistr&Eacute;e sur ").$GLOBALS['_data_']['nom_site'];
	 	}
		}
	 	
 	
	} else {
	   $style_lost = 'none';
	}
		$ENTETE.='		<div id="popup_password" style="display:'.$style_lost.'" class="popup2">
					<div class="conteneur_popup448">
						<div class="arrondi_haut_gris448"></div>
						<div class="pixel_gris448">
							<div class="pad_gd20_h10">
								<div class="contenu_popup">
									<div class="btn_fermer_popup2"><a href="javascript:void(0)"  title="Fermer" onclick="OuvrirFermer(\'popup_password\')"></a></div>
									<p class="titre_password titre_password_title">Mot de passe oubli&eacute;?</p>
									<div class="clear_right lineheight20">&nbsp;</div>
									<p class="lineheight15">Entrez l&rsquo;adresse mail avec laquelle vous vous identifiez. 
										Votre mot de passe vous sera renvoy&eacute; automatiquement par mail.</p>
									<p class="lineheight20">&nbsp;</p>
									<form method="post" action="" id="form_passe_perdu">
        <input type="hidden" name="action" value="lost_pass">
										<table id="tab_email_password" cellpadding="0" cellspacing="0">
											<tr>
												<td class="intitule_email_password"><p class="texte_gris" style="color:#6b829f">Votre email&nbsp;:</p></td>
											</tr>
											
											<tr>
												<td><input name="email_lost" type="text" class="chps_formu" value="'.trim(stripslashes($_POST['email_lost'])).'"/></td>
											</tr>
											<tr>
												<td><p class="lineheight15">&nbsp;</p></td>
											</tr>
											<tr>
												<td class="chps_btn"><input type="image" src="css/boutons/btn_valider_cap.png" onmouseover="this;src=\'css/boutons/btn_valider_cap_on.png\'" onmouseout="this.src=\'css/boutons/btn_valider_cap.png\'" alt="Valider" /></td>
											</tr>
										</table>
                                        <p class="error" align="center">'.$lost_alerte .'</p>
									</form>
									
									<p class="filet_transparent_big">&nbsp;</p>
									<p class="lineheight15">&nbsp;</p>
									<p class="centrer">Votre mot de passe vous a &eacute;t&eacute; renvoy&eacute; &agrave; l&rsquo;adresse mail <br />
										que vous venez de renseigner.</p>
								</div>
							</div>
						</div>
						<div class="arrondi_bas_gris448"></div>
					</div>
				</div>';
?>
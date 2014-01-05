<?php
$CORPS.='<div id="bloc_gauche180">
								<p class="affiner_recherche affiner_recherche_head">Affiner la recherche</p>
								<div class="pixel_gris180">
								
								
									<p class="filet_bigrisblanc">&nbsp;</p>
									<div class="bloc_nom_filtre">
										<p class="filtre_etat"><a href="javascript:void(0)" onclick="OuvrirFermer(\'bloc_filtre_etat\')">&Eacute;tat</a></p>
										<!--<p class="filtre_etat_on"><a href="javascript:void(0)" onclick="OuvrirFermer(\'bloc_filtre_etat\')"></a></p>-->
										<div class="bloc_filtre" id="bloc_filtre_etat" style="display:';$CORPS.=($idcat != "")?'block':'none';$CORPS.='">';
foreach($categories as $attribut=>$object_categorie){
$CORPS.='									<p><input type="checkbox" value="'.$object_categorie->getId().'" id="filtre_cat" name="filtre_cat" ';$CORPS.= ( ($idcat==$object_categorie->getId()) || (is_array($_SESSION["session_categorie"]) && (in_array($object_categorie->getId(),$_SESSION["session_categorie"]))))?'checked="checked"':'';$CORPS.=' onClick="navig_listings_jquery(\'session_categorie\',\''.$object_categorie->getId().'\',this.checked);" />&nbsp;'.$object_categorie->getNom().'</p>
											<p class="lineheight05">&nbsp;</p>';
}
$CORPS.='								</div>
									</div>
									
<div id="AffSsCatGauche" >
									
									<p class="filet_dashed_blanc">&nbsp;</p>
									<div class="bloc_nom_filtre">
										<p class="filtre_marque"><a href="javascript:void(0)" onclick="OuvrirFermer(\'bloc_filtre_marque\')">Marque</a></p>
										<div class="bloc_filtre" id="bloc_filtre_marque" style="display:';$CORPS.=(($idsscat != "") || ($idmarque != "") || (!empty($_SESSION["session_marque"])) || (!empty($_SESSION['sscat_menu'])) )?'block':'none';$CORPS.='">';
$list_sscategories 	= new SsCategorieList();
$sscategories		= $list_sscategories->getSearchResults();
foreach($sscategories as $attribut=>$object_marque){
$CORPS.='									<p><input type="checkbox" value="'.$object_marque->getId().'" id="filtre_marque" name="filtre_marque" ';$CORPS.= ( ($idsscat==$object_marque->getId()) || ($idmarque==$object_marque->getId()) || ( is_array($_SESSION["session_marque"]) && in_array($object_marque->getId(),$_SESSION["session_marque"])) || ( is_array($_SESSION["sscat_menu"]) && in_array($object_marque->getId(),$_SESSION["sscat_menu"]))  )?'checked="checked"':'';$CORPS.=' onClick="maj_modele_gauche(\''.$object_marque->getId().'\',this.checked);navig_listings_jquery(\'session_marque\',\''.$object_marque->getId().'\',this.checked);" />&nbsp;'.$object_marque->getNom().'</a></p>
											<p class="lineheight05">&nbsp;</p>';
}

$CORPS.='								</div>
									</div>
									
</div>
									';

/*----------------------------------------------------------------*/
// 							Mod&Egrave;le
/*----------------------------------------------------------------*/


$CORPS.='<div id="AffModeleGauche" >
							<p class="filet_dashed_blanc">&nbsp;</p>
									<div class="bloc_nom_filtre">
										<p class="filtre_modele"><a href="javascript:void(0)" onclick="OuvrirFermer(\'bloc_filtre_modele\')">Mod&egrave;le</a></p>
										<div class="bloc_filtre" id="bloc_filtre_modele" style="display:';$CORPS.=(($idmarque != '') || ($idsscat != '') || (!empty($_SESSION["session_modele"])) || (!empty($_SESSION["sscat_menu"])) )?'block':'none';$CORPS.='">';
$list_modele 				= new ModeleList();
$tabmodele					= array();
if($idsscat != ''){
	$tabmodele['idsscat']	= $idsscat;
	$_SESSION['sscat_menu'][] = $idsscat;
}
elseif($idmarque != ''){
	$tabmodele['idsscat']	= $idmarque;
	$_SESSION['sscat_menu'][] = $idmarque;
}


if(!empty($tabmodele)){
$modeles				= $list_modele->getSearchResults($tabmodele);


foreach($modeles as $attribut=>$object_modele){
$CORPS.='	<p><input type="checkbox" value="'.$object_modele->getId().'" id="filtre_modele" name="filtre_modele" ';$CORPS.= ( ($idmodele==$object_modele->getId()) || ( is_array($_SESSION["session_modele"]) && in_array($object_modele->getId(),$_SESSION["session_modele"])))?'checked="checked"':'';$CORPS.=' onClick="navig_listings_jquery(\'session_modele\',\''.$object_modele->getId().'\',this.checked);" />&nbsp;'.$object_modele->getNom().'</p>
			<p class="lineheight05">&nbsp;</p>';
}
}
else if(empty($tabmodele)){
$modeles				= $list_modele->getSearchResults($tabmodele);


foreach($modeles as $attribut=>$object_modele){
$CORPS.='	<p><input type="checkbox" value="'.$object_modele->getId().'" id="filtre_modele" name="filtre_modele" ';$CORPS.= ( ($idmodele==$object_modele->getId()) || ( is_array($_SESSION["session_modele"]) && in_array($object_modele->getId(),$_SESSION["session_modele"])))?'checked="checked"':'';$CORPS.=' onClick="navig_listings_jquery(\'session_modele\',\''.$object_modele->getId().'\',this.checked);" />&nbsp;'.$object_modele->getNom().'</p>
			<p class="lineheight05">&nbsp;</p>';
}
}
else{
	$CORPS.=htmlspecialchars_decode("S&eacute;lectionnez une mod&egrave;le");
}
$CORPS.='								</div>
									</div>
		 </div>';


$CORPS.='							<p class="filet_dashed_blanc">&nbsp;</p>
									<div class="bloc_nom_filtre">
										<p class="filtre_vehicule"><a href="javascript:void(0)" onclick="OuvrirFermer(\'bloc_filtre_vehicule\')">Type de v&eacute;hicule</a></p>
										<div class="bloc_filtre" id="bloc_filtre_vehicule" style="display:';$CORPS.=(!empty($_SESSION["session_type"]))?'block':'none';$CORPS.='">';
$list_types 	= new TypesList();
$types			= $list_types->getSearchResults();
foreach($types as $attribut=>$object_type){
	
$CORPS.='									<p><input type="checkbox" value="'.$object_type->getId().'" id="filtre_type" name="filtre_type" ';$CORPS.= ( ($idtype==$object_type->getId()) || ( is_array($_SESSION["session_type"]) && in_array($object_type->getId(),$_SESSION["session_type"])))?'checked="checked"':'';$CORPS.=' onClick="navig_listings_jquery(\'session_type\',\''.$object_type->getId().'\',this.checked);" />&nbsp;'.$object_type->getNom().'</a></p>
											<p class="lineheight05">&nbsp;</p>';
}

$CORPS.='								</div>
									</div>';


/***************************Add of year**********************/

$CORPS.='							<p class="filet_dashed_blanc">&nbsp;</p>
									<div class="bloc_nom_filtre">
										<p class="filtre_vehicule"><a href="javascript:void(0)" onclick="OuvrirFermer(\'bloc_filtre_year\')">Ann&eacute;e</a></p>
										<div class="bloc_filtre" id="bloc_filtre_year" style="display:';$CORPS.=(!empty($_SESSION["session_year"]))?'block':'none';$CORPS.='">';
$list_year 	= new YearList();
$year			= $list_year->getSearchResults();
foreach($year as $attribut=>$object_year){
	
$CORPS.='									<p><input type="checkbox" value="'.$object_year->getId().'" id="filtre_year" name="filtre_year" ';$CORPS.= ( ($idyear==$object_year->getId()) || ( is_array($_SESSION["session_year"]) && in_array($object_year->getId(),$_SESSION["session_year"])))?'checked="checked"':'';$CORPS.=' onClick="navig_listings_jquery(\'session_year\',\''.$object_year->getId().'\',this.checked);" />&nbsp;'.$object_year->getNom().'</a></p>
											<p class="lineheight05">&nbsp;</p>';
}

$CORPS.='								</div>
									</div>';
									
/**************************End of year**********************/									


/*----------------------------------------------------------------*/
// 							Motorisation
/*----------------------------------------------------------------*/
$CORPS.='
									
									
									<p class="filet_dashed_blanc">&nbsp;</p>
									<div class="bloc_nom_filtre">
										<p class="filtre_motorisation"><a href="javascript:void(0)" onclick="OuvrirFermer(\'bloc_filtre_motorisation\')">Motorisation</a></p>
										<div class="bloc_filtre" id="bloc_filtre_motorisation" style="display:';$CORPS.=(!empty($_SESSION["session_motorisation"]))?'block':'none';$CORPS.='">';
$list_motorisations 	= new MotorisationsList();
$motorisations			= $list_motorisations->getSearchResults();
foreach($motorisations as $attribut=>$object_motorisations){
$CORPS.='									<p><input type="checkbox" value="'.$object_motorisations->getId().'" id="filtre_motorisation" name="filtre_motorisation" ';$CORPS.= ( ($idmotorisation==$object_motorisations->getId()) || ( is_array($_SESSION["session_motorisation"]) && in_array($object_motorisations->getId(),$_SESSION["session_motorisation"])))?'checked="checked"':'';$CORPS.=' onClick="navig_listings_jquery(\'session_motorisation\',\''.$object_motorisations->getId().'\',this.checked);" />&nbsp;'.$object_motorisations->getNom().'</a></p>
											<p class="lineheight05">&nbsp;</p>';
}
$CORPS.='								</div>
									</div>
									
									
									<p class="filet_dashed_blanc">&nbsp;</p>
									<div class="bloc_nom_filtre">
										<p class="filtre_prix"><a href="javascript:void(0)" onclick="OuvrirFermer(\'bloc_filtre_prix\')">Prix</a></p>
										<div class="bloc_filtre_curseur" id="bloc_filtre_prix" style="display:';$CORPS.=( (!empty($_SESSION["session_prix1"])) || (!empty($_SESSION["session_prix2"])) )?'block':'none';$CORPS.='">
											<div id="slider-range" ></div>
											<p>&nbsp;</p>
											<p><input type="text" id="amount" style="border:0;background:#ebe9e8;color:#000;font-size:11px" /></p>
										</div>
									</div>
									<p class="filet_dashed_blanc">&nbsp;</p>
									<div class="bloc_nom_filtre">
										<p class="filtre_miles"><a href="javascript:void(0)" onclick="OuvrirFermer(\'bloc_filtre_miles\')">KM</a></p>
										<div class="bloc_filtre_curseur" id="bloc_filtre_miles" style="display:';$CORPS.=( (!empty($_SESSION["session_miles1"])) || (!empty($_SESSION["session_miles2"])) )?'block':'none';$CORPS.='">
											<div id="slider-miles" ></div>
											<p>&nbsp;</p>
											<p><input type="text" id="affmiles" style="border:0;background:#ebe9e8;color:#000;font-size:11px" /></p>
										</div>
									</div>
								</div>
								<div class="arrondi_bas_gris180"></div>
							</div>';




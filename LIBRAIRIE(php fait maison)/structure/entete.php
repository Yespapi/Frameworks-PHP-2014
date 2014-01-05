
<?php
if(IsConnect()) //Encart connect&Eacute;
    $ident_client = new Client($_SESSION[$GLOBALS['_data_']['session_idclient']]);

$ENTETE = '	
<script type="application/javascript" language="javascript">
	function LogoHide()
	{
		document.getElementById("logo_arrow_content").style.display = "none";
	}
	function ShowHide()
	{
		if(document.getElementById("logo_arrow_content").style.display == "block"){
			document.getElementById("logo_arrow_content").style.display = "none";
		}
		else{
			document.getElementById("logo_arrow_content").style.display = "block";
		}
	}
</script>
<script type="text/javascript">
	$("body").click(function(e) {
        // do something here like:
		var target = $(e.target);
		if(target.is("#logo_arrow"))
		{
			//Do Nothing
		}else
		{
        	LogoHide();
		}
      });

</script>
<div id="header">	
	<div id="header_iternal_part_main">
	<div id="header_iternal_part">									
				<div id="logo_images">					
					<div id="logo_MVA">
					<a href="'.$GLOBALS['_data_']['url_principale'].'index.php"></a>
					</div>		
					<div class="logo_arrow"><a href="javascript:void(0)" onclick="ShowHide()"><img src="'.$GLOBALS['_data_']['url_principale'].'css/images/logo_cheval_mustang.gif"  id="logo_arrow" border="0"></a></div>
					<div class="logo_arrow_content" id="logo_arrow_content">
						<a href="http://www.mavoitureamericaine.com/" target="_blank"><img src="'.$GLOBALS['_data_']['url_principale'].'css/images/logo_mavoitureamerica.png" border="0" alt="Voiture Americaine" title="Voiture Americaine"></a>
						<a href="http://www.voiture-us.com/" target="_blank"><img src="'.$GLOBALS['_data_']['url_principale'].'css/images/logo_voitureus.png" border="0" alt="Voiture Americaine" title="Voiture Americaine"></a>
						<a href="http://www.accessoires-automobiles.com/" target="_blank"><img src="'.$GLOBALS['_data_']['url_principale'].'/poliokolite_logo.png" border="0" alt="Poliokolite" title="Poliokolite"></a>
						<a href="http://www.mavoitureallemande.com/" target="_blank"><img src="'.$GLOBALS['_data_']['url_principale'].'css/images/logo_mavoitureallemande.png" border="0" alt="Voiture Allemande" title="Voiture Allemande"></a>
						<a href="http://www.mavoitureitalienne.com/" target="_blank"><img src="'.$GLOBALS['_data_']['url_principale'].'css/images/logo_mavoitureitalienne.png" border="0" alt="Voiture Italienne" title="Voiture Italienne"></a>
						<a href="http://www.monpickup.fr/" target="_blank"><img src="'.$GLOBALS['_data_']['url_principale'].'css/images/logo_monopickup.png" border="0" alt="Pickup" title="Pickup"></a>
						<a href="http://www.voiturettes.fr/" target="_blank"><img src="'.$GLOBALS['_data_']['url_principale'].'css/images/logo_voiturette.png" border="0" alt="Citadine" title="Citadine"></a>
						<a href="http://www.mustangs.fr/" target="_blank"><img src="'.$GLOBALS['_data_']['url_principale'].'css/images/logo_mva_2.png" border="0" alt="Mustangs" title="Mustangs"></a>
						<a href="http://www.uncabriolet.com/" target="_blank"><img src="'.$GLOBALS['_data_']['url_principale'].'css/images/logo_cabriolet.png" border="0" alt="Cabriolet" title="Cabriolet"></a>
						<a href="http://www.mavoiture4x4.fr/" target="_blank"><img src="'.$GLOBALS['_data_']['url_principale'].'css/images/logo_4x4.png" border="0" alt="4x4" title="4x4"></a>
						
						
						<a href="http://www.mavoitureanglaise.com/" target="_blank"><img src="'.$GLOBALS['_data_']['url_principale'].'css/images/logo_mavoitureanglaise.png" border="0" alt="Voiture Anglaise" title="Voiture Anglaise"></a>
						<a href="http://www.voitureplus.com/" target="_blank"><img src="'.$GLOBALS['_data_']['url_principale'].'css/images/logo_voitureplus.png" border="0" alt="Voiture Plus" title="Voiture Plus"></a>   
						
						
					</div>
				</div>		
					
				<div style="float:left;width:800px;">	
					<ul id="menu_secondaire">
						<li class="onglet13"><a href="'.$GLOBALS['_data_']['url_principale'].'contactez_voiture_de_collection.php"></a></li>
						<li class="onglet11"><a href="'.$GLOBALS['_data_']['url_principale'].'demande_assurance_voiture_de_collection.php">DEMANDE D&acute;ASURANCE</a></li>
						<li class="onglet10"><a href="'.$GLOBALS['_data_']['url_principale'].'demande_financement_voiture_de_collection.php">DEMANDE DE FINANCEMENT</a></li>
						<li class="onglet9"><a href="'.$GLOBALS['_data_']['url_principale'].'mandat_recherche_voiture_de_collection.php">MANDAT DE RECHERCHE</a></li>
						<li class="onglet8"><a href="'.$GLOBALS['_data_']['url_principale'].'qui_sommes_nous.php">QUI SOMMES-NOUS</a></li>
						<li class="onglet6"><a href="'.$GLOBALS['_data_']['url_principale'].'index.php">ACCUEIL</a></li>
						<li class="onglet7"><a href="'.$GLOBALS['_data_']['url_principale'].'index.php"></a></li>
						
					</ul>

					<p class="clear_right"></p>
					
					
					
					
					
					<div id="gabarit_menu">';

require('connexion.php');
require('passe_perdu.php');

$list_categories 	= new CategorieList();
$categories			= $list_categories->getSearchResults();

foreach($categories as $attribut=>$object_categorie){
	
$ENTETE.='<div id="menu'.$object_categorie->getId().'" onmouseover="menu_deroul(\'menu'.$object_categorie->getId().'\',1,1)" onmouseout="menu_deroul(\'menu'.$object_categorie->getId().'\',0,1)">
				<div id="menu'.$object_categorie->getId().'_ret"><a href="'.$GLOBALS['_data_']['url_principale'].'categorie.php?idcat='.$object_categorie->getId().'"><img src="'.$GLOBALS['_data_']['url_principale'].'css/boutons/onglet'.$object_categorie->getId().'_hover.png" alt="'.$object_categorie->getNom().'" title="'.$object_categorie->getNom().'" /></a></div>';

$ENTETE.='<div id="ss_menu'.$object_categorie->getId().'" onmouseover="menu_deroul(\'menu'.$object_categorie->getId().'\',1,1)" onmouseout="menu_deroul(\'menu'.$object_categorie->getId().'\',0,1)">
			<div class="ss_menu_demenu">';

			$tasscat['idcat']	= $object_categorie->getId();
			$list_sscategories 	= new SsCategorieList();
			$sscategories		= $list_sscategories->getSearchResults($tasscat);
			foreach($sscategories as $attribut=>$object_sscategorie){
				$ENTETE.='		<p class="ss_menu_txt"><a href="'.$GLOBALS['_data_']['url_principale'].'sous_categorie.php?idcat='.$object_categorie->getId().'&idsscat='.$object_sscategorie->getId().'" class="ss_menu_liens">'.$object_sscategorie->getNom().'</a></p>';
			}
$ENTETE.='	</div>
		</div>';

$ENTETE.='	</div>';
}

$ENTETE.='<div id="menu4" onmouseover="menu_deroul(\'menu4\',1,0)" onmouseout="menu_deroul(\'menu4\',0,0)" >
				<div id="menu4_ret"><a href="'.$GLOBALS['_data_']['url_principale'].'promotions_voiture_voiture_de_collection.php"><img src="'.$GLOBALS['_data_']['url_principale'].'css/boutons/onglet4_hover.png" alt="Voiture De Collection en Promotions" title="Voiture De Collection en Promotions" /></a></div>
			</div>
			<div id="menu5" onmouseover="menu_deroul(\'menu5\',1,0)" onmouseout="menu_deroul(\'menu5\',0,0)" >
				<div id="menu5_ret"><a href="'.$GLOBALS['_data_']['url_principale'].'recherche_voiture_voiture_de_collection.php"><img src="'.$GLOBALS['_data_']['url_principale'].'css/boutons/onglet5_hover.png" alt="Rechercher ma Voiture De Collection" title="Rechercher ma Voiture De Collection" /></a></div>
			</div>
			<div id="menu6" onmouseover="menu_deroul(\'menu6\',1,0)" onmouseout="menu_deroul(\'menu6\',0,0)">

				<div id="menu6_ret"><a href="'.$GLOBALS['_data_']['url_principale'].'moncompte.php"><img src="'.$GLOBALS['_data_']['url_principale'].'css/boutons/onglet6_hover.png" alt="Mon compte" title="Mon compte" /></a></div>
			</div>
		</div>
		
		<div class="clear_left"></div>';


/*foreach($categories as $attribut=>$object_categorie){

$ENTETE.='<div id="ss_menu'.$object_categorie->getId().'" onmouseover="menu_deroul(\'menu'.$object_categorie->getId().'\',1,1)" onmouseout="menu_deroul(\'menu'.$object_categorie->getId().'\',0,1)">
			<div class="ss_menu_demenu">';


$tasscat['idcat']	= $object_categorie->getId();
$list_sscategories 	= new SsCategorieList();
$sscategories		= $list_sscategories->getSearchResults($tasscat);
foreach($sscategories as $attribut=>$object_sscategorie){
	$ENTETE.='		<p class="ss_menu_txt"><a href="sous_categorie.php?idcat='.$object_categorie->getId().'&idsscat='.$object_sscategorie->getId().'" class="ss_menu_liens">'.$object_sscategorie->getNom().'</a></p>';
}
$ENTETE.='	</div>
		</div>';
}*/

if(!empty($_POST['idcatentete'])){
	$cat_entete 	= new Categorie($_POST['idcatentete']);
	$filtre_entete 	= stripslashes(ucfirst(strtolower($cat_entete->getNom())));
}
if($_POST['promotionentete'] == 1){
	$filtre_entete = 'Promotions';
}

if($filtre_entete == '')
	$filtre_entete = 'Sur tout le site';
	
$ENTETE.='<div style="width:701px;float:right">
			<form action="'.$GLOBALS['_data_']['url_principale'].'resultat_recherche_voiture_de_collection.php" method="post" id="form_search_entete" name="form_search_entete" >
			<ul class="liste_recherche">
				<li class="intitule_rech"></li>
				<li class="chps_input">

					<input name="search_key" id="search_key" type="text" class="chps132" onfocus="this.value=\'\'" value="'.stripslashes($_POST['search_key']).'" />
				</li>
				<li class="chps_select">
					<fieldset id="conteneurSelect">
					<div class="inputsSelect">
						<p class="selects" onclick="showHideSelect(\'listeSelect1\')" id="selectentete" >'.$filtre_entete.'</p>
						<ul id="listeSelect1">
							<li><a href="javascript:void(0)" onclick="validAndHide(\'\', this, \'idcatentete\', \'selectentete\')">Sur tout le site</a></li>';
foreach($categories as $attribut=>$object_categorie){
$ENTETE.='					<li><a href="javascript:void(0)" onclick="validAndHide(\''.$object_categorie->getId().'\', this, \'idcatentete\', \'selectentete\')">'.ucfirst(strtolower($object_categorie->getNom())).'</a></li>';
}
$ENTETE.='					<li><a href="javascript:void(0)" onclick="validAndHide(\'1\', this, \'promotionentete\', \'selectentete\')">Promotions</a></li>
						</ul>
					</div>
					<input type="hidden" name="idcatentete" id="idcatentete" />
					<input type="hidden" name="promotionentete" id="promotionentete" />
					</fieldset>
				</li>
				<li class="btn">
					<input type="image" src="'.$GLOBALS['_data_']['url_principale'].'css/boutons/btn_ok.png" onmouseover="this.src=\''.$GLOBALS['_data_']['url_principale'].'css/boutons/btn_ok_on.png\'" onmouseout="this.src=\''.$GLOBALS['_data_']['url_principale'].'css/boutons/btn_ok.png\'" alt="OK" />
				</li>
			</ul>
		</form>
';
	$ENTETE.='<div style="width:300px;float:left;padding:2px; margin-left:15px;">';

	$ENTETE.="<div style=\"width:80px;float:left\"><!-- Place this tag where you want the +1 button to render -->
	<g:plusone size=\"medium\" href=\"www.mavoituredecollection.com\"></g:plusone>
	
	<!-- Place this render call where appropriate -->
	<script type=\"text/javascript\">
	  (function() {
		var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
		po.src = 'https://apis.google.com/js/plusone.js';
		var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
	  })();
	</script></div>";
	
	
	$ENTETE.='<div style="width:110px;float:left"><a href="https://twitter.com/share" class="twitter-share-button" data-url="http://www.mavoituredecollection.com/" data-count="horizontal">Tweet</a><script type="text/javascript" src="//platform.twitter.com/widgets.js"></script></div>';
	
	$ENTETE.='<div style="width:80px;float:left"><div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) {return;}
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
  fjs.parentNode.insertBefore(js, fjs);
}(document, "script", "facebook-jssdk"));</script>

<div class="fb-like" data-href="http://www.mavoituredecollection.com" data-send="false" data-layout="button_count" data-width="80" data-show-faces="false"></div></div></div>';

	$ENTETE.="</div>		<p class=\"clear_left\"></p>
		</div>
		<div id=\"logo_LIVE_CHAT\" class=\"logo_LIVE_CHAT\">
		<a href=\"/mavoituredecollection/support/client.php?locale=fr&amp;style=simplicity\" target=\"_blank\" onclick=\"if(navigator.userAgent.toLowerCase().indexOf('opera') != -1 &amp;&amp; window.event.preventDefault) window.event.preventDefault();this.newWindow = window.open('/support/client.php?locale=fr&amp;style=simplicity&amp;url='+escape(document.location.href)+'&amp;referrer='+escape(document.referrer), 'webim', 'toolbar=0,scrollbars=0,location=0,status=1,menubar=0,width=640,height=480,resizable=1');this.newWindow.focus();this.newWindow.opener=window;return false;\"><img src=\"support/b.php?i=simple&amp;lang=fr\" border=\"0\" width=\"204\" height=\"75\" alt=\"\"/></a>
		</div>
		</div>
		
	</div>
	</div>
	</div>";


<?php

$PIED = '
	<div id="footer">.
	
	<div id="footer_internal_part1">
		<p class="lineheight15">&nbsp;</p>
		<div id="footer_internal_part1_colum1">
			<p id="footer_internal_heading">Ma voiture De Collection</p>
			<ul>
				<li><a href="'.$GLOBALS['_data_']['url_principale'].'recherche_voiture_voiture_de_collection.php">Recherche</a></li>
				<li><a href="'.$GLOBALS['_data_']['url_principale'].'mandat_recherche_voiture_de_collection.php">Mandat de recherche</a></li>
				<li><a href="'.$GLOBALS['_data_']['url_principale'].'promotions_voiture_voiture_de_collection.php">Promotions</a></li>
				<li><a href="'.$GLOBALS['_data_']['url_principale'].'qui_sommes_nous_etape.php">R&eacute;servation</a></li>
				<li><a href="'.$GLOBALS['_data_']['url_principale'].'club_voiture_voiture_de_collection.php">Carte Club</a></li>
			</ul>
		</div>
		<div id="footer_internal_part1_colum3">
			<p id="footer_internal_heading">Nos services</p>
			<ul>
				<li><a href="'.$GLOBALS['_data_']['url_principale'].'demande_financement_voiture_de_collection.php">Financement</a></li>
				<li><a href="'.$GLOBALS['_data_']['url_principale'].'assurance_voiture_de_collection.php">Assurance</a></li>
			   
				<li><a href="'.$GLOBALS['_data_']['url_principale'].'homologation_voiture_de_collection.php">Homologation</a></li>
				<li><a href="'.$GLOBALS['_data_']['url_principale'].'calcul_importation_voiture_de_collection.php">Calculateur</a></li>
				<li><a href="http://www.accessoires-automobiles.com/" target="blank_">Poliokolite</a></li>				
		</div>
		<div id="footer_internal_part1_colum2">
			<p id="footer_internal_heading">Informations</p>
			<ul>
				<li><a href="'.$GLOBALS['_data_']['url_principale'].'plan.php">Plan du site</a></li>
				<li><a href="'.$GLOBALS['_data_']['url_principale'].'actualite_voiture_de_collection.php">Actualit&eacute;s</a></li>
				<li><a href="#">Notre blog</a></li>
				<li><a href="'.$GLOBALS['_data_']['url_principale'].'sitedugroupe.php">Sites Groupe</a></li>
				<li><a href="#">Parternariats</a></li>
				<li><a href="'.$GLOBALS['_data_']['url_principale'].'nossalons.php">Nos salons</a></li>
				<li><a href="'.$GLOBALS['_data_']['url_principale'].'espace_presse.php">Articles de Presse</a></li>
								
			</ul>
						
		</div>		
		<div id="footer_internal_part1_colum4">
			<p id="footer_internal_heading">A propos</p>
			<ul>
				<li><a href="'.$GLOBALS['_data_']['url_principale'].'qui_sommes_nous.php">Pr&eacute;sentation</a></li>
				<li><a href="'.$GLOBALS['_data_']['url_principale'].'qui_sommes_nous_concept.php">Le concept</a></li>
				<li><a href="'.$GLOBALS['_data_']['url_principale'].'cgv.php">CGV</a></li> 
				<li><a href="'.$GLOBALS['_data_']['url_principale'].'mentions.php">Mentions l&eacute;gales</a></li>
				<li><a href="'.$GLOBALS['_data_']['url_principale'].'contactez_voiture_de_collection.php">Nous contacter</a></li>
			</ul>						
		</div>
		<div id="footer_internal_part1_colum5">
			<p id="footer_internal_heading">Mod&egrave;les de l&eacute;gende </p>
			<ul>
				<li><a href="#">Aston Martin Vanquish</a></li>
				<li><a href="#">Jaguar JX</a></li>
				<li><a href="#">Bentley Mulsanne 2012</a></li>
				<li><a href="#">Range Rover Evoque 2012</a></li>
				<li><a href="#">MG6 GT 2012</a></li>
			</ul>	
		</div>
<script type="text/javascript">
function getFocus(a)
	{
	document.getElementById(a).value="";
	}
function lostFocus(b)
	{
		if(document.getElementById(b).value=="")
			{
				if(document.getElementById(b).id=="input_email")
				{
					document.getElementById(b).value="Votre adresse email:";
				}
			}
	}
</script>
		<div id="footer_internal_part1_colum6">
			<p id="footer_internal_heading">NEWSLETTER</p>
			<div id="news_slater_mail">
				
				
				<form action="inscription_newsletter.php" id="newsletter_subscribers" method="post">
				<input type="text" name="input_email" id="input_email" value="Votre adresse email:" onfocus="getFocus(this.id)" onblur="lostFocus(this.id)"/>
				<input id="btn_email" type="image" src="'.$GLOBALS['_data_']['url_principale'].'css/images/footer_email_btn.png">
				
				</form>
			</div>			
			<p id="footer_internal_heading">FORUM MaVoitureDeCollection.com</p>
			<a href="#"><img class="image-margin" src="'.$GLOBALS['_data_']['url_principale'].'css/images/footer_forum.png" alt=""></a>
			
		</div>		
		<p class="clear_both"></p>
	</div>
	<div id="footer_internal_part2">		
		<p id="copyright">Copyright © 2012 MaVoitureDeCollection.com SARL Marque D&eacute;pos&eacute;e</br><span target="_blank">Version1.0</span> </p>
		<a href="'.$GLOBALS['_data_']['url_principale'].'contactez_voiture_de_collection.php"><p id="credit_debit_card"></p></a>
	</div>	
	<div id="footer_internal_part3">
		<div class="marquee" id="mycrawler2">
			<a href="http://www.voiturettes.fr/" target="_blank" ><img src="'.$GLOBALS['_data_']['url_principale'].'css/images/footer_voiturette.png" width="100px" height="43px" alt="Citadine" title="Citadine" /></a>
			<a href="http://www.uncabriolet.com/" target="_blank"><img src="'.$GLOBALS['_data_']['url_principale'].'css/images/footer_mon_cabriolet.png" width="100px" height="43px" alt="Cabriolet" title="Cabriolet" /></a>
			<a href="http://www.mavoiture4x4.fr/" target="_blank"><img src="'.$GLOBALS['_data_']['url_principale'].'css/images/footer_mon4x4.png" width="100px" height="43px" alt="4x4" title="4x4" /></a>
			<a href="http://www.mavoitureitalienne.com/" target="_blank"><img src="'.$GLOBALS['_data_']['url_principale'].'css/images/footer_mavoitureitalienne.png"  width="100px" height="43px" alt="Voiture Italienne" title="Voiture Italienne" /></a>
			<a href="http://www.mavoitureamericaine.com/" target="_blank"><img src="'.$GLOBALS['_data_']['url_principale'].'css/images/footer_ramses_2.png" width="100px" height="43px" alt="Ramses 2" title="Ramses 2" /></a>
			<a href="http://www.voiture-us.com/" target="_blank" ><img src="'.$GLOBALS['_data_']['url_principale'].'css/images/footer_voitureus.png" width="100px" height="43px" alt="Voiture Americaine" title="Voiture Americaine" /></a>
			<a href="http://www.accessoires-automobiles.com/" target="_blank"><img src="'.$GLOBALS['_data_']['url_principale'].'poliokolite_footer.png" width="100px" height="43px"  alt="Poliokolite est le sp&eacute;cialiste des accessoires automobiles" title="Poliokolite est une marque d\'accessoires automobiles" /></a>
			<a href="http://www.monpickup.fr/" target="_blank"><img src="'.$GLOBALS['_data_']['url_principale'].'css/images/footer_monopickup.png" width="100px" height="43px" alt="Pickup" title="Pickup" /></a>
			<a href="http://www.mavoitureamericaine.com/" target="_blank"><img src="'.$GLOBALS['_data_']['url_principale'].'css/images/footer_mavoitureamerica.png"  width="100px" height="43px" alt="Voiture Americaine" title="Voiture Americaine" /></a>
			<a href="http://www.mavoitureallemande.com/" target="_blank"><img src="'.$GLOBALS['_data_']['url_principale'].'css/images/footer_mavoitureallemande.png" width="100px" height="43px" alt="Voiture Allemande" title="Voiture Allemande" /></a>
			<a href="http://www.mustangs.fr/" target="_blank"><img src="'.$GLOBALS['_data_']['url_principale'].'css/images/footer_mustangs.png" width="100px" height="43px" alt="Voiture Mustangs.fr" title="Mustangs.fr"/></a>
		
		
		
		    <a href="http://www.voitureplus.com/" target="_blank" ><img src="'.$GLOBALS['_data_']['url_principale'].'css/images/footer_voitureplus.png" width="100px" height="43px" alt="Voiture Plus" title="Voiture Plus" /></a>
		    <a href="http://www.mavoitureanglaise.com/" target="_blank" ><img src="'.$GLOBALS['_data_']['url_principale'].'css/images/footer_mavoitureanglaise.png" width="100px" height="43px" alt="Voiture Anglaise" title="Voiture Anglaise" /></a>
		
		
		
		</div>			
	</div>	
</div>

<script type="text/javascript">
			marqueeInit({
			uniqueid: "mycrawler2",
			style: {
				"padding": "2px",
				"width": "1250px",
				"height": "64px"
			},
			inc: 3, //speed - pixel increment for each iteration of this marquee\'s movement
			mouse: "pause", //mouseover behavior ("pause" "cursor driven" or false)
			moveatleast: 2,
			neutral: 150,
			savedirection: true,
			random: false
			});
		</script>
<script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src=\'" + gaJsHost + "google-analytics.com/ga.js\' type=\'text/javascript\'%3E%3C/script%3E"));
</script>
<script type="text/javascript">
try {
var pageTracker = _gat._getTracker("UA-11805341-1");
pageTracker._trackPageview();
} catch(err) {}</script>';

$PIED.='
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(["_setAccount", "UA-29728127-3"]);
  _gaq.push(["_trackPageview"]);

  (function() {
    var ga = document.createElement("script"); ga.type = "text/javascript"; ga.async = true;
    ga.src = ("https:" == document.location.protocol ? "https://ssl" : "http://www") + ".google-analytics.com/ga.js";
    var s = document.getElementsByTagName("script")[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>';
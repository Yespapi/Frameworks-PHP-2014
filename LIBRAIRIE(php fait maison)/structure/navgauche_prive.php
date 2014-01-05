<?php
        
        $classon = 'class="lien_fleche_on"';
        $a1deb = '<a href="moncompte_reservations.php" class="lien_fleche">';
        $a1end = '</a>';
        $a2deb = '<a href="moncompte_infopersonnels.php" class="lien_fleche">';
        $a2end = '</a>';
        $a3deb = '<a href="moncompte_identifiants.php" class="lien_fleche">';
        $a3end = '</a>';
        $a4deb = '<a href="moncompte_newsletters.php" class="lien_fleche">';
        $a4end = '</a>';
        
        switch($NAVMONCOMPTE){
            case '1':
            $p1on = $classon;
            $a1deb = '';
            $a1end = '';
            break;
            case '2':
            $p2on = $classon;
            $a2deb = '';
            $a2end = '';
            break;
            case '3':
            $p3on = $classon;
            $a3deb = '';
            $a3end = '';
            break;
            case '4':
            $p4on = $classon;
            $a4deb = '';
            $a4end = '';
            break;
        }
	$NAVGAUCHE = '<div id="bloc_gauche180">
								<p id="arrondi_moncompte" class="arrondi_moncompte_title"><a href="moncompte.php">Mon Compte</a></p>
								<div class="pixel_gris180">
									<p class="filet_bigrisblanc">&nbsp;</p>
									<div class="pad20">
										<p '.$p1on.'>'.$a1deb.'Mes r&eacute;servations'.$a1end.'</p>
										<p class="lineheight05">&nbsp;</p>
										<p '.$p2on.'>'.$a2deb.'Mes coordonn&eacute;es'.$a2end.'</p>
										<p class="lineheight05">&nbsp;</p>
										<p '.$p3on.'>'.$a3deb.'Mes identifiants'.$a3end.'</p>
										<p class="lineheight05">&nbsp;</p>
										<p '.$p4on.'>'.$a4deb.'Mes newsletters'.$a4end.'</p>
										<p class="lineheight05">&nbsp;</p>
										
										<p><a href="deco.php" class="lien_fleche">Deconnexion</a></p>
										<p class="lineheight05">&nbsp;</p>
									</div>
								</div>
								<div class="arrondi_bas_gris180"></div>
							</div>';
?>
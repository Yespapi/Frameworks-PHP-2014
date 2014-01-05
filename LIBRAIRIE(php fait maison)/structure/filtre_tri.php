<?php


switch($valselect_tri){
	case 'prix' 			: $nomtri = 'Prix';break;
	case 'idmarque' 		: $nomtri = 'Marque';break;
	case 'miles' 			: $nomtri = 'Miles';break;
	case 'publication'		: $nomtri = 'Etat';break;
	case 'idmotorisation' 	: $nomtri = 'motorisation';break;
	case 'idyear' 	        : $nomtri = 'Ann&eacute;e';break;
	default 				: $nomtri = 'Trier par';
}

$CORPS.='<table class="tab_resultat_filtre_pagination" cellpadding="0" cellspacing="0">
				<tr>
					<td class="resultat"><p><span class="color2"><strong>'.$nbres.'</strong></span> voiture(s) trouv&eacute;e(s)</p></td>
					<td class="chps1"><fieldset class="conteneurSelect3">
						<div class="inputsSelect3">
							<p class="selects" onclick="showHideSelect(\'listeSelect\')" id="select_tri" >'.$nomtri.'</p>
							<ul id="listeSelect">
								<li><a href="javascript:navig_listings_jquery(\'session_tri\',\'prix\',this.checked);" onclick="validAndHide(\'prix\', this, \'valselect_tri\', \'select_tri\')">Prix</a></li>
								<li><a href="javascript:navig_listings_jquery(\'session_tri\',\'idmarque\',this.checked);" onclick="validAndHide(\'idmarque\', this, \'valselect_tri\', \'select_tri\')">Marque</a></li>
								<li><a href="javascript:navig_listings_jquery(\'session_tri\',\'miles\',this.checked);" onclick="validAndHide(\'miles\', this, \'valselect_tri\', \'select_tri\')">Miles</a></li>
								<li><a href="javascript:navig_listings_jquery(\'session_tri\',\'publication\',this.checked);" onclick="validAndHide(\'etat\', this, \'valselect_tri\', \'select_tri\')">&Eacute;tat</a></li>
								<li><a href="javascript:navig_listings_jquery(\'session_tri\',\'idmotorisation\',this.checked);" onclick="validAndHide(\'idmotorisation\', this, \'valselect_tri\', \'select_tri\')">Motorisation</a></li>
							    <li><a href="javascript:navig_listings_jquery(\'session_tri\',\'idyear\',this.checked);" onclick="validAndHide(\'idyear\', this, \'valselect_tri\', \'select_tri\')">Ann&eacute;e</a></li>
							</ul>
						</div>
						<input type="hidden" name="valselect_tri" id="valselect_tri" value="'.$valselect_tri.'" />
						</fieldset></td>
					<td class="chps2"><fieldset class="conteneurSelect3">
						<div class="inputsSelect3">
							<p class="selects" onclick="showHideSelect(\'listeSelect2\')" id="select_page" >10 par page</p>
							<ul id="listeSelect2">
								<li><a href="javascript:navig_listings_jquery(\'session_page\',\'10\',this.checked);" onclick="validAndHide(\'session_page\', this, \'valselect_page\', \'select_page\')">10 par page</a></li>
								<li><a href="javascript:navig_listings_jquery(\'session_page\',\'20\',this.checked);" onclick="validAndHide(\'session_page\', this, \'valselect_page\', \'select_page\')">20 par page</a></li>
								<li><a href="javascript:navig_listings_jquery(\'session_page\',\'30\',this.checked);" onclick="validAndHide(\'session_page\', this, \'valselect_page\', \'select_page\')">30 par page</a></li>
								<li><a href="javascript:navig_listings_jquery(\'session_page\',\'40\',this.checked);" onclick="validAndHide(\'session_page\', this, \'valselect_page\', \'select_page\')">40 par page</a></li>
								<li><a href="javascript:navig_listings_jquery(\'session_page\',\'100\',this.checked);" onclick="validAndHide(\'session_page\', this, \'valselect_page\', \'select_page\')">Tous</a></li>
							</ul>
						</div>
						<input type="hidden" name="valselect_page" id="valselect_page" />
						</fieldset></td>
					<td class="page">
						<div class="pagination">'.$pagination.'</div>
					</td>
		</tr>
		</table>';
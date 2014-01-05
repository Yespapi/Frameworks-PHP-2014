<?php


class Commandes{
	
	 // D&Eacute;claration des variables
    public $Id;
    public $Ip;
    public $Date;
    public $Heure;
    public $Numcmd;
    public $Idmembre;
	public $Pseudo;
	public $Email;
	public $Nomcomplet;
    public $Adresse;
    public $Adresse2;
    public $Cp;
    public $Ville;
    public $Nomcompletliv;
    public $Adresseliv;
    public $Adresse2liv;
    public $Cpliv;
    public $Villeliv;
    public $Pays;
	public $Paysliv;
    public $Etat;
    public $Idretour;
    public $Total;
    public $Totalremb;
    public $TotalAchat;
    public $TotalAchatremb;
    public $Port;
    public $Codepromo;
    public $Remise;
    public $RemisePriv;
    public $Privileges;
    public $ModPaiement;
    public $Idtransaction;
    public $DebitCb;
    public $Recredite;
   	public $Statut;
   	public $Colis;
	public $Transporteur;
	public $LinkTransporteur;
	
	public $Commentaire;
	
	public function getId(){
		return $this->Id;
	}
	
	public function getNumCmd(){
		return $this->Numcmd;
	}
	
	public function getDate(){
		return $this->Date;
	}
	
	public function getTotal(){
		return $this->Total;
	}
	
	public function getRemise(){
		return $this->Remise;
	}
	
	public function getPort(){
		return $this->Port;
	}
	
	public function getStatut(){
		return $this->Statut;
	}
	
    public function __construct($numcmd)
    {


        $this->Numcmd = $numcmd;
        $this->setCommande();

    }
	
    private function setCommande()
    {
		$db = DB::get();
        $Req = "SELECT * FROM t_commandes WHERE commandes_numcmd = '" . $this->Numcmd.
            "' AND commandes_supprimer='0' ";
        //echo $Req;
        $Sql 						= $db->query($Req) or die(mysql_error());
        $val 						= $db->fetch_array($Sql);
        $this->Ip	 				= $val['commandes_ip'];
        $this->Date 				= $val['commandes_date'];
        $this->DateExp 				= $val['commandes_dateexp'];
	    $this->Id 					= $val['commandes_id'];
	    $this->Idmembre 			= $val['commandes_idmembre'];
		$this->Email 				= stripallslashes($val['commandes_email']);
		$this->Nomcomplet 			= stripallslashes($val['commandes_nomcomplet']);
	    $this->Adresse 				= stripallslashes($val['commandes_adresse']);
	    $this->Adresse2 			= stripallslashes($val['commandes_adresse2']);
	    $this->Cp 					= stripallslashes($val['commandes_cp']);
	    $this->Ville				= stripallslashes($val['commandes_ville']);
	    $this->Nomcompletliv 		= stripallslashes($val['commandes_nomcompletliv']);
	    $this->Adresseliv 			= stripallslashes($val['commandes_adresseliv']);
	    $this->Adresse2liv 			= stripallslashes($val['commandes_adresseliv2']);
	    $this->Cpliv 				= stripallslashes($val['commandes_cpliv']);
	    $this->Villeliv 			= stripallslashes($val['commandes_villeliv']);
	    $this->Pays					= $val['commandes_pays'];
	    $this->Paysliv				= $val['commandes_paysliv'];
	 	    
	    $this->Etat 				= $val['commandes_etat'];
	    
	    $this->Total 				= $val['commandes_total'];
	   
	    $this->TotalAchat 			= $val['commandes_totalachat'];
	   
	    $this->Port 				= $val['commandes_port'];
	    $this->Colis				= $val['commandes_colis'];
	    $this->Codepromo 			= $val['commandes_codepromo'];
	    $this->Remise 				= $val['commandes_remise'];
	    $this->RemisePriv 			= $val['commandes_remisepriv'];
	    $this->Privileges			= $val['commandes_privileges'];
	    $this->ModPaiement 			= $val['commandes_modpaiement'];
	    $this->Idtransaction		= $val['commandes_idtransaction'];
	    $this->DebitCb 				= $val['commandes_debitcb'];
	    $this->Recredite 			= $val['commandes_recredite'];
	    $this->Statut 				= ($this->Etat == 'Exp&Eacute;di&Eacute;e')?htmlentities('Exp&Eacute;di&Eacute;e le ').date_inverse($this->DateExp):$this->Etat;
    	$this->Transporteur 		= $val['commandes_livraison'];
    	$this->Commentaire			= $val['commandes_commentaire'];
    	switch($this->Transporteur){
    		case 'Colissimo' :
    		$this->LinkTransporteur = 'http://www.coliposte.net/particulier/suivi_particulier.jsp?colispart='.$this->Colis;
    		break;
    		case 'Chronopost':
    		$this->LinkTransporteur = 'http://www.fr.chronopost.com/fr/tracking/result?listeNumeros='.$this->Colis;
    		break;
    	}
        
    }
    public function DeleteCommande(){
    	$db = DB::get();
    	$Delete = $db->query("UPDATE t_commandes SET commandes_supprimer='0' WHERE commandes_id = '" . $this->Id . "' LIMIT 1")or die(mysql_error());
        $_SESSION['idcmd_publication'] = "";
    }
    
	public function ModIdtransaction($idtransaction){
		$db = DB::get();
		$Update = $db->query("UPDATE t_commandes SET commandes_idtransaction='$idtransaction' WHERE commandes_id = '" . $this->Id . "' LIMIT 1")or die(mysql_error());
	}
    public function ModEtatCommande($etat){
    	
    	$db = DB::get();
    	$Update = $db->query("UPDATE t_commandes SET commandes_etat='$etat' WHERE commandes_id = '" . $this->Id . "' LIMIT 1")or die(mysql_error());
    	if($etat=="Pay&Eacute;e en pr&Eacute;paration"){
    		$codepromo = $this->Codepromo;
    		//InsertTest('Code promo '.$codepromo.' - Email : '.$this->Email);
    		$code = new Codepromo($codepromo,$this->Email);
    		$code->decremente($this->Idmembre);
    		
    	}
    	
    	if(($etat=="Annul&Eacute;e") && (($this->ModPaiement=="Ch&Egrave;que") ||  ($this->ModPaiement=="Virement"))){
    	
    		$this->DebiterStockCommandes(1);
    	}
    }
    
    /**
     * Debite les stocks une fois la commande pay&Eacute;e
     * 
     * @access public
     * @return void
     */
    public function DebiterStockCommandes($recredite=""){
    
    	if(($this->DebitCb==0) || ($this->ModPaiement!="Carte bancaire")){
    	
			$db = DB::get();
    		$Req = $db->query(" SELECT comarticles_id,comarticles_idtaille,comarticles_quantite,comarticles_type
    							 FROM t_comarticles
    							 WHERE comarticles_numcmd='".$this->Numcmd."' ") or die(mysql_error());
    		
    		while( list($id,$idtaille,$qte,$type)=$db->fetch_array($Req) ){
    			
    			if($idtaille > 0){
    				$Prod = new Taille($idtaille,0);
    				switch ($recredite){
    					case '1' : $Prod->reassortStock($qte);
    					break;
    					default : $Prod->DebiteStock($qte);
    				}
    				
    			}
    		
    		}
    		$Req_Update = $db->query("UPDATE t_commandes SET commandes_debitcb='1' WHERE commandes_id='".$this->Id."' LIMIT 1");
    	}
    }
    
    
    

    
    
    
    public function ModePaiement(){
    	return $this->ModPaiement;
    }
    
 
 
 	
    static function listeCommandes($idmembre,$AddSql="",$type="",$limit=""){
    	$db = DB::get();
    	$Req = "SELECT * FROM t_commandes WHERE commandes_idmembre = '$idmembre' AND commandes_supprimer='0' AND NOT (commandes_etat='En attente' AND commandes_modpaiement='Carte bancaire')  $AddSql ORDER BY commandes_id DESC $limit";
    	$Exec = $db->query($Req);
    	$cpt=1;
    	$res='';
    	$count = $db->num_rows($Exec);
    	while($Item = $db->fetch_object($Exec)){
    		$numcmd = $Item->commandes_numcmd;
    		$total = ( ($Item->commandes_total + $Item->commandes_port) - $Item->commandes_remise - $Item->commandes_remisepriv);
    		$etat = $Item->commandes_etat;
    		if($etat == 'Exp&Eacute;di&Eacute;e')
    			$etat.=' le '.reverse($Item->commandes_dateexp);
    		
    		$colis = $Item->commandes_colis;
    		if($colis=='')
    			{
    				$colis = '-';
    				$LinkTransporteur = '#';
    			} else {
    				
    				$transporteur = $Item->commandes_livraison;
    				switch($transporteur){
    					case 'Colissimo' :
    					$LinkTransporteur = 'http://www.coliposte.net/particulier/suivi_particulier.jsp?colispart='.$colis;
    					break;
    					case 'Chronopost':
    					$LinkTransporteur = 'http://www.fr.chronopost.com/fr/tracking/result?listeNumeros='.$colis;
    					break;
    				}
    				
    			}
    			
    		$Link_Com_Detail = 'moncompte_commandes_detail.php?numcmd='.$numcmd;
    			
    		$res.=' <tr id="ligne'.$cpt.'" style="background-color:#FFF;" onmouseover="getElementById(\'ligne'.$cpt.'\').style.background=\'#f0f5f9\'" onmouseout="getElementById(\'ligne'.$cpt.'\').style.background=\'#FFF\'">
              <td class="date"><p><a href="'.$Link_Com_Detail.'">'.reverse($Item->commandes_date).'</a></p></td>
              <td class="bon_cmd"><p><a href="'.$Link_Com_Detail.'" class="souligne">bc-'.$numcmd.'</a></p></td>
              <td class="montant"><p><a href="'.$Link_Com_Detail.'" class="color3">'.AfficheVirgule($total).' &euro;</a></p></td>
              <td class="etat"><p><span class="color4">'.$etat.'</span>&nbsp;&gt;&nbsp;<a href="'.$Link_Com_Detail.'" class="souligne">voir</a></p></td>
			  ';
              
              
              switch($type){
              	case 'retour' :
              	$res.='<td class="retour"><p><a href="process_retour.php?numcmd='.$numcmd.'" class="souligne">Cr&eacute;er un bon</a></p></td>
				  ';
              	break;
              	default : $res.='<td class="retour"><p><a href="'.$LinkTransporteur.'" target="_blank" class="color6">'.$colis.'</a></p></td>
				  ';
              }
              
           $res.=' </tr>
		   ';
    		   		
    		  if($cpt<$count){
    		  	$res.='<tr>
              <td colspan="5" class="ligne"></td>
            </tr>
			';
    		  }  		
    	$cpt++;	
    	}
    	if($count==0){
    		$res.='<td colspan="5"><p class="msg_error espacement">Aucun R&eacute;sultat pour le moment</p></td>
			';
    	}
    	return $res;
    }   


    
    
    /**
     * Extrait le contenu de la commande
     * 
     * @access public
     * @return array
     */
    public function listeProd(){
    	
    	
    	$db = DB::get();
    	$Req = "SELECT * FROM t_comarticles WHERE comarticles_numcmd='".$this->Numcmd."' ";
    	$Exec = $db->query($Req);
    	
    	$res = '';
    	$i = 0;
    	while($Item = $db->fetch_object($Exec)){
    	
	    	$id 				= 	$Item->comarticles_id;
			$type 				= 	$Item->comarticles_type;
			$visu_mini1 		= 	$Item->comarticles_img;
			$qte	 			= 	$Item->comarticles_quantite;
	    	$nomarticle 		= 	$Item->comarticles_nomarticle;
	    	$prix 				= 	$Item->comarticles_prix;
			$prixpromo 			= 	$Item->comarticles_prixpromo;
			$couleur			=	$Item->comarticles_couleur;
			$taille				=	$Item->comarticles_taille;
	    	$prixfinal 			= 	$prix;
			if($prixpromo>0){
				$prixprod = ''.number_format($prixpromo,2,',','').' &euro;<span class="prix_barre_popup">'.number_format($prix,2,',','').' &euro;</span>';
				$prixfinal = $prixpromo;
			}
			
			
				$tab_articles[$i]['nom'] 		= 	$nomarticle;
				$tab_articles[$i]['couleur']	= 	$couleur;
				$tab_articles[$i]['taille'] 	= 	$taille;
				$tab_articles[$i]['prix'] 		= 	$prix;	 
				$tab_articles[$i]['prixpromo']	= 	$prixpromo;
				$tab_articles[$i]['image']		= 	$visu_mini1;
				$tab_articles[$i]['type'] 		= 	$type;
				$tab_articles[$i]['id'] 		= 	$id;
				$tab_articles[$i]['quantite'] 	= 	$qte;
				$tab_articles[$i]['prixfinal'] 	= 	$prixfinal;
				
		
    	$i++;
    	}	
    
	
    	return $tab_articles;
    }
    
    
    /**
     * A developper
     */
    
    public function ListeProdMail(){
    	
    	$suite = '';
		return $suite;
    }
    
    
    
    public function verif_proprio(){

    	$db = DB::get();
    	$Req = "SELECT * FROM t_commandes WHERE commandes_numcmd = '" . $this->Numcmd.
            "' AND commandes_supprimer='0' AND commandes_idmembre = '".$_SESSION[$GLOBALS['_data_']['session_idclient']]."' ";
            
        
         $Exec = $db->query($Req);
         
         if($db->num_rows($Exec)==0){
         	echo "<script type='application/javascript'>window.location='moncompte.php'</script>";

         }
         
    }
    
    /**
     * Affiche la liste des produits composants la commande
     * 
	 * @access public
     * @return string
     */
     
    public function BonDeCommande($relance=""){
 		
 $date_com 			= $this->Date;
 $Modepaiement 		= $this->ModPaiement;
 $Etat 				= $this->Etat;
 $numcmd			= $this->Numcmd;
 $NomComplet		= $this->Nomcomplet;
 $Adresse			= $this->Adresse;
 $Adresse2 			= $this->Adresse2;
 $Cp				= $this->Cp;
 $Ville 			= $this->Ville;
 $Pays				= $this->Pays;
 $Nomcompletliv 	= $this->Nomcompletliv;
 $Adresseliv 		= $this->Adresseliv;
 $Adresse2liv 		= $this->Adresse2liv;
 $Cpliv 			= $this->Cpliv;
 $Villeliv 			= $this->Villeliv;
 $Paysliv			= $this->Paysliv;
 $Commentaire 		= $this->Commentaire;
 $total 			= $this->Total;
 $port 				= $this->Port;
 $remise 			= $this->Remise;
 $remisepriv		= $this->RemisePriv;
 $privileges		= $this->Privileges;
 $codepromo 		= $this->Codepromo;
 $total_avc_port	= (($total+$port)-$remise - $remisepriv);	
 $Statut 			= $this->Statut;
 $Transporteur		= $this->Transporteur;
 $LinkTransporteur 	= ($Etat=='Exp&Eacute;di&Eacute;e')?'Pour suivre votre colis&nbsp;&gt;&nbsp;<a href="'.$this->LinkTransporteur.'" target="blank" class="souligne">Cliquez ici</a>':'';
 
 $liste_prod = $this->listeProd();
 
  $adresse_fact = stripallslashes($Adresse);
 
 if($Adresse2!="")
 	$adresse_fact .='<br />'.stripallslashes($Adresse2);
 
 $CORPS = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<meta http-equiv="Content-Style-Type" content="text/css">

<style type="text/css">
<!--
.filet_000 {
	background:#000;
	line-height:1px;
	height:1px;
}

.pad10 {
	padding:10px;
}
.prix_barre {
	text-decoration:line-through;
}

.texte10 {
	font-size:10px;
}
.texte11 {
	font-size:11px;
}
.texte12 {
	font-size:12px;
}
.texte13 {
	font-size:13px;
}

#conteur_bon_commande {
	width:580px;
	padding:10px;
	padding-right:0px;
	padding-bottom:25px;
	background-color:#FFF;
}
#entete_bon_commande {
	width:580px;
	height:127px;
}
#entete_bon_commande td {
	vertical-align:top;
}
#entete_bon_commande td.logo {
	width:296px;
}
#entete_bon_commande td.commande {
	text-align:right;
	padding-right:20px;
	color:#525655;
	font-size:22px;
	padding-top:20px;
	width:276px;
}
#entete_bon_commande td.fiche_paie {
	text-align:right;
	font-size:24px;
}
#entete_bon_commande td.coordonnees {
	padding-left:0px;
	padding-bottom:20px;
}
.bloc_detail_cmd {
	line-height:20px;
	width:301px;
	font-size:12px;
}
.bloc_adresse {
	width:240px;
	float:right;
	padding:20px;
	/*margin-left:293px;*/
	font-size:12px;
	margin-right:20px;
	margin-bottom:13px;
	border:#e5e5e5 solid 1px;
}
.bloc_adresse2 {
	width:280px;
	float:right;
	/*margin-left:293px;*/
	font-size:12px;
	margin-right:20px;
	margin-bottom:13px;
	border:#000 solid 1px;
}
.txt_adresse {
	padding-top:10px;
	font-size:10px;
	padding-bottom:30px;
}
.tab_produit_panier_print {
	width:580px;
	border:#000 solid 1px;
}
.tab_produit_panier_print td {
	vertical-align:middle;
}
.tab_produit_panier_print th {
	padding-top:10px;
	text-align:left;
	padding-bottom:10px;
}
.tab_produit_panier_print th.ref {
	width:167px;
	text-align:left;
	padding-left:10px;
}
.tab_produit_panier_print th.couleur {
	width:83px;
	text-align:center;
}
.tab_produit_panier_print th.taille {
	width:87px;
	text-align:center;
}
.tab_produit_panier_print th.quantite {
	width:73px;
	text-align:center;
}
.tab_produit_panier_print th.prix {
	width:73px;
	text-align:center;
}
.tab_produit_panier_print th.total {
	width:67px;
	padding-right:10px;
	text-align:right;
}
.tab_produit_panier_printth.ligne {
	height:5px;
}
.tab_produit_panier_print td.ref {
	width:167px;
	text-align:left;
	padding-left:10px;
}
.tab_produit_panier_print td.couleur {
	width:73px;
	text-align:center;
	padding-left:5px;
	padding-right:5px;
	font-size:12px;
}
.tab_produit_panier_print td.taille {
	width:87px;
	text-align:center;
}
.tab_produit_panier_print td.quantite {
	width:73px;
	text-align:center;
}
.tab_produit_panier_print td.prix {
	width:73px;
	text-align:center;
	font-size:12px;
}
.tab_produit_panier_print td.total {
	width:67px;
	padding-right:10px;
	text-align:right;
	font-size:12px;
}
.tab_produit_panier_print td.ligne {
	height:13px;
}
.tab_produit_panier_print td.ligne_color {
	height:2px;
	line-height:2px;
	background-color:#D8D8D8;
}
.produit_visuel_print {
	width:166px;
}
.produit_visuel_print td {
	vertical-align:middle;
}
.produit_visuel_print td.visuel_66x66 {
	width:66px;
	height:66px;
	border:#EDEDED solid 1px;
}
.produit_visuel_print td.description_produit {
	width:78px;
	padding-right:8px;
	font-size:12px;
	padding-left:12px;
}
.bloc_mode_paiement_print {
	width:237px; 
	border:#000 solid 1px;
	margin-top:15px;
}
.bloc_cmd2_print {
	border:#000 solid 1px;
	width:300px;
	//margin-right:10px;
	margin-left:30px;
	margin-top:15px;
}
.recap_panier_total_print {
	width:301px;
	margin-top:22px;
	margin-bottom:5px;
}
.recap_panier_total_print td {
	vertical-align:top;
	padding-bottom:7px;
}
.recap_panier_total_print td.intitule_total {
	width:194px;
	text-align:right;
}
.recap_panier_total_print td.montant_total {
	width:91px;
	text-align:right;
	padding-right:15px;
}
.recap_panier_total_print td.intitule_total2 {
	width:194px;
	text-align:right;
	color:#CC492B;
}
.recap_panier_total_print td.montant_total2 {
	width:91px;
	text-align:right;
	padding-right:15px;
	color:#CC492B;
}
.recap_panier_total_print td.ligne_color2 {
	height:1px;
	border-top:#000 solid 1px;
}
.recap_panier_total_print td.ligne {
	height:7px;
}
-->
</style>
</head>

<body>
	<div id="conteur_bon_commande">
		<table id="entete_bon_commande" cellpadding="0" cellspacing="0">
			<tr>
				<td class="logo"><img src="'.$GLOBALS['_data_']['url_principale'].'css/images/logo_print.gif" width="296" height="90" alt="" /></td>
				<td class="commande">Commande</td>
			</tr>
			<tr>
				<td colspan="2" class="coordonnees">
				  <p><br /><br />Ch&egrave;r(e) client(e),<br /><br />';
				  
				  switch($relance){
				  	case '1':
				  	$CORPS.='Votre commande portant le num&Eacute;ro  '.$this->Numcmd.' est en attente de paiement depuis 5 jours.<br />
					Celle ci ne vous sera r&Eacute;serv&Eacute;e que pour 5 jours suppl&Eacute;mentaires, d&Eacute;lai au del&Agrave; duquel nous ne pourrons vous conserver les produits.<br />';
					break;
					case '2':
				  	$CORPS.='Votre commande portant le num&Eacute;ro  '.$this->Numcmd.' est en attente de paiement depuis 10 jours.<br />
					Celle ci ne peut malheureusement plus vous &Ecirc;tre r&Eacute;serv&Eacute;e et viens d\'&Ecirc;tre annul&Eacute;e par notre syst&Egrave;me.<br />';
					break;
					default:$CORPS.='Nous avons bien reçu votre commande portant le num&Eacute;ro commande '.$this->Numcmd.'<br />
					';
				  }
				
					
					
					
					$CORPS.='Vous trouverez ci dessous le r&eacute;capitulatif de votre commande<br /><br />A bientôt et merci pour votre confiance.<br /><br />
					L&acute;&eacute;quipe de '.$GLOBALS['_data_']['nom_site'].'<br /><br /></p> </td>
			</tr>
		</table>
		<div class="bloc_adresse">
			<p><strong>'.$NomComplet.'</strong></p>
			<p>'.$adresse_fact.'</p>
			<p>'.$Cp.' '.$Ville.'</p>
			<p>'.SelectNomFromTable('pays',$Pays).'</p>
		</div>
		<div class="bloc_detail_cmd">
		  <p><strong>N&deg; de commande&nbsp;</strong>:&nbsp;CMD-'.$numcmd.'</p>
			<p><strong>Date de la commande &nbsp;</strong>:&nbsp;'.reverse($date_com).'</p>
			<p><strong>&Eacute;tat de la commande&nbsp;</strong>:&nbsp;'.$Statut.'</p>
            <p><strong>Mode de livraison&nbsp;</strong>:&nbsp;'.$Transporteur.'</p>
			<p><strong>Info livraison&nbsp;</strong>:&nbsp;'.$LinkTransporteur.'</p>
		</div>
		<div class="clear_right"></div>
        <p class="lineheight30">&nbsp;</p>
        <table class="tab_produit_panier_print" cellpadding="0" cellspacing="0">
      <tr>
        <th colspan="6" class="ligne"><p class="pad_g10">MES ARTICLES</p></th>
      </tr>
      <tr>
        <td colspan="6"><p class="filet_000">&nbsp;</p></td>
      </tr>
      <tr>
        <th class="ref"><p>R&eacute;f&eacute;rence</p></th>
        <th class="couleur"><p>Couleur</p></th>
        <th class="taille"><p>Taille</p></th>
        <th class="quantite"><p>Quantitt&eacute;</p></th>
        <th class="prix"><p>Prix TTC</p></th>
        <th class="total"><p>Total TTC</p></th>
      </tr>
      <tr>
        <td colspan="6"><img src="'.$GLOBALS['_data_']['url_principale'].'css/images/filet_print.gif" width="580" height="1" /></td>
      </tr>
      <tr>
        <td colspan="6" class="ligne"></td>
      </tr>';
 
  foreach($liste_prod as $cle=>$val){
  	
  
 $CORPS.='
      <tr>
        <td class="ref"><table class="produit_visuel_print" cellpadding="0" cellspacing="0">
            <tr>
              <td class="visuel_66x66">'.affiche_photo_gene('produits',$val['image'],' width="66" ','', 'MDM-').'</td>
              <td class="description_produit"><p>'.$val['nom'].'</p></td>
            </tr>
          </table></td>';
 
 if(in_array($val['type'],explode(',','totallook,cadeaux'))){
 	$db = DB::get();
 	$Req = "SELECT 	comarticles_compose_nomarticle,comarticles_compose_idtaille 
					FROM t_comarticles_compose 
					WHERE comarticles_compose_idcomarticles='".$val['id']."'  
					AND comarticles_compose_supprime='0' 
					ORDER BY comarticles_compose_id ASC";
	
 	$Sendreq = $db->query($Req);
 	
 	$CORPS.='<td colspan="2" style="text-align:center">';
 	
 	while($row =$db->fetch_array($Sendreq)){
 		$taille_compose = new Taille($row['comarticles_compose_idtaille']);
 		
 		$CORPS.=$row['comarticles_compose_nomarticle'].' - '.$taille_compose->Taille.'<br />';
 		
 	}
 	
 	$CORPS.='</td>
 			<td class="quantite"><p>1</p></td>';
 }
 else{
 	$idcouleur = SelectFieldFromTable('produits_couleurs','idcouleur',$val['couleur']);
 	$nomcouleur = SelectNomFromTable('couleurs',$val['couleur']);
 	
 	$CORPS.='	<td class="couleur"><p>'.stripallslashes($nomcouleur).'</p></td>
                <td class="taille"><p>'.$val['taille'].'</p></td>
     			<td class="quantite"><p>'.$val['quantite'].'</p></td>';
 	
 }
  if($val['prixpromo']!='0.00'){
 	$CORPS.='      <td class="prix"><p class="prix_barre">'.$val['prix'].'</p><p>'.$val['prixpromo'].' &euro;</p></td>';
 }
 else{
 	$CORPS.='	<td class="prix"><p>'.$val['prix'].'</p></td>';
 }
 $CORPS.='
        
        <td class="total"><p>'.$val['prixfinal'].' &euro;</p></td>
      </tr>
      <tr>
        <td colspan="6" class="ligne"></td>
      </tr>
      <tr>
        <td colspan="6"><img src="'.URL_PRINCIPALE.'css/images/filet_print.gif" width="580" height="1" /></td>
      </tr>
      <tr>
        <td colspan="6" class="ligne"></td>
      </tr>';
  }
  //class="bloc_cmd2_print"
 $CORPS.=' <tr>
        <td colspan="6" class="ligne"></td>
        </tr>
    </table>
    <p><br /></p>
    
    <div class="float_right">
    
    <table>
		<tr>
		
		 <td style="vertical-align:top">
	  <div class="bloc_mode_paiement_print"><div class="pad10">
	    <p class="texte13"><strong>LIVRAISON</strong></p>
        </div>
        <p class="filet_000">&nbsp;</p>
      <div class="pad10"><p class="texte13">'.$Nomcompletliv.'<br />'.$Adresseliv.'<br />'.$Cpliv.' '.$Villeliv.' '.SelectNomFromTable('pays',$Paysliv).'<br />'.$Commentaire;
	  
	  $CORPS.='</p></div></div>
      
      <p>&nbsp;</p>
      <div class="bloc_mode_paiement_print">
	  	<div class="pad10"><p class="texte11"><strong>Mode de paiement</strong>&nbsp;:&nbsp;'.$Modepaiement.'</p></div>
		  </div>
      
      </td>
		
			<td style="vertical-align:top">
    
	  <div  class="bloc_cmd2_print">
	  	<div class="pad10"><p class="texte13"><strong>TOTAL DE MA COMMANDE</strong></p></div>
        <p class="filet_000">&nbsp;</p>
		<table class="recap_panier_total_print" cellpadding="0" cellspacing="0">
			<tr>
				<td class="intitule_total"><p>Montant TTC de ma commande</p></td>
				<td class="montant_total"><p>'.number_format($total,2,',','').' &euro;</p></td>
			</tr>';
 if($remise != '0.00'){
 $CORPS.='
                <tr>
                  <td class="intitule_total"><p>Remise offre sp&eacute;ciale<br /><i>'.$codepromo.'</i></p></td>
                  <td class="montant_total"><p>-'.number_format($remise,2,',','').' &euro;</p></td>
                </tr>';
 }
  if($remisepriv != '0.00'){
  	$Priv = new Privileges($privileges);
 $CORPS.='
                <tr>
                  <td class="intitule_total"><p>Remise Client '.$Priv->Nom.' - '.$Priv->Remise.' %</p></td>
                  <td class="montant_total"><p>-'.number_format($remisepriv,2,',','').' &euro;</p></td>
                </tr>';
 }
 
 $CORPS.='<tr>
				<td class="intitule_total"><p>Frais de port</p></td>
				<td class="montant_total"><p>'.number_format($port,2,',','').' &euro;</p></td>
			</tr>
            <tr>
            	<td class="ligne" colspan="2"></td>
            </tr>
            <tr>
            	<td height="5" colspan="2" class="ligne_color2"></td>
            </tr>
            <tr>
            	<td class="ligne" colspan="2"></td>
            </tr>
            <tr>
				<td class="intitule_total"><p>Total &agrave; r&eacute;gler TTC</p></td>
				<td class="montant_total"><p>'.number_format($total_avc_port,2,',','').' &euro;</p></td>
			</tr>
            <tr>
				<td class="intitule_total"><p><em>Dont TVA (19,6%)</em></p></td>
				<td class="montant_total"><p>'.number_format(getTva($total_avc_port),2,',','').' &euro;</p></td>
			</tr>
		</table>
		
	  </div>
	  
      </div>
      </td>
     
    </tr>
  </table>
	  <div class="clear_right"></div>
</div>

</body>
</html>';
return $CORPS;
 	}
    
   
    /**
     * Commandes::SendMailCommande()
     * 
     * @return void
     */
    public function SendMailCommande(){
    	
    	$Modepaiement = $this->ModPaiement;
    	$AddPhrasePaiement = "Vous trouverez ci dessous le r&eacute;capitulatif de votre commande<br /><br />";
					if($Modepaiement=="Ch&Egrave;que"){
						$AddPhrasePaiement.="<p><strong>Veuillez libeller votre ch&egrave;que &agrave; l&rsquo;ordre de ".$GLOBALS['_data_']['nom_site']." et l&rsquo;envoyer &agrave; l&rsquo;adresse suivante :</strong></p>
						<p>".$GLOBALS['_data_']['coordonnees']."</p>";
					}
					if($Modepaiement=="Virement"){
						$AddPhrasePaiement.="<p><strong>Merci d&rsquo;envoyer votre r&egrave;glement en rappelant le num&eacute;ro de la commande &agrave; :</strong></p>
						<p>".$GLOBALS['_data_']['coordonnees']." </p>";
					}
				$AddPhrasePaiement.='<br /><br />A bient&ocirc;t et merci pour votre confiance.';	
					
					
					
    	$subject = "Confirmation de commande CMD-".$this->Numcmd." du ".date("d/m/Y");
 		$message = imprime_mail_commande($this->Numcmd,$AddPhrasePaiement);
 		//InsertTest($this->Email.'<br>'.$message);

 		
 		$mail = new PHPmailer();
		$mail->IsMail();
		$mail->IsHTML(true);
		$mail->From		=$GLOBALS['_data_']['email_princ'];
		$mail->FromName	=$GLOBALS['_data_']['nom_site'];
		$mail->AddAddress($this->Email);
		$mail->AddBCC($GLOBALS['_data_']['email_princ']);
		$mail->Subject	= $subject;
		$mail->Body		= $message;
	//	echo 'texte commande : '.$this->BonDeCommande();
	
		if(!$mail->Send()){ //Teste le return code de la fonction
			
			echo $mail->ErrorInfo; //Affiche le message d'erreur (ATTENTION:voir section 7)
		}
		
		unset($mail);
    }
    
    
    public function GetMontantFinal($remise=0,$port=0){
    	$total = $this->Total;
    	if($remise = 1){
    	$total -= Format_nombre($this->Remise);
    	$total -= Format_nombre($this->RemisePriv);	
    	}
    	if($port==1){
    		$total += Format_nombre($this->Port);
    	}
    	return $total;
    	
    	
    }
    public function GetModPaiementFiaNet(){
    	$mode = $this->ModPaiement;
    	//echo $mode;
    	$tab = array("Carte bancaire"=>"carte","Paypal"=>"paypal","Ch&Egrave;que"=>"cheque","Mandat"=>"cheque");
    	return $tab[$mode];
    }
    public function MajPrixAchat(){
    	$db = DB::get();
    	$Req = $db->query("SELECT comarticles_id,comarticles_prixachat,comarticles_type from t_comarticles WHERE comarticles_numcmd='".$this->Numcmd."'");
    	$prix = 0;
    	while(list($idcmd,$prixachat,$type)=$db->fetch_array($Req)){
    		if($type=="simple"){
    			$prix += $prixachat;
    		} else {
    			//on va boucler le contenu
    			$Req2 = mysql_query("SELECT comarticles_compose_prixachat FROM t_comarticles_compose WHERE comarticles_compose_idcomarticles='$idcmd'");
    			while(list($prixachat2)=$db->fetch_array($Req2)){
    				$prix += $prixachat2;
    			}
    		}
    	}
    	$Update = mysql_query("UPDATE t_commandes SET commandes_totalachat='$prix' WHERE commandes_id='".$this->Id."' LIMIT 1");
    }
    public function SuiteNomsCommandes(){
    	$Req = "SELECT comarticles_nomarticle from t_comarticles WHERE comarticles_numcmd='".$this->Numcmd."'";
    	$Send = mysql_query($Req);
    	$count = mysql_numrows($Send);
    	$i = 1;
    	while(list($nom)=mysql_fetch_array($Send)){
    		$suite.=replacement($nom);
    		if($i<$count){
    			$suite.="-";
    		}
    		$i++;
    	}
    	return $suite;
    }
    public function SuiteNomsCommandesNewTag(){
    	$Req = "SELECT comarticles_nomarticle,comarticles_idtaille,comarticles_prixfinal,comarticles_quantite,comarticles_type from t_comarticles WHERE comarticles_numcmd='".$this->Numcmd."'";
    	$Send = mysql_query($Req);
    
    	while(list($nom,$idtaille,$prix,$qte,$type)=mysql_fetch_array($Send)){
    		
    		
    		
    		if(($type=="vp") || ($type=='simple')){
    			$Taille = new Taille($idtaille);
    			$reference = $Taille->reference;
    		} else {
    			$reference = 'NC';
    		}
$suite.=',\'prdref\', \''.$reference.'\'
,\'prdamount\', \''.Division($prix,1.196).'\'
,\'prdquantity\', \''.$qte.'\'
,\'prdname\', \''.addslashes($nom).'\'';
    	
    	}
    	return $suite;
    	
    }
    
    
    
	
}
?>

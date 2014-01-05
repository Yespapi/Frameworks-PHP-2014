<?php
/*
 * @author:
 * 
 * 
 */
 
 class Client{
 	
 	// D&Eacute;claration des variables
 	public $Id;
 	public $Civilite=array(); // Array['f'] : facturation | Array['l'] : livraison
 	public $Prenom = array();
 	public $Nom = array();
 	public $Societe=array();
 	public $Adresse = array();
 	public $Adresse2 = array();
 	public $Cp = array();
 	public $Dpt = array();
 	public $Region = array();
 	public $Ville = array();
 	public $Pays = array();
 	public $Tel = array();
 	public $Fax = array();
 	public $Mobile = array();
 	public $Email;
 	public $Pass;
 	public $Privileges;
 	public $Pseudo;
 	public $Profil; // 0 => client normal : 1 => client premium
 	public $TxtProfil;
 	public $Statut;
 	public $TxtStatut;
 	
 	private $ListeAdresse = array();
 	
 	public $Photo;
 	public $Note;
 	public $NbPoints; 	
 	public $Optin = array();//0=>newsletter | 1=> Ventes priv&Eacute;es
 	public $BaseNewsletter;
 	public $DateInscr; // date d'inscription
 	public $DateNaissance; // Date de naissance
 	public $Commentaire =array();
 	
 	public $table;
 	
 	
 	
 	// Accesseur de la classe
 	public function getId(){return $this->Id;}
 	public function getSociete($qui){return stripallslashes($this->Societe[$qui]);}
 	public function getCivilite($qui){return $this->Civilite[$qui];}
 	public function getPseudo(){return stripallslashes($this->Pseudo);}
 	public function getPrenom($qui){return stripallslashes($this->Prenom[$qui]);}
 	public function getNom($qui){return stripallslashes($this->Nom[$qui]);}
 	public function getAdresse($qui){return stripallslashes($this->Adresse[$qui]);}
 	public function getAdresse2($qui){return stripallslashes($this->Adresse2[$qui]);}
 	public function getCp($qui){return stripallslashes($this->Cp[$qui]);}
 	public function getDpt($qui){return stripallslashes($this->Dpt[$qui]);}
 	public function getRegion($qui){return stripallslashes($this->Region[$qui]);}
 	public function getVille($qui){return stripallslashes($this->Ville[$qui]);}
 	public function getPays($qui){return stripallslashes($this->Pays[$qui]);}
	public function getTel($qui){return stripallslashes($this->Tel[$qui]);}
	public function getFax($qui){return stripallslashes($this->Fax[$qui]);}
	public function getMobile($qui){return stripallslashes($this->Mobile[$qui]);}
 	public function getCommentaire($qui){return stripallslashes($this->Commentaire[$qui]);}
 	public function getEmail(){return $this->Email;}
 	public function getPass(){return $this->Pass;}
 	public function getPrivileges(){return $this->Privileges;}
 	public function getStatut(){return $this->Statut;}
 	public function getTxtStatut(){return $this->TxtStatut;}
 	public function getProfil(){return $this->Profil;}
 	public function getTxtProfil(){return stripallslashes($this->TxtProfil);}
 	public function getBaseNewsletter(){return $this->BaseNewsletter;}
 	public function getOptin($quoi){return $this->Optin[$quoi];}
 	public function getPhoto(){return $this->Photo;}
 	
 	public function getListeAdresse($num){return $this->ListeAdresse[$num];}
 	
 	public function getEtab(){return $this->Etab;}
 	public function getGuichet(){return $this->Guichet;}
 	public function getCompte(){return $this->Compte;}
 	public function getCle(){return $this->Cle;}
 		
 	
 	public function getNote(){return $this->note;}
 	
 	
 	public function getDateInscr(){return $this->DateInscr;}
 	public function getDateNaissance(){return $this->DateNaissance;}
 	
 	public static function getIdFromEmail($email){
 		
 		try{
	 		$db = DB::get();
	 		$Req = "SELECT comptes_id FROM t_comptes WHERE comptes_email = '$email' ";
 			$Exec = $db->query($Req);
 			list($id) = $db->fetch_row($Exec);
 			return $id;
 		}
 		catch(Exception $e){}
 	}
 	
  	

 	// Modifieur de la classe
 	public function setId($id){$this->Id=$id;}
 	public function setSociete($societe,$qui){$this->Societe[$qui]=$societe;}
 	public function setCivilite($civilite,$qui){$this->Civilite[$qui]=$civilite;}
 	public function setPseudo($prenom=""){
 		
 		if($prenom == "")
 			$prenom = $this->prenom['f'];
 		
 		$this->Pseudo=strtoupper(washmot($prenom).'_'.$this->Id);
 	}
 	public function setPrenom($prenom,$qui){$this->Prenom[$qui]=$prenom;}
 	public function setNom($nom,$qui){$this->Nom[$qui]=$nom;}
 	public function setAdresse($adresse,$qui){$this->Adresse[$qui]=$adresse;}
 	public function setAdresse2($adresse,$qui){$this->Adresse2[$qui]=$adresse;}
 	public function setCp($cp,$qui){$this->Cp[$qui]=$cp;}
 	public function setDpt($dpt,$qui){$this->Dpt[$qui]=$dpt;}
 	public function setRegion($region,$qui){$this->Region[$qui]=$region;}
 	public function setVille($ville,$qui){$this->Ville[$qui]=$ville;}
 	public function setPays($pays,$qui){$this->Pays[$qui]=$pays;}
	public function setTel($tel,$qui){$this->Tel[$qui]=$tel;}
	public function setFax($fax,$qui){$this->Fax[$qui]=$fax;}
	public function setMobile($mobile,$qui){$this->Mobile[$qui]=$mobile;}
	public function setCommentaire($commentaire,$qui){$this->Commentaire[$qui]=$commentaire;}
 	public function setEmail($email){$this->Email=$email;}
	public function setOptin($optin,$quoi){$this->Optin[$quoi]=$optin;}
 	public function setPass($pass){$this->Pass=$pass;}
 	public function setStatut($statut){$this->Statut=$statut;}
 	public function setBaseNewsletter($basenewsletter){$this->BaseNewsletter = $basenewsletter;}
 	public function setProfil($profil){$this->Profil=$profil;}
 	public function setPhoto($photo){$this->Photo=$photo;}
 	public function setDateNaissance($jour,$mois,$annee){$this->DateNaissance=$annee.'-'.$mois.'-'.$jour;}
 	
 	public function setNbEtoile($nbetoile){$this->NbPoints=$nbetoile;}
 	public function setNbEval($nbeval){$this->NbPoints=$nbeval;}
 	 	
 	public function GetNomComplet(){
 		return stripallslashes($this->Civilite['f'].' '.stripallslashes($this->Prenom['f']).' '.stripallslashes($this->Nom['f']));
 	}
 	
 	public function GetNomCompletliv(){
 		$this->setLivraison(0);
 		return stripallslashes($this->Civilite['l'].' '.stripallslashes($this->Prenom['l']).' '.stripallslashes($this->Nom['l']));
 	}
 	
 	public function RecupPass($email){
 				
 		
 		$val = mysql_fetch_array(mysql_query("SELECT comptes_pass from t_comptes WHERE comptes_email='$email' LIMIT 1"));
 		$Pass = LiverCrypt::Decrypte($val[0]);
 		return $Pass;
 	}
 	
 	public static function existe_mail($email,$id="",$inscrit="",$type=""){
 		

 		try{
	 		$db = DB::get();
 			$Req = "SELECT comptes_basenewsletter FROM t_comptes WHERE comptes_email = '".$db->escape($email)."' AND comptes_supprime = '0' ";
	 		if($id!=""){
	 			$Req.=" AND comptes_id<>'$id' ";
	 		}
	 		if($inscrit==1){
	 			$Req.=" AND comptes_newsletter".$type."='1' ";
	 		}
	 		
	 		$Exec = $db->query($Req);
	 		if($db->num_rows($Exec)==''){return 'false';}
	 		else{
	 			list($news) = mysql_fetch_row($Exec);
	 			return $news;
	 		}
	 	}
 		catch(Exception $e){}
 	}
 	
 	
 	static function Inscription_newsletter($email,$type=""){
 		$idexists = self::existe_mail($email);
 		
 		try{
 			$db = DB::get();
	 		if($idexists>0){
	 			$Requete = "UPDATE t_comptes SET comptes_newsletter".$type."='1' WHERE comptes_id='$idexists' LIMIT 1";
	 		} else {
	 			$Requete = "INSERT INTO t_comptes SET comptes_date='".date("Y-m-d")."',
				 									  comptes_basenewsletter='1',
													   comptes_newsletter".$type."='1',
													   comptes_email='".$db->escape($email)."'";
	 			
	 		}
	 		$Sendsql = $db->query($Requete);
 		}
 		catch(Exception $e){}
 	}
 	
	 	
 	//Modifier un client
 	
 	public function modifierClient(){
 		
 		try{
 			$db = DB::get();
	 		$Req = " UPDATE t_comptes SET comptes_basenewsletter = '".$this->BaseNewsletter."',
	 									  comptes_societe		 = '".trim($db->escape($this->Societe['f']))."',	  
			 							  comptes_civilite = '".trim($this->Civilite['f'])."'," .
				" 						  comptes_prenom = '".trim($db->escape($this->Prenom['f']))."'," .
				"						  comptes_nom = '".trim($db->escape($this->Nom['f']))."'," .
								"		  comptes_adresse = '".trim($db->escape($this->Adresse['f']))."'," .
										" comptes_adresse2 = '".trim($db->escape($this->Adresse2['f']))."'," .
				"						  comptes_ville = '".trim($db->escape($this->Ville['f']))."'," .
										" comptes_cp = '".$db->escape(trim($this->Cp['f']))."', " .
									"	  comptes_pays = '".trim($this->Pays['f'])."' ,
										  comptes_tel = '".$db->escape(trim($this->Tel['f']))."' , " .
										" comptes_actif='".trim($this->Statut)."'," .
								  		" comptes_naissance = '".$this->DateNaissance."' " .
								  		"  " .									
								" WHERE comptes_id = '".$this->Id."' ";
 		$Exec = $db->query($Req) or die(mysql_error());
 		}
 		catch(Exception $e){}
 	}
 	
 	
 	public function insertLivraison(){
 		
 		try{
	 		if(empty($this->ListeAdresse)){
	 		
	 		$db = DB::get();	
	 			
	 		$Req = " INSERT INTO t_adresses SET adresses_idcompte = '".$this->Id."' ,
	 											adresses_societe  = '".$db->escape(trim($this->Societe['l']))."',
			 							  		adresses_civilite = '".trim($this->Civilite['l'])."'," .
											  " adresses_prenom = '".$db->escape(trim($this->Prenom['l']))."'," .
											  " adresses_nom = '".$db->escape(trim($this->Nom['f']))."'," .
											  " adresses_adresse = '".$db->escape(trim($this->Adresse['l']))."'," .
											  " adresses_adresse2 = '".$db->escape(trim($this->Adresse2['l']))."'," .
											  " adresses_cp = '".$db->escape(trim($this->Cp['l']))."'," .
											  " adresses_ville = '".$db->escape(trim($this->Ville['l']))."', " .
	 										  " adresses_pays = '".$db->escape(trim($this->Pays['l']))."', " .
											  " adresses_tel = '".$db->escape(trim($this->Tel['l']))."'," .
											  " adresses_commentaire = '".$db->escape(trim($this->Commentaire['l']))."' " ;
										  	  
	 		$Exec = $db->query($Req) or die(mysql_error());
	 		}
	 		else{
	 			$idlivraison = $this->ListeAdresse[0];
	 			$this->modLivraison($idlivraison);
	 		}
 		}
 		catch(Exception $e){}
 	}
 	
 	public function modLivraison($num){
 		
 		try{

 			$db = DB::get();
 		if($num!=''){
 			$Req = "UPDATE t_adresses SET adresses_civilite = '".trim($this->Civilite['l'])."',
 										  adresses_societe  = '".$db->escape(trim($this->Societe['l']))."', " .
										" adresses_prenom = '".trim($db->escape($this->Prenom['l']))."'," .
									  	" adresses_nom = '".trim($db->escape($this->Nom['l']))."'," .
										" adresses_societe = '".trim($db->escape($this->Societe['l']))."'," .
										" adresses_adresse = '".trim($db->escape($this->Adresse['l']))."'," .
										" adresses_adresse2 = '".trim($db->escape($this->Adresse2['l']))."'," .
										" adresses_cp = '".trim($db->escape($this->Cp['l']))."'," .
										" adresses_ville = '".trim($db->escape($this->Ville['l']))."', " .
 			 							" adresses_pays = '".$db->escape(trim($this->Pays['l']))."', " .
										" adresses_tel = '".trim($this->Tel['l'])."'," .
										" adresses_commentaire = '".trim($db->escape($this->Commentaire['l']))."' " .
								   "WHERE adresses_id = '$num'  " ;
 			
 			$Exec = $db->query($Req);
 		}
 		}
 		catch(Exception $e){}
 	}
 	 	
 	public function modEmail($email){
 		try{
 			$db = DB::get();
 			$Req = " UPDATE t_comptes SET comptes_email = '$email' WHERE comptes_id = '".$this->Id."' ";
 			$Exec = $db->query($Req) or die(mysql_error());
 		}
 		catch(Exception $e){}
 	}
 	
 	public function modStatut($statut){
 		try{
 			$db = DB::get();
 			$Req = " UPDATE t_comptes SET comptes_actif = '$statut' WHERE comptes_id = '".$this->Id."' ";
 			$Exec = $db->query($Req) or die(mysql_error());
 		}
 		catch(Exception $e){}
 	}
 	
 	public function modPass($pass){
 		try{
 			$db = DB::get();	
 			$passcrypt = LiverCrypt::Crypte($pass); 		
 			$Req = " UPDATE t_comptes SET comptes_pass = '$passcrypt' WHERE comptes_id = '".$this->Id."' ";
 			$Exec = $db->query($Req) or die(mysql_error());
 		}
 		catch(Exception $e){}
 	}
 	 	 	
	
 	
 	public function modifnews(){
 		
 		try{
 			$db = DB::get();
 			$Req = "UPDATE t_comptes SET comptes_newsletter = '".$this->getOptin(0)."'," .
 									"comptes_newsletter3 = '".$this->getOptin(2)."' WHERE comptes_id = '".$this->Id."' ";
 			
 			
 			
 			$Exec = $db->query($Req) or die(mysql_error());
 		}
 		catch(Exception $e){}
 	}
 	
 	public function modBaseNews($etat){
 	 	try{
 			$db = DB::get();
 			$Req = "UPDATE t_comptes SET comptes_basenewsletter = '$etat' WHERE comptes_id = '".$this->Id."' ";
 			$Exec = $db->query($Req);
 	 	}
 		catch(Exception $e){}
 	}
 	
 	public function modPortable($num){
 	 	try{
 			$db = DB::get();
 			$Req = "UPDATE t_comptes SET comptes_portable = '$num' WHERE comptes_id = '".$this->Id."' ";
 			$Exec = mysql_query($Req);
 	 	}
 		catch(Exception $e){}	
 	}
 	
 	public function send_mail($id,$email="",$type=""){
 		
 		if($email == ''){
 			$email = $this->getEmail();
 		}
 		
 		if($type == ''){	
 			$subject = 'Inscription sur le site '.$GLOBALS['_data_']['nom_site'];
			$message = $this->GetNomComplet().',<br><br>Vous venez de vous inscrire sur le site '.$GLOBALS['_data_']['nom_site'].' <strong><br><br>
						Vos identifiants de connexion sont les suivants : <br><br>
						Email : <font face="Arial, Helvetica, sans-serif" style="font-size:11px;" color="#5f9aca">'.$email.'</font><br>
						Mot de passe : <font face="Arial, Helvetica, sans-serif" style="font-size:11px;" color="#5f9aca">'.LiverCrypt::Decrypte($this->getPass()).'</font></strong><br>
						<img src="'.$GLOBALS['_data_']['url_principale'].'images_mail/spacer.gif" height="16" alt=""><br><br>';	
 			
 		}
 		elseif($type == 2){
 			$subject = 'Modification de vos identifiants sur le site '.$GLOBALS['_data_']['nom_site'];
 			$message = $this->GetNomComplet().',<br><br>Vous venez de modifier vos identifiants de connexion au site '.$GLOBALS['_data_']['nom_site'].'.<br><br>
					   <br><br>Voici vos nouveaux codes d&acute;acc&egrave;s vous permettant de vous connecter &agrave; votre compte '.$GLOBALS['_data_']['nom_site'].' :<br><br>
					   <strong>Email : <font face="Arial, Helvetica, sans-serif" style="font-size:11px;" color="#5f9aca">'.$email.'</font>
					   <br>Mot de passe : <font face="Arial, Helvetica, sans-serif" style="font-size:11px;" color="#5f9aca">'.LiverCrypt::Decrypte($this->getPass()).'</font></strong><br><br>';
 			
 		}
 		
 		$mail = new PHPmailer();
		$mail->IsMail();
		$mail->IsHTML(true);
		$mail->From=$GLOBALS['_data_']['email_princ'];
		$mail->FromName=$GLOBALS['_data_']['nom_site'];
		$mail->AddAddress($email);
		$mail->Subject=$subject;
			
		$mail->Body=imprime_mail($message);
		if(!$mail->Send()){ //Teste le return code de la fonction
			
			echo $mail->ErrorInfo; //Affiche le message d'erreur (ATTENTION:voir section 7)
		}
		
		unset($mail);
 		
 	}
 	
 	/**
 	 * V&Eacute;rifie si l'adresse mail pass&Eacute; en param&Egrave;tre a d&Eacute;j&Agrave; &Eacute;t&Eacute; parrain&Eacute;e
 	 * 
 	 * @access public
 	 * @return bool
 	 */
 	public function isDejaParrain($email){
 		
 		try{
 			$db = DB::get();
 			$sql = ' SELECT codepromo_id 
 					 FROM t_codepromo 
 					 WHERE codepromo_supprime = \'0\'  
 					 AND codepromo_idparrain = \''.$this->Id.'\' 
 					 AND codepromo_type = \'Parrainage\' 
 					 AND codepromo_listeval = \''.$db->escape($email).'\'  
 					 AND codepromo_actif = \'1\' ';
 			
 			$result = $db->query($sql);
 			$nb_result = $db->num_rows($result);
 			
 			if($nb_result>0)
 				return true;
 			else
 				return false;
 		
 		}
 		catch(Exception $e){}
 		
 	}
 	
 	
 	/**
 	 * Envoi un mail au filleul
 	 * 
 	 * @access public
 	 * @param string : email du filleul
 	 * @return void
 	 */
 	public function sendMailParrainage($email,$nom,$code = '',$filleul = '',$messagelaisse=''){
 		
 		$messagelaisse = trim($messagelaisse);
 		if($filleul == ''){
	 		$subject = 'Un ami souhaite vous parrainer sur le site '.$GLOBALS['_data_']['nom_site'];
	 		$message = 'Bonjour '.ucfirst($nom).'<br /><br /> 
	 					'.$this->GetNomComplet().' a souhait&eacute; vous parrainer afin de vous faire conna&icirc;tre notre site.<br>';
	
			if($messagelaisse != ''){
				$message .='<br>
							<strong>Son message </strong>: '.stripslashes($messagelaisse).' <br>
							<br>';
			}
	
			$message.='	<br>
							En passant commande chez nous, vous permettez &agrave; '.$this->GetNomComplet().' <font face="Arial, Helvetica, sans-serif" style="font-size:12px;" color="#5f9aca">de b&eacute;n&eacute;ficier d\'<strong>un bon d\'achat</strong> &agrave; valoir sur sa prochaine commande.</font> <br>
						<br>
						<br>
							Rendez-vous sur notre site <a href="'.$GLOBALS['_data_']['url_principale'].'" style="font-size:12px; text-decoration:underline; color:#5f9aca">'.$GLOBALS['_data_']['url_principale'].'</a><br> ';
	 					
	 					
 					
 		}
 		else{
 			$subject = 'Votre filleul a pass&Eacute; commande sur le site '.$GLOBALS['_data_']['nom_site'];
 			$message = ' Bonjour '.ucfirst($nom).'<br /><br /> 
 						Vous avez parrain&eacute; '.$this->GetNomComplet().' qui vient de passer sa premi&egrave;re commande sur notre site. 
						<br><br><br><br>
						<font face="Arial, Helvetica, sans-serif" style="font-size:16px;" color="#5f9aca">Vous b&eacute;n&eacute;ficiez donc <br>
						<strong>d&rsquo;un bon d&rsquo;achat de  '.$GLOBALS['_data_']['reduc_parrainage'].' '.htmlentities($GLOBALS['_data_']['sigle_parrainage']).' </strong><br>
						&agrave; valoir sur votre prochaine commande. </font>
						<br><br><br><font face="Arial, Helvetica, sans-serif" style="font-size:12px;" color="#5f9aca">Vous retrouverez ce bon d&rsquo;achat ainsi que le code permettant de l&rsquo;utiliser dans votre <a href="'.$GLOBALS['_data_']['url_principale'].'moncompte.php" style="font-size:12px; text-decoration:underline; color:#4e6472">Espace client</a>, rubrique Mes filleuls. </font>';
 		}
 		$mail = new PHPmailer();
		$mail->IsMail();
		$mail->IsHTML(true);
		$mail->From=$GLOBALS['_data_']['email_princ'];
		$mail->FromName=$GLOBALS['_data_']['nom_site'];
		$mail->AddAddress($email);
		$mail->AddBCC($GLOBALS['_data_']['email_princ']);
		$mail->Subject=$subject;
			
		$mail->Body=imprime_mail($message);
		if(!$mail->Send()){ //Teste le return code de la fonction
			
			echo $mail->ErrorInfo; //Affiche le message d'erreur (ATTENTION:voir section 7)
		}
		
		unset($mail);
 	
 	}
 	
 	/**
 	 * Cr&Eacute;er le code parrainage
 	 * 
 	 * @access public
 	 * @return void
 	 */
 	public function genere_parrainage($email,$nom,$filleul = '',$message=''){
 		// On va cr&Eacute;er le code promo associ&Eacute;
 		// Si filleul est vide c'est le parrain qui invite ses filleuls
 		
 		
 		
 		try{
 			$code_parrainage = '';
 			
	 			$code_parrainage = GenerateNumParrainage();
	 			//code valable 1 an
	 			$un_an_de_plus = date('Y')+1;
	 			$sql_add = ($filleul == '')?' codepromo_idparrain = \''.$this->Id.'\' ,':' codepromo_idfilleul = \''.$filleul.'\' , ';
	 			if($filleul == ''){
	 				$nb_util = 0;
	 			}
	 			else{
	 				$nb_util = 1;
	 			}
	 			$db = DB::get();
		 		$sql = "INSERT INTO t_codepromo 
		 				SET codepromo_nom		=	'".$db->escape($code_parrainage)."' , 
							codepromo_debut		=	'".date('Y-m-d')."' , 
							codepromo_fin 		=	'".date($un_an_de_plus.'-m-d')."' , 
							codepromo_minimum 	=	'10' , 
							codepromo_nbutil 	=	'".$nb_util."' , 
							codepromo_type 		=	'Parrainage' , 
							codepromo_listeval 	= 	'$email' ,
							".$sql_add."
							codepromo_remise 	=	'".$GLOBALS['_data_']['reduc_parrainage']."' , 
							codepromo_sigle 	=	'".$GLOBALS['_data_']['sigle_parrainage']."' , 
							codepromo_operation =   'Parrainage',
							codepromo_actif 	=	'1' ";
	 	
	 			$InsertionSql = $db->query($sql) or die(mysql_error());
 			
 			$this->sendMailParrainage($email,$nom,$code_parrainage,$filleul,$message);
 		}
 		catch(Exception $e){}
 	}
 	
 	// D&Eacute;finit sur quel table on va travaill&Eacute;
 	public function setTable($table){
 		$this->table = $table;
 	}
 	
 	// Initialisation des variables
 	public function set(){
 		
 		if($this->Id==""){
 			//header("location:".$GLOBALS['_data_']['url_principale']."?erreur=client");
 			//exit();
 		}
 		try{
	 		$db = DB::get();
 			$Req = "SELECT * FROM t_comptes WHERE comptes_id = '".$this->Id."' ";
	 				
	 		$Exec = $db->query($Req);
	 		$CLIENT = $db->fetch_object($Exec);
	 	
	 		$this->Pseudo = stripallslashes($CLIENT->comptes_pseudo);
	 		$this->Societe['f'] = stripallslashes($CLIENT->comptes_societe);
	 		$this->Civilite['f'] = $CLIENT->comptes_civilite;
	 		$this->Prenom['f'] = stripallslashes($CLIENT->comptes_prenom);
	 		$this->Nom['f'] = stripallslashes($CLIENT->comptes_nom);
	 		$this->Adresse['f'] = stripallslashes($CLIENT->comptes_adresse);
	 		$this->Adresse2['f'] = stripallslashes($CLIENT->comptes_adresse2);
	 		$this->Ville['f'] = stripallslashes($CLIENT->comptes_ville);
	 		$this->Cp['f'] = stripallslashes($CLIENT->comptes_cp);
	 		$this->Pays['f'] = stripallslashes($CLIENT->comptes_pays);
	 		$this->Tel['f'] = stripallslashes($CLIENT->comptes_tel);
	 				
	 		$this->Email = $CLIENT->comptes_email;
	 		$this->Pass = $CLIENT->comptes_pass;
	 		$this->Privileges = $CLIENT->comptes_privileges;
	 		$this->Statut = $CLIENT->comptes_actif;
	 		$this->Profil = $CLIENT->comptes_statut;
			 		
	 		
	 		if($this->Statut==1){
	 			$this->TxtStatut = 'Actif';
	 		}
	 		else{
	 			$this->TxtStatut = 'D&eacute;sactiv&eacute;';
	 		}
	 		
	 		$this->BaseNewsletter = $CLIENT->comptes_basenewsletter;
	 		$this->Optin[0] = $CLIENT->comptes_newsletter;
	 		$this->Optin[1] = $CLIENT->comptes_newsletter2;
	 		$this->Optin[2] = $CLIENT->comptes_newsletter3;
	 		
	 		$this->DateInscr 		= $CLIENT->comptes_date;
	 		$this->DateNaissance 	= $CLIENT->comptes_naissance; 	
	 		 $Req2 = "SELECT adresses_id FROM t_adresses WHERE adresses_idcompte = '".$this->Id."' AND adresses_supprime='0' ORDER BY adresses_id ASC ";
	 		$Exec2 = $db->query($Req2);
	 		$cpt=0;
	 		while($Item = $db->fetch_object($Exec2)){
	 			$this->ListeAdresse[$cpt] = $Item->adresses_id;
	 			
	 			$cpt++;
	 			
	 		}
 		}
 		catch(Exception $e){}
 	}
 
   
   public function setLivraison($num=""){
		
		if($num=='')
			$num = 0;
			
			try{	
				$db = DB::get();
				$Req = "SELECT * FROM t_adresses WHERE adresses_id = '".$this->ListeAdresse[$num]."' LIMIT 1";	
			
				$Exec = $db->query($Req);
				$Item = $db->fetch_object($Exec);
				
				$this->setSociete($Item->adresses_societe,'l');
				$this->setCivilite($Item->adresses_civilite,'l');
				$this->setPrenom($Item->adresses_prenom,'l');
				$this->setNom($Item->adresses_nom,'l');
				$this->setAdresse($Item->adresses_adresse,'l');
				$this->setAdresse2($Item->adresses_adresse2,'l');
				$this->setCp($Item->adresses_cp,'l');
				$this->setVille($Item->adresses_ville,'l');
				$this->setPays($Item->adresses_pays,'l');
				$this->setTel($Item->adresses_tel,'l');
				$this->setCommentaire($Item->adresses_commentaire,'l');
			}
			catch(Exception $e){}
	}
   
 	public function CreateClient(){
 			try{	
				$db = DB::get();
	 			$Req = "INSERT INTO t_comptes SET comptes_date = '".date('Y-m-d')."', comptes_actif='1' ";
	 		 	$Exec = $db->query($Req) or die(mysql_error());
	 		 	$id = $db->last_insert_id();
	 		 	$this->Id = $id;
 			}
			catch(Exception $e){}
 	}
	
 	
 	
 	public function GetinscriptionNewsletter($email,$news,$part){
 		$email = trim($email);
 		
 		try{	
				$db = DB::get();
 		
		 		$Req = "SELECT comptes_id,comptes_newsletter,comptes_newsletter2 from t_comptes WHERE comptes_email='".$db->escape($email)."' LIMIT 1";
		 	
		 		$Sendsql = $db->query($Req);
		 		list($id,$news1,$news2) = $db->fetch_array($Sendsql);
		 		
		 		if($id>0){
		 			if((($news==1) && ($news1==0)) || (($part==1) && ($news2==0))){
		 				return $id;
		 			} else {
		 				$return = 'ko';
		 			}
		 		}
		 	
		 		return $return ;
 		}
 		catch(Exception $e){}
 	}
 	
 /**
 	 * Retourne a liste des filleuls
 	 * 
 	 * @param $id
 	 * @return unknown_type
 	 */
 	public function getListeFilleuls(){
 		$liste_filleul = array();
 		try{
 			$db = DB::get();
 			$sql = 'SELECT * 
 					FROM t_codepromo 
 					WHERE codepromo_supprime = \'0\'  
 					AND codepromo_type=\'Parrainage\'
 					AND codepromo_idparrain = \''.$this->Id.'\'   ';
 			//echo $sql;die();
 			$result = $db->query($sql);
 			$i = 0;
 			// liste des filleuls
 			while($row = $db->fetch_assoc($result)){
 				$liste_filleul[$i]['email'] 	= $row['codepromo_listeval'];
 				 				
 				$liste_filleul[$i]['date']		= $row['codepromo_debut'];
 				$liste_filleul[$i]['remise']	= $row['codepromo_remise'].' '.$row['codepromo_sigle'];
 				$liste_filleul[$i]['idparrain']	= $row['codepromo_idparrain'];
 				$liste_filleul[$i]['idfilleul']	= $row['codepromo_idfilleul'];
 				
 				//codepromo_listeval LIKE \'%'.$this->getEmail().'%\'
 				
 				$id_filleul = self::getIdFromEmail($row['codepromo_listeval']);
 				$membre = new Client($id_filleul);
 				if($id_filleul != ''){
 					$membre->set();
 					$liste_filleul[$i]['nomcomplet'] = $membre->getNomComplet();
 				}
				else{
					$liste_filleul[$i]['nomcomplet'] = $row['codepromo_listeval'];
				}
 			
 				$sql2 = 'SELECT * 
	 					FROM t_codepromo 
	 					WHERE codepromo_supprime = \'0\'  
	 					AND codepromo_type=\'Parrainage\'
	 					AND codepromo_idfilleul = \''.$id_filleul.'\' 
	 					AND codepromo_listeval LIKE \'%'.$this->getEmail().'%\'  ';
				
				$result2 	= $db->query($sql2);
				$nbres 		= $db->num_rows($result2);
				if($nbres != ''){
					while($row2 = $db->fetch_assoc($result2)){
						$liste_filleul[$i]['code']		= $row2['codepromo_nom'];
						$liste_filleul[$i]['date_gagne']= $row2['codepromo_debut'];
						$liste_filleul[$i]['nbutil']	= $row2['codepromo_nbutil'];
					}
				}
				else{
						$liste_filleul[$i]['code']		= '-';
						$liste_filleul[$i]['nbutil']	= '-';
				}
 			$i++;
 			}
 			
 			
 			
 			return $liste_filleul;
 		}
 		catch(Exception $e){}
 	}
 	
 	/**
 	 * Retourne la somme des commandes
 	 * @return decimal
 	 */
 	public function GetSommeCommandes(){
 		
 		try{
 			$db = DB::get();
 			$Requete = "SELECT SUM(commandes_total - commandes_remise -  commandes_remisepriv) as somme from t_commandes WHERE commandes_idmembre='".$this->Id."' AND commandes_supprimer='0' AND commandes_etat NOT IN('En attente','Annul&Eacute;e') GROUP BY commandes_idmembre";
 			$Send = $db->query($Requete)or die(mysql_error().'<br>'.$Requete);
 			$val = $db->fetch_assoc($Send);
 			return $val['somme'];
 		}
 		catch(Exception $e){}
 	}
 	
 	/**
 	 * Met &Agrave; jour le statut privil&Egrave;ge d'un client
 	 * @param $niveau
 	 * @return void
 	 */
 	public function MajPrivileges($niveau)
 	{
 		try{
 			$db = DB::get();
 			$sql = "UPDATE t_comptes SET comptes_privileges='$niveau' WHERE comptes_id='".$this->Id."' LIMIT 1";
 			$Update = $db->query($sql);
 		}
 		catch(Exception $e){}
 	}
 	
 	// Mail envoy&Eacute; &Agrave; l'inscription ou la modification des acc&Egrave;s
 	public function send_mail_privilege($montant,$remise){ 
 		 		
 		 		
		$sujet = 'Votre nouveau statut sur le site '.$GLOBALS['_data_']['nom_site'];
 		
 		$message=  $this->GetNomComplet().'<br /><br />';
 		 		
 		//$message.=' Vous &egrave;tes client sur le site '.NOM_SITE.' depuis le '.reverse($this->getDateInscr()).' <br />';
		$message.=' Le montant total de vos commandes a atteint '.$montant.'&euro;, ce qui vous permet de devenir un client privil&egrave;ge. <br />  ';
 		$message.=' D&eacute;sormais, : <br />';
 		$message.=' - Vous b&eacute;n&eacute;ficierez d&acute;une remise de '.$remise.' %<br />';
 		$message.=' - Vos commandes seront trait&eacute;es en priorit&eacute;<br />';
 		$message.=' - Vous serez automatiquement avertis lors de l&acute;arriv&eacute; de nouveaux produits <br />';
 		

 		$mail = new PHPmailer();
		$mail->IsMail();
		$mail->IsHTML(true);
		$mail->From=$GLOBALS['_data_']['email_princ'];
		$mail->FromName=$GLOBALS['_data_']['nom_site'];
		$mail->AddAddress($this->getEmail());
		$mail->Subject=$sujet;
		//$mail->Body=imprime_mail($message);
		$mail->Body=imprime_mail($message);
		if(!$mail->Send()){ //Teste le return code de la fonction
			
			echo $mail->ErrorInfo; //Affiche le message d'erreur (ATTENTION:voir section 7)
		}
		
		unset($mail);
 		
 	}
 	
 	
 	public static function lost_pass($email_lost){
 		
 		try{
 			$db 	= DB::get();
 			$REQ 	= "SELECT comptes_civilite,comptes_nom,comptes_prenom, comptes_pass FROM t_comptes WHERE comptes_email = '".$email_lost."' AND comptes_actif='1' ";
		 	$EXEC 	= $db->query($REQ);
		 	list($civilite,$nom, $prenom, $pw) = $db->fetch_row($EXEC);
		 	$mot_passe = LiverCrypt::Decrypte($pw);
		 	$email_send = $email_lost;
		 	
		 	if($db->num_rows($EXEC) != ''){
		 		
		 		// Envoi du mail 
		 		$result_ok = 1;
		 		$mail = new PHPmailer();
				$mail->IsMail();
				$mail->IsHTML(true);
				$mail->From		=	$GLOBALS['_data_']['email_princ'];
				$mail->FromName	=	$GLOBALS['_data_']['nom_site'];
				$mail->AddAddress($email_send);
				$mail->Subject	=	'Mot de passe oubli&Eacute; sur '.$GLOBALS['_data_']['nom_site'];
				$mail->Body=imprime_mail("<font style=\"font-size:12px;\" >Bonjour ".$civilite." ".ucfirst(stripslashes($prenom))." ".strtoupper(stripslashes($nom))." , <br /><br />" .
										"Vos acc&Egrave;s sur le site ".$GLOBALS['_data_']['nom_site']." vous sont renvoy&eacute; suite &agrave; votre demande de mot de passe oubli&eacute; " .
										"<br />" .
										"Vous trouverez ci-dessous vos identifiants de connexion" .
										"<br />" .
										"Conservez les, ils vous serviront pour vous identifier la prochaine fois que vous viendrez sur notre site" .
										"<br /><br /> " .
										"Votre Identifiant :".trim(stripslashes($email_send))." <br />" .
										"Votre mot de passe :".$mot_passe." </font>"  );
//										"L'&Eacute;quipe ".$GLOBALS['_data_']['nom_site'];
				if(!$mail->Send()){ //Teste le return code de la fonction
					echo $mail->ErrorInfo; //Affiche le message d'erreur (ATTENTION:voir section 7)
				}
				unset($mail);
		 		
		 		return 'ok';
		 	}
 		}
 		catch(Exception $e){}
 		
 	}
 	
 	
 	/**
 	 * Constructeur de l'objet
 	 * @param $id
 	 * @return void
 	 */
 	public function __construct($id=''){
 		
 		 if($id!=''){
 		 	$this->Id = $id;
 		 	$this->table = 't_comptes';
 		 	$this->set();
 		 }
 	
 	}
 	 	
 }
 
?>
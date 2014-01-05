<?php


class Client
{

    // D&Eacute;claration des variables
    private $Id;
    private $Date;
    private $BaseNewsletter;
    private $Newsletter;
    private $Newsletter2;
    private $Newsletter3;
    private $Civilite;
    private $Prenom;
    private $Nom;
    private $Societe;
    private $Email;
    private $Adresse;
    private $Adresse2;
    private $Cp;
    private $Ville;
    private $Tel;
    private $Pass;
    private $Actif;
    private $Naissance;
    private $Privileges;
    private $Pays;


    //constantes
    public static $Table = 'comptes';


    // Modifieur de la classe
    public function SetField($val, $field)
    {
        $this->{$field} = $val;
        //echo $field.'<br>';
    }
    // R&Eacute;cup&Eacute;rateur de champ
    public function GetField($field)
    {
        return $this->{$field};

    }


    public function GetNomComplet()
    {
        return stripslashes($this->Civilite . ' ' . $this->Prenom . ' ' . $this->Nom);
    }

    static function DeleteClient($array)
    {
        try {
            $db = DB::get();
            foreach ($array as $c => $v) {
                $query = DB::DeleteClassic(self::$Table, $v);
                $result = $db->query($query);
            }

        }
        catch (exception $e) {
            //echo $e->getMessage();
        }

    }


    //Ajouter un client
    static function addClient()
    {
        try {
            $db = DB::get();

            $query = "INSERT into t_" . self::$Table . " SET " . self::$Table . "_date='" .
                date("Y-m-d") . "'";
            $result = $db->query($query);
            return $db->last_insert_id();


        }
        catch (exception $e) {
            //echo $e->getMessage();
        }


    }

    static function TabValeurs($var = "")
    {

        
        $tab_update[] = 'civilite';
        $tab_update[] = 'prenom';
        $tab_update[] = 'nom';
        if($var != "coordonnees"){
        	$tab_update[] = 'email';
        }
        $tab_update[] = 'adresse';
        $tab_update[] = 'adresse2';
        $tab_update[] = 'ville';
        $tab_update[] = 'cp';
        $tab_update[] = 'pays';
        $tab_update[] = 'tel';

        if ($var == "") {
            $tab_update[] = 'basenewsletter';
            $tab_update[] = 'actif';
            $tab_update[] = 'naissance';
            $tab_update[] = 'newsletter';
            $tab_update[] = 'newsletter2';
            $tab_update[] = 'newsletter3';
        }

        return $tab_update;
    }
    //Modifier un client

    public function modifierClient($var="")
    {
        try {
            $db = DB::get();

            $Req = "UPDATE t_" . self::$Table . ' SET ';
            $tab = $this->TabValeurs($var);
            $nb_lignes_update = count($tab);

            $i = 1;


            foreach ($tab as $cle => $valeur) {


                $Req .= self::$Table . "_" . $valeur . "='" . $db->escape($this->{ucfirst($valeur)
                    }) . "'";

                if ($i < $nb_lignes_update)
                    $Req .= " ,";

                $i++;
            }
            $Req .= " WHERE " . self::$Table . "_id = '" . $this->Id . "' LIMIT 1";
            //echo $Req.'<br>';
            //exit();
            $result = $db->query($Req);


        }
        catch (exception $e) {
            //echo $e->getMessage();
        }


    }

    public function getId()
    {
        return $this->Id;
    }
    // Initialisation des variables
    public function set()
    {

        try {
            $db = DB::get();

            $Req = "SELECT * FROM t_" . self::$Table . " WHERE " . self::$Table . "_id = '" .
                $this->Id . "' ";

            $result = $db->query($Req);
            $CLIENT = $db->fetch_object($result);

            $this->Date = $CLIENT->{self::$Table . '_date'};
            $this->BaseNewsletter = $CLIENT->{self::$Table . '_basenewsletter'};
            $this->Newsletter = $CLIENT->{self::$Table . '_newsletter'};
            $this->Newsletter2 = $CLIENT->{self::$Table . '_newsletter2'};
            $this->Newsletter3 = $CLIENT->{self::$Table . '_newsletter3'};
            $this->Civilite = $CLIENT->{self::$Table . '_civilite'};
            $this->Prenom = stripslashes($CLIENT->{self::$Table . '_prenom'});
            $this->Nom = stripslashes($CLIENT->{self::$Table . '_nom'});
            $this->Societe = stripslashes($CLIENT->{self::$Table . '_societe'});
            $this->Email = stripslashes($CLIENT->{self::$Table . '_email'});
            $this->Pass = stripslashes($CLIENT->{self::$Table . '_pass'});
            $this->Adresse = stripslashes($CLIENT->{self::$Table . '_adresse'});
            $this->Adresse2 = stripslashes($CLIENT->{self::$Table . '_adresse2'});
            $this->Cp = stripslashes($CLIENT->{self::$Table . '_cp'});
            $this->Ville = stripslashes($CLIENT->{self::$Table . '_ville'});
            $this->Pays = stripslashes($CLIENT->{self::$Table . '_pays'});
            $this->Tel = stripslashes($CLIENT->{self::$Table . '_tel'});
            $this->Actif = stripslashes($CLIENT->{self::$Table . '_actif'});
            $this->Naissance = $CLIENT->{self::$Table . '_naissance'};


        }
        catch (exception $e) {
            //echo $e->getMessage();
        }


    }
    
    
 	public function modEmail($email){
 		try{
 			$db = DB::get();
 			$Req = " UPDATE t_" . self::$Table . " SET " . self::$Table . "_email = '$email' WHERE " . self::$Table . "_id = '".$this->Id."' ";
 			$Exec = $db->query($Req) or die(mysql_error());
 		}
 		catch(Exception $e){}
 	}
    
    public function modPass($pass)
    {

        try {
            $db = DB::get();

            $passcrypt = LiverCrypt::Crypte($pass);
            $this->Pass = $passcrypt;
            $Req = " UPDATE t_" . self::$Table . " SET " . self::$Table . "_pass = '$passcrypt' WHERE " .
                self::$Table . "_id = '" . $this->Id . "' ";
            $result = $db->query($Req);


        }
        catch (exception $e) {
            //echo $e->getMessage();
        }


    }


    public static function lost_pass($email_lost)
    {

        try {
            $db = DB::get();
            $REQ = "SELECT comptes_civilite,comptes_nom,comptes_prenom, comptes_pass FROM t_comptes WHERE comptes_email = '" .
                $email_lost . "' 
             AND comptes_actif='1'  AND comptes_basenewsletter='0' AND comptes_supprime='0'";
            $EXEC = $db->query($REQ);
            list($civilite, $nom, $prenom, $pw) = $db->fetch_row($EXEC);
            $mot_passe = LiverCrypt::Decrypte($pw);
            $email_send = $email_lost;

            if ($db->num_rows($EXEC) != '') {

                // Envoi du mail
                $result_ok = 1;
                $mail = new PHPmailer();
                $mail->IsMail();
                $mail->IsHTML(true);
                $mail->From = $GLOBALS['_data_']['email_princ'];
                $mail->FromName = $GLOBALS['_data_']['nom_site'];
                $mail->AddAddress($email_send);
                $mail->Subject = 'Mot de passe oubli&Eacute; sur ' . $GLOBALS['_data_']['nom_site'];
                $mail->Body = imprime_mail("<font style=\"font-size:12px;\" >Bonjour " . $civilite .
                    " " . ucfirst(stripslashes($prenom)) . " " . strtoupper(stripslashes($nom)) .
                    " , <br /><br />" . "Vos acc&Egrave;s sur le site " . $GLOBALS['_data_']['nom_site'] .
                    " vous sont renvoy&eacute; suite &agrave; votre demande de mot de passe oubli&eacute; " .
                    "<br />" . "Vous trouverez ci-dessous vos identifiants de connexion" . "<br />" .
                    "Conservez les, ils vous serviront pour vous identifier la prochaine fois que vous viendrez sur notre site" .
                    "<br /><br /> " . "Votre Identifiant :" . trim(stripslashes($email_send)) .
                    " <br />" . "Votre mot de passe :" . $mot_passe . " </font>");
                //										"L'&Eacute;quipe ".$GLOBALS['_data_']['nom_site'];
                if (!$mail->Send()) { //Teste le return code de la fonction
                    echo $mail->ErrorInfo; //Affiche le message d'erreur (ATTENTION:voir section 7)
                }
                unset($mail);

                return 'ok';
            }
        }
        catch (exception $e) {
        }

    }
    public static function Validemail($email, $pass)
    {
        try {
            $db = DB::get();

            $Req = " SELECT comptes_pass from t_comptes WHERE comptes_actif='1' 
            AND comptes_supprime='0' AND comptes_email='" . $db->escape($email) .
                "' 
             AND comptes_basenewsletter='0' LIMIT 1";
            //InsertTest($Req);
            $result = $db->query($Req);
            list($passcompte) = $db->fetch_row($result);
            $passdescrypte = LiverCrypt::Decrypte($passcompte);
            if ($passdescrypte == $pass)
                return true;
            else
                return false;

        }
        catch (exception $e) {
            //echo $e->getMessage();
        }
    }
    public static function Doublonemail($email,  $id = null)
    {
        try {
            $db = DB::get();

            if ((!is_null($id)) && ($id > 0))
                $addqsql = " AND comptes_id<>'$id' ";



            $Req = " SELECT comptes_id from t_comptes WHERE comptes_actif='1' 
            AND comptes_supprime='0' AND comptes_email='" . $db->escape($email) .
                "' 
              AND comptes_basenewsletter='0' " . $addqsql;
            $result = $db->query($Req);
            $count = $db->num_rows($result);
            if ($count > 0)
                return true;
            else
                return false;

        }
        catch (exception $e) {
            //echo $e->getMessage();
        }
    }
    public static function GetinscriptionNewsletter($email, $news, $part)
    {
        $email = trim($email);

        try {
            $db = DB::get();

            $Req = "SELECT comptes_id,comptes_newsletter,comptes_newsletter2 from t_comptes WHERE comptes_email='" .
                $db->escape($email) . "' LIMIT 1";

            $Sendsql = $db->query($Req);
            list($id, $news1, $news2) = $db->fetch_array($Sendsql);

            if ($id > 0) {
                if ((($news == 1) && ($news1 == 0)) || (($part == 1) && ($news2 == 0))) {
                    return $id;
                } else {
                    $return = 'ko';
                }
            }

            return $return;
        }
        catch (exception $e) {
        }
    }

    public function send_mail($email = "", $type = 1)
    {

        if ($email == '') {
            $email = $this->Email;
        }
        switch ($type) {
            case '1':
                $Titre = 'Vous venez de vous inscrire sur le site';
                $subject = 'Inscription sur le site ' . $GLOBALS['_data_']['nom_site'];
                break;
            case '2':
                $Titre = 'Vos identifiants ont &eacute;t&eacute; modifi&eacute;s';
                $subject = 'Vos identifiants ont &Eacute;t&Eacute; modifi&Eacute;s sur le site ' . $GLOBALS['_data_']['nom_site'];
                break;
        }

        $DecryptePass = LiverCrypt::Decrypte($this->Pass);

        $message = $this->GetNomComplet() . ',<br><br>' . $Titre . ' ' . $GLOBALS['_data_']['nom_site'] .
            ' <strong><br><br>
						Vos identifiants de connexion sont les suivants : <br><br>
						Email : <font face="Arial, Helvetica, sans-serif" style="font-size:11px;" color="#5f9aca">' .
            $email . '</font><br>
						Mot de passe : <font face="Arial, Helvetica, sans-serif" style="font-size:11px;" color="#5f9aca">' .
            $DecryptePass . '</font></strong><br>
						<br><br>';


        $mail = new PHPmailer();
        $mail->IsMail();
        $mail->IsHTML(true);
        $mail->From = $GLOBALS['_data_']['email_princ'];
        $mail->FromName = $GLOBALS['_data_']['nom_site'];
        $mail->AddAddress($email);
        $mail->Subject = $subject;

        $mail->Body = imprime_mail($message);
        if (!$mail->Send()) { //Teste le return code de la fonction

            echo $mail->ErrorInfo; //Affiche le message d'erreur (ATTENTION:voir section 7)
        }

        unset($mail);

    }
    /**
     * Client::GetOptins()
     * 
     * @return string
     */
    public function GetOptins()
    {
        if ($this->Newsletter == 1)
            $chaine = htmlentities('Inscrit &Agrave; la newsletter');

        if ($this->Newsletter2 == 1) {
            if ($chaine != "")
                $chaine .= '<br/>';

            $chaine .= htmlentities('Inscrit aux partenaires');
        }
        if ($this->Newsletter3 == 1) {
            if ($chaine != "")
                $chaine .= '<br/>';

            $chaine .= htmlentities('Inscrit au club');
        }
        return $chaine;
    }
    
    
 	public function modifnews(){
 		
 		try{
 			$db = DB::get();
 			$Req = "UPDATE t_comptes SET comptes_newsletter = '".$this->Newsletter."'," .
 									"comptes_newsletter2 = '".$this->Newsletter2."' WHERE comptes_id = '".$this->Id."' ";
 			
 			
 			
 			$Exec = $db->query($Req);
 		}
 		catch(Exception $e){
 			var_dump($e->getMessage());
 		}
 	}
    
    
    
    
    
    
    
    public function __construct($id)
    {


        $this->Id = $id;
        $this->set();

    }


}

?>
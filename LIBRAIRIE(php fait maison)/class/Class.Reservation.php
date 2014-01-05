<?php


class Reservation
{

    // D&Eacute;claration des variables
    private $Id;
    private $Numero;
    private $Date;
    private $Idcompte;
    private $Nomcomplet;
    private $Email;
    private $Adresse;
    private $Adresse2;
    private $Cp;
    private $Ville;
    private $Pays;
    private $Tel;
    private $Montantttc;
    private $Idproduit;
    private $Nomproduit;
    private $Categorie;
    private $Miles;
    private $Prix;
    private $Promotion;
    private $Image;
    private $Etat;
    private $Parrain;


    //constantes
    public static $Table = 'reservation';


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

    static function DeleteReservation($array)
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


    //Ajouter un Reservation
    static function addReservation()
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

    static function TabValeurs()
    {

        $tab_update[] = 'numero';
        $tab_update[] = 'idcompte';
        $tab_update[] = 'nomcomplet';
        $tab_update[] = 'email';
        $tab_update[] = 'adresse';
        $tab_update[] = 'adresse2';
        $tab_update[] = 'ville';
        $tab_update[] = 'cp';
        $tab_update[] = 'pays';
        $tab_update[] = 'tel';
        $tab_update[] = 'montantttc';
        $tab_update[] = 'idproduit';
        $tab_update[] = 'nomproduit';
        $tab_update[] = 'categorie';
        $tab_update[] = 'miles';
        $tab_update[] = 'prix';
        $tab_update[] = 'promotion';
        $tab_update[] = 'image';
        $tab_update[] = 'etat';
        $tab_update[] = 'parrain';

        return $tab_update;
    }
    //Modifier un Reservation

    public function modifierReservation()
    {
        try {
            $db = DB::get();

            $Req = "UPDATE t_" . self::$Table . ' SET ';
            $tab = $this->TabValeurs();
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
    
    public function getEtat(){
        switch($this->Etat){
            case 'En attente':$etat = 'En attente';
            break;
            case 'Valide':$etat='Pay&Eacute;e';
            break;
            default : $etat = $this->Etat;
        }
        return $etat;
    }

    public function getId()
    {
        return $this->Id;
    }
    // Initialisation des variables
    public function set($num = null)
    {

        try {
            $db = DB::get();
			if($num == NULL){
            $Req = "SELECT * FROM t_" . self::$Table . " WHERE " . self::$Table . "_id = '" .
                $this->Id . "' ";
			}
			else{
			$Req = "SELECT * FROM t_" . self::$Table . " WHERE " . self::$Table . "_numero = '" .
                $this->Numero . "' ";	
			}
            $result = $db->query($Req);
            $Reservation = $db->fetch_object($result);
			$this->Id 		= $Reservation->{self::$Table . '_id'};
            $this->Numero 	= $Reservation->{self::$Table . '_numero'};
            $this->Date = $Reservation->{self::$Table . '_date'};
            $this->Idcompte = $Reservation->{self::$Table . '_idcompte'};
            $this->Nomcomplet = stripslashes($Reservation->{self::$Table . '_nomcomplet'});
            $this->Email = stripslashes($Reservation->{self::$Table . '_email'});
            $this->Adresse = stripslashes($Reservation->{self::$Table . '_adresse'});
            $this->Adresse2 = stripslashes($Reservation->{self::$Table . '_adresse2'});
            $this->Cp = stripslashes($Reservation->{self::$Table . '_cp'});
            $this->Ville = stripslashes($Reservation->{self::$Table . '_ville'});
            $this->Pays = stripslashes($Reservation->{self::$Table . '_pays'});
            $this->Tel = stripslashes($Reservation->{self::$Table . '_tel'});
            $this->Montantttc = stripslashes($Reservation->{self::$Table . '_montantttc'});
            $this->Idproduit = $Reservation->{self::$Table . '_idproduit'};
            $this->Nomproduit = stripslashes($Reservation->{self::$Table . '_nomproduit'});
            $this->Categorie = stripslashes($Reservation->{self::$Table . '_categorie'});
            $this->Miles = stripslashes($Reservation->{self::$Table . '_miles'});
            $this->Prix = stripslashes($Reservation->{self::$Table . '_prix'});
            $this->Promotion = stripslashes($Reservation->{self::$Table . '_promotion'});
            $this->Image = stripslashes($Reservation->{self::$Table . '_image'});
            $this->Etat = stripslashes($Reservation->{self::$Table . '_etat'});
            $this->Parrain = stripslashes($Reservation->{self::$Table . '_parrain'});

        }
        catch (exception $e) {
            //echo $e->getMessage();
        }


    }


    /**
     * Reservation::GetIdCommande()
     * 
     * @param mixed $idclient
     * @return int
     */
    public static function GetIdCommande($idclient)
    {
        try {
            $db = DB::get();

            $Req = "SELECT reservation_id FROM t_reservation WHERE reservation_idcompte = '" .
                $idclient . "' AND reservation_supprime='0' AND reservation_etat='En attente' ORDER BY reservation_id DESC LIMIT 1";
            $send = $db->query($Req);
            list($id) = $db->fetch_row($send);
            return $id;


        }
        catch (exception $e) {
            //echo $e->getMessage();
        }
    }
    public function send_mail($email="")
    {

        if ($email == '') {
            $email = $this->Email;
        }


        $subject = 'Votre r&Eacute;servation CMD-' . $this->Numero . ' sur le site ' . $GLOBALS['_data_']['nom_site'];
        $mail = new PHPmailer();
        $mail->IsMail();
        $mail->IsHTML(true);
        $mail->From = $GLOBALS['_data_']['email_princ'];
        $mail->FromName = $GLOBALS['_data_']['nom_site'];
        $mail->AddAddress($this->Email);
        $mail->Subject = $subject;

        $mail->Body = imprime_mail_reservation($this->Id);
        if (!$mail->Send()) { //Teste le return code de la fonction

            echo $mail->ErrorInfo; //Affiche le message d'erreur (ATTENTION:voir section 7)
        }

        unset($mail);

    }
    public function ReservationConfirmed()
    {
        try {
            $db = DB::get();

            $Req = "UPDATE t_" . self::$Table . " SET " . self::$Table .
                "_etat='Valide' WHERE " . self::$Table . "_id = '" . $this->Id . "' LIMIT 1";
            $send = $db->query($Req);
           
            $this->send_mail();


        }
        catch (exception $e) {
            //echo $e->getMessage();
        }
    }
    
	public function ReservationStatut($statut)
    {
        try {
            $db = DB::get();

            $Req = "UPDATE t_" . self::$Table . " SET " . self::$Table .
                "_etat='".$statut."' WHERE " . self::$Table . "_id = '" . $this->Id . "' LIMIT 1";
            $send = $db->query($Req);
            $this->send_mail();

            $subject = 'Changement de l\'&Eacute;tat de votre r&Eacute;servation CMD-' . $this->Numero . ' sur le site ' .
            $GLOBALS['_data_']['nom_site'];
	       
	        $message = ' <font face="Arial, Helvetica, sans-serif" style="font-size:12px;" color="#666666">Ch&egrave;r(e) client(e),<br /><br /><br />
						Nous vous informons que votre r&eacute;servation portant le num&eacute;ro CMD-' . $this->Numero . ' vient de passer &Agrave; l&rsquo;&eacute;tat <strong>'.$statut.' </strong></font><br /><br /><br />
	            Nous vous remercions pour votre confiance<br /><br />
	            L&rsquo;&eacute;quipe de '.$GLOBALS['_data_']['nom_site'].'
				<br><br><br>';
	
	        $mail = new PHPmailer();
	        $mail->IsMail();
	        $mail->IsHTML(true);
	        $mail->From = $GLOBALS['_data_']['email_princ'];
	        $mail->FromName = $GLOBALS['_data_']['nom_site'];
	        $mail->AddAddress($this->Email);
	        $mail->Subject = $subject;
	      
	        $mail->Body = imprime_mail($message);
	        if (!$mail->Send()) { //Teste le return code de la fonction
	
	            echo $mail->ErrorInfo; //Affiche le message d'erreur (ATTENTION:voir section 7)
	        }
	
	        unset($mail);
            

        }
        catch (exception $e) {
            //echo $e->getMessage();
        }
    }
    public function __construct($id,$num = null)
    {


        $this->Id = $id;
        if($num != NULL){$this->Numero = $num;}
        $this->set($num);

    }


}

?>
<?php


class Session
{


    public $IdSession;
    public $NiveauSession;
    public $NiveauSession_Attache;
    public $Nom;
    public $Prenom;

    private function VerifIdSession()
    {
        $db = DB::get();
    	$Select = $db->query("SELECT users_id from t_users WHERE users_id='" . $this->
            IdSession . "' AND users_actif = '1'");
        $count = $db->num_rows($Select);
        if ($count == 0)
        {
            return false;
        } else
        {
            return true;
        }
    }
    public function HasAccess($NiveauPage)
    {
        if (($this->VerifIdSession() == false) || ($NiveauPage < $this->NiveauSession))
        {
        	if(empty($_SESSION['iduser_admin'])){
        		$page = $GLOBALS['_data_']['url_back'].'index.php';
        	} else {
        		$page = 'javascript:history.go(-1);';
        	}
            echo 'Vous n&rsquo;avez pas les droits n&eacute;cessaires &agrave; l&rsquo;affichage de cette page<br/>
					<a href="'.$page.'">Retour</a>';
            exit();
        }

    }
    private function SetSessions()
    {
        $_SESSION['nom_admin'] = $this->Nom;
        $_SESSION['prenom_admin'] = $this->Prenom;
        $_SESSION['niveau_admin'] = $this->NiveauSession;
        $_SESSION['niveau_attache_admin'] = $this->NiveauSession_Attache;
    }
    public function SetVars($var = "")
    {
        $db = DB::get();
    	$Select = $db->query("SELECT users_nom, users_prenom, users_niveau, users_niveau_attache from t_users WHERE users_id='" .
            $this->IdSession . "' AND users_actif = '1'");
        list($nom, $prenom, $niveau, $niveauatt) = $db->fetch_row($Select);
        $this->Nom = CleanChaine($nom);
        $this->Prenom = CleanChaine($prenom);
        $this->NiveauSession = $niveau;
        $this->NiveauSession_Attache = $niveauatt;
        if ($var == 1)
            $this->SetSessions();

    }


    public function Deconnect()
    {

        $arrSessions = $HTTP_SESSION_VARS;
        session_destroy();
        unset($arrSessions);
        echo "<script type='application/javascript'>window.location='index.php'</script>";


    }

    function __construct($Nom)
    {

        $Crypte = new LiverCrypt();
        $Session_decrypte = $Crypte->Decrypte($Nom);
        $this->IdSession = $Session_decrypte;
    }


}

?>

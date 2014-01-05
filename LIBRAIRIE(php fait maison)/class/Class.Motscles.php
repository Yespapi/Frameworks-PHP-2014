<?php

class Motscles
{

    /**
     * tableau contenant la liste des mots cl&Eacute;s
     * 
     * @access private
     * @return array
     */
    private $id;

    /**
     * Mot cl&Eacute;
     * @access public
     * @var varchar
     */
    private $nom;


    /**
     * Fr&Eacute;quenc d'utilisation
     * @access public
     * @var integer
     */
    private $frequence;


    /**
     * Constructeur
     * 
     * @access public
     * @return void
     */
    function __construct($filtre = null)
    {

        try {

            $sql_type = ($filtre == null) ? '' : ' AND motscles_id = \'' . $filtre . '\' ';

            $db = DB::get();
            $sql = 'SELECT * 
					FROM t_motscles 
					WHERE motscles_supprime =\'0\' ' . $sql_type;
            $result = $db->query($sql);
            while ($row = $db->fetch_assoc($result)) {
                $this->id = $row['motscles_id'];
                $this->nom = $row['motscles_nom'];
                $this->frequence = $row['motscles_frequence'];
            }
        }
        catch (exception $e) {
        }
    }

    /**
     * Retourne l identifiant
     * 
     * @access public
     * @return array
     */
    public function getId()
    {
        return $this->id;
    }


    /**
     * retourne le mot cl&Eacute;
     * Motscles::getNom()
     * 
     * @return
     */
    public function getNom()
    {
        return stripslashes($this->nom);
    }
    /**
     * nombre d utilisation du mot cl&Eacute;
     * Motscles::getFrequence()
     * 
     * @return
     */
    public function getFrequence()
    {
        return $this->frequence;
    }
    /**
     * Motscles::ExisteMotCle()
     * Verifier si le mot cl&Eacute; a d&Eacute;ja &Eacute;t&Eacute; tap&Eacute;
     * 
     * @param mixed $keyword
     * @return
     */
    public static function ExisteMotCle($keyword)
    {
        try {


            $db = DB::get();
            $sql = 'SELECT motscles_id  
					FROM t_motscles 
					WHERE motscles_supprime =\'0\' AND motscles_nom=\'' . $db->escape($keyword) .
                '\'';
            //InsertTest('Existemotscles : '.$sql);
            $result = $db->query($sql);
            list($id) = $db->fetch_row($result);
            return $id;

        }
        catch (exception $e) {
        }

    }
    /**
     * Motscles::VerifIpDoublonForKeyword()
     * 
     * @param mixed $id
     * @return boolean
     */
    public static function VerifIpDoublonForKeyword($id)
    {
        try {
        	$db = DB::get();
            $Key = new Motscles($id);
            $keyword = $Key->getNom();
            $ipclient = $_SERVER[REMOTE_ADDR];
            $Req = "SELECT motscles_id from t_motscles RIGHT JOIN t_motscles_dates ON(motscles_id=motscles_dates_idmotcle) WHERE motscles_supprime='0' AND motscles_dates_date='" .
                date("Y-m-d") . "' AND motscles_dates_ip='$ipclient' AND motscles_nom='$keyword'";
            $query = $db->query($Req);
            if ($db->num_rows($query) > 0) {
                return true;
            } else {
                return false;
            }
        }
        catch (exception $e) {
        }
    }
    /**
     * Motscles::AjouteFrequence()
     * Update du champ frequence
     * 
     * @param mixed $id
     * @return void
     */
    public static function AjouteFrequence($id)
    {
        try {


            $db = DB::get();

            if (!Motscles::VerifIpDoublonForKeyword($id)) {
                $sql = 'SELECT motscles_frequence  
					FROM t_motscles 
					WHERE motscles_supprime =\'0\' AND motscles_id=\'' . $id . '\'';
                //InsertTest('Ajoutefrequence : '.$sql);
                $result = $db->query($sql);
                list($frequence) = $db->fetch_row($result);
                $frequence += 1;
                $update_query = "UPDATE t_motscles SET motscles_frequence='$frequence' WHERE motscles_id='$id' LIMIT 1";
                //InsertTest('Ajoutefrequence 2  : '.$update_query);
                $send = $db->query($update_query);
                Motscles::InsertDateMotCle($id);
            }


        }
        catch (exception $e) {
        }

    }
    /**
     * Ajoute la date dutilisation du mot cl&Eacute;
     * Motscles::InsertDateMotCle()
     * 
     * @param mixed $id
     * @return void
     */
    public static function InsertDateMotCle($id)
    {
        try {


            $db = DB::get();
            $ipclient = $_SERVER[REMOTE_ADDR];
            $sql = "INSERT INTO t_motscles_dates SET motscles_dates_idmotcle='" . $id .
                "',motscles_dates_ip='$ipclient',motscles_dates_date='" . date("Y-m-d") . "'";
            //InsertTest('InsertDatemotcle : '.$sql);
            $result = $db->query($sql);

        }
        catch (exception $e) {
        }
    }
    /**
     * Motscles::InsertMotCle()
     * Insertion en base
     * 
     * @param mixed $keyword
     * @return void
     */
    public static function InsertionBaseMotCle($keyword)
    {
        try {


            $db = DB::get();
            $sql = "INSERT INTO t_motscles SET motscles_nom='" . $db->escape($keyword) .
                "',motscles_frequence='1'";
            //InsertTest('InsertMotCle : '.$sql);
            $result = $db->query($sql);
            $idinsere = $db->last_insert_id();
            Motscles::InsertDateMotCle($idinsere);


        }
        catch (exception $e) {
        }

    }
    /**
     * Motscles::AjouteMotCle()
     * G&Egrave;re les actions update ou insert
     * 
     * @param mixed $keyword
     * @return void
     */
    public static function AjouteMotCle($keyword)
    {
        $keyword = trim($keyword);
        $keyword = strtolower($keyword);

        if ($keyword != "") {
            $idexist = Motscles::ExisteMotCle($keyword);
            if ($idexist > 0) {
                Motscles::AjouteFrequence($idexist);
            } else {
                Motscles::InsertionBaseMotCle($keyword);
            }
        }

    }
}
?>
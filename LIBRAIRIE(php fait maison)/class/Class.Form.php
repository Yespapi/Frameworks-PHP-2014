<?php


class Form
{


    public static function Checkresult($var, $verifPhrase)
    {


        if ((htmlentities($var)) == (htmlentities($verifPhrase))) {

            return "checked='checked'";
        }
    }

    public static function Selectresult($var, $verifPhrase)
    {


        if ((htmlentities($var)) == (htmlentities($verifPhrase))) {

            return "selected='selected'";
        }
    }


    public static function Select_General($post, $table, $default = "Tous", $join =
        "", $where = "", $tri = "nom", $redirect = "", $suitelink = "", $utf8 = "", $defaultchamp =
        "nom")
    {

        try {

            $db = DB::get();
            $Req = "SELECT " . $table . "_id," . $table . "_" . $defaultchamp . " from t_" .
                $table . " " . $join . " " . $where . " order by " . $table . "_$tri ASC ";

            // echo $Req.'<br>';

            $Select = $db->query($Req) or die(mysql_error());
            if ($default != "") {
                $suite = '<option value="' . $redirect . $suitelink . '" selected>--' . $default .
                    '--</option>';
            } else {
                $suite = '';
            }
            while (list($id, $nom) = $db->fetch_array($Select)) {
                if ($id == $post) {
                    $selected = " selected ";
                } else {
                    $selected = "";
                }
                $nom = stripslashes($nom);
                if ($utf8 == "1") {
                    $nom = utf8_encode($nom);
                }
                $suite .= '<option value="' . $redirect . $id . $suitelink . '" ' . $selected .
                    '>' . $nom . '</option>
				';
            }
            $count = $db->num_rows($Select);
            if (($count == 0) && ($post != "")) {
                $suite .= '<option value="" selected>--------Aucun r&eacute;sultat---------</option>';
            }

            return $suite;
        }
        catch (exception $e) {
        }
    }


    public static function Select_Civ($civ = "")
    {

        try {
            $db = DB::get();
            $Req = " SELECT civilite_id,civilite_intitule FROM t_civilite ORDER BY civilite_id ASC";
            $Exec = $db->query($Req);
            list($id, $intitule) = $db->fetch_row($Exec);

            if ($intitule == $civ) {

                $selected = " selected ";

            } else {
                $selected = "";
            }
            $suite .= ' <option value = "' . $id . '"' . $selected . ' >
	            ' . $intitule . ' </option> ';
            return $suite;
        }
        catch (exception $e) {
            var_dump($e->getMessage());
        }

    }

    /**
     * 
     * @param $table
     * @param $field
     * @param $post
     * @param $init
     * @return varchar
     */
    function SelectEnum($table, $field, $post, $init = "")
    {

        try {
            $db = DB::get();
            $Request = "SHOW COLUMNS FROM " . $table . " WHERE Field = '" . $field . "'";
            $SendSql = $db->query($Request);
            $tab = $db->fetch_assoc($SendSql);
            $valeurs = $tab['Type'];
            $masque = "#(?:enum|set)\('([^\)].*)'\)$#i";
            $valeurs = preg_replace($masque, "$1", $valeurs);
            $tval = explode("','", $valeurs);
            if ($init == "") {
                $options .= '<option value="">--------Choisir---------</option>
				';
            }
            foreach ($tval as $cle => $result) {

                ($post == $result) ? $selected = "selected" : $selected = "";

                $options .= '<option value="' . $result . '" ' . $selected . '>' . $result .
                    '</option>
				';
            }
            return $options;
        }
        catch (exception $e) {
            var_dump($e->getMessage());
        }

    }


    public static function VerifierAdresseMail($adresse)
    {
        $Syntaxe = ' #^[\w.-]+@[\w.-]+\.[a-zA-Z]{2,5}$#';
        if (preg_match($Syntaxe, $adresse))
            return true;
        else
            return false;
    }


    public static function GenerateListeNumerique($vardepard, $vararrive, $post)
    {
        $i = $vardepard;
        $sup = "";

  
        while ($i <= $vararrive) {
            if (strlen($i) == 1) {
                $sup = "0";
            } else {
                $sup = "";
            }
            if ($i == $post) {
                $selected = 'selected="selected"';
            } else {
                $selected = "";
            }
            $options .= '<option value="' . $i . '" ' . $selected . '>' . $sup . $i .
                '</option>';
            $i++;

        }
        return $options;
    }


    public static function choixCivilite($champs, $post = "", $param = "")
    {

        $Req = "SELECT * FROM t_civilite ORDER BY civilite_id DESC ";
        $Exec = mysql_query($Req);
        $result = "";
        while ($CIV = mysql_fetch_object($Exec)) {
            $select = "";
            if ($post == $CIV->civilite_nom) {
                $select = 'checked="checked"';
            }

            $result .= '<li class="puce_civilite"><input name="' . $champs . '" id="' . $champs .
                '" type="radio" value="' . $CIV->civilite_nom . '" ' . $select . ' ' . $param .
                ' /></li>
                 	   <li class="intitule_civilite noir"><p>' . $CIV->civilite_nom .
                '</p></li>';
        }
        return $result;

    }

    public static function AfficheChampfromsuite($suite, $table)
    {

        $tab = explode("@", $suite);
        foreach ($tab as $cle => $valeur) {
            if ($valeur != "") {

                $sortie .= SelectNomFromTable($table, $valeur) . " - ";
            }
        }

        return $sortie;

    }
    public static function ListeMonth($post)
    {
        try {
            $db = DB::get();
            $select = $db->query("SELECT month_num,month_titre from t_month order by month_num ASC");
            while (list($num, $titre) = $db->fetch_array($select)) {
                if ($post == $num) {
                    $selected = "selected";
                } else {
                    $selected = "";
                }
                $options .= '<option value="' . $num . '" ' . $selected . '>' . $titre .
                    '</option><br/>';
            }
            return $options;
        }
        catch (exception $e) {
        }
    }


    public static function SelectPays($post)
    {
        try {
            $db = DB::get();
            $sql = 'SELECT pays_id,pays_nom  
					from t_pays  order by pays_nom ASC ';
            $result = $db->query($sql);
            //$suite = '<option value="">S&eacute;lectionnez un pays</option>';
            while (list($id, $nom) = $db->fetch_array($result)) {


                if ($id == $post) {
                    $selected = ' selected="selected" ';
                } else {
                    $selected = "";
                }
                $nom = stripslashes($nom);
                $suite .= '<option value="' . $id . '" ' . $selected . '>' . htmlentities(ucfirst
                    (mb_strtolower($nom))) . '</option>';
            }
            return $suite;

        }
        catch (exception $e) {
        }
    }


}


?>

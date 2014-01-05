<?php


class Financement
{

    // D&Eacute;claration des variables
    private $Id;
    private $Date;
    private $Civilite;
    private $Prenom;
    private $Nom;
    private $Societe;
    private $Email;
    private $Tel;
    private $Idproduit;


    //constantes
    public static $Table = 'financement';


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

    static function DeleteFinancement($array)
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

   /**
    * Mise en hors ligne d'une sous cat&Eacute;gorie
    * @access public
    * @return void
    */ 
   public function delete(){
   		try{
   			$db = DB::get();
   			$sql = "UPDATE t_" . self::$Table . "  
   					SET " . self::$Table . "_supprime='1'  
   					WHERE " . self::$Table . "_id = '".$this->Id."' ";
   		
   			$result = $db->query($sql);
   		}
   		catch(Exception $e){
   			var_dump($e->getMessage());
   		}
   }

    //Ajouter un Assurance
    static function add()
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

        
        $tab_update[] = 'civilite';
        $tab_update[] = 'prenom';
        $tab_update[] = 'nom';
        $tab_update[] = 'email';
        $tab_update[] = 'tel';
        $tab_update[] = 'idproduit';



        return $tab_update;
    }
    //Modifier un Assurance

    public function modifier()
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
            $Item = $db->fetch_object($result);

            $this->Date 		= $Item->{self::$Table . '_date'};
            $this->Civilite 	= $Item->{self::$Table . '_civilite'};
            $this->Prenom 		= stripslashes($Item->{self::$Table . '_prenom'});
            $this->Nom 			= stripslashes($Item->{self::$Table . '_nom'});
            $this->Societe 		= stripslashes($Item->{self::$Table . '_societe'});
            $this->Description	= stripslashes($Item->{self::$Table . '_description'});
            $this->Email 		= stripslashes($Item->{self::$Table . '_email'});
            $this->Tel 			= stripslashes($Item->{self::$Table . '_tel'});
            $this->Idproduit 	= $Item->{self::$Table . '_idproduit'};


        }
        catch (exception $e) {
            //echo $e->getMessage();
        }


    }
    
    public function __construct($id)
    {


        $this->Id = $id;
        $this->set();

    }


}

?>
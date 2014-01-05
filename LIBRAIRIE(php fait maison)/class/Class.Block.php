<?php


class Block
{

    // D&Eacute;claration des variables
    private $Id;
    private $Title;
    private $Desc;


    //constantes
    public static $Table = 'block';


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
	

    static function TabValeurs()
    {

        
        $tab_update[] = 'title';
        $tab_update[] = 'desc';


        return $tab_update;
    }
    //Modifier un Assurance

    public function modifier($Title,$Desc)
    {
        try {
            $db = DB::get();

            $Req = "UPDATE t_" . self::$Table . ' SET `title`="' . $Title . '", `desc`="'. $Desc . '"';                   
            
            $Req .= " WHERE id = " . $this->Id . " LIMIT 1";

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

            $Req = "SELECT * FROM t_" . self::$Table . " WHERE id = '" .
                $this->Id . "' ";

            $result = $db->query($Req);
            $Item = $db->fetch_object($result);

			$this->Id 		= $Item->{'id'};
            $this->Title 		= $Item->{'title'};
            $this->Desc 	= $Item->{'desc'};

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
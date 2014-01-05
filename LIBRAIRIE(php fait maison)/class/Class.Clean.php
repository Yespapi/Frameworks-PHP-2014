<?php

class Clean
{
    static function DefineTypeChaine($valeur, $params, $limit = 255)
    {


        switch ($params) {
            case 'int':
                $sortie = intval($valeur);
                break;
            case 'decimal':
                $valeur = str_replace(',', '.', $valeur);
                $sortie = $valeur;
                break;
            case 'string':
                if ((is_int($limit)) && (!empty($valeur))) {
                    $sortie = stripslashes(substr(trim($valeur), 0, $limit));
                    $sortie = str_replace('’', '\'', $sortie);
                } else {
                    if (!empty($valeur))
                        $sortie = stripallslashes(trim($valeur));
                }
                break;
            case 'array':
                $sortie = (is_array($valeur)) ? $valeur:
                array();
                break;
            case 'decode':
                if ((is_int($limit)) && (!empty($valeur))) {
                    $sortie = substr(trim(urldecode($valeur)), 0, $limit);
                } else {
                    if (!empty($valeur))
                        $sortie = stripallslashes(trim(urldecode($valeur)));
                }
                break;

        }
        return $sortie;
    }


}

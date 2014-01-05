    <?php
    /***********************************
    * ** Auteur : Olivier BELLANCE**
    * ** Version 1.0 **
    * ** 19/01/2007 **
    * ** **
    * utilisation : 
    * echo $SOURCE->start_html("Nom de page",$JS,$CSS,'',$META,'','','',"xmlns=http://www.w3.org/1999/xhtml");
	* echo $SOURCE->start_body($ENTETE,$CORPS,$PIED,$LOAD_BODY);	
    * ici $ENTETE represente un header
    * 	  $CORPS le corps de la page
    * 	  $PIED le footer
    *     $LOAD_BODY les attributs de la balise body 
    * ***********************************/
     class HTML {
     /*
    * ici s�parateur peut �tre
    * chang� suivant l'envie de l'utilisateur
    * relatif aux appels de fonctions des balises input
    * */
     var $_separateur;
     /*
     Ordre d'affichage
     des attributs _Tattribut pour les fonctions relatives aux balises input
    */
     var $_ordre;
     // Tableau d'attribut non exhaustif, pourra �tre enrichi en fonction des besoins
     var $_Tattributs;
    
     function HTML() {
     $this->_separateur = "::";
     $this->_Tattributs = array("name", "value", "class", "style", "lang", "title", "size", "maxlength", "wrap", "accept", "other", "src", "label", "defaut", "vertical", "cols", "rows", "multiple");
     }
    
     // Renvoie l'ent�te HTML
     /* Usage 
     
      start_html("le titre", "nom fichier source javascript", "nom fichier source css", "contenu dans la balise head, ajout personnel", "tableau associatif de balise meta (cl� => valeur)", "URL base", "cible", "auteur", "langue utilis�e", "contenu affich� dans les balises noscript");
     
     */
     function start_html($titre = "Untitled Document", $script = "", $style = "", $head = "", $meta = "", $base = "", $target = "", $author = "", $lang = "", $noscript = "", $ajaxscript = "") {
     $metas = "";
    
    // if (!Empty($lang)) $lang = " lang=\"$lang\"";
     if (!Empty($author)) $author = "<link rev=\"MADE\" href=\"mailto:$author\">\n";
     if (!Empty($base)) {
     if (!Empty($target)) $target = " target=\"$target\"";
    
     $base = "<base href=\"$base\"$target>\n";
     }
     if (!Empty($meta) && is_array($meta)) foreach ($meta as $key => $value) $metas .= "<meta name=\"$key\" content=\"$value\">\n";
     if (!Empty($script)) $script = $this->js($script, 1);
     if (!Empty($style)) $style = $this->css($style, 1);
     if (!Empty($noscript)) $noscript = "<noscript>$noscript</noscript>\n";
    
     return "<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">\n" .
     		"<html $lang>\n<head>\n<title>$titre</title>\n" .
     		"<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\" />\n".$author.$base.$metas.$style.$noscript.$ajaxscript.$script.$head.
     		"	<link rel=\"shortcut icon\" type=\"image/png\" href=\"".$GLOBALS['_data_']['url_principale']."css/images/favicon.ico\" />
			 "
			 ."
     		</head>\n ";
     }
    
     // G�re le javascript
     /* Usage 
     
      js("contenu ou fichier source", "0 ou 1 : contenu javascript ou source javascript");
     
     */
     function js($js, $fic = 0) {
     $script = "";
    
     if (!$fic) {
     $script .= "<script language=\"JavaScript\">".$js."</script>\n";
     } else {
     $param = explode(",", $js);
    
     foreach ($param as $val) {
     $script .= "<script language=\"JavaScript\" type=\"text/javascript\" src=\"$val\"></script>\n";
     }
     }
    
     return $script;
     }
    
     // G�re le css
     /* Usage 
     
      js("contenu ou fichier source", "0 ou 1 : contenu css ou source css");
     
     */
     function css($css, $fic = 0) {
     $script = "";
    
     if (!$fic) {
     $script .= "<style type=\"text/css\">".$css."</style>\n";
     } else {
     $param = explode(",", $css);
    
     foreach ($param as $val) {
     $script .= "<link rel=\"stylesheet\" href=\"$val\" type=\"text/css\" />\n";
     }
     }
    
     return $script;
     }
    
     // Renvoi la balise body
     /* Usage 
     
      start_body("contenu ins�r� entre la balise de d�but et de fin", "attribut dans la balise");
     
     */
     function start_body($entete_page ,$corps = "", $pied_page="", $balise = "") {
     	return "<body ".$balise." >\n".$entete_page.$corps.$pied_page;
     }
    
     // Renvoi la balise form
     /* Usage 
     
      start_form("contenu ins�r� entre la balise de d�but et de fin", "attribut dans la balise", "attribut nom de la balise", "attribut m�thode", "attribut action, renvoi vers le fichier g�rant la requ�te HTML", "attribut d�signant le type d'encodage", "attribut class", "attribut style", "attribut accept", "attribut accept_charset", "attribut titre", "attribut langue");
     
     */
     function start_form($corps = "", $balise = "", $name = "", $method = "post", $action = "", $enctype = "application/x-www-form-urlencoded", $class = "", $style = "", $target = "", $accept = "", $accept_charset = "", $title = "", $lang = "") {
     if (!Empty($balise)) $balise = " $balise";
     if (!Empty($method)) $method = " method=\"$method\"";
     else $method = " method=\"post\"";
     if (!Empty($name)) $name = " name=\"".$name."\"";
     if (isset($_SERVER["QUERY_STRING"])) $query = "?".$_SERVER["QUERY_STRING"]."";
     else $query = "";
     if (!Empty($class)) $class = " class=\"".$class."\"";
     if (!Empty($style)) $style = " style=\"".$style."\"";
     if (!Empty($target)) $target = " target=\"".$target."\"";
     if (!Empty($accept)) $accept = " accept=\"".$accept."\"";
     if (!Empty($accept_charset)) $accept_charset = "accept_charset=\"".$accept_charset."\"";
     if (!Empty($title)) $title = " title=\"".$title."\"";
     if (!Empty($lang)) $lang = " lang=\"".$lang."\"";
     if (Empty($action)) {
     if (isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] == "on") $protocol = "https";
     else $protocol = "http";
    
     $action = " action=\"".$protocol."://".$_SERVER["HTTP_HOST"].$_SERVER["SCRIPT_NAME"]."$query\"";
     } else $action = " action=\"".$action."\"";
     if (!Empty($enctype)) $enctype = " enctype=\"$enctype\"";
    
     $form = "$name$method$action$enctype$balise$class$style$target$accept$accept_charset$title$lang";
    
     return "<form$form>\n".$corps;
     }
    
     // Fin de la balise form
     function end_form() {
     return "</form>\n";
     }
    
     // Fin du document HTML
     function end_html($corps = "") {
     	return $corps."</body>\n</html>";
     }
    
     /* Usage 
     
      text("name::monnom", "value::mavaleur", "class::maclass", "lang::malang", "maxlength::masaisie", "size::mataille", "title::montitre", "style::monstyle", "other::mesautres");
      sur cette fa�on ci l'ordre n'a aucune importance
      ou
      text("monnom", "mavaleur", "mataille", "masaisie", "maclass", "monstyle", "malang", "montitre", "mesautres");
      sur cette fa�on l�, l'ordre est tr�s important � respecter
     
     */
     function text() {
     $param = func_get_args();
     array_unshift($param, "text");
     $this->_ordre = array(0, 1, 2, 3, 4, 5, 6, 7, 10);
     return $this->input($param);
     }
    
     /* Usage 
     
      pwd("name::monnom", "value::mavaleur", "class::maclass", "lang::malang", "maxlength::masaisie", "size::mataille", "title::montitre", "style::monstyle", "other::mesautres");
      sur cette fa�on ci l'ordre n'a aucune importance
      ou
      pwd("monnom", "mavaleur", "mataille", "masaisie", "maclass", "monstyle", "malang", "montitre", "mesautres");
      sur cette fa�on l�, l'ordre est tr�s important
     
     */
     function pwd() {
     $param = func_get_args();
     array_unshift($param, "password");
     $this->_ordre = array(0, 1, 2, 3, 4, 5, 6, 7, 10);
     return $this->input($param);
     }
    
     /* Usage 
     
      upload("name::monnom", "value::mavaleur", "class::maclass", "lang::malang", "accept::maaccept", "size::mataille", "title::montitre", "style::monstyle", "other::mesautres");
      ou
      upload("monnom", "mavaleur", "maaccept", "mataille", "maclass", "monstyle", "malang", "montitre", "mesautres");
      sur cette fa�on l�, l'ordre est tr�s important
     
     */
     function upload() {
     $param = func_get_args();
     array_unshift($param, "file");
     $this->_ordre = array(0, 1, 9, 6, 2, 3, 4, 5, 10);
     return $this->input($param);
     }
    
     /* Usage 
     
      res("value::mavaleur", "class::maclass", "style::monstyle", "lang::malang", "title::montitre", "other::mesautres");
      ou
      res("mavaleur", "maclass", "monstyle", "malang", "montitre", "mesautres");
      sur cette fa�on l�, l'ordre est tr�s important
     
     */
     function res() {
     $param = func_get_args();
     array_unshift($param, "reset");
     $this->_ordre = array(1, 2, 3, 4, 5, 10);
     return $this->input($param);
     }
    
     /* Usage 
     
      button("name::monnom", "value::mavaleur", "class::maclass", "style::monstyle", "lang::malang", "title::montitre", "other::mesautres");
      ou
      button("monnom", "mavaleur", "maclass", "monstyle", "malang", "montitre", "mesautres");
      sur cette fa�on l�, l'ordre est tr�s important
     
     */
     function button() {
     $param = func_get_args();
     array_unshift($param, "button");
     $this->_ordre = array(0, 1, 2, 3, 4, 5, 10);
     return $this->input($param);
     }
    
     /* Usage 
     
      submit("value::mavaleur", "class::maclass", "style::monstyle", "lang::malang", "title::montitre", "other::mesautres");
      ou
      submit("mavaleur", "maclass", "monstyle", "malang", "montitre", "mesautres");
      sur cette fa�on l�, l'ordre est tr�s important
     
     */
     function submit() {
     $param = func_get_args();
     array_unshift($param, "submit");
     $this->_ordre = array(1, 2, 3, 4, 5, 10);
     return $this->input($param);
     }
    
     /* Usage 
     
      hidden("name::monnom", "value::mavaleur", "class::maclass", "style::monstyle", "lang::malang", "title::montitre", "other::mesautres");
      ou
      hidden("monnom", "mavaleur", "maclass", "monstyle", "malang", "montitre", "mesautres");
      sur cette fa�on l�, l'ordre est tr�s important
     
     */
     function hidden() {
     $param = func_get_args();
     array_unshift($param, "hidden");
     $this->_ordre = array(0, 1, 2, 3, 4, 5, 10);
     return $this->input($param);
     }
    
     /* Usage 
     
      img_but("name::monnom", "src::masource", "value::mavaleur", "class::maclass", "style::monstyle", "lang::malang", "title::montitre", "other::mesautres");
      ou
      img_but("monnom", "masource", "mavaleur", "maclass", "monstyle", "malang", "montitre", "mesautres");
      sur cette fa�on l�, l'ordre est tr�s important
     
     */
     function img_but() {
     $param = func_get_args();
     array_unshift($param, "image");
     $this->_ordre = array(0, 11, 1, 2, 3, 4, 5, 10);
     return $this->input($param);
     }
    
     /* Usage 
     
      check("monnom", "mavaleur", "monlabel", "maclass", "monstyle", "malang", "montitre", "mesautres");
     
     */
     function check() {
     $param = func_get_args();
     $input = "<input type=\"checkbox\"";
     $this->_ordre = array(0, 1, 12, 2, 3, 4, 5, 10);
    
     $i = 0;
     $j = 0;
     $label = "";
     $valeur = "";
     $name = "";
     $taille = count($param);
    
     foreach ($param as $value) {
     $value = preg_replace("/\n/", "", $value);
    
     if (preg_match("/(\w+)".$this->_separateur."(.)/",$value,$res)) {
     switch ($res[1]) {
     case "other" :
     $input .= " ".$res[2];
     $j++;
     break;
     case "label" :
     $label = " ".$res[2];
     $j++;
     break;
     case "value" :
     $valeur = $res[2];
     $input .= " ".$res[1]."=\"".$res[2]."\"";
     $j++;
     break;
     case "name" :
     $name = $res[2];
     default :
     $input .= " ".$res[1]."=\"".$res[2]."\"";
     $j++;
     }
     } else {
     if ($value) {
     if ($this->_Tattributs[$this->_ordre[$i]] == "other") $input .= " ".$value;
     elseif ($this->_Tattributs[$this->_ordre[$i]] == "label") $label = $value;
     elseif ($this->_Tattributs[$this->_ordre[$i]] == "value") {
     $valeur = $value;
     $input .= " ".$this->_Tattributs[$this->_ordre[$i]]."=\"".$value."\"";
     } elseif ($this->_Tattributs[$this->_ordre[$i]] == "name") {
     $name = $value;
     $input .= " ".$this->_Tattributs[$this->_ordre[$i]]."=\"".$value."\"";
     } else $input .= " ".$this->_Tattributs[$this->_ordre[$i]]."=\"".$value."\"";
     }
     $i++;
     }
     }
     if ((isset($_REQUEST["$name"]) && ($_REQUEST["$name"] == $valeur || strtolower($_REQUEST["$name"]) == "on")) || strtolower($valeur) == "on") $input .= " checked";
     $input .= " />".$label."\n";
     $this->_ordre = array();
    
     return (($j == $taille && $i == 0) || ($i == $taille && $j == 0)) ? $input : 0;
     }
    
     /* Usage 
     
      radio("monnom", "mavaleur", "monlabel", "mondefaut", "maclass", "monstyle", "malang", "montitre", "oui", "mesautres");
     
     */
     function radio() {
     $param = func_get_args();
     $input = "<input type=\"radio\"";
     $this->_ordre = array(0, 1, 12, 13, 2, 3, 4, 5, 14, 10);
    
     $i = 0;
     $vertical = "";
     $valeur = "";
     $defaut = "";
     $label = "";
     $taille = count($param);
    
     foreach ($param as $value) {
     if ($value) {
     if ($this->_Tattributs[$this->_ordre[$i]] == "other") $input .= " ".$value;
     elseif ($this->_Tattributs[$this->_ordre[$i]] == "vertical") $vertical = "<br />";
     elseif ($this->_Tattributs[$this->_ordre[$i]] == "value") $valeur = $value;
     elseif ($this->_Tattributs[$this->_ordre[$i]] == "defaut") $defaut = $value;
     elseif ($this->_Tattributs[$this->_ordre[$i]] == "label") $label = $value;
     else $input .= " ".$this->_Tattributs[$this->_ordre[$i]]."=\"".$value."\"";
     }
    
     $i++;
     }
     if (is_array($valeur)) {
     $temoin = $input;
     $input = "";
    
     foreach ($valeur as $val) {
     $tempo = " value=\"".$val."\"";
    
     if (isset($defaut) && ($val == $defaut)) $tempo .= " checked";
    
     	$input .= $temoin.$tempo." />".($label && $label[$val] ? $label[$val] : $val)."\n$vertical";
     }
     } 
     else {
     	
     	$input .= " value=\"".$valeur."\"";
    
     	if (isset($defaut) && ($valeur == $defaut)) $input .= " checked";
    
     		$input .= " />".$label."\n$vertical";
     }
    
     $this->_ordre = array();
     return $i == $taille ? $input."\n" : 0;
     }
    
     function input() {
     $param = func_get_args();
     $input = "<input type=\"".$param[0][0]."\"";
     array_shift($param[0]);
    
     $i = 0;
     $j = 0;
     $taille = count($param[0]);
    
     foreach ($param[0] as $value) {
     $value = preg_replace("/\n/", "", $value);
    
     if (preg_match("/(\w+)".$this->_separateur."(.)/",$value,$res)) {
     switch ($res[1]) {
     case "other" :
     $input .= " ".$res[2];
     $j++;
     break;
     default :
     $input .= " ".$res[1]."=\"".preg_replace("/\"/", "'", stripslashes($res[2]))."\"";//on remplace tous les " en ', on supprime en plus tous les \ rajout�s par php, avant : $input .= " ".$res[1]."=\"".$res[2]."\"";
     $j++;
     }
     } else {
     if ($value != '') {
     if ($this->_Tattributs[$this->_ordre[$i]] == "other") $input .= " ".$value;
     else $input .= " ".$this->_Tattributs[$this->_ordre[$i]]."=\"".preg_replace("/\"/", "'", stripslashes($value))."\"";
     }
     $i++;
     }
     }
    
     $this->_ordre = array();
    
     return (($j == $taille && $i == 0) || ($i == $taille && $j == 0)) ? $input." />\n" : 0;
     }
    
     /* Usage 
     
      textarea("name::monnom", "value::mavaleur", "cols::mescols", "rows::mesrows", "class::maclass", "style::monstyle", "lang::malang", "title::montitre", "wrap::monwrap", "other::mesautres");
      ou
      textarea("monnom", "mavaleur", "mescols", "mesrows", "maclass", "monstyle", "malang", "montitre", "monwrap", "mesautres");
      sur cette fa�on l�, l'ordre est tr�s important
     
     */
     function textarea() {
     $param = func_get_args();
     $input = "<textarea";
     $this->_ordre = array(0, 1, 15, 16, 2, 3, 4, 5, 8, 10);
    
     $i = 0;
     $j = 0;
     $valeur = "";
     $taille = count($param);
    
     foreach ($param as $value) {
     $value = preg_replace("/\n/", "", $value);
    
     if (preg_match("/(\w+)".$this->_separateur."(.)/",$value,$res)) {
     switch ($res[1]) {
     case "other" :
     $input .= " ".$res[2];
     $j++;
     break;
     case "value" :
     $valeur = preg_replace("/\"/", "'", stripslashes($res[2]));
     $j++;
     break;
     default :
     $input .= " ".$res[1]."=\"".preg_replace("/\"/", "'", stripslashes($res[2]))."\"";
     $j++;
     }
     } else {
     if ($value) {
     if ($this->_Tattributs[$this->_ordre[$i]] == "other") $input .= " ".$value;
     elseif ($this->_Tattributs[$this->_ordre[$i]] == "value") $valeur = preg_replace("/\"/", "'", stripslashes($value));
     else $input .= " ".$this->_Tattributs[$this->_ordre[$i]]."=\"".preg_replace("/\"/", "'", stripslashes($value))."\"";
     }
    
     $i++;
     }
     }
    
     return (($j == $taille && $i == 0) || ($i == $taille && $j == 0)) ? $input.">".$valeur."</textarea>\n" : 0;
     }
    
     /* Usage 
     
      popup("monnom", "mavaleur", "monlabel", "mondefaut", "multiple", "maclass", "monstyle", "masize", "malang", "montitre", "mesautres");
     
     */
     function popup() {
     $param = func_get_args();
     $popupmenu = "<select";
     $this->_ordre = array(0, 1, 12, 13, 17, 2, 3, 6, 4, 5, 10);
    
     $i = 0;
     $mul = 0;
     $style = "";
     $valeur = "";
     $label = "";
     $defaut = "";
     $name = "";
     $class = "";
     $taille = count($param);
    
     foreach ($param as $value) {
     if ($value) {
     switch ($this->_Tattributs[$this->_ordre[$i]]) {
     case "multiple" :
     $mul = 1;
     case "other" :
     $popupmenu .= " ".$value;
     break;
     case "style" :
     if (is_array($value)) $style = $value;
     else $popupmenu .= " ".$this->_Tattributs[$this->_ordre[$i]]."=\"".$value."\"";
     break;
     case "value" :
     $valeur = $value;
     break;
     case "label" :
     $label = $value;
     break;
     case "defaut" :
     $defaut = $value;
     break;
     case "name" :
     $name = " name=\"".$value;
     break;
     case "class" :
     if (is_array($value)) $class = $value;
     else $popupmenu .= " ".$this->_Tattributs[$this->_ordre[$i]]."=\"".$value."\"";
     break;
     default :
     $popupmenu .= " ".$this->_Tattributs[$this->_ordre[$i]]."=\"".$value."\"";
     break;
     }
     }
    
     $i++;
     }
    
     if ($mul == 1 && !ereg("\[\]$",$name)) $name .= "[]";
    
     $popupmenu .= $name."\">\n";
    
     if (is_array($valeur)) {
     $j = 0;
     foreach ($valeur as $val) {
     $sel = "";
     $tempo = " value=\"".$val."\"";
     if (isset($style[$j])) $tempo .= " style=\"".$style[$j]."\"";
     if (isset($class[$j])) $tempo .= " class=\"".$class[$j]."\"";
     if (isset($defaut)) {
     if (is_array($defaut) && $mul == 1) {
     foreach ($defaut as $def) if ($def == $val) $sel = " selected";
     } elseif ($defaut == $val) $sel = " selected";
     }
    
     $popupmenu .= "<option ".$tempo.$sel.">".(isset($label) && isset($label[$val]) ? $label[$val] : $val)."</option>\n";
     $j++;
     }
     } else {
     if (isset($defaut) && $valeur == $defaut) $sel = " selected";
     if (isset($valeur)) $popupmenu .= "<option value=\"".$valeur."\"$sel>".($label?$label:$valeur)."</option>\n";
     }
    
     $popupmenu .= "</select>\n";
     $this->_ordre = array();
     return $i == $taille ? $popupmenu : 0;
     }
    
     function param($param = "") {
     if (!Empty($param)) {
     $panam = isset($_REQUEST["$param"]) ? $_REQUEST["$param"] : "";
     return $panam;
     } else {
     $param = array();
    
     foreach ($_REQUEST as $name => $value) {
     $param[$name] = $value;
     }
     }
    
     return $param;
     }
    
     function set_separateur() {
     $param = func_get_args();
    
     if ($param) $this->_separateur = $param[0];
     }
    
     function url() {
     if (isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] == "on") $protocol = "https";
     else $protocol = "http";
    
     return $protocol."://".$_SERVER["HTTP_HOST"].$_SERVER["SCRIPT_NAME"];
     }
     }
     ?>



<?
class Control extends IControl
	{
	//[BEGIN] VAR
	public $TypeControl;
	//[END] VAR
	//[BEGIN] ACCESSEUR GET
	public function getTypeControl(){return $this->TypeControl;}
	//[END] ACCESSEUR GET
	//[BEGIN] ACCESSEUR ADD
	public function addTypeControl($TypeControl){$this->TypeControl=$TypeControl;}
	//[END] ACCESSEUR ADD
//[BEGIN] SECTION USERFRIENDLY
 /* Methods : info
  * this method show value of the attribut of the object 
  **/ 
public function info()
	  {$Info.="Val. Attr. TypeControl : ".self::getTypeControl()."<br>"; 
 	   return $Info;
	 }
 /* Method : toString()
  * to get a valid string character to show later
  **/ 
public function toString()	{
	 }
 /* Method : affiche()
  * do an echo on toString()
  **/ 
public function affiche() { echo self::toString(); }
//[END] SECTION USERFRIENDLY
//[BEGIN] SECTION USER
//[END] SECTION USER
/* Constructeur de la Class : Control
 * 
 */
	public function __construct()
		{global $Log;
	 	 self::addLog($Log);
	 	 self::getLog()->AddMessage("Object init Control","Object","Reussit");
		 echo "Fun : ".func_get_arg(0)." :: ".func_get_arg(1)."<br>";
	 	 switch(func_num_args())
	 	 	{case 0 : break;
	 	 	 case 1 : self::addNameVar(func_get_arg(0));
	 	 	 		  break;
	 	 	 case 2 : self::addNameVar(func_get_arg(0));
	 	 	 		  self::addTypeVar(func_get_arg(1));
	 	 	 		  break;
	 	 	}
		}
	}
?>
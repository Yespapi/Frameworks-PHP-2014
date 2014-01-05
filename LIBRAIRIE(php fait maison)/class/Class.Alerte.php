<?php


class Alerte{
	
	var $message;
	
	
	function affiche($type = "alerte"){
		
		/*$affiche='<div class="blockAdvertMsg">
					<table border="0" cellpadding="0" cellspacing="0" style="border:none;background:#fdf9bb" >
						<tr>
							<td>
								<img src="'.$GLOBALS['_data_']['url_back'].'css/images/attention.png">
							</td>
						<td style="text-align:center;vertical-align:middle">
							<div style="color:#CC0000;font-weight:bold;font-size:12px;padding-top:5px;padding-left:5px">'.$this->message.'</div>
						</td>
					 </tr>
					</table>';*/
		
		switch($type){
			case 'confirm' 	: $class="blockConfirmMsg";break;
			case 'info'		: $class="blockInformMsg";break;
			case 'avert'	: $class="blockAdvertMsg";break;
			case 'alerte'	: $class="blockErrorMsg";break;
			default			: $class="blockErrorMsg";
		}
		
		$affiche = '<div class="'.$class.'">
					<p><strong>'.$this->message.'</strong></p>
					</div>';
					
		return $affiche;
		
	}
	
	function __construct($un_message){
		
		$this->message=$un_message;
		
	}
	
}
?>

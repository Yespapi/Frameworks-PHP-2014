<?php
App::uses('AppModel', 'Model');
/**
 * Category Model
 *
 */
class Category extends AppModel {    
	// Association to the Item Model
    public $hasMany = 'Item'; 
    
	//  Data Validate for the form field (2 fields are being validated)
    public $validate = array(
        'name' => 'notEmpty',
        'length_type' => 'notEmpty'
    );
}

?>
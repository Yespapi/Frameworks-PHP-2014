<?php

class Item extends AppModel {
	// Associate to the Category Mode
    public $belongsTo = 'Category';
    
	// Data Validate for the form field (4 fields are being validated)
    public $validate = array(
        'category_id' => 'numeric',
        'title' => 'notEmpty',
        'year' => array(
            'rule' => 'numeric',
            'message' => 'Please enter a 4 digit year.'
        ),
        'length' => 'numeric'
    );
}

?>
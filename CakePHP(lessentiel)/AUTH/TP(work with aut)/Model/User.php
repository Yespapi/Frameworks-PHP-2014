<?php
App::uses('AppModel', 'Model');
/**
 * User Model
 *
 */
class User extends AppModel 
{
    public function beforeSave() 
    {
        $this->data['User']['password'] = 
                AuthComponent::password($this->data['User']['password']);
        return true;
    }
    
/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
        'password' => 'notempty',
        'username' => 'notempty',
		'last_name' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'first_name' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
                /*
                 * 
                 * $this->data['User']['password'] = 
                AuthComponent::password($this->data['User']['password']);
        
        return true;
                 */
			),
		),
	);
}

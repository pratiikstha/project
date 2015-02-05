<?php
class PersonalAccount extends AppModel {
	var $name = 'PersonalAccount';
	var $primaryKey = 'personal_account_id';
	var $displayField = 'name';
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $hasMany = array(
		'DayBook' => array(
			'className' => 'DayBook',
			'foreignKey' => 'personal_account_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);
	
	var $belongsTo = array(
		'Person' => array(
			'className' => 'Citizen',
			'foreignKey' => 'ssn_no',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'ContactPerson' => array(
			'className' => 'Citizen',
			'foreignKey' => 'contact_person',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
	);

}

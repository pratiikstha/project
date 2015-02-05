<?php
class Balance extends AppModel {
	var $name = 'Balance';
	var $primaryKey = 'balance_id';
	var $displayField = 'year';
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $belongsTo = array(
		'Account' => array(
			'className' => 'Account',
			'foreignKey' => 'account_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
?>
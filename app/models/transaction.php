<?php
class Transaction extends AppModel {
	var $name = 'Transaction';
	var $primaryKey = 'transaction_id';
	var $displayField = 'voucher_id';
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $belongsTo = array(
		'Voucher' => array(
			'className' => 'Voucher',
			'foreignKey' => 'voucher_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
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
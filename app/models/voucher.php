<?php
class Voucher extends AppModel {
	var $name = 'Voucher';
	var $primaryKey = 'voucher_id';
	var $displayField = 'reverse_voucher_no';
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $belongsTo = array(

		'VoucherType' => array(
			'className' => 'VoucherType',
			'foreignKey' => 'voucher_type_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

	var $hasMany = array(
		'Transaction' => array(
			'className' => 'Transaction',
			'foreignKey' => 'voucher_id',
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

}
?>
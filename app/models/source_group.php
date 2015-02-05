<?php
class SourceGroup extends AppModel {
	var $name = 'SourceGroup';
	var $primaryKey = 'source_group_id';
	var $displayField = 'source_group_name';
	var $validate = array(
		'source_group_id' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'source_group_name' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				'message' => 'cannot be blank',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $hasMany = array(
		'IncomeSource' => array(
			'className' => 'IncomeSource',
			'foreignKey' => 'source_group_id',
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
<?php
class ValidRelation extends AppModel {
	var $name = 'ValidRelation';
	var $primaryKey = 'relation_id';
	var $displayField = 'relation_name';
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $hasMany = array(
		'relation_id' => array(
			'className' => 'CitizenRelation',
			'foreignKey' => 'relation_id',
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
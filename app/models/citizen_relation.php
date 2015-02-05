<?php
class CitizenRelation extends AppModel {
	var $name = 'CitizenRelation';
	var $primaryKey = 'citizen_relation_id';
	var $displayField = 'ssn_no';
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $belongsTo = array(
		'Relation' => array(
			'className' => 'ValidRelation',
			'foreignKey' => 'relation_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'SsnNo' => array(
			'className' => 'Citizen',
			'foreignKey' => 'ssn_no',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
?>
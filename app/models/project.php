<?php
class Project extends AppModel {
	var $name = 'Project';
	var $primaryKey = 'project_id';
	var $displayField = 'project_title';
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $hasMany = array(
		'ProjectDetail' => array(
			'className' => 'ProjectDetail',
			'foreignKey' => 'project_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'ProjectContractor' => array(
			'className' => 'ProjectContractor',
			'foreignKey' => 'project_id',
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

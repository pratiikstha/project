<?php
class ProjectContractor extends AppModel {
	var $name = 'ProjectContractor';
	var $primaryKey = 'project_contractor_id';
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $belongsTo = array(
		'Project' => array(
			'className' => 'Project',
			'foreignKey' => 'project_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'PersonalAccount' => array(
			'className' => 'PersonalAccount',
			'foreignKey' => 'personal_account_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}

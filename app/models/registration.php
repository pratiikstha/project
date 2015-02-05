<?php
class Registration extends AppModel {
	var $name = 'Registration';
	var $primaryKey = 'registration_id';
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $hasOne = array(
		'DayBook' => array(
			'className' => 'DayBook',
			'foreignKey' => 'day_book_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}

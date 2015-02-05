<?php
class Citizen extends AppModel {
	var $name = 'Citizen';
	var $primaryKey = 'ssn_no';
	var $displayField = 'citizenship_no';

	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $hasMany = array(
		'ssn_no' => array(
			'className' => 'CitizenRelation',
			'foreignKey' => 'ssn_no',
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
		'relative_ssn' => array(
			'className' => 'CitizenRelation',
			'foreignKey' => 'relative',
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

	var $validate = array(
		'cityzenship_no' => array(
			'rule' => 'notEmpty',
			'message' => 'नागरिकता न. खालि भयो।'
		),
		'region' => array(
			'rule' => 'notEmpty',
			'message' => 'विकास क्षेत्र छान्नु होला।'
		),
		'zone' => array(
			'rule' => 'notEmpty',
			'message' => 'अन्चलछान्नु होला।'
		),
		'district' => array(
			'rule' => 'notEmpty',
			'message' => 'जिल्ला छान्नु होला।'
		),
		'vms_option' => array(
			'rule' => 'notEmpty',
			'message' => 'गाविस/महानगरपालिका/उप-माहानगारपालिका छान्नु होला।'
		),
		'vms_name' => array(
			'rule' => 'notEmpty',
			'message' => 'गाविसको नाम छान्नु होला।'
		),
		'ward_no' => array(
			'rule' => 'notEmpty',
			'message' => 'क्षेत्र न. खालि भयो।'
		),
		'birthregion' => array(
			'rule' => 'notEmpty',
			'message' => 'विकास क्षेत्र छान्नु होला।'
		),
		'birthzone' => array(
			'rule' => 'notEmpty',
			'message' => 'अन्चलछान्नु होला।'
		),
		'birthdistrict' => array(
			'rule' => 'notEmpty',
			'message' => 'जिल्ला छान्नु होला।'
		),
		'birth_vms_option' => array(
			'rule' => 'notEmpty',
			'message' => 'गाविस/महानगरपालिका/उप-माहानगारपालिका छान्नु होला।'
		),
		'birth_vms_name' => array(
			'rule' => 'notEmpty',
			'message' => 'गाविसको नाम छान्नु होला।'
		),
		'birth_ward_no' => array(
			'rule' => 'notEmpty',
			'message' => 'क्षेत्र न. खालि भयो।'
		),
		'first_name' => array(
			'rule' => 'notEmpty',
			'message' => 'पहिलो नाम खालि भयो।'
		),
		'last_name' => array(
			'rule' => 'notEmpty',
			'message' => 'थर खालि भयो।'
		),
		'prepared_by' => array(
			'rule' => 'notEmpty',
			'message' => 'तयार पारेको व्यक्ति खालि भयो।'
		),
		'verfied_by' => array(
			'rule' => 'notEmpty',
			'message' => 'प्रमाणित गरेको व्यक्ति खालि भयो।'
		),
		'issued_by' => array(
			'rule' => 'notEmpty',
			'message' => 'निकालेको व्यक्ति खालि भयो।'
		)
	);
}
?>
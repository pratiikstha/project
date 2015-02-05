<?php
class Account extends AppModel {
	var $name = 'Account';
	var $primaryKey = 'account_id';
	var $displayField = 'account_name';
	var $useTable = 'v_accounts';
	//The Associations below have been created with all possible keys, those that are not needed can be removed

	var $hasMany = array(
		'Balance' => array(
			'className' => 'Balance',
			'foreignKey' => 'account_id',
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
		'ParentAccount' => array(
			'className' => 'Account',
			'foreignKey' => 'account_id',
			'dependent' => true,
			'conditions' => 'account_id=parent_id',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'Transaction' => array(
			'className' => 'Transaction',
			'foreignKey' => 'account_id',
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

		'user_acount_code' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'account_name' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'budget_item' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'level' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);
	
	

	
	function getTreeOfAccounts($accounts) {
		$accounts = $this->Account->find('all', array('fields' => array('account_id', 'parent_id', 'level', 'account_name'), 'order' => array('level asc', 'parent_id asc'), 'conditions' => array('level')));
		$accountsTree = array();
		foreach($accounts as $k => $v) {
			$curAccount = $v['Account'];
			if( $curAccount['level'] == 0) {
				
				$accountsTree[$curAccount['account_id']] = array(
										'account_name' => $curAccount['account_name'],
										'level' => $curAccount['level'],
										'parent_id' => $curAccount['parent_id'],
										'childs' => $this->getChildOf($curAccount['account_id'], array('account_id', 'account_name', 'level', 'parent_id'))
								);
			}
		}
	}
	
	function getParentOf($id, $fields = 'account_name') {
		$parent = $this->Account->find('list', array('conditions' => 'account_id=' . $id, 'parent_id'));
		$parentCode = $parent[$id];
		$parentDetail = $this->Account->find('list', array('conditions' => 'account_id=' . $parentCode, $fields));
		return $parentDetail;
	}
	
	function getChildOf($id, $fields = array('account_name')) {
		$childs = $this->Account->find('all', array('conditions' => 'parent_id=' . $id, 'fields' => $fields, 'order' => 'account_id'));
		return $childs;
	}
	
	
	

}
?>
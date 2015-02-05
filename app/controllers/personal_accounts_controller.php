<?php
class PersonalAccountsController extends AppController {

	var $name = 'PersonalAccounts';
	var $uses = array('PersonalAccount', 'Citizen', 'Authake.User');
	var $accountTypeArray = array(
								0 => EMPLOYEE,
								1 => OFFICIALS,
								2 => COMMITTEES,
								3 => CONTRACTORS,
								4 => OTHER_PERSON,
								5 => ORGANIZATIONS,
	);

	function beforeFilter() {
		$this->set('accountTypeArray', $this->accountTypeArray);
		parent::beforeFilter();
	}

	function index() {
		$this->PersonalAccount->recursive = 0;
		$this->set('personalAccounts', $this->paginate());
	}

	function getPersonalAccountList() {
		$accounts = array();
		$pAccounts = $this->PersonalAccount->find('all', array('fields' => array('personal_account_id', 'ssn_no', 'type', 'name') ));
		foreach($pAccounts as $k => $v) {
			$pAccount = $v['PersonalAccount'];
			if($pAccount['type'] == 0 || $pAccount['type'] == 1 || $pAccount['type'] == 4) {
				App::import('Controller', 'Citizens');
				$Citizens = new CitizensController;
				//Load model, components...
				$Citizens->constructClasses();
				$personName = $Citizens->getPersonInfoBySsnNo(array($pAccount['ssn_no']));
				
				//$personName = $this->requestAction('/citizens/getPersonInfoBySsnNo/' . $pAccount['ssn_no'], array("return"));
				$accounts[$pAccount['personal_account_id']] = $personName . " (" . $this->accountTypeArray[$pAccount['type']] . ")" ;
			} else {
				$accounts[$pAccount['personal_account_id']] = $pAccount['name'] . " (" . $this->accountTypeArray[$pAccount['type']] . ")";
			}
		}
		return $accounts;
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid personal account', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('personalAccount', $this->PersonalAccount->read(null, $id));
	}

	function add() {
		//$this->layout = '';
		if (!empty($this->data)) {
			$type = $this->data['PersonalAccount']['type'];
			if($type == 0 || $type == 1 || $type == 3) {
				$this->data['PersonalAccount']['ssn_no'] = $this->data['PersonalAccount']['person_name_id'];
			} else {
				$regDate = $this->data['PersonalAccount']['registered_date']['Y'] . "-" . $this->data['PersonalAccount']['registered_date']['m'] . "-" . $this->data['PersonalAccount']['registered_date']['d'];
				$regDate = $this->NepaliCalendar->convertToEnglishDate($regDate, 'Y-m-d');
				//echo $createDate;
				$this->data['PersonalAccount']['registered_date'] = $regDate . ' 00:00:00';
				$this->data['PersonalAccount']['contact_person'] = $this->data['PersonalAccount']['contact_person_id'];
			}
			$this->data['PersonalAccount']['reg_timestamp'] = date('Y-m-d H:i:s');
			$this->data['PersonalAccount']['mod_timestamp'] = date('Y-m-d H:i:s');
			$this->data['PersonalAccount']['reg_ssn_no'] = 1;
			$this->data['PersonalAccount']['mod_ssn_no'] = 1;
			$this->data['PersonalAccount']['delete_flag'] = 0;
			$this->PersonalAccount->create();
			if ($this->PersonalAccount->save($this->data)) {
				
				$this->Session->setFlash(__('The personal account has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The personal account could not be saved. Please, try again.', true));
			}
		}
		$this->setNepaliDateParam();
	}
	
	function getCitizenSsnNo() {
		//input to citizen table
		$ctznNo = $this->NepaliNumber->toggleNumberLang($this->data['PersonalAccount']['citizenship_no'], 'English');
		
		$countCtzn = $this->Citizen->find("list", array('conditions' => array('citizenship_no' => $ctznNo), 'fields' => array('ssn_no', 'citizenship_no')));
		$ssnNo = '';
		if(count($countCtzn) > 0) {
			foreach($countCtzn as $k => $v) {
				$ssnNo = $k;
			}
			$this->data['PersonalAccount']['person_name_id'] = $ssnNo;
		} else {
			//print "citizen entry need to be done";
			$this->data['Citizen']['birth_date'] = "1900-01-01";
			$this->data['Citizen']['birth_place'] = 1;
			$this->data['Citizen']['permanent_address'] = 1;
			$this->data['Citizen']['citizenship_no'] = $ctznNo;
			$this->data['Citizen']['first_name'] = '';
			$this->data['Citizen']['last_name'] = '';
			
			foreach(explode(" ", $this->data['PersonalAccount']['person_name']) as $k => $v) {
				if($k == 0) {
					$this->data['Citizen']['first_name'] = $v;
				} else {
					$this->data['Citizen']['last_name'] .=  ' ' . $v;
				}
			}
			
			$this->Citizen->create($this->data);
			$this->Citizen->save($this->data);
			
			$ssnNo = $this->Citizen->getLastInsertId();
			//print $ssnNo;
			$this->data['PersonalAccount']['person_name_id'] = $ssnNo;
		}
		return $ssnNo;
	}
	
	private function validates() {
		if(isset($this->data['PersonalAccount']['type']) && $this->data['PersonalAccount']['type'] != '') {
			$type = $this->data['PersonalAccount']['type'];
			if($type == 0 || $type == 1 || $type == 3) {
				if(!isset($this->data['PersonalAccount']['person_name_id']) || $this->data['PersonalAccount']['person_name_id'] == ''){
					if(!isset($this->data['PersonalAccount']['person_name']) || $this->data['PersonalAccount']['person_name'] == '') {
						$this->Session->setFlash(__('Person Name is not selected or inputted'));
						return false;
					}
					if(!isset($this->data['PersonalAccount']['citizenship_no']) || $this->data['PersonalAccount']['citizenship_no'] == '') {
						$this->Session->setFlash(__('Please Select Person or Enter Citizenship no information'));
						return false;
					}
					
					$ssnNo = $this->getCitizenSsnNo();
					//print $ssnNo;
					$count = $this->PersonalAccount->find('count', array('conditions' => array('PersonalAccount.ssn_no' => $ssnNo)));
					if($count == 1) {
						$this->Session->setFlash(__("Employee already exists"));
						return false;
					}
					//$this->Session->setFlash(__('Person Name is not selected'));
					//return false;
				} else {

				}
				if(!isset($this->data['PersonalAccount']['designation']) || $this->data['PersonalAccount']['designation'] == ''){
					$this->Session->setFlash(__('Please input designation'));
					return false;
				}
			} else {
				if(!isset($this->data['PersonalAccount']['contact_person_id']) || $this->data['PersonalAccount']['contact_person_id'] == ''){
					$this->Session->setFlash(__('Contact Person is not selected'));
					return false;
				}
				if(!isset($this->data['PersonalAccount']['name']) || $this->data['PersonalAccount']['name'] == ''){
					$this->Session->setFlash(__('Organization/Contractor Name is not inputted'));
					return false;
				}
				if(
				(!isset($this->data['PersonalAccount']['pan_no']) || $this->data['PersonalAccount']['pan_no'] == '') &&
				(!isset($this->data['PersonalAccount']['vat_no']) || $this->data['PersonalAccount']['vat_no'] == '')
				){
					$this->Session->setFlash(__('Both VAT and PAN No. cannot be blank'));
					return false;
				}
				if(!isset($this->data['PersonalAccount']['bank_account_name_1']) || $this->data['PersonalAccount']['bank_account_name_1'] == ''){
					$this->Session->setFlash(__('Bank and its Branch Name 1 is required'));
					return false;
				}
				if(!isset($this->data['PersonalAccount']['bank_account_id_1']) || $this->data['PersonalAccount']['bank_account_id_1'] == ''){
					$this->Session->setFlash(__('Bank Account -1 is required'));
					return false;
				}
			}
		} else {
			$this->Session->setFlash(__('Type is not Selected'));
			return false;
		}
		return true;
	}

	function addUsername($id) {
		if(!$id) {
			$this->redirect("/personal_accounts/index");
		}

		$pAccount = $this->PersonalAccount->find('list', array('conditions' => array('personal_account_id' => $id), 'fields' => array('personal_account_id', 'ssn_no')));
		if(count($pAccount) <= 0) {
			$this->redirect("/personal_accounts/index");
		}
		
		if(!$this->AppFunction->checkAdminOrSelf($pAccount[$id])) {
			$this->callError();
		}
		
		$this->User->find();
		
		//pr($this->User->find());
		if (!empty($this->data) && $this->validatesUsername()) {
			$this->data['User']['login'] = $this->data['PersonalAccount']['username'];
			$this->data['User']['password'] = md5($this->data['PersonalAccount']['password']);
			$this->data['User']['email'] = $this->data['PersonalAccount']['username'];
			$this->data['User']['disable'] = 0;
			$this->data['User']['created'] = date('Y-m-d H:i:s');
			$this->data['User']['updated'] = date('Y-m-d H:i:s');
			$this->data['User']['ssn_no'] = $this->data['PersonalAccount']['ssn_no'];
			
			$this->User->create($this->data);
			$this->User->save($this->data);
			
			$lastID = $this->User->getLastInsertId();
			
			$query = "insert into authake_groups_users values( $lastID , 1)";
			$this->User->query($query);
			$this->redirect('/');
			//$this->PersonalAccount->query("insert into authake_users(login, password, email, disable, created, updated, ssn_no) values('$username', '$password', '$email', $disable, '$created', '$updated', $ssnNo')");
		}
		$this->set('id', $id);
		$this->set('ssn_no', $pAccount[$id]);
	}

	function validatesUsername() {
		if(!isset($this->data['PersonalAccount']['username']) || $this->data['PersonalAccount']['username'] == '') {
			$this->Session->setFlash(__('Username is not selected or inputted'));
			return false;
		}
		if(!isset($this->data['PersonalAccount']['password']) || $this->data['PersonalAccount']['password'] == '') {
			$this->Session->setFlash(__('Password is not selected or inputted'));
			return false;
		}
		
		$condition = array();
		$condition['login'] = $this->data['PersonalAccount']['username'];
		$count = $this->User->find('count', array('conditions'=> $condition));
		
		if ($count == 1 ){
			$this->Session->setFlash(__('Username already exists', true));
			return false;
		}
		return true;
	}
	
	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid personal account', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->PersonalAccount->save($this->data)) {
				$this->Session->setFlash(__('The personal account has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The personal account could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->PersonalAccount->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for personal account', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->PersonalAccount->delete($id)) {
			$this->Session->setFlash(__('Personal account deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Personal account was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}

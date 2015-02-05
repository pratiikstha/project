<?php
class AccountsController extends AppController {

	var $name = 'Accounts';
	var $uses = array('Account', 'Voucher', 'Transaction', 'Balance');
	var $accountTree = array();
	var $accountLevel = array();
	
	function beforeFilter() {
		parent::beforeFilter();
		$this->setupAccounts();
	}
	
	function setupAccounts() {
		$this->accountTree = $this->getAccountsTree();
		$this->Session->write('Accounts', $this->accountTree);
		if($accounts = $this->Session->read('Accounts')) {
			$this->accountTree = $accounts;
		} else {
			$this->accountTree = $this->getAccountsTree();
			$this->Session->write('Accounts', $this->accountTree);
		}
		
		if($accounts = $this->Session->read('AccountLevel')) {
			$this->accountLevel = $this->Account->find('list', array('fields' => 'account_id,parent_id', 'order' => 'account_id asc')); //$accounts;
		} else {
			$this->accountLevel = $this->Account->find('list', array('fields' => 'account_id,parent_id', 'order' => 'account_id asc'));
			$this->Session->write('AccountLevel', $this->accountLevel);
		}
	}

	function index() {
		//print_r($this->accountTree);
		$this->getAdvanceGivenAndClearedForId(20, 2068, 04);
	}

	function getAccountsTree($id = 0, $level = 0) {
		if ($id == 0) {
			$parent = NULL;
		} else {
			$parent = $id;
		}
		$tempAcc = array();
		$tree = array();
		$tempAcc = $this->Account->find('list', array('conditions' => array('parent_id' => $parent, 'is_active' => 'Y'), 'order' => 'account_id'));
		foreach($tempAcc as $k => $v) {
			if($k >= 0) {
				$tree[$k] = array(
						'account_name' => $v,
						'childs' => $this->getAccountsTree($k, $level++)
				);
			}
		}
		return $tree;
	}

	function printTree($pageType =  '') {
		$this->set('accountTree', $this->accountTree);
		if($pageType != '') {
			$this->set('pageType', $pageType);
		}
		if($pageType != '') {
			$this->layout = "";
			$this->render('account_tree_plain');
		} else {
			$this->render('account_tree');
		}
	}

	function allocateAnnualBudget() {
		//$budgets = $this->Account->find('all', array('conditions' => array('Account.parent_id ' => BUDGET_RELEASES)));

		//$this->set('budgets', $budgets);
		
		$this->Account->recursive = 0;
		$conditions = "Account.level=1 and Account.parent_id=" . INCOME;
		$parentIncome = $this->Account->find('list', array('conditions' => $conditions, 'account_name', 'order' => 'account_id ASC'));
		$childIncomeArray = array();
		foreach($parentIncome as $k => $v) {
			$childIncomeArray[$k] = $this->getChildOf($k, 'account_name, budget_code, level, parent_id, account_id, current_balance, opening_balance');
		}
		$this->set('headingsIncome', $parentIncome);
		$this->set('subheadingsIncome', $childIncomeArray);
		
		
		
		$this->Account->recursive = 0;
		$conditions = "Account.level=1 and Account.parent_id=" . EXPENDITURES;
		$parent = $this->Account->find('list', array('conditions' => $conditions, 'account_name', 'order' => 'account_id ASC'));
		$childArray = array();
		foreach($parent as $k => $v) {
			$childArray[$k] = $this->getChildOf($k, 'account_name, budget_code, level, parent_id, account_id, current_balance, opening_balance');
		}
		$this->set('total_income', '');
		$this->set('headings', $parent);
		$this->set('subheadings', $childArray);
		$this->render('allocate_annual_budget');
	}

	function allocateBudget($id = null) {
		if (!empty($this->data)) {
			//print_r($this->data['Account']);
			if(isset($this->data['Account']['total_income']) && $this->data['Account']['total_income'] != ''){
				$totalIncome = $this->data['Account']['total_income'];
				unset($this->data['Account']['total_income']);
				$dataArray = $this->getDataForUpdate($totalIncome);
			} else {
				$dataArray = $this->getDataForUpdate();
			}
			if(!$dataArray) {
				$this->validateErrors($this->Account);
				$this->Session->setFlash(__('Total allocated Budget for expenses is more than available budget.', true));
				$this->redirect(array('action' => 'allocateAnnualBudget'));
			}
			$totalAmount = 0;
			foreach($dataArray as $k => $v ){
				$this->data['Account']['account_id'] = $k;
				foreach($v as $field => $value) {
					$this->data['Account'][$field] = $value;
					$totalAmount += $value;
				}
				$this->data['Account']['edited_by'] = $this->Authake->getSsnNo();
				$this->data['Account']['edited_date'] = date('Y-m-d H:i:s');
				
				$this->Account->set($this->data);
				if($this->Account->validates()){
					$this->Account->create();
					if ($this->Account->save($this->data)) {
						
					} else {
						$this->Session->setFlash(__('The account could not be saved. Please, try again.', true));
					}
				} else {
					$this->validateErrors($this->Account);
				}
			}
			$this->Session->setFlash(__('The account has been saved', true));
			$this->redirect('allocateAnnualBudget');
		} else {
			$this->redirect('index');
		}
	}

	/**
	 * 
	 * This function is used for bulk update
	 * @param 
	 * 
	 */
	function getDataForUpdate($totalRelease = 0) {
		//$expenseArray = array();
		//$budgetArray = array();
		$dataArray = array();
		$totalExpenses = 0;
		//$totalRelease = 0;
		$fieldName = '';
		foreach($this->data['Account'] as $k => $v) {
			if($separater = strripos($k, '_')) {
				$id = substr($k, $separater+1);
				$v = $this->NepaliNumber->toggleNumberLang($v, 'english');
				$fieldName = substr($k, 0, $separater);
				if(strpos($fieldName, 'budget_') !== false) {
					$fieldName = substr($fieldName, 7);
					$dataArray[$id][$fieldName] = $v;
					$totalRelease += floatval($v);
				} else {
					$dataArray[$id][$fieldName] = $v;
					$totalExpenses += floatval($v);
				}
			}
		}
		/*
		if ($totalRelease < $totalExpenses) {
			//return false;
		}
		$liabilityValue = 0;
		//if($fieldName == 'opening_balance') {
			$parentLiability = $this->Account->find('list', array('conditions' => array('account_id' => array(LIABILITIES, BUDGET_RELEASES)), 'fields' => array($fieldName)));
			if($parentLiability[LIABILITIES] == '') {
				$liabilityValue = $totalRelease;
			} else {
				$liabilityValue = $liabilityValue + $totalRelease;
				if ($parentLiability[BUDGET_RELEASES] != '') {
					$liabilityValue -= $parentLiability[BUDGET_RELEASES];
				}
			}
		//}

		$dataArray[LIABILITIES][$fieldName] = $liabilityValue;
		$dataArray[BUDGET_RELEASES][$fieldName] = $totalRelease;
		*/
		$dataArray[EXPENDITURES][$fieldName] = $totalExpenses;
		
		return $dataArray;
	}

	function getReleaseTillNow() {
		$this->Account->fields = 'current_budget_release';
		$releaseData = $this->Account->find('first', array('conditions' => 'account_id=' . BUDGET_RELEASES , 'fields' => array('current_budget_release') ));
		$releaseTillNow = $releaseData['Account']['current_budget_release'];
		return $releaseTillNow;
	}

	function getAvailableBalance() {
		$availableBalance = 0;
		$cfArray = $this->getCarriedForwardOfLastFiscalYear();
		foreach($cfArray as $id => $balance) {
			$availableBalance += $balance;
		}
		return $availableBalance;
	}

	/**
	 * Function getCarriedForwardOfLastFiscalYear 
	 * Retrieves the balance amount transfered from Previous fiscal year.
	 * @author Rekha Adhikari
	 * @access Private
	 * @param array @accounts [optional]
	 * @param returnType (if return type is set then the balance is returned separately otherwise returned as sum
	 * If array of account not passed then it will retrieve for all bank balance, Advance account and cash account. 
	 * @return array @balances
	 */
	function getCarriedForwardOfLastFiscalYear($accountIds = '', $returnType = '') {
		if( (is_array($accountIds) && count($accountIds) == 0) || $accountIds == '' ) {
			$accounts = $this->Account->find('list', array('conditions' => array('parent_id' => BANK_ID, 'is_active' => 'Y')));
			$accounts[CASH_ID] = CASH;
			$accountIds = array_keys($accounts);
		} else {
			if(!is_array($accountIds)) {
				$accountIds = explode(',', $accountIds);
			}
		}
		
		if($returnType == '') {
			$transactions = $this->Transaction->find('first', array('fields' => array('SUM(amount) as amount'), 'conditions' => array('Voucher.voucher_type_id' => CF_VOUCHER_TYPE_ID, 'Transaction.account_id' => $accountIds)));
			$balances = $transactions[0]['amount'];
			if(!$balances) {
				$balances = 0;
			}
		} else {
			$balances = array();
			$transactions = $this->Transaction->find('all', array('fields' => array('Transaction.account_id', 'Transaction.amount'), 'conditions' => array('Voucher.voucher_type_id' => CF_VOUCHER_TYPE_ID, 'Transaction.account_id' => $accountIds)));
			foreach($transactions as $k => $v) {
				$trans = $v['Transaction'];
				$balances[$trans['account_id']] = $trans['amount'];
			}
		}
		
		/*
		 * retrieved from balance table
		 * 
			$fiscalYear = $this->NepaliCalendar->getPreviousFiscalYear();
			$endDate = $fiscalYear['fiscal_year_end_date'];
		
			$balances = $this->Balance->find('list', array('conditions' => array('date' => $endDate, 'account_id' => array_keys($accounts), 'year_or_month' => 'Y'), 'fields' => array('account_id', 'closing_balance')));
		*/
		return $balances;
	}

	function getParentOf($id, $level = 0, $fields = 'account_name') {
		$parentArray = $this->findParents($this->accountLevel, $id);
		$this->autoRender = false;
		return $parentArray;
	}
	
	function getParents($id) {
		$parentArray = $this->findParents($this->accountLevel, $id);
		$this->autoRender = false;
		return $parentArray;
	}

	private function findParents($a, $n){
	    $out = array();
	        if (isset($a[$n]) && $a[$n] != ''){
	            $out = $this->findParents($a, $a[$n]);
	            $out[]=$a[$n];
	        }
	    return $out;
	}

	function getChildOf($id, $fields = 'account_name') {
		$childs = $this->Account->find('all', array('conditions' => 'parent_id=' . $id, 'fields' => $fields, 'order' => 'account_id'));
		return $childs;
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid account', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('account', $this->Account->read(null, $id));
	}
	
	private function validates() {
		if(!isset($this->data['Account']['budget_code']) || $this->data['Account']['budget_code'] == '') {
			//$this->Session->setFlash(__('Please Fill Budget Code', true));
			//return false;
		}
		if(!isset($this->data['Account']['account_name']) || $this->data['Account']['account_name'] == '') {
			$this->Session->setFlash(__('Please Fill Account Name', true));
			return false;
		}
		return true;
	}

	function addAdvanceAccount($pageType = '') {
		App::import('Controller', 'PersonalAccounts');
		$personalAccounts = new PersonalAccountsController;
		//Load model, components...
		$personalAccounts->constructClasses();
		$personalAccountsList = $personalAccounts->getPersonalAccountList();
		$advanceAccounts = array();
		foreach($this->accountTree[ASSETS]['childs'][ADVANCE_AC_ID]['childs'] as $k => $v) {
			$advanceAccounts[] = $k;
		}
		$result = $this->Account->find('list', array('conditions' => array('account_id' => $advanceAccounts), 'fields' => array('account_id', 'personal_account_id')));
		foreach($result as $k => $v) {
			unset($personalAccountsList[$v]);
		}
		$this->set('personalAccounts', $personalAccountsList);
		if (!empty($this->data)) {
			//print_r($this->data);
			//exit;
			if($this->data['Account']['personal_account_id'] != '') {
				$this->data['Account']['parent_id'] = ADVANCE_AC_ID;
				$this->data['Account']['level'] = 2;
				$this->data['Account']['created_date'] = date('Y-m-d H:i:s');
				$this->data['Account']['created_by'] = $this->Authake->getSsnNo();
				$this->data['Account']['edited_date'] = date('Y-m-d H:i:s');
				$this->data['Account']['edited_by'] = $this->Authake->getSsnNo();
				$this->data['Account']['account_name'] = $personalAccountsList[$this->data['Account']['personal_account_id']];
				
				$page = $this->data['Account']['page'];
				//$this->Account->set($this->data);
				$this->Account->create();
				if ($this->Account->save($this->data)) {
					$this->Session->setFlash(__('The account has been saved', true));
					$this->Session->delete('Accounts');
					$this->Session->delete('AccountLevel');
					$this->redirect("/accounts/printTree/$page");
				} else {
					$this->Session->setFlash(__('The account could not be saved. Please, try again.', true));
				}
			}
		}
		$this->set('pageType', $pageType);
	}

	function addProject() {
		
	}
	/**********************
	 * 
	 * Parameter accountType is used to differentiate the templates
	 * 
	 * 
	 **********************/
	function add($parentId = '', $pageType = '') {
		if($parentId == ADVANCE_AC_ID) {
			$this->redirect('/accounts/addAdvanceAccount');
		}
		$parents = $this->getParentOf($parentId);
		if(isset($parents[0]) && $parents[0] == EXPENDITURES) {
			$this->redirect('/accounts/addProject');
		}
		$this->layout = "";
		if (!empty($this->data) && $this->validates()) {
			
			$parentId = $this->data['Account']['parent_id'];
			$this->data['Account']['created_by'] = $this->Authake->getSsnNo();
			$this->data['Account']['created_date'] = date('Y-m-d H:i:s');
			$this->data['Account']['edited_by'] = $this->Authake->getSsnNo();
			$this->data['Account']['edited_date'] = date('Y-m-d H:i:s');
			$this->data['Account']['budget_code'] = $this->NepaliNumber->toggleNumberLang($this->data['Account']['budget_code'], 'english');
			
			$page = $this->data['Account']['page'];
			//$this->Account->set($this->data);
			$this->Account->create();
			if ($this->Account->save($this->data)) {
				$this->Session->setFlash(__('The account has been saved', true));
				$this->Session->delete('Accounts');
				$this->Session->delete('AccountLevel');
				$this->redirect("/accounts/printTree/$page");
			} else {
				$this->Session->setFlash(__('The account could not be saved. Please, try again.', true));
			}
		} elseif ($parentId == '') {
			$this->redirect('/accounts/printTree');
		}
		$this->set('pageType', $pageType);
		$accounts = $this->Account->find('first', array('conditions' => array('account_id' => $parentId)));
		
		$this->set('accounts', $accounts['Account']);
		$this->render('add');
	}

	function edit($id = null) {
		if (!empty($this->data)) {
			$totalIncome = $this->data['Account']['total_income'];
			unset($this->data['Account']['total_income']);
			$dataArray = $this->getDataForUpdate('expense', $totalIncome);
			if(!$dataArray) {
				$this->validateErrors($this->Account);
				$this->Session->setFlash(__('Total allocated Budget for expenses is more than available budget.', true));
				$this->redirect(array('action' => 'getAccounts'));
			}
			$totalAmount = 0;
			foreach($dataArray as $k => $v ){
				$this->data['Account']['account_id'] = $k;
				foreach($v as $field => $value) {
					$this->data['Account'][$field] = $value;
					$totalAmount += $value;
				}
				$this->data['Account']['edited_by'] = $this->Authake->getSsnNo();
				$this->data['Account']['edited_date'] = date('Y-m-d H:i:s');
				
				$this->Account->set($this->data);
				if($this->Account->validates()){
					$this->Account->create();
					if ($this->Account->save($this->data)) {
						
					} else {
						$this->Session->setFlash(__('The account could not be saved. Please, try again.', true));
					}
				} else {
					$this->validateErrors($this->Account);
				}
			}
			$this->Session->setFlash(__('The account has been saved', true));
			$this->redirect('getAccounts');
		} else {
			$this->redirect('index');
		}
	}

	function showBankAccounts() {
		$accounts = $this->Account->find('all', array('conditions' => array('parent_id' => BANK_ID)));
		$this->set('parent_name', BANK . ACCOUNT . MANY);
		$this->set('accounts', $accounts);

		$this->render('account_list');
	}

	function addBankAccount() {
		if (!empty($this->data)) {
			$parentAcc = $this->Account->find('first', array('conditions' => array('parent_id' => 1, 'account_name like' => 'Bank%')));
			$this->data['Account']['parent_id'] = BANK_ID;
			
			$this->data['Account']['created_by'] = $this->Authake->getSsnNo();
			$this->data['Account']['edited_by'] = $this->Authake->getSsnNo();
			$this->data['Account']['created_date'] = date('Y-m-d');
			$this->data['Account']['edited_date'] = date('Y-m-d');
			
			//$this->Account->set($this->data);
			$this->Account->create();
			if ($this->Account->save($this->data)) {
				$this->Session->setFlash(__('The account has been saved', true));
				$this->redirect(array('action' => 'showBankAccounts'));
			} else {
				$this->Session->setFlash(__('The account could not be saved. Please, try again.', true));
			}
		}
		
		$accounts = $this->Account->ParentAccount->find('list', array('conditions' => 'level=' . 1));
		$this->set(compact('accounts'));
		//$this->render('add');
		
	}

	function delete($id = '', $pageType = '') {
		$this->layout = "";
		if (!empty($this->data)) {
			$id = $this->data['Account']['account_id'];
			$page = $this->data['Account']['page'];
			
			
			$this->data['Account']['is_active'] = 'N';
			$this->Account->create();
			if ($this->Account->save($this->data)) {
				//$this->Session->setFlash(__('The account has been saved', true));
				$this->Session->delete('Accounts');
				$this->redirect("/accounts/printTree/$page");
			} else {
				$this->Session->setFlash(__('The account could not be deleted. Please, try again.', true));
			}
		} elseif ($id == '') {
			$this->redirect('/accounts/printTree');
		}
		$this->set('pageType', $pageType);
		$accounts = $this->Account->find('first', array('conditions' => array('account_id' => $id)));
		$this->set('accounts', $accounts['Account']);
	}

	function getBankCashBook($year = '', $month = '', $type = '') {
		if($year == '') {
			$year = $this->NepaliCalendar->nepaliDate('Y');
		}
		if ($month == '') {
			$month = sprintf("%02d", $this->NepaliCalendar->nepaliDate('m'));
		}
		
		$this->set('year', $year);
		$this->set('month', $month);
		$this->set('monthNepali', $this->NepaliCalendar->getNepaliMonthName($month));
		$this->set('yearNepali', $this->NepaliNumber->toggleNumberLang($year));
		
		$bcbArray = array();
		
		$bankBalance =  0;
		$cashDebitTotal = 0;
		$cashDebitTotal = 0;
		$cashCreditTotal = 0;
		$bankDebitTotal = 0;
		$bankCreditTotal = 0;
		$budgetExpenditureTotal = 0;
		$advanceGivenTotal = 0;
		$advanceClearedTotal = 0;
		$miscDebitTotal = 0;
		$miscCreditTotal = 0;
		
		$cfArray = array();
		$cfArray['particulars'] = CARRIED_FORWARD;
		
		$prevYearMonth = $this->NepaliCalendar->getPreviousYearMonth($year, $month);
		$endDate = $this->NepaliCalendar->getLastDayOfNepaliMonthInEnglish($prevYearMonth[0], $prevYearMonth[1]);
			
		$bankAccounts = $this->Account->find('list', array('conditions' => array('parent_id' => BANK_ID, 'is_active' => 'Y')));
		
		$advanceAccounts = $this->Account->find('list', array('conditions' => array('parent_id' => ADVANCE_AC_ID, 'is_active' => 'Y')));
		$cashAccount[CASH_ID] = CASH;
		
			//print_r($result);
			
			$result = $this->Balance->find('first', array('conditions' => array('date' => $endDate, 'Balance.account_id' => array_keys($bankAccounts)), 'fields' => array('SUM(closing_balance)')));
			if( count($result) > 0) {
				$cfArray['balance'] = $result[0]['sum'];
				$bankBalance += $result[0]['sum'];
				$bankDebitTotal += $result[0]['sum'];
				$miscCreditTotal += $result[0]['sum'];
				$cfArray['misc_cr'] = $result[0]['sum'];
			}
			$result = $this->Balance->find('first', array('conditions' => array('date' => $endDate, 'Balance.account_id' => array_keys($cashAccount)), 'fields' => array('SUM(closing_balance)')));
			if( count($result) > 0) {
				$cfArray['cash_dr'] = $result[0]['sum'];
				$cashDebitTotal += $result[0]['sum'];
				$miscCreditTotal += $result[0]['sum'];
				$cfArray['misc_cr'] = $cfArray['misc_cr'] + $result[0]['sum'];
			}
			$result = $this->Balance->find('first', array('conditions' => array('date' => $endDate, 'Balance.account_id' => array_keys($advanceAccounts)), 'fields' => array('SUM(closing_balance)')));
			if( count($result) > 0) {
				$cfArray['advance_given'] = $result[0]['sum'];
				$advanceGivenTotal += $result[0]['sum'];
				//$cfArray['misc_dr'] = $result[0]['sum'];
				//$advanceGivenTotal += $result[0]['sum'];
				//$miscDebitTotal += $result[0]['sum'];
			}
			$cfArray['date'] = $this->NepaliCalendar->formatNepaliDate('2068-' . $month[1] .  '-01-', 'm/d');
		//print_r($cfArray);
		$bcbArray[] = $cfArray;
		$startDate = $this->NepaliCalendar->getFirstDayOfNepaliMonthInEnglish($year, $month);
		$endDate = $this->NepaliCalendar->getLastDayOfNepaliMonthInEnglish($year, $month);

		$conditionArray['Voucher.created_date >='] = $startDate;
		$conditionArray['Voucher.created_date <='] = $endDate;
		$conditionArray['Voucher.voucher_type_id !='] = CF_VOUCHER_TYPE_ID;
		
		$vouchers = $this->Voucher->find('all', array('conditions' => $conditionArray, 'order' => 'Voucher.created_date asc, Voucher.voucher_id ASC'));

		if (count($vouchers) == 0) {
			if($type == 'book') {
				$this->layout = '';
				$this->render('print_bank_cash_book');
			} else if($type == 'trial') {
				$this->layout = '';
				$this->render('print_trial_balance');
			} else {
				$this->render('bank_cash_book');
			}
		}
		
		foreach($vouchers as $v) {
			$voucher = $v['Voucher'];
			$narration = explode('~', $voucher['narration']);
			if(count($narration) == 2) {
				$voucher['narration'] = $narration[0] . " (" . $narration[1] . ")";
				$voucher['cheque_no'] = array_pop(explode(":",$narration[1]));
			} else {
				$voucher['cheque_no'] = '';
			}

			$tmpArr = array();

			//$createdDate = $this->NepaliNumber->toggleNumberLang($voucher['created_date']);
			$createdDate = $this->NepaliCalendar->nepaliDate('m/d', substr($voucher['created_date'], 0,10), 'nepali');
			$tmpArr['date'] = $createdDate;
			if (isset($voucher['voucher_number']) && $voucher['voucher_number'] != '') {
				$tmpArr['code'] = $voucher['voucher_number'];
			} else  {
				$tmpArr['code'] = $this->NepaliNumber->toggleNumberLang($voucher['voucher_id']); //$this->NepaliCalendar->convertEngNumberToNepaliNumber($voucher['voucher_id']);
			}
			
			$tmpArr['particulars'] = $voucher['narration'];

			foreach($v['Transaction'] as $trans) {
				$amount = $trans['amount'];
				$parents = $this->getParentOf($trans['account_id']);
				if($trans['account_id'] == CASH_ID) { //cash
					if($trans['drcr'] == 'Dr') {
						$tmpArr['cash_dr'] = $amount;
						$cashDebitTotal += floatval($trans['amount']);
					} else {
						$tmpArr['cash_cr'] = $amount;
						$cashCreditTotal += floatval($trans['amount']);
					}
				} else if( $trans['account_id'] == BANK_ID || array_pop($parents) == BANK_ID) { //if bank or immediate parent is bank
					if($trans['drcr'] == 'Dr') {
						$tmpArr['bank_dr'] = $amount;
						$bankDebitTotal += floatval($trans['amount']);
						$bankBalance = $bankBalance + floatval($trans['amount']);
					} else {
						$tmpArr['bank_cr'] = $amount;
						$bankCreditTotal += floatval($trans['amount']);
						$bankBalance -= $trans['amount'];
					}
					$tmpArr['cheque_no'] = $voucher['cheque_no'];
					$tmpArr['balance'] = $bankBalance;
				} else {
					if($voucher['voucher_type_id'] == 1 && (isset($parents[0]) && $parents[0] == EXPENDITURES)) { //general voucher for budget expenses
						$accountInfo = $this->Account->read('budget_code', $trans['account_id']);
						$tmpArr['budget_code'] = $accountInfo['Account']['budget_code'];
						$tmpArr['budget_amount'] = $amount;
						$budgetExpenditureTotal += $trans['amount'];
					} else if ($voucher['voucher_type_id'] == 2) {
						if(isset($parents[0]) && $parents[0] == EXPENDITURES) {
							//print EXPENDITURES . $amount;
							//print "<BR>";
							$tmpArr['budget_amount'] = $amount;
							$budgetExpenditureTotal += $trans['amount'];
						}
						else if($trans['drcr'] == 'Dr') {
							$accountInfo = $this->Account->read('budget_code', $voucher['advance_expense_account']);
							$tmpArr['budget_code'] = $accountInfo['Account']['budget_code'];
							if(isset($tmpArr['budget_amount'])) {
								$tmpArr['budget_amount'] += $amount;
							} else {
								$tmpArr['budget_amount'] = $amount;
							}
							if(isset($tmpArr['advance_given'])) {
								$tmpArr['advance_given'] += $amount;
							} else {
								$tmpArr['advance_given'] = $amount;
							}
							$budgetExpenditureTotal += $trans['amount'];
							$advanceGivenTotal += $trans['amount'];
						} else {
							$tmpArr['budget_code'] = $this->getBudgetCodeFromVoucherId($trans['voucher_id']);
							$tmpArr['advance_cleared'] = $amount;
							$advanceClearedTotal += $trans['amount'];
							$tmpArr['budget_amount'] = $tmpArr['budget_amount'];
							$tmpArr['budget_advance'] = $amount;
							//print $tmpArr['budget_amount'];
							$budgetExpenditureTotal -= $trans['amount'];
						}
					} else {
						$tmpArr['misc_account_id'] = $trans['account_id'];
						if($trans['drcr'] == 'Dr') { 
							if(isset($tmpArr['misc_dr'])) {
								$tmpArr['misc_dr'] += $amount;
							} else {
								$tmpArr['misc_dr'] = $amount;
							}
							$miscDebitTotal += $trans['amount'];
							
						} else {
							if(isset($tmpArr['misc_cr'])) {
								$tmpArr['misc_cr'] += $amount;
							} else {
								$tmpArr['misc_cr'] = $amount;
							}
							$miscCreditTotal += $trans['amount'];
						}
					}
				}
			} 
			$bcbArray[] = $tmpArr;
		}

		//print
		$this->set('data', $bcbArray);
		
		$trialBalanceDebitTotal = $cashDebitTotal + $bankDebitTotal + $budgetExpenditureTotal + $miscDebitTotal + $advanceGivenTotal;
		$trialBalanceCredit = $cashCreditTotal + $bankCreditTotal + $miscCreditTotal + $advanceClearedTotal;
		$unclearedAdvance = $advanceGivenTotal - $advanceClearedTotal;
		$trialBalanceCreditTotal = $trialBalanceCredit + $unclearedAdvance;
		
		$this->set('bank_balance', $bankBalance);
		$this->set('cash_debit', $cashDebitTotal);
		$this->set('cash_credit', $cashCreditTotal);
		$this->set('bank_debit', $bankDebitTotal);
		$this->set('bank_credit', $bankCreditTotal);
		$this->set('budget_expenditure', $budgetExpenditureTotal);
		$this->set('advance_given', $advanceGivenTotal);
		$this->set('advance_cleared', $advanceClearedTotal);
		$this->set('misc_debit', $miscDebitTotal);
		$this->set('misc_credit', $miscCreditTotal);
		
		$this->set('trial_debit_total', $trialBalanceDebitTotal);
		$this->set('trial_credit', $trialBalanceCredit);
		$this->set('uncleared_advance', $unclearedAdvance);
		$this->set('trial_credit_total', $trialBalanceCreditTotal);
		
		

		if($type == 'book') {
			$this->layout = '';
			$this->render('print_bank_cash_book');
		} else if($type == 'trial') {
			$this->layout = '';
			$this->render('print_trial_balance');
		} else {
			$this->render('bank_cash_book');
		}
	}

	function getBudgetCodeFromVoucherId($voucherId) {
		$retBudgetCode = '';
		
		$voucherInfo = $this->Voucher->find('first', array('conditions' => array('voucher_id'=> $voucherId)));
		$refVoucherId = null;
		if (isset($voucherInfo['Voucher']['advance_expense_account']) && $voucherInfo['Voucher']['advance_expense_account'] !== null) {
			$refVoucherId = $voucherInfo['Voucher']['advance_expense_account'];
		} elseif (isset($voucherInfo['Voucher']['clearance_voucher_id']) && $voucherInfo['Voucher']['clearance_voucher_id'] !== null) {
			if (strrpos($voucherInfo['Voucher']['clearance_voucher_id'], "/") !== false) {
				$temp = explode("/", $voucherInfo['Voucher']['clearance_voucher_id']);
				$refVoucherId = $temp[0];
			} else {
				$refVoucherId = $voucherInfo['Voucher']['clearance_voucher_id'];
			}
		}
		if ($refVoucherId !== null) {
			$voucherInfo1 = $this->Voucher->find('first', array('conditions' => array('voucher_id'=> $refVoucherId)));
				
			$accountInfo = $this->Account->read('budget_code', $voucherInfo1['Voucher']['advance_expense_account']);
			$retBudgetCode = $accountInfo['Account']['budget_code'];
		}
		return $retBudgetCode;
	}
	
	function getAdvanceAccountList($year = '', $month = '') {
		$advanceAccounts = $this->Account->find('all', array('fields' => array('account_id', 'account_name', 'current_balance'), 'conditions' => array('parent_id' => ADVANCE_AC_ID)));
		
		if($year == '') {
			$year = $this->NepaliCalendar->nepaliDate('Y');
		}
		if ($month == '') {
			$month = $this->NepaliCalendar->nepaliDate('m');
		}
		//print_r($advanceAccounts);
		$this->set('accounts', $advanceAccounts);
		$this->set('year', $year);
		$this->set('month', $month);
		$this->render('advance_list');
	}
	
	function viewAdvanceDetail($id, $type= '', $year = '', $month = '') {
		$this->layout = '';
		if (!$id) {
			$this->Session->setFlash(__('Invalid account', true));
			$this->redirect(array('action' => 'getAdvanceAccountList'));
		}
		if($year == '') {
			$year = $this->NepaliCalendar->nepaliDate('Y');
		}
		if ($month == '') {
			//$month = $this->NepaliCalendar->nepaliDate('m');
		}
	
		$accInfo = $this->Account->find('list', array('conditions' => array('account_id' => $id)));
		$accountName = $accInfo[$id];
		$advances = array();
	
		$balance =  0;
	
		$cfArray = array();
		$cfArray['particulars'] = CARRIED_FORWARD;
		/*
		 if($month) {
			$prevYearMonth = $this->NepaliCalendar->getPreviousYearMonth($year, $month);
			$endDate = $this->NepaliCalendar->getLastDayOfNepaliMonthInEnglish($prevYearMonth[0], $prevYearMonth[1]);
	
			$result = $this->Balance->find('list', array('conditions' => array('date' => $endDate, 'account_id' => $id), 'fields' => array('account_id', 'closing_balance')));
	
			if(isset($result[$id])) {
				$cfArray['amount_dr'] = $result[$id];
				$balance = $result[$id];
			}
			$cfArray['date'] = $this->NepaliCalendar->nepaliDate('m') . '/1';
		}
	
		$advances[] = $cfArray;
		*/
	
		//$startDate = $this->NepaliCalendar->getFirstDayOfNepaliMonthInEnglish($year, $month);
		//$endDate = $this->NepaliCalendar->getLastDayOfNepaliMonthInEnglish($year, $month);
	
		//$conditionArray['Voucher.created_date >='] = $startDate;
		//$conditionArray['Voucher.created_date <='] = $endDate;
		$conditionArray['Transaction.account_id'] = $id;
		//$vouchers = $this->Voucher->find('all', array('conditions' => $conditionArray, 'order' => 'Voucher.created_date asc'));
	
	
	
		$transactions = $this->Transaction->find('all', array('conditions' => $conditionArray));
	
		if(count($transactions) > 0) {
	
			foreach($transactions as $v) {
				$tmpArr = array();
				$createdDate = $this->NepaliCalendar->nepaliDate('m/d', substr($v['Voucher']['created_date'], 0,10));
				$tmpArr['date'] = $createdDate;
				$tmpArr['particulars'] = $v['Voucher']['narration'];
				
				if (isset($v['Voucher']['voucher_number']) && $v['Voucher']['voucher_number'] !=''){
					$tmpArr['voucher_id'] = $v['Voucher']['voucher_number'];
				} else {
					$tmpArr['voucher_id'] = $this->NepaliNumber->toggleNumberLang($v['Voucher']['voucher_id']);
				}
				
				if($v['Transaction']['drcr'] == 'Dr') {
					$tmpArr['amount_dr'] = $v['Transaction']['amount'];
					$balance += $v['Transaction']['amount'];
				} else {
					$tmpArr['amount_cr'] = $v['Transaction']['amount'];
					$balance -= $v['Transaction']['amount'];
				}
				$tmpArr['balance'] = $balance;
				$advances[] = $tmpArr;
			}
		}
		$this->set('advances', $advances);
		$this->set('balance', $balance);
		$this->set('account_name', $accountName);
		$this->set('id', $id);
		$this->render('advance_detail');
	}
	
	/**function viewAdvanceDetail($id, $year = '', $month = '') {
		if (!$id) {
			$this->Session->setFlash(__('Invalid account', true));
			$this->redirect(array('action' => 'getAdvanceAccountList'));
		}
		if($year == '') {
			$year = $this->NepaliCalendar->nepaliDate('Y');
		}
		if ($month == '') {
			$month = $this->NepaliCalendar->nepaliDate('m');
		}
		
		$accInfo = $this->Account->find('list', array('conditions' => array('account_id' => $id)));
		$accountName = $accInfo[$id];
		$advances = array();
		
		$balance =  0;

		$cfArray = array();
		$cfArray['particulars'] = CARRIED_FORWARD;
		if($month) {
			$prevYearMonth = $this->NepaliCalendar->getPreviousYearMonth($year, $month);
			$endDate = $this->NepaliCalendar->getLastDayOfNepaliMonthInEnglish($prevYearMonth[0], $prevYearMonth[1]);
	
			$result = $this->Balance->find('list', array('conditions' => array('date' => $endDate, 'account_id' => $id), 'fields' => array('account_id', 'closing_balance')));

			if(isset($result[$id])) {
				$cfArray['amount_dr'] = $result[$id];
				$balance = $result[$id];
			}
			$cfArray['date'] = $this->NepaliCalendar->nepaliDate('m') . '/1';
		}
		
		$advances[] = $cfArray;
		
		$startDate = $this->NepaliCalendar->getFirstDayOfNepaliMonthInEnglish($year, $month);
		$endDate = $this->NepaliCalendar->getLastDayOfNepaliMonthInEnglish($year, $month);

		$conditionArray['Voucher.created_date >='] = $startDate;
		$conditionArray['Voucher.created_date <='] = $endDate;
		$conditionArray['Transaction.account_id'] = $id;
		//$vouchers = $this->Voucher->find('all', array('conditions' => $conditionArray, 'order' => 'Voucher.created_date asc'));
		
		
		
		$transactions = $this->Transaction->find('all', array('conditions' => $conditionArray));
		
		if(count($transactions) > 0) {			
	
			foreach($transactions as $v) {
				$tmpArr = array();
				$createdDate = $this->NepaliCalendar->nepaliDate('m/d', substr($v['Voucher']['created_date'], 0,10), 'nepali');
				$tmpArr['date'] = $createdDate;
				$tmpArr['particulars'] = $v['Voucher']['narration'];
				$tmpArr['voucher_id'] = $v['Voucher']['voucher_id'];
				if($v['Transaction']['drcr'] == 'Dr') {
					$tmpArr['amount_dr'] = $v['Transaction']['amount'];
					$balance += $v['Transaction']['amount'];
				} else {
					$tmpArr['amount_cr'] = $v['Transaction']['amount'];
					$balance -= $v['Transaction']['amount'];
				}
				$tmpArr['balance'] = $balance;
				$advances[] = $tmpArr;
			}
		}
		$this->set('advances', $advances);
		$this->set('balance', $balance);
		$this->set('account_name', $accountName);
		$this->render('advance_detail');
	}**/

	function updateMonthlyBalance($accountId, $year = '', $month = '') {
		if($year == '') {
			$year = $this->NepaliCalendar->nepaliDate('Y');
		}
		if ($month == '') {
			$month = $this->NepaliCalendar->nepaliDate('m');
		}
		
		$this->getBalanceTillMonth(BANK_ID, $year, $month);
		$this->getBalanceTillMonth(CASH_ID, $year, $month);
		$this->getBalanceTillMonth(ADVANCE_AC_ID, $year, $month);
		$this->getBalanceTillMonth(LIABILITIES, $year, $month);
		
	}

	function transferMonthlyBalance($year = '', $month = '') {
		if($year == '') {
			$year = $this->NepaliCalendar->nepaliDate('Y');
		}
		if ($month == '') {
			$month = $this->NepaliCalendar->nepaliDate('m');
		}
		
		//$this->getBalanceTillMonth(array(LIABILITIES, BANK_ID, CASH_ID, ADVANCE_AC_ID));
		$accounts = $this->Account->find('list', array('conditions' => array('is_active' => 'Y', 'current_balance NOT' => NULL)));
		$accountIds = array();
		$accountIds = array_keys($accounts);
		
		$this->transferBalanceTillMonth($accountIds, $year, $month);
		/*
		$accountIds = array();
		//getting child accounts
		$accounts = $this->Account->find('list', array('conditions' => array('parent_id' => array(BANK_ID, ADVANCE_AC_ID), 'is_active' => 'Y')));
		$accountIds = array_keys($accounts);
		$accountIds[] = CASH_ID;
		$this->transferBalanceTillMonth($accountIds, $year, $month);
		*/
	}

	function transferBalanceTillMonth($accountIds, $year = '', $month = '') {
		if($year == '') {
			$year = $this->NepaliCalendar->nepaliDate('Y');
		}
		if ($month == '') {
			$month = $this->NepaliCalendar->nepaliDate('m');
		}
		/*$accounts = $this->Account->find('list', array('conditions' => array('parent_id ' => $balanceHead), 'fields' => 'account_id'));
		$accountIds = array();
		
		foreach($balanceHead as $k){
			$accountIds[] = $k;
		}
		foreach($accounts as $k => $v) {
			$accountIds[] = $v;
			$budgetArr[$k] = 0;
		}*/
		
		//print_r($accountIds);
		$conditionArray = array("Account.account_id " =>  $accountIds);
		$result = $this->Account->find('all', array('conditions' => $conditionArray, 'fields' => array('opening_balance', 'current_balance', 'account_id', 'current_budget_release')));
		
		foreach($result as $k => $v) {
			$account = $v['Account'];
			$budgetArr[$account['account_id']] = $account;
		}
		
		$endDate = $this->NepaliCalendar->getLastDayOfNepaliMonthInEnglish($year, $month);
		$this->data['Balance']['date'] = $endDate;
		$this->data['Balance']['year_or_month'] = 'M';
		foreach($budgetArr as $k => $v) {
			$this->data['Balance']['account_id'] = $k;
			
			//if previous data exists then dont insert
			$count = $this->Balance->find('count', array('conditions' => array('Balance.account_id' => $k, 'date' => $endDate, 'year_or_month' => 'M')));
			if($count > 0) {
				continue;
			}
			$this->data['Balance']['closing_balance'] = $v['current_balance'];
			if(isset($v['current_budget_release']) && $v['current_budget_release'] != '') {
				$this->data['Balance']['current_budget_release'] = $v['current_budget_release'];
			} else {
				unset($this->data['Balance']['current_budget_release']);
			}
			
			$this->Balance->create();
			if (! $this->Balance->save($this->data)) {
				$successFlag = false;
			}
		}
		return array($budgetArr);
	}

	/**
	 * Inserts/Updates the carried forward data
	 * @author Rekha Adhikari
	 * @access Public
	 * @param No 
	 * @return No
	 */
	function getCarriedForward(){
		$bankAccounts = $this->Account->find('list', array('conditions' => array('parent_id' => BANK_ID, 'is_active' => 'Y')));
		$advanceAccounts = $this->Account->find('list', array('conditions' => array('parent_id' => ADVANCE_AC_ID, 'is_active' => 'Y')));
		$cashAccount[CASH_ID] = CASH;
		//$accounts = array_merge($cashAccount, $bankAccounts, $advanceAccounts);
		//$accounts[ADVANCE_AC_ID] = ADVANCE;
		
		foreach($bankAccounts as $k => $v) {
			$accounts[$k] = $v;
		}
		foreach($advanceAccounts as $k => $v) {
			$accounts[$k] = $v;
		}
		$accounts[CASH_ID] = CASH;
		$fiscalYear = $this->NepaliCalendar->getPreviousFiscalYear();
		$lastFYEndDate = $fiscalYear['fiscal_year_end_date'];
		
		if (!empty($this->data)) {
			App::import('Controller', 'Vouchers');
			$Vouchers = new VouchersController;
			//Load model, components...
			$Vouchers->constructClasses();
			
			foreach($accounts as $k => $v) {
				$this->data['Account']['account_id'] = $k;
				$amount = $this->NepaliNumber->toggleNumberLang($this->data['Account']['opening_balance_' . $k], 'english');
				if($amount != '') {
					
					//if balance already exist then skip
					if(isset($this->data['Account']['balance_id_' . $k]) && $this->data['Account']['balance_id_' . $k] != '') {
						//$this->data['Balance']['balance_id'] = $this->data['Account']['balance_id_' . $k];
					} else {
						$voucherArray['trans_count'] = 2;
						$voucherArray['voucher_type_id'] = 5;
						$voucherArray['narration'] = CARRIED_FORWARD;
						$currentFYYear = $this->NepaliCalendar->getCurrentFiscalYear();
						$voucherArray['created_date'] = $currentFYYear['fiscal_year_start_date'];
	
						$voucherArray['trans_account_id_1'] = $k;
						$voucherArray['trans_account_1'] = $v;
						$voucherArray['trans_amount_1'] = $amount;
						$voucherArray['trans_drcr_1'] = 'Dr';
	
						$voucherArray['trans_account_id_2'] = CF_ID;
						$voucherArray['trans_account_2'] = CARRIED_FORWARD;
						$voucherArray['trans_amount_2'] = $amount;
						$voucherArray['trans_drcr_2'] = 'Cr';
	
						$result = $Vouchers->procVoucherInsert($voucherArray);
						
						if (!$result) {
							//print "failed";
						} else {
							$this->data['Balance']['account_id'] = $k;
							$this->data['Balance']['closing_balance'] = $amount;
							$this->data['Balance']['date'] = $lastFYEndDate;
							$this->data['Balance']['year_or_month'] = 'Y';
							
							$this->Balance->set($this->data);
							$this->Balance->create();
							if (!$this->Balance->save($this->data)) {
								$this->Session->setFlash(__('The account could not be saved. Please, try again.', true));
							}
						}
					}
				}
			}
			$this->redirect('/accounts/getCarriedForward');
		} else {
			$balanceArray = array();
			$balances = $this->Balance->find('all', array('fields' => array('Balance.account_id', 'balance_id', 'Balance.closing_balance') , 'conditions' => array('Balance.account_id' => array_keys($accounts), 'date' => $lastFYEndDate, 'year_or_month' => 'Y')));
	
			foreach($balances as $k => $v) {
				$balance = $v['Balance'];
				$balanceArray[$balance['account_id']] = array('balance_id' => $balance['balance_id'], 'closing_balance' => $balance['closing_balance']);
			}
			$this->set('balances', $balanceArray);
		}
		
		$this->set('accounts', $accounts);
		$this->set('cash', $cashAccount);
		$this->set('banks', $bankAccounts);
		$this->set('advances', $advanceAccounts);
		$this->render('carried_forward');
	}

	/**
	 * Gets the Ledger of each account item
	 * @author Rekha Adhikari
	 * @access Public
	 * @param $accountId, $year, $month 
	 * @return No
	 */
	function getLedger($id, $type= '', $year = '', $month = '') {
		if (!$id) {
			$this->Session->setFlash(__('Invalid account', true));
			$this->redirect(array('action' => 'index'));
		}
		if($year == '') {
			$year = $this->NepaliCalendar->nepaliDate('Y');
		}
		if ($month == '') {
			//$month = $this->NepaliCalendar->nepaliDate('m');
		}
		
		$accInfo = $this->Account->find('list', array('conditions' => array('account_id' => $id)));
		$accountName = $accInfo[$id];
		$advances = array();
		
		$balance =  0;

		$cfArray = array();
		$cfArray['particulars'] = CARRIED_FORWARD;
		/*
		 if($month) {
			$prevYearMonth = $this->NepaliCalendar->getPreviousYearMonth();
			$endDate = $this->NepaliCalendar->getLastDayOfNepaliMonthInEnglish($prevYearMonth[0], $prevYearMonth[1]);

			$result = $this->Balance->find('list', array('conditions' => array('date' => $endDate, 'account_id' => $id), 'fields' => array('account_id', 'closing_balance')));

			if(isset($result[$id])) {
				$cfArray['amount_dr'] = $result[$id];
				$balance = $result[$id];
			}
			$cfArray['date'] = $this->NepaliCalendar->nepaliDate('m') . '/1';
		}
		
		$advances[] = $cfArray;
		*/
		
		//$startDate = $this->NepaliCalendar->getFirstDayOfNepaliMonthInEnglish($year, $month);
		//$endDate = $this->NepaliCalendar->getLastDayOfNepaliMonthInEnglish($year, $month);

		//$conditionArray['Voucher.created_date >='] = $startDate;
		//$conditionArray['Voucher.created_date <='] = $endDate;
		$conditionArray['Transaction.account_id'] = $id;
		//$vouchers = $this->Voucher->find('all', array('conditions' => $conditionArray, 'order' => 'Voucher.created_date asc'));
		

		$transactions = $this->Transaction->find('all', array('conditions' => $conditionArray, 'order' => 'Voucher.created_date asc'));
		
		if(count($transactions) > 0) {
	
			foreach($transactions as $v) {
				$tmpArr = array();
				$createdDate = $this->NepaliCalendar->nepaliDate('m/d', substr($v['Voucher']['created_date'], 0,10), 'nepali');
				$tmpArr['date'] = $createdDate;
				
				$tmpArr['particulars'] = $v['Voucher']['narration'];
				if (isset($v['Voucher']['voucher_number']) && $v['Voucher']['voucher_number'] !=''){
					$tmpArr['voucher_id'] = $v['Voucher']['voucher_number'];
				} else {
					$tmpArr['voucher_id'] = $this->NepaliNumber->toggleNumberLang($v['Voucher']['voucher_id']);
				}
				$tmpArr['voucher_number'] = $v['Voucher']['voucher_number'];
				if($v['Transaction']['drcr'] == 'Dr') {
					$tmpArr['amount_dr'] = $v['Transaction']['amount'];
					$balance += $v['Transaction']['amount'];
				} else {
					$tmpArr['amount_cr'] = $v['Transaction']['amount'];
					$balance -= $v['Transaction']['amount'];
				}
				$tmpArr['balance'] = $balance;
				$advances[] = $tmpArr;
			}
		}
		$this->set('id', $id);
		$this->set('advances', $advances);
		$this->set('balance', $balance);
		$this->set('account_name', $accountName);

		$this->layout = '';
		$this->render('print_get_ledger');
	}

	/**
	 * Get the monthly Account information
	 * @author Rekha Adhikari
	 * @access Public
	 * @param $year, $month 
	 * @return No
	 */
	function getMonthlyAccount($year = '' , $month = '', $type = '') {
		$currentMonthFlg = false;
		$currentYear = $this->NepaliCalendar->nepaliDate('Y');
		$currentMonth = $this->NepaliCalendar->nepaliDate('m');
		
		$tblToRead = '';
		if( ($year == '' || $month == '') || ($year == $currentYear && $month == $currentMonth)) {
			$tblToRead = 'current';
			$year = $currentYear;
			$month = $currentMonth;
		} else {
			$endDate = $this->NepaliCalendar->getLastDayOfNepaliMonthInEnglish($year, $month);
			$expenses = $this->Balance->find('all', array('conditions' => array('Account.budget_item' => 'Y', 'Account.level' => 2, 'date' => $endDate), 'order' => 'Account.account_id ASC'));
			if(count( $expenses) == 0) {
				$tblToRead = 'current';
			}
		}
		
		if($tblToRead == 'current') {
			
			$endDate = $this->NepaliCalendar->getLastDayOfNepaliMonthInEnglish($year, $month);
			//if monthly account is generated for current month then read the amounts from account table
			$expenses = $this->Account->find('all', array('conditions' => array('budget_item' => 'Y', 'level' => 2, 'current_balance NOT' => NULL), 'order' => 'Account.account_id ASC', 'fields' => array('account_id', 'budget_code', 'opening_balance', 'account_name', 'current_balance')));
			$currentMonthFlg = true;
			
			$release = $this->Account->find('first', array('fields' => array('SUM(current_balance)'),'conditions' => array('Account.budget_item' => 'I', 'Account.level' => 2)));
			
			
			//get cash, bank, advance balance
			$assetBalance = $this->Account->find('all', array('conditions' => array('account_id' => array(CASH_ID, BANK_ID, ADVANCE_AC_ID))));
		} else {
			//if monthly account is generated for current month then read only the budget heads from
			//account table, balances will be read from Balance table later on 
			$endDate = $this->NepaliCalendar->getLastDayOfNepaliMonthInEnglish($year, $month);
			//$expenses = $this->Account->find('all', array('conditions' => array('budget_item' => 'Y', 'level >=' => 1), 'fields' => array('account_id', 'budget_code', 'account_name', 'opening_balance')));
			$expenses = $this->Balance->find('all', array('conditions' => array('Account.budget_item' => 'Y', 'Account.level' => 2, 'date' => $endDate), 'order' => 'Account.account_id ASC'));
			
			$release = $this->Balance->find('first', array('fields' => array('SUM(current_balance)'),'conditions' => array('Account.budget_item' => 'I', 'Account.level' => 2, 'date' => $endDate)));
			//get cash, bank, advance balance
			$assetBalance = $this->Balance->find('all', array('conditions' => array('Balance.account_id' => array(CASH_ID, BANK_ID), 'date' => $endDate)));
		}
		print_r($assetBalance);
		
		$prevMonth = $this->NepaliCalendar->getPreviousYearMonth($year, $month);
		$prevEndDate = $this->NepaliCalendar->getLastDayOfNepaliMonthInEnglish($prevMonth[0], $prevMonth[1]);
		
		$monthlyAccountArray = array();
		
		$totals['total_allocation'] = 0;
		$totals['total_current_month_expense'] = 0;
		$totals['total_release_till_current_month'] = 0;
		$totals['total_expense_till_current_month'] = 0;
		$totals['total_remaining_budget'] = 0;
		
		$totals['release_till_current_month'] = 0;
		
		//RELEASES
		if(count($release) > 0) {
			$totals['release_till_current_month'] = $release[0]['sum'];
		}
		
		//carried forward
		if($month != FY_START_MONTH) {
			$carriedForward = $this->Balance->find('all', array('fields' => array('SUM(closing_balance)'),'conditions' => array('Balance.account_id' => $accounts, 'date' => $prevEndDate)));
			$carriedForward = $carriedForward[0][0]['sum'];
			$totalRelease = $carriedForward + $totals['total_release_till_current_month'];
		} else {
			$cf = $this->Account->find('first', array('conditions' => array('account_id' => CARRIED_FORWARD), 'fields' => array('current_balance')));
			
		}
		pr($totals);
		
		//EXPENDITURES
		foreach($expenses as $k => $v) {
			$tmpArr = array();
			$account = $v['Account'];
			
			$accountId = $account['account_id'];
			
			$tmpArr['budget_code'] = $account['budget_code'];
			$tmpArr['budget_title'] = $account['account_name'];
			$tmpArr['total_allocation'] = $account['opening_balance'];
			$totals['total_allocation'] = $totals['total_allocation'] + $tmpArr['total_allocation'];
			
			
			//print $accountId;print "<br>";
			$expenseTillPreviousMonth = 0;
			if($month != FY_START_MONTH) {
				print "<br>";
				print $prevEndDate;
				print "<Br>";
				$prevBalances = $this->Balance->find('all', array('Balance.account_id' => $accountId, 'year_or_month' => 'M', 'date' => $prevEndDate));
				foreach($prevBalances as $a => $b) {
					print $b['Balance']['account_id'];
					if($b['Balance']['account_id'] == $accountId) {
						
						//print $expenseTillPreviousMonth = $b['Balance']['closing_balance'];
						//print "<br>";
					}
				}
				/*if(count($prevBalances) > 0) {
					$expenseTillPreviousMonth = $prevBalances['Balance']['closing_balance'];
				}*/
			}
			
			if(!$currentMonthFlg) {
				$balances = $this->Balance->find('first', array('account_id' => $accountId, 'year_or_month' => 'M', 'date' => $endDate));
				$currentMonthExpense = $v['Balance']['closing_balance']-$expenseTillPreviousMonth;
				//$currentMonthExpense = $balances['Balance']['closing_balance']-$expenseTillPreviousMonth;
			} else {
				$currentExpense = $this->Account->find('list', array('fields' => array('account_id', 'current_balance'),'condition' => array('Account.account_id' => $accountId)));
				//print_r($currentExpense);
				print $currentExpense[$accountId];
				print "<br>";
				$currentMonthExpense = $currentExpense[$accountId]-$expenseTillPreviousMonth;
			}
			$advanceExpense = $this->getAdvanceGivenAndClearedForId($accountId, $year, $month);
			
			$currentMonthExpense += $advanceExpense;
			
			$tmpArr['current_month_expense'] = $currentMonthExpense;
			$totals['total_current_month_expense'] = $totals['total_current_month_expense'] + $currentMonthExpense;

			//$totals['total_release_till_current_month'] = $totals['total_release_till_current_month'] + $expenseTillPreviousMonth;

			$tmpArr['expense_till_current_month'] = $currentMonthExpense + $expenseTillPreviousMonth;
			$totals['total_expense_till_current_month'] = $totals['total_expense_till_current_month'] + $tmpArr['expense_till_current_month'];

			$tmpArr['remaining_budget'] = $tmpArr['total_allocation'] - $tmpArr['expense_till_current_month'];
			$totals['total_remaining_budget'] = $totals['total_remaining_budget'] + $tmpArr['remaining_budget'];

			$monthlyAccountArray[] = $tmpArr;
		}
		//assign cash, bank and advance balance
		$cashBalance = 0;
		$bankBalance = 0;

		foreach($assetBalance as $k => $v) {
			$account = $v['Account'];
			if($account['account_id'] == CASH_ID) {
				$cashBalance = $account['current_balance'];
			} else if($account['account_id'] == BANK_ID) {
				$bankBalance = $account['current_balance'];
			}
		}

		$this->set('cash_balance', $cashBalance);
		$this->set('bank_balance', $bankBalance);
		$this->set('total_balance', $cashBalance+$bankBalance);
		
		//get Carried Forward amount of Cash and bank from previous month
		$currentAccounts = 0;
		if($month != FY_START_MONTH) {
			$accounts = array(CASH_ID, BANK_ID);
		} else {
			$accounts = $this->Account->find('list', array('conditions' => array('parent_id' => BANK_ID, 'is_active' => 'Y')));
			$accounts = array_keys($accounts);
			$accounts[] = CASH_ID;
		}
		

		$this->set('carried_forward', $carriedForward);
		$this->set('total_release', $totalRelease);
		$this->set('release_expense_difference', $totalRelease-$totals['total_expense_till_current_month']);

		//get advance given and cleared amount
		list($advanceGiven, $advanceCleared) = $this->getAdvanceGivenAndCleared($year, $month);
		$this->set('advance_given', $advanceGiven);
		$this->set('advance_cleared', $advanceCleared);
		
		$unclearedAdvance = $advanceGiven-$advanceCleared;
		$this->set('uncleared_advance', $unclearedAdvance);
		
		$this->set('net_expense', ($totals['total_expense_till_current_month']-$unclearedAdvance));
		$this->set('monthly_account', $monthlyAccountArray);
		$this->set('totals', $totals);
		//print_r($monthlyAccountArray);
		
		
		$this->set('month', $month);
		$this->set('year', $year);
		$this->set('end_of_month', $this->NepaliCalendar->convertToNepaliDate($endDate));
		if ($type == '') {
			$this->render('monthly_account');
		} else {
			$this->layout = '';
			$this->render('print_monthly_account');
		}
	}

	/**
	 * Finds the total Advance given and cleared in given year and month
	 * @author Rekha Adhikari
	 * @access Private
	 * @param $year, $month 
	 * @return array($advanceGiven, $advanceCleared)
	 */
	private function getAdvanceGivenAndCleared($year, $month) {
		$startDate = $this->NepaliCalendar->getFirstDayOfNepaliMonthInEnglish($year, $month);
		$endDate = $this->NepaliCalendar->getLastDayOfNepaliMonthInEnglish($year, $month);

		$conditionArray['Voucher.created_date >='] = $startDate;
		$conditionArray['Voucher.created_date <='] = $endDate;
		$conditionArray['Voucher.voucher_type_id'] = 2;

		$vouchers = $this->Voucher->find('all', array('conditions' => $conditionArray));

		$advanceClearedTotal = 0;
		$advanceGivenTotal = 0;
		foreach($vouchers as $v) {
			foreach($v['Transaction'] as $trans) {
				$parents = $this->getParentOf($trans['account_id']);
					if(isset($parents[1]) && $parents[1] == ADVANCE_AC_ID) {
						if($trans['drcr'] == 'Dr') {
							$advanceGivenTotal += $trans['amount'];
						} else {
							$advanceClearedTotal += $trans['amount'];
						}
					}
			}
		}
		return array($advanceGivenTotal, $advanceClearedTotal);
	}
	
	private function getAdvanceGivenAndClearedForId($accountId, $year, $month) {
		$startDate = $this->NepaliCalendar->getFirstDayOfNepaliMonthInEnglish($year, $month);
		$endDate = $this->NepaliCalendar->getLastDayOfNepaliMonthInEnglish($year, $month);

		$conditionArray['Voucher.created_date >='] = $startDate;
		$conditionArray['Voucher.created_date <='] = $endDate;
		$conditionArray['Voucher.voucher_type_id'] = 2;
		$conditionArray['Voucher.advance_expense_account'] = $accountId;

		$trans = $this->Transaction->find('all', array('conditions' => $conditionArray));
		//print_r($trans);
		$advanceGiven = 0;
		foreach($trans as $k => $v) {
			$parents = $this->getParentOf($v['Transaction']['account_id']);
			if(isset($parents[1]) && $parents[1] == ADVANCE_AC_ID) {
				if($v['Transaction']['drcr'] == 'Dr') {
					$advanceGiven += $v['Transaction']['amount'];
				}
			}
		}
		//print $advanceGiven;
		
		$trans = $this->Transaction->find('all', array('conditions' => array('Voucher.voucher_type_id' => 2, 'Transaction.account_id' => $accountId)));

		$advanceCleared = 0;
		foreach($trans as $k => $v) {
			if($accountId == $v['Transaction']['account_id']) {
				if($v['Transaction']['drcr'] == 'Dr') {
					$advanceCleared += $v['Transaction']['amount'];
				}
			}
		}
		//print $advanceCleared;
		return ($advanceGiven-$advanceCleared);
		/*
		$vouchers = $this->Voucher->find('all', array('conditions' => $conditionArray));

		$advanceClearedTotal = 0;
		$advanceGivenTotal = 0;
		foreach($vouchers as $v) {
			foreach($v['Transaction'] as $trans) {
				$parents = $this->getParentOf($trans['account_id']);
					if(isset($parents[1]) && $parents[1] == ADVANCE_AC_ID) {
						if($trans['drcr'] == 'Dr') {
							$advanceGivenTotal += $trans['amount'];
						} else {
							$advanceClearedTotal += $trans['amount'];
						}
					}
			}
		}
		return array($advanceGivenTotal, $advanceClearedTotal);
		*/
	}

	function balanceTransfer() {
		
	}
}
?>
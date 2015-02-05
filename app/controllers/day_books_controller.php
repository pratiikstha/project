<?php
class DayBooksController extends AppController {

	var $name = 'DayBooks';
	var $paginate = array('limit'=>'10');
	var $uses = array('DayBook', 'Citizen', 'Account');

	function beforeFilter() {
		parent::beforeFilter();
		$this->setNepaliDateParam();
		
	}
	function index($y='', $m='', $d='', $print = '') {
		$conditionArray = array();
		if ($print == 'book') {
			$this->layout = '';
			$transactionDate = $y . "-" . $m . "-" . $d;
			if($transactionDate != '--') {
				$transactionDate = $this->NepaliCalendar->convertToEnglishDate($transactionDate, 'Y-m-d');
				$conditionArray['DayBook.transaction_date'] = $transactionDate;
			}
		} else if(isset($this->data['created_date']) && $this->data['created_date'] !=""){
				$transactionDate = $this->data['created_date']['Y'] . "-" . $this->data['created_date']['m'] . "-" . $this->data['created_date']['d'];
				if($transactionDate != '--') {
					$transactionDate = $this->NepaliCalendar->convertToEnglishDate($transactionDate, 'Y-m-d');
					$conditionArray['DayBook.transaction_date'] = $transactionDate;
				}
		} else {
			$conditionArray['DayBook.transaction_date'] = date('Y-m-d');
		}
		
		$this->DayBook->recursive = 0;
		$this->paginate = array(
									'DayBook' => array(
													'order' => 'DayBook.transaction_date DESC',
													'conditions'=> $conditionArray,
						));
		$result = $this->paginate('DayBook');
		App::import('Controller', 'Accounts');
		$Accounts = new AccountsController;
		//Load model, components...
		$Accounts->constructClasses();
		$Accounts->setupAccounts();

		$totals['transaction_amount'] = 0;
		$totals['fine_amount'] = 0;
		$totals['discount_amount'] = 0;
		$totals['net_amount'] = 0;
		
		foreach ($result as $k => $dayBook) {
			$accountId = $dayBook['DayBook']['account_id'];
			//print $displayAccount;
			$parents = $Accounts->getParents($accountId);
			if(isset($parents[2])) {
				$incomeData = $this->Account->find('first', array('conditions' => array('account_id' => $parents[2]), 'fields' => array('budget_code', 'account_name')));
				$displayAccountName = $this->NepaliNumber->toggleNumberLang($incomeData['Account']['budget_code'], 'Nepali') . " " . $incomeData['Account']['account_name'];
			} else {
				$displayAccountName = "";
			}
			$result[$k]['DayBook']['account_name'] = $displayAccountName;
			$result[$k]['DayBook']['net_amount'] = $dayBook['DayBook']['transaction_amount'] + $dayBook['DayBook']['fine_amount'] - $dayBook['DayBook']['discount_amount'];
			
			$totals['transaction_amount'] += $dayBook['DayBook']['transaction_amount'];
			$totals['fine_amount'] += $dayBook['DayBook']['fine_amount'];
			$totals['discount_amount'] += $dayBook['DayBook']['discount_amount'];
			$totals['net_amount'] += $result[$k]['DayBook']['net_amount'];
		}
		$this->set('totals', $totals);
		$this->set('dayBooks', $result);
		if ($print == 'book') {
			$this->render('print_day_book');
		}
	}


	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid day book', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->layout = '';
		$incomeData = $this->DayBook->read(null, $id);
		//$incomeData['DayBook']['']
		$incomeData['DayBook']['transaction_date'] = $this->NepaliCalendar->nepaliDate('Y / m / d', substr($incomeData['DayBook']['transaction_date'], 0,10), 'nepali');
		$incomeData['DayBook']['net_amount'] = $incomeData['DayBook']['transaction_amount'] + $incomeData['DayBook']['fine_amount'] - $incomeData['DayBook']['discount_amount'];
		$this->set('dayBook', $incomeData);
	}

	function add() {
		if (!empty($this->data)) {
			if($this->validates()){
				$this->data['DayBook']['received_by'] = 1;
				$this->DayBook->create();
				if ($this->DayBook->save($this->data)) {
					$this->redirect(array('action' => 'view', $this->DayBook->getLastInsertID()));
				} else {
					$this->Session->setFlash(__('The day book could not be saved. Please, try again.', true));
				}
			}
		}

		$citizen = $this->Citizen->find('list');
		$this->set(compact('citizen'));
	}

	private function validates() {
		$ctznValidFlag = false;
		$amountValidFlag = false;
		$dateValidFlag = false;
		$incomeValidFlag = false;
		$fineValidFlag = true;
		$discountValidFlag = true;

		if(isset($this->data['DayBook']['person_name_id']) && $this->data['DayBook']['person_name_id'] != ''){
				$this->data['DayBook']['received_from'] = $this->data['DayBook']['person_name_id'];
				$ctznValidFlag = true;
		}

		if(isset($this->data['DayBook']['transaction_amount']) && $this->data['DayBook']['transaction_amount'] != '') {
			$amount = $this->NepaliNumber->toggleNumberLang($this->data['DayBook']['transaction_amount'], 'english');
			if(is_numeric($amount)) {
				$this->data['DayBook']['transaction_amount'] = $amount;
				$amountValidFlag = true;
			}
		}
		
		if(isset($this->data['DayBook']['fine_amount']) && $this->data['DayBook']['fine_amount'] != '') {
			$fineAmount = $this->NepaliNumber->toggleNumberLang($this->data['DayBook']['fine_amount'], 'english');
			if(is_numeric($amount)) {
				$this->data['DayBook']['fine_amount'] = $fineAmount;
			} else {
				$fineValidFlag = false;
			}
		}
		
		if(isset($this->data['DayBook']['discount_amount']) && $this->data['DayBook']['discount_amount'] != '') {
			$discountAmount = $this->NepaliNumber->toggleNumberLang($this->data['DayBook']['discount_amount'], 'english');
			if(is_numeric($amount)) {
				$this->data['DayBook']['discount_amount'] = $discountAmount;
			} else {
				$discountValidFlag = false;
			}
		}
		
		if(isset($this->data['DayBook']['transaction_date']) && $this->data['DayBook']['transaction_date'] != '') {
			$dateValidFlag = true;
		}
		
		if(isset($this->data['DayBook']['account_id']) && $this->data['DayBook']['account_id'] != '') {
			$incomeValidFlag = true;
		}
		
		if(!$ctznValidFlag) {
			$this->Session->setFlash(__('Citizen information are Empty or Invalid', true));
			return false;
		}
		if(!$dateValidFlag) {
			$this->Session->setFlash(__('Transaction Date is Empty or Invalid', true));
			return false;
		}
		if(!$incomeValidFlag) {
			$this->Session->setFlash(__('Income Source is Empty or Invalid', true));
			return false;
		}
		if(!$amountValidFlag) {
			$this->Session->setFlash(__('Amount is Empty or Invalid', true));
			return false;
		}
		if(!$fineValidFlag) {
			$this->Session->setFlash(__('Fine Amount is Invalid', true));
			return false;
		}
		
		if(!$discountValidFlag) {
			$this->Session->setFlash(__('Discount Amount is Invalid', true));
			return false;
		}
		return true;
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid day book', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			$this->data['DayBook']['transaction_amount'] = $this->NepaliNumber->toggleNumberLang($this->data['DayBook']['transaction_amount'], 'english');
			//$this->data['DayBook']['transaction_date'] = $this->NepaliCalendar->convertToEnglishDate($this->data['DayBook']['transaction_date']);
			if ($this->DayBook->save($this->data)) {
				$this->Session->setFlash(__('The day book has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The day book could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->DayBook->read(null, $id);
		}
		$this->data['DayBook']['transaction_amount'] = $this->NepaliNumber->toggleNumberLang($this->data['DayBook']['transaction_amount'], 'nepali');
		$this->data['DayBook']['transaction_date_display'] = $this->NepaliCalendar->nepaliDate("Y-m-d", $this->data['DayBook']['transaction_date'], 'nepali');
		$incomeSources = $this->DayBook->IncomeSource->find('list');
		$this->set(compact('incomeSources'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for day book', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->DayBook->delete($id)) {
			$this->Session->setFlash(__('Day book deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Day book was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
	
	function getIncomeByBudgetCode($budgetCode) {
		$this->layout = '';
		$budgetCode = urldecode($budgetCode);

		if($budgetCode == '') {
			print_r(json_encode(array()));
		} else {
			$results = $this->Account->find('all', array('fields' => array('account_name', 'account_id', 'budget_code'),'conditions'=>array('budget_code LIKE'=>$budgetCode.'%', 'budget_item' => 'I', 'level >=' => 3), 'order' => 'account_id'));
			if(count($results) <= 0) {
				$results = $this->Account->find('all', array('fields' => array('account_name', 'account_id', 'budget_code'),'conditions'=>array('account_name LIKE'=>$budgetCode.'%', 'budget_item' => 'I', 'level >=' => 3), 'order' => 'account_id'));
			} 
			
			$accounts = array();
			foreach($results as $k => $v) {
				$accounts[$v['Account']['account_id']] = $v['Account']['account_name'] . " (" . $this->NepaliNumber->toggleNumberLang($v['Account']['budget_code'], 'nepali') . ')';
			}
			//print_r($accounts);
			print_r(json_encode($accounts));
		}
	}
}
?>
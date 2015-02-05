<?php
class VouchersController extends AppController {

	var $name = 'Vouchers';
	var $uses = array('Voucher', 'Account', 'Transaction', 'VoucherType');
	var $helpers = array('NepaliForm');
	var $accountParent = array();
	
	function beforeFilter() {
		$this->setVoucherTypeArray();
		$this->setNepaliDateParam();
		parent::beforeFilter();
	}
	
	function index() {
		
		$this->Voucher->recursive = 0;
		$conditionArray = array();
		if(isset($this->data['VoucherSearch']['narration']) && $this->data['VoucherSearch']['narration'] !=""){
			$conditionArray['Voucher.narration LIKE '] = '%' . $this->data['VoucherSearch']['narration'] . '%';
		}
		
		if(isset($this->data['created_date']) && $this->data['created_date'] !=""){
			$createDate = $this->data['created_date']['Y'] . "-" . $this->data['created_date']['m'] . "-" . $this->data['created_date']['d'];
			if($createDate != '--') {
				$createDate = $this->NepaliCalendar->convertToEnglishDate($createDate, 'Y-m-d');
				$conditionArray['Voucher.created_date'] = $createDate;
			}
		}
		if(isset($this->data['VoucherSearch']['voucher_type_id']) && $this->data['VoucherSearch']['voucher_type_id'] !=""){
			$conditionArray['Voucher.voucher_type_id'] = $this->data['VoucherSearch']['voucher_type_id'];
		}
		
		$this->paginate = array(
							'Voucher' => array(
											'order' => 'Voucher.voucher_id DESC',
											'conditions'=> $conditionArray,
								)
				        	);
		$this->Voucher->order = 'Voucher.voucher_id DESC';
		$this->set('vouchers', $this->paginate('Voucher'));
	}

	function testDatagrid() {
		$this->layout = "";
	}
	private function setVoucherTypeArray() {
		$this->set('voucherTypes', $this->VoucherType->find('list'));
	}

	function view($id = null, $print = '') {
		if (!$id) {
			$this->Session->setFlash(__('Invalid voucher', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->layout = '';

		$vouchers = $this->Voucher->read(null, $id);
		//$vouchers['Voucher']['voucher_id'] = $this->NepaliNumber->toggleNumberLang($vouchers['Voucher']['voucher_id']);
		$createdDate = $vouchers['Voucher']['created_date'];

		$createdDate = $this->NepaliCalendar->nepaliDate('Y/m/d', substr($createdDate, 0,10), 'nepali');
		$vouchers['Voucher']['created_date'] = $createdDate;
		
		foreach($vouchers['Transaction'] as $k => $v) {
			$accountId = $v['account_id'];
			$account = $this->Account->find('first', array('conditions' => array('account_id' => $accountId), 'fields' => array('account_name', 'budget_code')));
			$vouchers['Transaction'][$k]['account_name'] = $account['Account']['account_name'];
			$vouchers['Transaction'][$k]['budget_code'] = $account['Account']['budget_code'];
			
			if(strpos($vouchers['Transaction'][$k]['drcr'], 'Dr') !== false) {
				$vouchers['Transaction'][$k]['drcr'] = 'Dr';
			} else{
				$vouchers['Transaction'][$k]['drcr'] = 'Cr';
			}
			$vouchers['Transaction'][$k]['transaction_id'] = $this->NepaliNumber->toggleNumberLang($vouchers['Transaction'][$k]['transaction_id']);
			$vouchers['Transaction'][$k]['amount'] = $vouchers['Transaction'][$k]['amount'];
		}
		
		$narration = explode('~', $vouchers['Voucher']['narration']);
		if(count($narration) == 2) {
			$vouchers['Voucher']['narration'] = $narration[0] . " (" . $narration[1] . ")";
			$vouchers['Voucher']['cheque_no'] = $narration[1];
		}

		if(isset($vouchers['Voucher']['clearance_voucher_id'])) {
			$clearances = explode('/', $vouchers['Voucher']['clearance_voucher_id']);
			if(isset($clearances[0])) {
				$vouchers['Voucher']['clearance_of'] = $clearances[0];
			}
			if(isset($clearances[1])) {
				$vouchers['Voucher']['clearance_by'] = explode(',', $clearances[1]);
			}
		}
		echo "ttt";
		if(isset($vouchers['Voucher']['posted_by'])) {
			
			echo $vouchers['Voucher']['posted_by'];
			$vouchers['Voucher']['posted_by_name'] = $this->getNameFromSsnNo($vouchers['Voucher']['posted_by']);
		}
		
		if(isset($vouchers['Voucher']['checked_by'])) {
			echo $vouchers['Voucher']['checked_by'];
			$vouchers['Voucher']['checked_by_name'] = $this->getNameFromSsnNo($vouchers['Voucher']['checked_by']);
		}
		
		$this->set('voucher', $vouchers);
		$this->set('print', $print);
	}

	function add($voucherTypeId = '') {
		$trans = array();
		if (!empty($this->data) && isset($this->data['Voucher']['trans_count'])) {
			$transactionCount = $this->data['Voucher']['trans_count'];
			if($this->Voucher->validates() && $this->validateVoucher()){
				
				$this->data['Voucher']['edited_by'] = $this->Authake->getSsnNo();
				$this->data['Voucher']['edited_date'] = date('Y-m-d H:i:s');
				
				$createDate = $this->data['Voucher']['created_date']['Y'] . "-" . $this->data['Voucher']['created_date']['m'] . "-" . $this->data['Voucher']['created_date']['d'];
				$createDate = $this->NepaliCalendar->convertToEnglishDate($createDate, 'Y-m-d');
				//echo $createDate;
				$this->data['Voucher']['created_date'] = $createDate . ' 00:00:00';
				//$this->data['Voucher']['created_date'] = $this->data['Voucher']['created_date']  . ' 00:00:00';
				$this->data['Voucher']['created_by'] = $this->Authake->getSsnNo();
				
				$this->data['Voucher']['posted_by'] = $this->Authake->getSsnNo();
				$this->data['Voucher']['posted_date'] = date('Y-m-d');
				
				if(isset($this->data['Voucher']['cheque_no']) && $this->data['Voucher']['cheque_no'] != '') {
					$this->data['Voucher']['narration'] .= '~' . CHEQUE_NO . ':' . $this->data['Voucher']['cheque_no']; 
				}
				
				if(isset($this->data['Voucher']['trans_account_id_a']) && $this->data['Voucher']['trans_account_id_a'] != '') {
					$this->data['Voucher']['advance_expense_account'] = $this->data['Voucher']['trans_account_id_a'];
				}
				
				if(isset($this->data['Voucher']['clearance_voucher_id']) && $this->data['Voucher']['clearance_voucher_id'] != '') {
					$this->data['Voucher']['clearance_voucher_id'] = $this->data['Voucher']['clearance_voucher_id'];
					//unset($this->data['Voucher']['advance_expense_account']);
				}
				
				$this->Voucher->create();
				if ($this->Voucher->save($this->data)) {
					$voucherId = $this->Voucher->getLastInsertID();
					if(isset($this->data['Voucher']['clearance_voucher_id'])) {
						$this->updateClearanceVoucher($this->data['Voucher']['clearance_voucher_id'], $voucherId);
					}
					$this->requestAction('transactions/add/' . $voucherId , array("return"));
					$this->updateBalance();
					$this->Session->setFlash(__('The voucher has been saved', true));
					$this->redirect('/vouchers'); ///view/' . $voucherId);
				} else {
					$this->Session->setFlash(__('The voucher could not be saved. Please, try again.', true));
				}
			} else {
				$this->validateErrors($this->Voucher);
				$this->set('error', 1);
			}
		} else {
			$transactionCount = 2;
			if(isset($this->data['Voucher']['advance_account_id'])) {
				$accountId = $this->data['Voucher']['advance_account_id'];
				$result = $this->Account->find('list', array('conditions' => array('account_id' => $accountId)));

				$trans[1]['trans_account_id'] = $accountId;
				$trans[1]['trans_account'] = $result[$accountId];
				$trans[1]['trans_drcr'] = 'Dr';
				$trans[1]['trans_amount'] = $this->data['Voucher']['amount'];
			}
		}
		
		for($i = 1; $i <= $transactionCount; $i++) {
			
			if(isset($this->data['Voucher']['trans_account_id_'. $i])) {
				$accountId = $this->data['Voucher']['trans_account_id_'. $i];
			} else {
				$accountId = '';
			}
			if(isset($this->data['Voucher']['trans_account_'. $i])) {
				$account = $this->data['Voucher']['trans_account_'. $i];
			} else {
				$account = '';
			}
			if(isset($this->data['Voucher']['trans_drcr_'. $i])) {
				$drcr = $this->data['Voucher']['trans_drcr_'. $i];
			} else {
				if($i == 1) {
					$drcr = 'Dr';
				} else if($i == 2) {
					$drcr = 'Cr';
				} else {
					$drcr = '';
				}
			}
			if(isset($this->data['Voucher']['trans_amount_'. $i])) {
				$amount = $this->data['Voucher']['trans_amount_'. $i];
			} else {
				$amount = '';
			}
			
			$trans[$i]['trans_account_id'] = $accountId;
			$trans[$i]['trans_account'] = $account;
			$trans[$i]['trans_drcr'] = $drcr;
			$trans[$i]['trans_amount'] = $amount;
		}
		
		if(isset($this->data['Voucher']['trans_account_id_a'])) {
				$accountId = $this->data['Voucher']['trans_account_id_a'];
		} else {
				$accountId = '';
		}
		if(isset($this->data['Voucher']['trans_account_a'])) {
			$account = $this->data['Voucher']['trans_account_a'];
		} else {
			$account = '';
		}
		$trans['adv']['trans_account_id_a'] = $accountId;
		$trans['adv']['trans_account_a'] = $account;

		if(isset($this->data['Voucher']['voucher_type_id'])) {
			$voucherTypeId = $this->data['Voucher']['voucher_type_id'];
		}
		
		if(isset($this->data['Voucher']['narration'])) {
			$this->set('narration', $this->data['Voucher']['narration']);
		}
		$this->set('defaults', $trans);
		//$vouchers = $this->Voucher->Voucher->find('list');
		$voucherTypes = $this->Voucher->VoucherType->find('list', array('order' => 'voucher_type_id asc'));
		$this->set(compact('vouchers', 'voucherTypes'));
		
		$this->setNepaliDateParam();
		
		$this->set('voucherTypeId', $voucherTypeId);
		$this->set('transactionCount', $transactionCount);
	}

	function check($voucherId) {
		$this->Voucher->query("update vouchers set checked_by = '" . $this->Authake->getSsnNo() . "', checked_date = '" . date('Y-m-d') . "' where voucher_id = " . $voucherId);
		$this->redirect(array('controller' => 'vouchers', 'action' => 'view', $voucherId));
	}

	function verify($voucherId) {
		$this->Voucher->query("update vouchers set checked_by = '" . $this->Authake->getSsnNo() . "', checked_date = '" . date('Y-m-d') . "'");
		$this->redirect("/view/" . $voucherId);
	}

	function clearAdvance($voucherId) {
		//$transactions = $this->Voucher->find('all', array('condition' => array('voucher_id' => $voucherId), 'fields' => array('Voucher.voucher_id', 'Voucher.voucher_type_id', 'Voucher.advance_expense_account', 'Transaction.amount','Transaction.drcr', 'Transaction.account_id')));
		//$transactions = $this->Transaction->find('first', array('condition' => array('Transaction.voucher_id' => $voucherId, 'Voucher.voucher_id' => $voucherId), 'fields' => array('Voucher.voucher_id', 'Voucher.voucher_type_id', 'Voucher.advance_expense_account', 'Transaction.amount','Transaction.drcr', 'Transaction.account_id')));
		$transactions = $this->Voucher->read(null, $voucherId);
		$i = 1;
		$trans = $transactions['Transaction'][0];
		
		$this->data['Voucher']['trans_drcr_1'] = 'Dr';
		$drAccountId = $transactions['Voucher']['advance_expense_account'];
		$this->data['Voucher']['trans_account_id_1'] = $drAccountId;

		$accountInfo = $this->Account->find('list', array('conditions' => array('account_id' => $drAccountId)));

		$this->data['Voucher']['trans_account_1'] = $accountInfo[$drAccountId];
		$this->data['Voucher']['trans_amount_1'] = $this->NepaliNumber->precision($trans['amount'],2);
		
		$this->data['Voucher']['trans_drcr_2'] = 'Cr';
		$this->data['Voucher']['trans_account_id_2'] = $trans['account_id'];
		$accountInfo = $this->Account->find('list', array('conditions' => array('account_id' => $trans['account_id'])));
		$this->data['Voucher']['trans_account_2'] = $accountInfo[$trans['account_id']];
		$this->data['Voucher']['trans_amount_2'] = $this->NepaliNumber->precision($trans['amount']);
		
		//print_r($this->data);
		$transactionCount = 2;
		
		$trans = array();
		for($i = 1; $i <= $transactionCount; $i++) {
			if(isset($this->data['Voucher']['trans_account_id_'. $i])) {
				$accountId = $this->data['Voucher']['trans_account_id_'. $i];
			} else {
				$accountId = '';
			}
			if(isset($this->data['Voucher']['trans_account_'. $i])) {
				$account = $this->data['Voucher']['trans_account_'. $i];
			} else {
				$account = '';
			}
			if(isset($this->data['Voucher']['trans_drcr_'. $i])) {
				$drcr = $this->data['Voucher']['trans_drcr_'. $i];
			} else {
				if($i == 1) {
					$drcr = 'Dr';
				} else if($i == 2) {
					$drcr = 'Cr';
				} else {
					$drcr = '';
				}
			}
			if(isset($this->data['Voucher']['trans_amount_'. $i])) {
				$amount = $this->data['Voucher']['trans_amount_'. $i];
			} else {
				$amount = '';
			}
			$trans[$i]['trans_account_id'] = $accountId;
			$trans[$i]['trans_account'] = $account;
			$trans[$i]['trans_drcr'] = $drcr;
			$trans[$i]['trans_amount'] = $amount;
		}
		
		if(isset($this->data['Voucher']['trans_account_id_a'])) {
				$accountId = $this->data['Voucher']['trans_account_id_a'];
		} else {
				$accountId = '';
		}
		if(isset($this->data['Voucher']['trans_account_a'])) {
			$account = $this->data['Voucher']['trans_account_a'];
		} else {
			$account = '';
		}
		$trans['adv']['trans_account_id_a'] = $accountId;
		$trans['adv']['trans_account_a'] = $account;

		$this->set('defaults', $trans);
		//$vouchers = $this->Voucher->Voucher->find('list');
		$voucherTypes = $this->Voucher->VoucherType->find('list', array('order' => 'voucher_type_id asc'));
		$this->set(compact('vouchers', 'voucherTypes'));
		
		$this->setNepaliDateParam();
		
		$this->set('voucherTypeId', 2);
		$this->set('advance_clear', $voucherId);
		$this->set('transactionCount', $transactionCount);
		
		$this->set('clear', 1);

		$this->render('add');
	}

	function updateClearanceVoucher($advanceVoucherId, $clearVoucherId) {
		$voucherInfo = $this->Voucher->find('list', array('conditions' => array('voucher_id' => $advanceVoucherId), 'fields' => array('voucher_id', 'clearance_voucher_id')));
		// clearance data is stored as following
		// clearanceOf/ClearedBySeparatedByComma
		$clearance = explode('/', $voucherInfo[$advanceVoucherId]);
		$items = count($clearance);
		if($items == 0) {
			$clearanceBy = '/' . $clearVoucherId;
		} else {
			if(isset($clearance[1])) {
				$clearanceBy = $voucherInfo[$advanceVoucherId] . ',' . $clearVoucherId;
			} else {
				$clearanceBy = $clearance[0] . '/' . $clearVoucherId;
			}
		}
		
		$this->Voucher->query("update vouchers set clearance_voucher_id = '$clearanceBy' where voucher_id=$advanceVoucherId");
		
	}

	/***
	 * Inserting data to Transaction and Voucher Manually (not by filling voucher form)
	 * 
	 */
	function procVoucherInsert($voucherArray) {
		if($this->validateVoucher($voucherArray)){
				
			$this->data['Voucher']['edited_by'] = $this->Authake->getSsnNo();
			$this->data['Voucher']['edited_date'] = date('Y-m-d H:i:s');
			
			$this->data['Voucher']['created_date'] = $voucherArray['created_date'];
			$this->data['Voucher']['created_by'] = $this->Authake->getSsnNo();
				
			$this->data['Voucher']['posted_by'] = $this->Authake->getSsnNo();
			$this->data['Voucher']['posted_date'] = date('Y-m-d');
			
			$this->data['Voucher']['voucher_type_id'] = $voucherArray['voucher_type_id'];
			$this->data['Voucher']['narration'] = $voucherArray['narration'];
			
			$this->Voucher->create();
			if ($this->Voucher->save($this->data)) {
				$voucherId = $this->Voucher->getLastInsertID();
				
				$this->procTransactionInsert($voucherId, $voucherArray);
				$this->updateBalance($voucherArray);
				$this->Session->setFlash(__('The voucher has been saved', true));
				return true;
				//$this->redirect('/vouchers'); ///view/' . $voucherId);
			} else {
				$this->Session->setFlash(__('The voucher could not be saved. Please, try again.', true));
				print "failed to insert to voucher";
				return false;
			}
		} else {
			//print "invalid";
			return false;
		}
	}
	
	private function procTransactionInsert($voucherId, $voucherArray) {
			$successFlag = true;
			$transctionCount = $voucherArray['trans_count'];
			$this->data['Transaction']['voucher_id'] = $voucherId;
			for($i = 1; $i <= $transctionCount; $i++) {
				$amount = $voucherArray['trans_amount_' . $i];
				$this->data['Transaction']['account_id'] = $voucherArray['trans_account_id_' . $i];
				$this->data['Transaction']['drcr'] = $voucherArray['trans_drcr_' . $i];
				$this->data['Transaction']['amount'] = $this->NepaliNumber->toggleNumberLang($amount, 'english');
				$this->data['Transaction']['remarks'] = '';
				
				$this->Transaction->create();
				if (! $this->Transaction->save($this->data)) {
					$successFlag = false;
				}
			}
			return $successFlag;
	}

	/**
	 * 
	 * This function validates 2 types of validation in Transaction part
	 * Whether AccountId, Drcr and Amount Fields are filled or not
	 * Whether the Debit Amount and Credit Amount are equal or not
	 * This still needs to implement the Account Balance validation
	 */
	private function validateVoucher($voucherArray = array()) {
		if(count($voucherArray) == 0) {
			$voucherArray = $this->data['Voucher'];
		}
		
		$transactionCount = $voucherArray['trans_count'];
		$voucherType = $voucherArray['voucher_type_id'];
		
		$emptyFlag = false;
		$balanceInvalidFlag = false; 
		$drTotal = 0;
		$crTotal = 0;
		for($i = 1; $i <= $transactionCount; $i++) {
			// Empty Validation
			if (
			!isset($voucherArray['trans_account_id_'. $i]) || $voucherArray['trans_account_id_' . $i] == '' ||
			!isset($voucherArray['trans_account_'. $i]) || $voucherArray['trans_account_' . $i] == '' ||
			!isset($voucherArray['trans_drcr_'. $i]) || $voucherArray['trans_drcr_'. $i] == '' ||
			!isset($voucherArray['trans_amount_'. $i]) || $voucherArray['trans_amount_'. $i] == '' ||
			!isset($voucherArray['narration']) || $voucherArray['narration'] == ''
			) {
				$emptyFlag = true;
				break;
			}
			
			$accountId = $voucherArray['trans_account_id_'. $i];
			$amount = $voucherArray['trans_amount_'. $i];
			$amount = $this->NepaliNumber->toggleNumberLang($amount, 'english');
			$drcr = $voucherArray['trans_drcr_'. $i];
			
			//Double Entry Validation
			if ($drcr == 'Dr' ) {
				$drTotal += $amount;
			} else {
				$crTotal += $amount;
			}
			
			//get parent Accounts
			$parents = $this->requestAction("/accounts/getParentOf/$accountId", array("return"));
			
			//store in array for updating balance purpose
			$this->accountParent[$accountId] = array('drcr' => $drcr, 'amount' => $amount, 'parent' => $parents);
			
			//Account Balance validation here
			//if the current account is Asset and it is credited, then validate the balance
			 if($parents[0] == ASSETS && $drcr == 'Cr') {
			 	if($voucherType == 4) {
			 		//print "voucher type 4";
			 		$this->validateLastYearVoucher($accountId, $amount);
			 	}

				//$parentI = array_pop($parents);
				$accountI = $this->Account->read(array('current_balance', 'opening_balance'), $accountId);
				if($amount > $accountI['Account']['current_balance']) {
					$balanceInvalidFlag = true;
				}
			 }
		}

		if(!isset($voucherArray['narration']) || $voucherArray['narration'] == '') {
			$emptyFlag = true;
		}
			
		if($emptyFlag) {
			$this->Session->setFlash(__('Voucher Fields are Empty or Invalid', true));
			return false;
		}
		if($drTotal != $crTotal) {
			$this->Session->setFlash(__('Debit Amount and Credit Amount Does not Match', true));
			return false;
		}
		
		if($balanceInvalidFlag) {
			$this->Session->setFlash(__('There is no enough balance', true));
			return false;
		}
		return true;
	}
	
	function validateLastYearVoucher($accountId, $amount) {
		//get parent Accounts
		//$this->requestAction('transactions/add/' . $voucherId , array("return"));
		
		App::import('Controller', 'Accounts');
		$Accounts = new AccountsController;
		//Load model, components...
		$Accounts->constructClasses();
		$cfBalance = $Accounts->getCarriedForwardOfLastFiscalYear(array($accountId));

		$transactions = $this->Transaction->find('first', array('fields' => array('SUM(amount) as amount'), 'conditions' => array('Voucher.voucher_type_id' => 4, 'Transaction.account_id' => $accountId, 'Transaction.drcr' => 'Cr')));
		$balances = $transactions[0]['amount'];

		if(($cfBalance-$balances) < $amount) {
			return false;
		} else {
			return true;
		}
	}

	private function updateBalance($voucherArray = array()) {
		if(count($voucherArray) == 0) {
			$voucherArray = $this->data['Voucher'];
		}

		$transactionCount = $voucherArray['trans_count'];
		for($i = 1; $i <= $transactionCount; $i++) {
			// Empty Validation
			$accountId = $voucherArray['trans_account_id_'. $i];
			/*if(isset($this->accountParent[$accountId])) {
				$amount = $this->accountParent[$accountId]['amount'];
				$drcr = $this->accountParent[$accountId]['drcr'];
				$parents = $this->accountParent[$accountId]['parent'];
			} else {
			*/
				$amount = $voucherArray['trans_amount_'. $i];
				$amount = $this->NepaliNumber->toggleNumberLang($amount, 'english');
				$drcr = $voucherArray['trans_drcr_'. $i];
				$parents = $this->requestAction("/accounts/getParentOf/$accountId", array("return"));
			//}

			//if the item is Assets
			//if Debit, add to all the parents
			//if Credit, decrease from all the parents
			if($parents[0] == ASSETS) {
				//also add balance to current item
				$parents[] = $accountId;
				foreach($parents as $v) {
					$data = $this->Account->read(array('current_balance'), $v);
					$currentBalance = $data['Account']['current_balance'];
					if($currentBalance == ''){
						$currentBalance = $amount;
					} else {
						if($drcr == 'Dr') {
							$currentBalance += $amount;
						} else {
							$currentBalance -= $amount;
						}
					}
					$this->Account->query("update v_accounts set current_balance=$currentBalance where account_id=$v");
				}
			}
			
			//if the item is Expenditure
			//if Debit add to all parents
			if($parents[0] == EXPENDITURES && $drcr = 'Dr') {
				if($voucherArray['voucher_type_id'] != 4) {
					$parents[] = $accountId;
					foreach($parents as $v) {
						$data = $this->Account->read('current_balance', $v);
						$currentBalance = $data['Account']['current_balance'];
						if($currentBalance == ''){
							$currentBalance = $amount;
						} else {
							if($drcr == 'Dr') {
								$currentBalance += $amount;
							} else {
								$currentBalance -= $amount;
							}
						}
						$this->Account->query("update v_accounts set current_balance=$currentBalance where account_id=$v");
					}
				}
			}
			
			//if the item is Income, same as Assets
			if($parents[0] == INCOME) {
				$parents[] = $accountId;
				foreach($parents as $v) {
					$data = $this->Account->read('current_balance', $v);
					$currentBalance = $data['Account']['current_balance'];
					if($currentBalance == ''){
						$currentBalance = $amount;
					} else {
						if($drcr == 'Cr') {
							$currentBalance += $amount;
						} else {
							$currentBalance -= $amount;
						}
					}
					$this->Account->query("update v_accounts set current_balance=$currentBalance where account_id=$v");
				}
			}
			
			//if the item is Liabilities, same as Assets
			if($parents[0] == LIABILITIES) {
				$parents[] = $accountId;
				foreach($parents as $v) {
					$data = $this->Account->read('current_balance', $v);
					$currentBalance = $data['Account']['current_balance'];
					
					if($currentBalance == ''){
						$currentBalance = $amount;
					} else {
						if($drcr == 'Dr') {
							$currentBalance -= $amount;
						} else {
							$currentBalance += $amount;
						}
					}
					
					$this->Account->query("update v_accounts set current_balance=$currentBalance where account_id=$v");
				}
				/*
				//if it is budget release
				if($parents[1] == BUDGET_RELEASES) {
					foreach($parents as $v) {
						$data = $this->Account->read('current_budget_release', $v);
						$currentBudgetRelease = $data['Account']['current_budget_release'];
						if($currentBudgetRelease == ''){
							$currentBudgetRelease = $amount;
						} else {
							if($drcr == 'Dr') {
								$currentBudgetRelease -= $amount;
							} else {
								$currentBudgetRelease += $amount;
							}
						}
						$this->Account->query("update accounts set current_budget_release=$currentBudgetRelease where account_id=$v");
					}
				}
				*/
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid voucher', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Voucher->save($this->data)) {
				$this->Session->setFlash(__('The voucher has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The voucher could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Voucher->read(null, $id);
		}
		//$vouchers = $this->Voucher->Voucher->find('list');
		$voucherTypes = $this->Voucher->VoucherType->find('list');
		$this->set(compact('vouchers', 'voucherTypes'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for voucher', true));
			$this->redirect(array('action'=>'index'));
		}
		
		
		$transactions = $this->Transaction->find('all', array('conditions' => array('Transaction.voucher_id' => $id)));
		//print_r($transactions);
		foreach($transactions as $transaction) {
			$trans = $transaction['Transaction'];
			$amount = $trans['amount'];
			$accountId = $trans['account_id'];
			
			$drcr = $trans['drcr'] == 'Dr' ? 'Cr' : 'Dr';
			$parents = $this->requestAction("/accounts/getParentOf/$accountId", array("return"));

			//if the item is Assets
			//if Debit, add to all the parents
			//if Credit, decrease from all the parents
			if($parents[0] == ASSETS) {
				//also add balance to current item
				$parents[] = $accountId;
				foreach($parents as $v) {
					$data = $this->Account->read(array('current_balance'), $v);
					$currentBalance = $data['Account']['current_balance'];
					
					if($currentBalance == ''){
						$currentBalance = $amount;
					} else {
						if($drcr == 'Dr') {
							$currentBalance += $amount;
						} else {
							$currentBalance -= $amount;
						}
					}
					$this->Account->query("update v_accounts set current_balance=$currentBalance where account_id=$v");
				}
			}
			
			//if the item is Expenditure
			//if Debit add to all parents
			if($parents[0] == EXPENDITURES && $drcr = 'Dr') {
				$parents[] = $accountId;
				foreach($parents as $v) {
					$data = $this->Account->read('current_balance', $v);
					$currentBalance = $data['Account']['current_balance'];
					if($currentBalance == ''){
						$currentBalance = $amount;
					} else {
						if($drcr == 'Dr') {
							$currentBalance += $amount;
						} else {
							$currentBalance -= $amount;
						}
					}
					$this->Account->query("update v_accounts set current_balance=$currentBalance where account_id=$v");
				}
			}
			
			//if the item is Income, same as Assets
			if($parents[0] == INCOME) {
				$parents[] = $accountId;
				foreach($parents as $v) {
					$data = $this->Account->read('current_balance', $v);
					$currentBalance = $data['Account']['current_balance'];
					if($currentBalance == ''){
						$currentBalance = $amount;
					} else {
						if($drcr == 'Dr') {
							$currentBalance += $amount;
						} else {
							$currentBalance -= $amount;
						}
					}
					$this->Account->query("update v_accounts set current_balance=$currentBalance where account_id=$v");
				}
			}
			
			//if the item is Liabilities, same as Assets
			if($parents[0] == LIABILITIES) {
				$parents[] = $accountId;
				foreach($parents as $v) {
					$data = $this->Account->read('current_balance', $v);
					$currentBalance = $data['Account']['current_balance'];
					if($currentBalance == ''){
						$currentBalance = $amount;
					} else {
						if($drcr == 'Dr') {
							$currentBalance -= $amount;
						} else {
							$currentBalance += $amount;
						}
					}
					$this->Account->query("update v_accounts set current_balance=$currentBalance where account_id=$v");
				}
				//if it is budget release
				if($parents[1] == BUDGET_RELEASES) {
					foreach($parents as $v) {
						$data = $this->Account->read('current_budget_release', $v);
						$currentBudgetRelease = $data['Account']['current_budget_release'];
						if($currentBudgetRelease == ''){
							$currentBudgetRelease = $amount;
						} else {
							if($drcr == 'Dr') {
								$currentBudgetRelease -= $amount;
							} else {
								$currentBudgetRelease += $amount;
							}
						}
						$this->Account->query("update v_accounts set current_budget_release=$currentBudgetRelease where account_id=$v");
					}
				}
			}

		}
		$this->Transaction->query('delete from transactions where voucher_id = ' . $id);
		if ($this->Voucher->delete($id)) {
			$this->Session->setFlash(__('Voucher deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Voucher was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}

	function budgetRelease() {
		if (!empty($this->data)) {
			$this->Voucher->create();
			if ($this->Voucher->save($this->data)) {
				$this->Session->setFlash(__('The voucher has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The voucher could not be saved. Please, try again.', true));
			}
		}
		
		$this->requestAction('accounts/getBankAccounts', array("return"));
		//$vouchers = $this->Voucher->Voucher->find('list');
		$voucherTypes = $this->Voucher->VoucherType->find('list');
		$this->set(compact('vouchers', 'voucherTypes'));
	}

	function getAccountByBudgetCode($budgetCode = '') {
		$this->layout = '';
		$budgetCode = urldecode($budgetCode);
		if($budgetCode == '') {
			print_r(json_encode(array()));
		} else {
			$accounts = $this->Account->find('list', array('conditions'=>array('budget_code LIKE'=>$budgetCode.'%'), 'order' => 'account_id'));
			if(count($accounts) <= 0) {
				$accounts = $this->Account->find('list', array('conditions'=>array('account_name LIKE'=>$budgetCode.'%'), 'order' => 'account_id'));
			} 
			print_r(json_encode($accounts));
		}
	}
	
	function getAccountByBudgetCode1($budgetCode = '') {
		$this->layout = '';
		$budgetCode = urldecode($budgetCode);
		if($budgetCode == '') {
			print_r(json_encode(array()));
		} else {
			$accounts = $this->Account->find('list', array('conditions'=>array('budget_code LIKE'=>$budgetCode.'%'), 'order' => 'account_id'));
			if(count($accounts) <= 0) {
				$accounts = $this->Account->find('list', array('conditions'=>array('account_name LIKE'=>$budgetCode.'%'), 'order' => 'account_id'));
			} 
			$accountArray = array();
			foreach($accounts as $k => $v) {
				$accountArray[]['account_id'] = $k;
				$accountArray[]['account_name'] = $v;
			}
			print_r(json_encode($accountArray));
		}
	}
	
	function viewPdf($id = null)
    {
		if (!$id) {
			$this->Session->setFlash(__('Invalid voucher', true));
			$this->redirect(array('action' => 'index'));
		}
		Configure::write('debug',0); // Otherwise we cannot use this method while developing

        $id = intval($id);
        
		$vouchers = $this->Voucher->read(null, $id);
		$vouchers['Voucher']['voucher_id'] = $this->NepaliNumber->toggleNumberLang($vouchers['Voucher']['voucher_id']);
		$createdDate = $vouchers['Voucher']['created_date'];

		$createdDate = $this->NepaliCalendar->nepaliDate('Y/m/d', substr($createdDate, 0,10), 'nepali');
		$vouchers['Voucher']['created_date'] = $createdDate;
		foreach($vouchers['Transaction'] as $k => $v) {
			$accountId = $v['account_id'];
			$account = $this->Account->find('first', array('conditions' => array('account_id' => $accountId), 'fields' => array('account_name', 'budget_code')));
			$vouchers['Transaction'][$k]['account_name'] = $account['Account']['account_name'];
			$vouchers['Transaction'][$k]['budget_code'] = $account['Account']['budget_code'];
			
			if(strpos($vouchers['Transaction'][$k]['drcr'], 'Dr') !== false) {
				$vouchers['Transaction'][$k]['drcr'] = 'Dr';
			} else{
				$vouchers['Transaction'][$k]['drcr'] = 'Cr';
			}
			$vouchers['Transaction'][$k]['transaction_id'] = $this->NepaliNumber->toggleNumberLang($vouchers['Transaction'][$k]['transaction_id']);
			$vouchers['Transaction'][$k]['amount'] = $this->NepaliNumber->currency($vouchers['Transaction'][$k]['amount']);
		}
		
		$narration = explode('~', $vouchers['Voucher']['narration']);
		if(count($narration) == 2) {
			$vouchers['Voucher']['narration'] = $narration[0] . " (" . $narration[1] . ")";
			$vouchers['Voucher']['cheque_no'] = $narration[1];
		}

		$this->set('voucher', $vouchers);
		$this->layout = "";
		$this->render('view_pdf');

    }
}
?>
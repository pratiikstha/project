<?php
class TransactionsController extends AppController {

	var $name = 'Transactions';
	var $uses = array('Transaction', 'VoucherType', 'Account');

	function index() {
		$this->Transaction->recursive = 0;
		$this->set('transactions', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid transaction', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('transaction', $this->Transaction->read(null, $id));
	}

	function add($voucherId) {
		if (!empty($this->data)) {
			$successFlag = true;
			$transctionCount = $this->data['Voucher']['trans_count'];
			$this->data['Transaction']['voucher_id'] = $voucherId;
			for($i = 1; $i <= $transctionCount; $i++) {
				$amount = $this->data['Voucher']['trans_amount_' . $i];
				$this->data['Transaction']['account_id'] = $this->data['Voucher']['trans_account_id_' . $i];
				$this->data['Transaction']['drcr'] = $this->data['Voucher']['trans_drcr_' . $i];
				$this->data['Transaction']['amount'] = $this->NepaliNumber->toggleNumberLang($amount, 'english');
				$this->data['Transaction']['remarks'] = '';
				
				$this->Transaction->create();
				if (! $this->Transaction->save($this->data)) {
					$successFlag = false;
				}
			}
			return $successFlag;
		}
		$this->redirect('vouchers/add');
	}


	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid transaction', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Transaction->save($this->data)) {
				$this->Session->setFlash(__('The transaction has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The transaction could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Transaction->read(null, $id);
		}
		$vouchers = $this->Transaction->Voucher->find('list');
		$accounts = $this->Transaction->Account->find('list');
		$this->set(compact('vouchers', 'accounts'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for transaction', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Transaction->delete($id)) {
			$this->Session->setFlash(__('Transaction deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Transaction was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}

	function budgetRelease() {
		if (!empty($this->data)) {
			$this->Transaction->create();
			if ($this->Transaction->save($this->data)) {
				$this->Session->setFlash(__('The transaction has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The transaction could not be saved. Please, try again.', true));
			}
		}
		$vouchers = $this->VoucherType->find('list');
		$accounts = $this->Transaction->Account->find('list', array('conditions' => array('Account.level' => 2), 'order' => array('account_id asc')));
		$this->set(compact('vouchers', 'accounts'));
	}
}
?>
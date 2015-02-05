<?php
class VmsController extends AppController {

	var $name = 'Vms';

	function index() {
		$this->Vm->recursive = 0;
		$this->set('vms', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid vm', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('vm', $this->Vm->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Vm->create();
			if ($this->Vm->save($this->data)) {
				$this->Session->setFlash(__('The vm has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The vm could not be saved. Please, try again.', true));
			}
		}
		$districts = $this->Vm->District->find('list');
		$this->set(compact('districts'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid vm', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Vm->save($this->data)) {
				$this->Session->setFlash(__('The vm has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The vm could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Vm->read(null, $id);
		}
		$districts = $this->Vm->District->find('list');
		$this->set(compact('districts'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for vm', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Vm->delete($id)) {
			$this->Session->setFlash(__('Vm deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Vm was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
?>
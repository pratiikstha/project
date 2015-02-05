<?php
class ProjectContractorsController extends AppController {

	var $name = 'ProjectContractors';

	function index() {
		$this->ProjectContractor->recursive = 0;
		$this->set('projectContractors', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid project contractor', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('projectContractor', $this->ProjectContractor->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->ProjectContractor->create();
			if ($this->ProjectContractor->save($this->data)) {
				$this->Session->setFlash(__('The project contractor has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The project contractor could not be saved. Please, try again.', true));
			}
		}
		$projects = $this->ProjectContractor->Project->find('list');
		$personalAccounts = $this->ProjectContractor->PersonalAccount->find('list');
		$this->set(compact('projects', 'personalAccounts'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid project contractor', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->ProjectContractor->save($this->data)) {
				$this->Session->setFlash(__('The project contractor has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The project contractor could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->ProjectContractor->read(null, $id);
		}
		$projects = $this->ProjectContractor->Project->find('list');
		$personalAccounts = $this->ProjectContractor->PersonalAccount->find('list');
		$this->set(compact('projects', 'personalAccounts'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for project contractor', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->ProjectContractor->delete($id)) {
			$this->Session->setFlash(__('Project contractor deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Project contractor was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}

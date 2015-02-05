<?php
class DistrictsController extends AppController {

	var $name = 'Districts';
	var $components = array('RequestHandler');
	var $paginate = array('limit'=>'10');

	function index() {
		$this->District->recursive = 0;
		$this->District->order = 'district_id ASC';
		$this->set('districts', $this->paginate());
		if ($this->RequestHandler->isAjax()) {
			$this->render('/elements/districts/paging');
		}
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid district', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('district', $this->District->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->District->create();
			if ($this->District->save($this->data)) {
				$this->Session->setFlash(__('The district has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The district could not be saved. Please, try again.', true));
			}
		}
		$zones = $this->District->Zone->find('list');
		$this->set(compact('zones'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid district', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->District->save($this->data)) {
				$this->Session->setFlash(__('The district has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The district could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->District->read(null, $id);
		}
		$zones = $this->District->Zone->find('list');
		$this->set(compact('zones'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for district', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->District->delete($id)) {
			$this->Session->setFlash(__('District deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('District was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
?>
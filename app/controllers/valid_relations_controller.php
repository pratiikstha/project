<?php
class ValidRelationsController extends AppController {

	var $name = 'ValidRelations';

	function index() {
		$this->ValidRelation->recursive = 0;
		$this->set('validRelations', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid valid relation', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('validRelation', $this->ValidRelation->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->ValidRelation->create();
			if ($this->ValidRelation->save($this->data)) {
				$this->Session->setFlash(__('The valid relation has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The valid relation could not be saved. Please, try again.', true));
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid valid relation', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->ValidRelation->save($this->data)) {
				$this->Session->setFlash(__('The valid relation has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The valid relation could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->ValidRelation->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for valid relation', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->ValidRelation->delete($id)) {
			$this->Session->setFlash(__('Valid relation deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Valid relation was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
?>
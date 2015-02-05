<?php
class ProjectDetailsController extends AppController {

	var $name = 'ProjectDetails';

	function index() {
		$this->ProjectDetail->recursive = 0;
		$this->set('projectDetails', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid project detail', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('projectDetail', $this->ProjectDetail->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->ProjectDetail->create();
			if ($this->ProjectDetail->save($this->data)) {
				$this->Session->setFlash(__('The project detail has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The project detail could not be saved. Please, try again.', true));
			}
		}
		$projects = $this->ProjectDetail->Project->find('list');
		$this->set(compact('projects'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid project detail', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->ProjectDetail->save($this->data)) {
				$this->Session->setFlash(__('The project detail has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The project detail could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->ProjectDetail->read(null, $id);
		}
		$projects = $this->ProjectDetail->Project->find('list');
		$this->set(compact('projects'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for project detail', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->ProjectDetail->delete($id)) {
			$this->Session->setFlash(__('Project detail deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Project detail was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}

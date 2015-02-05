<?php
class PermissionsController extends AuthakeAppController {
	var $name = 'Permissions';
	var $paginate = array(
            'limit' => 100000,
            'order' => array(
                'Permission.id' => 'asc'
            )
        );
	//var $layout = 'authake';
    
    var $uses = array('Authake.Permission');

	function index($tableonly = false) {
		$this->Permission->recursive = 0;
		$this->set('authakePermissions', $this->paginate());
		$this->set('tableonly', $tableonly);
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid authake permission', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('authakePermission', $this->Permission->read(null, $id));
	}

	function add() {
		$this->_getControllerActions();
		if (!empty($this->data)) {
			$this->Permission->create();
			if ($this->Permission->save($this->data)) {
				$this->Session->setFlash(__('The authake permission has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The authake permission could not be saved. Please, try again.', true));
			}
		}
		//print_r($action);
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid authake permission', true));
			$this->redirect(array('action' => 'index'));
		}
		$controllers = $this->_getControllerActions();
		
		if (!empty($this->data)) {
			if ($this->Permission->save($this->data)) {
				$this->Session->setFlash(__('The authake permission has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The authake permission could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Permission->read(null, $id);
			//print_r($controllers[]);
			$currentControl = $this->data['Permission']['controller'];
			$currentActions = array();
			foreach($controllers[$currentControl] as $v) {
				$currentActions[$v] = $v;
			}
			$this->set('currentActions', $currentActions);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for authake permission', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Permission->delete($id)) {
			$this->Session->setFlash(__('Authake permission deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Authake permission was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
	
	function _getControllerActions() {
		$controllers = $this->Authake->_getControllers();
		foreach($controllers as $control => $actionArray) {
			$acts = array();
			foreach($actionArray as $k => $actions){
				$acts[] = $actions; 
			}
			$action[$control] = $acts;
			$controls[$control] = $control; 
		}

		$this->set('controllers', $controls);
		$this->set('actions', $action);
		return $controllers;
	}
}
?>
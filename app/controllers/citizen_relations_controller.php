<?php
class CitizenRelationsController extends AppController {

	var $name = 'CitizenRelations';
	var $uses = array('CitizenRelation', 'ValidRelation', 'Citizen');

	function index() {
		$this->CitizenRelation->recursive = 0;
		$relation_by = $this->CitizenRelation->query("select citizen_relation_id, citizen_relations.ssn_no, relative, relation_name, citizen_relations.relation_id, first_name, last_name from citizen_relations, citizens, valid_relations where citizens.ssn_no = citizen_relations.ssn_no and citizen_relations.relation_id = valid_relations.relation_id;
		");
		$relative = $this->CitizenRelation->query("select first_name as first_relation, last_name as last_relation from citizens, citizen_relations where citizens.ssn_no=citizen_relations.relative");

		foreach($relative as $key => $value):
			foreach ($value as $k => $val):
				$relation_by[$key][$k]['first_relation'] = $val['first_relation'];
				$relation_by[$key][$k]['last_relation'] = $val['last_relation'];
			endforeach;
		endforeach;
		$this->set('relationby', $relation_by);
		//print_r($this->paginate('CitizenRelation'));
		//$this->set('citizenRelations', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid citizen relation', true));
			$this->redirect(array('action' => 'index'));
		}
		$citizenName = $this->CitizenRelation->read(null, $id);
		$citizenNo = $citizenName['CitizenRelation']['ssn_no'];
		$citizenRelative = $citizenName['CitizenRelation']['relative'];
		$relation_by = $this->CitizenRelation->query("select first_name, last_name from citizens where citizens.ssn_no = $citizenNo");
		$relative = $this->CitizenRelation->query("select first_name, last_name from citizens where citizens.ssn_no = $citizenRelative");
		$this->set('relationby', $relation_by);
		$this->set('relative', $relative);
		$this->set('citizenRelation', $this->CitizenRelation->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->CitizenRelation->create();
			if ($this->CitizenRelation->save($this->data)) {
				$this->Session->setFlash(__('The citizen relation has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The citizen relation could not be saved. Please, try again.', true));
			}
		}
		$relations = $this->ValidRelation->find('list');
		$this->set(compact('relations'));

		$ssnNos = $this->Citizen->find('list');
		$this->set(compact('ssnNos'));
		$relatives = $this->Citizen->find('list');
		$this->set(compact('relatives'));
		/*$ssnNos = $this->Citizen->find('all', array('fields'=> 'Citizen.ssn_no, Citizen.citizenship_no'));
		print_r($ssnNos);
		$relationIds = $this->Citizen->find('all', array('fields'=> 'Citizen.ssn_no, Citizen.citizenship_no'));
		$this->set(compact('ssnNos', 'relationIds'));*/
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid citizen relation', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			$this->data['CitizenRelation']['relation_id'] = $this->data['CitizenRelation']['relation'];
			if ($this->CitizenRelation->save($this->data)) {
				$this->Session->setFlash(__('The citizen relation has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The citizen relation could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->set('CitizenRelation', $this->CitizenRelation->read(null, $id));
			$this->data = $this->CitizenRelation->read(null, $id);
		}
		$ssnNos = $this->CitizenRelation->SsnNo->find('list');
		$relatives = $this->CitizenRelation->SsnNo->find('list');
		
		$this->set('ssnNo', $ssnNos);
		$this->set('relative', $relatives);
		$relations = $this->ValidRelation->find('list');
		$this->set('relation_id', $relations);
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for citizen relation', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->CitizenRelation->delete($id)) {
			$this->Session->setFlash(__('Citizen relation deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Citizen relation was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
?>
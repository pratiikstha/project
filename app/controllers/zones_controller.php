<?php
class ZonesController extends AppController {

	var $name = 'Zones';
	var $components = array('NepaliCalendar');

	function index() {
		echo "<h1>Eng to Nepali" . $this->NepaliCalendar->convertEngNumberToNepaliNumber('123123') . "</h1>";
		echo "<h1>Nep to English" . $this->NepaliCalendar->convertNepaliNumberToEnglishNumber('१२३४५६७८९०') . "</h1>";
		$this->Zone->recursive = 0;
		$this->Zone->order = 'zone_id ASC';
		$this->set('zones', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid zone', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('zone', $this->Zone->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Zone->create();
			if ($this->Zone->save($this->data)) {
				$this->Session->setFlash(__('The zone has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The zone could not be saved. Please, try again.', true));
			}
		}
		$regions = $this->Zone->Region->find('list');
		$this->set(compact('regions'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid zone', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Zone->save($this->data)) {
				$this->Session->setFlash(__('The zone has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The zone could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Zone->read(null, $id);
		}
		$regions = $this->Zone->Region->find('list');
		$this->set(compact('regions'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for zone', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Zone->delete($id)) {
			$this->Session->setFlash(__('Zone deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Zone was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
?>
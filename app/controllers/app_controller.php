<?php
class AppController extends Controller {

	var $components = array('Authake.Authake', 'Session', 'NepaliCalendar', 'NepaliNumber', 'AppFunction');
    var $helpers = array('Html', 'Form','Authake.Authake', 'Javascript', 'NepaliCalendar', 'NepaliNumber', 'NumberToWord', 'AppFunction');

    function beforeFilter() {
    	$this->checkInstall();
		$this->auth();
		parent::beforeFilter();
	}
	
	function checkInstall() {
		if(file_exists(INSTALL_FILE_PATH)) {
			if(GOVT_TYPE == 0) {
				//$this->Account->setSource('v_accounts');
			} else if(GOVT_TYPE == 1) {
				//$this->Account->setSource('m_accounts');
			}
			return true;
		} else {
			$this->redirect('/installations/add');
		}
	}

	private function auth() {
		Configure::write('Authake.useDefaultLayout', true);
		$this->Authake->beforeFilter($this);
	}
	
	protected function setNepaliDateParam() {
		$today = $this->NepaliCalendar->nepaliDate('Y-m-d');
		$currentDates = explode('-', $today);

		$minYear = $currentDates[0]-1;
		$maxYear = $currentDates[0]+1;
		$years = array();
		for($i = $minYear; $i <= $maxYear; $i++){
			$years[$i] = $this->NepaliNumber->toggleNumberLang($i);
		}
		$this->set('years', $years);
		
		$monthNames = $this->NepaliCalendar->getNepaliMonthNames();
		$this->set('months', $monthNames);

		for($i = 1; $i <= 32; $i++){
			$days[sprintf('%02d', $i)] = $this->NepaliNumber->toggleNumberLang(sprintf('%02d', $i));
		}
		$this->set('days', $days);

		if(!isset($this->data['created_date']['Y'])) {
			$this->set('selectedYear', $currentDates[0]);
		} else {
			$this->set('selectedYear', $this->data['created_date']['Y']);
		}

		if(!isset($this->data['created_date']['m'])) {
			$this->set('selectedMonth', $currentDates[1]);
		} else {
			$this->set('selectedMonth', $this->data['created_date']['m']);
		}

		if(!isset($this->data['created_date']['d'])) {
			$this->set('selectedDay', $currentDates[2]);
		} else {
			$this->set('selectedDay', $this->data['created_date']['d']);
		}
	}

	function callError() {
		$this->Session->setFlash(__('Not valid User to access this function', true));
		$this->redirect('/');
	}
	
	function getNameFromSsnNo($ssnNo) {
		if($ssnNo == 0) {
			return "ADMIN";
		}
		App::import('Controller', 'Citizens');
		$Citizens = new CitizensController;
		//Load model, components...
		$Citizens->constructClasses();
		$personName = $Citizens->getPersonInfoBySsnNo($ssnNo);
		
		return $personName;
	}
	
	
}
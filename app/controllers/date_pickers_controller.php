<?php
class DatePickersController extends AppController {

	var $name = 'DatePickers';
	var $uses = array();
	var $layout = '';
	var $calArray = array();

	function index($year = null, $month = null, $callFromElement = null){

		if ($year == null) {
			$year = $this->NepaliCalendar->nepaliDate('Y', date('Y-m-d'));
		}
		if ($month == null) {
			$month = $this->NepaliCalendar->nepaliDate('m', date('Y-m-d')); 
		}
		if ($callFromElement == null ) {
			$callFromElement = 0;
		}
		$monthArray = $this->NepaliCalendar->getMonthArray($year, $month);
		$startDayOfMonth = date('w', strtotime($monthArray[0]));
		list($prevYear, $prevMonth) = $this->NepaliCalendar->getPreviousYearMonth($year, $month);
		list($nextYear, $nextMonth) = $this->NepaliCalendar->getNextYearMonth($year, $month);
		
		$this->_resetCalArray();
		$count = 0;
		for ($i = 0; $i < 5; $i++) {
			for ($j = 0; $j < 7; $j++) {
				if ($i == 0 && $j < $startDayOfMonth){
					continue;
				}
				if (isset($monthArray[$count])) {
					$this->calArray[$i][$j]['english_date'] = $monthArray[$count];
					$this->calArray[$i][$j]['nepali_date'] = ++$count;
				} else {
					break;
				}
			}
		}
		
		$this->set('year',  $this->NepaliNumber->precision($year, 0));
		$this->set('month',  $this->NepaliCalendar->getNepaliMonthName($month));
		$this->set('monthInNumber',  $this->NepaliNumber->toggleNumberLang($month, 'nepali'));
		$this->set('eleName', $callFromElement);
		$this->set('prevYear',  $prevYear);
		$this->set('prevMonth', $prevMonth);
		$this->set('nextYear',  $nextYear);
		$this->set('nextMonth', $nextMonth);
		$this->set('calendar',  $this->calArray);
	}

	function _resetCalArray() {
		for ($i = 0; $i < 5; $i++) {
			for ($j = 0; $j < 7; $j++) {
				$this->calArray[$i][$j]['english_date'] = '';
				$this->calArray[$i][$j]['nepali_date'] = '';
			}
		}
	}
}
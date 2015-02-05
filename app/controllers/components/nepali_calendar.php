<?php

/**
 * Nepali Calendar Component
 * @author Rubim Shrestha
 * 
 * English Date to Nepali Date Conversion
 * Nepali Date To English Date Conversion
 * 
 * Display Nepali Year Calendar for Select Year and Month
 * 
 */
class NepaliCalendarComponent extends Object {

	var $components = array('NepaliNumber');
	
	var $nepaliMonthName = array (
									'01'  => array ('english' => 'Baishak', 'engMon' => 'Apr-May',  'nepali' => 'बैशाख'),
									'02'  => array ('english' => 'Jestha',  'engMon' => 'May-Jun',  'nepali' => 'जेष्ठ'),
									'03'  => array ('english' => 'Ashar',   'engMon' => 'Jun-Jul',  'nepali' => 'असार'),
									'04'  => array ('english' => 'Shrawan', 'engMon' => 'Jul-Aug',  'nepali' => 'श्रावण'),
									'05'  => array ('english' => 'Bharda',  'engMon' => 'Aug-Sep',  'nepali' => 'भाद्र'),
									'06'  => array ('english' => 'Asoj',    'engMon' => 'Sep-Oct',  'nepali' => 'असोज'),
									'07'  => array ('english' => 'Kartik',  'engMon' => 'Oct-Nov',  'nepali' => 'कार्तिक'),
									'08'  => array ('english' => 'Mangsir', 'engMon' => 'Nov-Dec',  'nepali' => 'मंसिर'),
									'09'  => array ('english' => 'Poush',   'engMon' => 'Dec-Jan',  'nepali' => 'पौष'),
									'10'  => array ('english' => 'Magh',    'engMon' => 'Jan-Feb',  'nepali' => 'माघ'),
									'11'  => array ('english' => 'Falgun',  'engMon' => 'Feb-Mar',  'nepali' => 'फागुन'),
									'12'  => array ('english' => 'Chatira', 'engMon' => 'Mar-Apr',  'nepali' => 'चैत्र')
	);

	var $nepaliWeekDayName = array (
									'0'  => array ('english' => 'Sunday',    'nepali' => 'आइतबार',  'nepali_short' => 'आइत'),
									'1'  => array ('english' => 'Monday',    'nepali' => 'सोमबार',  'nepali_short' => 'सोम'),
									'2'  => array ('english' => 'Tuesday',   'nepali' => 'मंगलबार',  'nepali_short' => 'मंगल'),
									'3'  => array ('english' => 'Wednesday', 'nepali' => 'बुधबार',   'nepali_short' => 'बुध'),
									'4'  => array ('english' => 'Thursday',  'nepali' => 'बिहीबार',   'nepali_short' => 'बिही'),
									'5'  => array ('english' => 'Friday',    'nepali' => 'शुक्रबार',   'nepali_short' => 'शुक्र'),
									'6'  => array ('english' => 'Saturday',  'nepali' => 'शनिबार',   'nepali_short' => 'शनि'),
	);
	
	function getDateObject($date, $type) {
		//echo $date;
		//echo "<br>";
		$ADBS = ($type == 'english') ? 'AD' : 'BS';
		$lookdir = ($type == 'english') ? 'engDate' : 'nepDate';
		$className = 'Year' . substr($date,0,4). $ADBS;
		//echo $className;
		//echo "<br>";
		$path = VENDORS . 'conversion' . DS . $lookdir . DS . $className . '.php';
		//echo $path;
		if (file_exists($path)) {
			require_once $path;
			$obj = new $className();
			return $obj;
		}
	}

	function getConvertedDate($date, $type) {
		//$date = $this->NepaliNumber->toggleNumberLang($date,)
		
		$obj = $this->getDateObject($date, $type);
		return $obj->getDate($date);
	}

	function convertToNepaliDate($date, $formatDate = false) {
		$date = substr($date, 0, 10);
		$convertedDate = $this->getConvertedDate($date, 'english');
		$returnDate = '';
		if ($formatDate === true) {
			$returnDate = $this->formatNepaliDate($convertedDate, $format);
		} else {
			$returnDate = substr($convertedDate, 0, 10);
		}
		return $returnDate;
	}

	function convertToEnglishDate($date, $formatDate = false) {
		//$date = $this->NepaliNumber->toggleNumberLang($date, 'english');
		//print $date;
		$temp = str_replace('-', '', $date);
		if (!is_numeric($temp)) {
			$date = $this->NepaliNumber->toggleNumberLang($date, 'english');
		}
	    $date = mb_substr($date, 0, 10, 'UTF-8');
	//	print $date;
		$convertedDate = $this->getConvertedDate($date, 'nepali');
		$returnDate = '';
		if ($formatDate === true) {
			$returnDate = $this->formatNepaliDate($convertedDate, $format);
		} else {
			$returnDate = substr($convertedDate, 0, 10);
		}
		return $returnDate;
	}

	function formatNepaliDate($date, $format = 'default') {
		list($y, $m, $d, $w) = explode("-", $date);
		
		$y = $this->NepaliNumber->precision($y, 0);
		$m = $this->NepaliNumber->precision(sprintf("%02d", $m), 0);
		$d = $this->NepaliNumber->precision(sprintf("%02d", $d), 0);

		$retDateStr = '';

		if ($format == 'default') {
			$retDateStr = $y . '/' . $m . '/' . $d;
		} elseif ($format == 'm/d') {
			$retDateStr = $m . '/' . $d;
		}
	 	
	 	return $retDateStr;  
	}

	function formatEnglishDate($date, $format = 'default') {
		list($y, $m, $d, $w) = explode("-", $date);
	 	$retDateStr = $y . ' - ' . $m . ' - ' . $d;
	 	return $retDateStr;
	}

	function getMonthArray($year, $month, $weekDays = false) {
		$obj = $this->getDateObject($year, 'nepali');

		$yrDateArray = $obj->getDateArray();

		$pattern =  "/^" . $year . '-' . sprintf('%02d', $month) . '-(0[1-9]|[12][0-9]|3[012])$/';
		$monthArr = array();
		foreach ($yrDateArray as $k => $v) {
			if (preg_match($pattern, $k)) {
				if($weekDays === false) {
					$monthArr[] = substr($v, 0, 10);
				} else {
					$monthArr[] = $v;
				}
			}
		}
		return $monthArr;
	}

	function getFirstDayOfNepaliMonthInEnglish($year, $month) {
		$retArr = $this->getMonthArray($year, $month);
		return $retArr[0];
	}

	function getLastDayOfNepaliMonthInEnglish($year, $month) {
		$retArr = $this->getMonthArray($year, $month);
		$reverseArray = array_reverse($retArr);
		return $reverseArray[0];
	}

	function getFiscalYear($year, $month) {
		$fyStartYear = $year;
		$fyEndYear = $year;
		if (intVal($month) <= 3) {
			$fyStartYear= intVal($year) - 1;
		} else {
			$fyEndYear = intVal($year) + 1;
		}
		$retFYArray = array();
		$retFYArray['fiscal_year_start_date'] = $this->getFirstDayOfNepaliMonthInEnglish($fyStartYear, '04');
		$retFYArray['fiscal_year_end_date']  = $this->getLastDayOfNepaliMonthInEnglish($fyEndYear, '03');

		return $retFYArray;
	}
	
	function getCurrentFiscalYear() {
		$currYear  = $this->nepaliDate('Y');
		$currMonth = $this->nepaliDate('m');
		return $this->getFiscalYear($currYear, $currMonth);
	}

	function getPreviousFiscalYear() {
		$currYear  = $this->nepaliDate('Y');
		$currMonth = $this->nepaliDate('m');
		return $this->getFiscalYear((intVal($currYear) - 1), $currMonth);
	}

	function getPreviousMonthStartEndDate() {
		$year = $this->nepaliDate('Y');
		$month = intVal($this->nepaliDate('m') -1 );
		if (intVal($month) == 0) {
			$year = intVal($year) - 1;
			$month = '12';
		}
		return $this->getFirstAndLastDateOfMonthInEnglish($year, $month);
	}

	function getCurrentMonthStartEndDate(){
		$year = $this->nepaliDate('Y');
		$month = $this->nepaliDate('m');
		return $this->getFirstAndLastDateOfMonthInEnglish($year, $month);
	}

	function getNextMonthStartEndDate() {
		$year = $this->nepaliDate('Y');
		$month = intVal($this->nepaliDate('m') + 1 );
		if (intVal($month) == 13) {
			$year = intVal($year) + 1;
			$month = '01';
		}
		return $this->getFirstAndLastDateOfMonthInEnglish($year, $month);
	}

	function getFirstAndLastDateOfMonthInEnglish($year, $month) {
		$retDateArray = array();
		$retDateArray['start_date'] = $this->getFirstDayOfNepaliMonthInEnglish($year, $month);
		$retDateArray['end_date']  = $this->getLastDayOfNepaliMonthInEnglish($year, $month);

		return $retDateArray;
	}

	function nepaliDate($format = "Y-m-d" , $date = null, $lang = 'english') {
		if ($date == null) {
			$date = date('Y-m-d');
		}
		$convertedDate = $this->getConvertedDate($date, 'english');
		list($yr, $mon, $dt, $wkd) = explode("-", $convertedDate);
		/* list of format words*
		 * Day
		 * d: Day of the month, 2 digits with leading zeros (i.e. 01 to 32)
		 * D: A textual representation of a day, three letters (i.e. Mon through Sun)
		 * j: Day of the month without leading zeros (i.e. 1 to 32)
		 * l: A full textual representation of the day of the week (i.e. Sunday to Friday)
		 * Month
		 * F: A full textual representation of a month, such as Baishak to Chaitra
		 * m: Numeric representation of a month, with leading zeros (i.e. 01 to 12)
		 * n: Numeric representation of a month, without leading zeros (i.e. 1 to 12)
		 * t: Number of days in the given month (29 through 32)
		 * Year
		 * Y: A full numeric representation of a year, 4 digits (i.e. 1999 or 2003)
		 * y: A two digit representation of a year (i.e. 99 or 03)
		 */

		//DAY
		$d = sprintf('%02d', $dt);
		if ($lang == 'nepali') {
			$D = sprintf('%s', $this->nepaliWeekDayName[$wkd]['nepali_short']);
		} else {
			$D = sprintf('%s', substr($this->nepaliWeekDayName[$wkd]['english'], 0, 3));
		}
		$j = sprintf('%d', intVal($dt));
		$l = sprintf('%s', $this->nepaliWeekDayName[$wkd][$lang]);

		//MONTH
		$F = sprintf('%s', $this->nepaliMonthName[$mon][$lang]);
		$m = sprintf('%02d', $mon);
		$n = sprintf('%d', intVal($mon));
		$t = sprintf('%d', count($this->getMonthArray($yr, $mon)));

		//YEAR
		$Y = sprintf('%d', $yr);
		$y = sprintf('%d', substr($yr, 2, 4));

		$search = array();

		//DAY
		$search[] = '/d/';
		$search[] = '/j/';

		//MONTH
		$search[] = '/m/';
		$search[] = '/n/';
		$search[] = '/t/';

		//YEAR
		$search[] = '/Y/';
		$search[] = '/y/';

		$search[] = '/D/';
		$search[] = '/l/';
		$search[] = '/F/';

		$replacement = array();
		
		//DAY
		$replacement[] = $d;
		$replacement[] = $j;

		//MONTH
		$replacement[] = $m;
		$replacement[] = $n;
		$replacement[] = $t;

		//YEAR
		$replacement[] = $Y;
		$replacement[] = $y;

		$replacement[] = $D;
		$replacement[] = $l;
		$replacement[] = $F;

		$count = 0;
		$retDateStr = preg_replace($search, $replacement, $format);
		if ($lang == 'nepali') {
			$retDateStr = $this->NepaliNumber->toggleNumberLang($retDateStr, 'nepali', 'other');
		}
		return $retDateStr;
	}

	function getPreviousYearMonth($year = null, $month = null) {
		if ($year == null) {
			$year = $this->nepaliDate('Y');
		}

		if ($month == null) {
			$month = $this->nepaliDate('m');
		}

		if ($month == 1) {
			$year = $year - 1;
			$month = 12;
		} else {
			$month = $month - 1;
		}

		return array($year, sprintf("%02d", $month));
	}

	function getNextYearMonth($year = null, $month = null) {
		if ($year == null) {
			$year = $this->nepaliDate('Y');
		}

		if ($month == null) {
			$month = $this->nepaliDate('m');
		}

		if ($month == 12) {
			$year = $year + 1;
			$month = 1;
		} else {
			$month = $month + 1;
		}

		return array($year, sprintf("%02d", $month));
	}
	
	function getNepaliMonthName($month) {
		return $this->nepaliMonthName[$month]['nepali'];
	}
	
	function getNepaliMonthNames($index = 'nepali') {
		$monthNames = array();
		foreach($this->nepaliMonthName as $k => $v) {
			$monthNames[$k] = $v[$index];
		}
		return $monthNames;
	}
}
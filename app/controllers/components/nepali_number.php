<?php

/**
 * Nepali Number Component
 * @author Rubim Shrestha
 * 
 */
class NepaliNumberComponent extends Object {

	var $components = array('Number');

	var $nepaliLetters = array (
									'0' => '०',
									'1' => '१',
									'2' => '२',
									'3' => '३',
									'4' => '४',
									'5' => '५',
									'6' => '६',
									'7' => '७',
									'8' => '८',
									'9' => '९',
									'.' => '.',
									',' => ',',
									'-' => '-',
									'/' => '/',
									'%' => '%',
									'०' => '0',
									'१' => '1',
									'२' => '2',
									'३' => '3',
									'४' => '4',
									'५' => '5',
									'६' => '6',
									'७' => '7',
									'८' => '8',
									'९' => '9',
								);
	var $numberArray = array (
										
								);
	function precision($number, $precision = 2) {
		$num = sprintf("%02d", $this->Number->precision($number, $precision));
		return $this->toggleNumberLang($num);
	}

	function toPercentage($number, $precision = 2) {
		return $this->toggleNumberLang($this->Number->toPercentage($number, $precision));
	}

	function format($number, $options = false) {
		return $this->Number->format($number, $option);
	}

	function currency($number, $precision = 2, $prefix = false) {
		$number = $this->Number->precision($number, $precision);
		$patterns = "/(\d+?)(?=(\d\d)+(\d)(?!\d))(\.\d+)?/";
		$replace = "\\1,";
		$number = preg_replace($patterns, $replace, $number);
		$retCurrencyStr = $this->toggleNumberLang(preg_replace($patterns, $replace, $number), 'nepali', 'currency');
		if ($precision == 0) {
			$retCurrencyStr .= "/-";
		} else {
			$retCurrencyStr = str_replace(".", "/", $retCurrencyStr);
		}
		if ($prefix === true) {
			$retCurrencyStr =  "रू." . $retCurrencyStr;
		} 
		return $retCurrencyStr;
	}

	function convertToNepaliNum($value) {
		$string = strVal($value);
		$nr = 0;
		$retArr = array();
		while (isset($string{$nr})) {
			$retArr[$nr] = $this->nepaliLetters[$string{$nr}];
			$nr++;
		} 
		return implode('', $retArr);
	}

	function toggleNumberLang($value, $convertTo = 'nepali', $type = 'number') {
		if ($type == 'number') {
			if ($convertTo == 'english') {
				if(is_numeric($value)) {
					return $value;
				}
			} else if ($convertTo == 'nepali') {
				if(!is_numeric($value)) {
					return $value;
				}
			}
		}
		
		$retArr = array();
		
		$npNumArray = (preg_split('/(?<!^)(?!$)/u', $value)); 
		foreach($npNumArray as $k => $v) {
			if (array_search($v, $this->nepaliLetters) !== false) {
				$retArr[] = $a = array_search($v, $this->nepaliLetters);
			} else {
				$retArr[] = $v;
			}
		}
		return implode('', $retArr);
	}
}
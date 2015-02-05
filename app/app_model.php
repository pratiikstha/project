<?php
class AppModel extends Model {

	function validateNullByte($field = array()) {
		foreach ($field as $k) {
			$k = addslashes($k);
			if (strpos($k, "%00") !== false || strpos($k, '\0') !== false || strpos($k, '\x00') !== false) {
				return false;
			} else {
				return true;
			}
		}
	}

	function validateSpaceOnly($field = array()) {
		foreach ($field as $name => $value) {
			if(mb_ereg_match("^(\s|　)+$", $value)) {
				return false;
			} else {
				return true;
			}
		}
	}
	
	function validateNumber($field = array()) { 
		print "validating";
		foreach($field as $k) {
			if(is_numeric($k)){
				print "true";
				return true;
			}
			foreach($k as $char) {
				$charHex = '0x0' . dechex($this->mb_ord($char));
				if(($charHex >= 0x0966 && $charHex <= 0x096f) || $charHex == 0x02e) {
					continue;
				} else {
					print "false";
					return false;
				}
			}
			print "true1";
			return true;
		}
	}
}
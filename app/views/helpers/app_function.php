<?php

class AppFunctionHelper extends Object {

	var $helpers = array('Authake.Authake');

	function checkAdminOrSelf($id, $type = 'ssn_no') {
		$sessionUserId = $this->Authake->getUserId();
		$sessionVal = '';
		if($type != 'ssn_no') {
			$sessionVal = $sessionUserId;
		} else {
			$sessionVal = $this->Authake->getSsnNo();
		}
		if( $sessionUserId == 1 || ($sessionVal == $id)) {
			return true;
		}
		return false;
	}
	
	
	
}
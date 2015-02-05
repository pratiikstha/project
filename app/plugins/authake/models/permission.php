<?php
/*
    This file is part of Authake.

    Author: Rekha Adhikari
    Contributors:

    Authake is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    Authake is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with Foobar.  If not, see <http://www.gnu.org/licenses/>.
*/


class Permission extends AuthakeAppModel {
    var $name = 'Permission';
    var $useTable = "authake_permissions";
    var $useDbConfig = 'authake';
	var $validate = array(
		'controller' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'action' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);
    
    

    function getPermissions() {
    	
    	$fields = array('controller', 'action', 'groups', 'allow_persons', 'deny_persons');
    	$order = 'id asc';

    	$accessArray = array();
    	
    	$result = $this->find('all', array('conditions'=>'', 'fields'=>$fields, 'order'=>$order));
        foreach($result as $k => $permission) {
        	extract($permission['Permission']);
			if(isset($groups) && $groups != '' && isset($allow_persons) && $allow_persons != '' && isset($deny_persons) && $deny_persons != '') {
        		$accessArray[$controller][$action] = 0;
        	} else {
        		$allowedGroupArray = array();
        		if(isset($groups) && $groups != '') {
        			$allowedGroupArray = explode(',',$groups);
        		}
        		
        		$allowedPersonArray = array();
        		if(isset($allow_persons) && $allow_persons != '') {
        			$allowedPersonArray = explode(',',$allow_persons);
        		}
        		
        		$deniedPersonArray = array();
        		if(isset($deny_persons) && $deny_persons != '') {
        			$deniedPersonArray = explode(',',$deny_persons);
        		}

        		$actionArray = array("groups" => $allowedGroupArray, "allow" => $allowedPersonArray, "deny" => $deniedPersonArray);
				$accessArray[$controller][$action] = $actionArray;
        	}
        }
		return $accessArray;
    }

}
?>
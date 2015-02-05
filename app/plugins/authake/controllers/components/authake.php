<?php
/*
    This file is part of Authake.

    Author: Jérôme Combaz (jakecake/velay.greta.fr)
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

class AuthakeComponent extends Object {
  
    var $components = array('Session');
    
    var $_forward = null;
    var $_flashmessage = '';
    
    function startup(&$controller = null) {
        /**
        * AUTHAKE CONFIGURATION
        * All these changes can be overrided in AppController->beforeFilter action
        */
        
        /**
        * Base URL, used to insert the application URL in mails.
        */
        if(Configure::read('Authake.baseUrl') == null){
            Configure::write('Authake.baseUrl', Router::getInstance()->url('/', true));   // set the full application url
        }
        if(Configure::read('Authake.service') == null){
            Configure::write('Authake.service', 'Authake'); //Name of the service i.e. "Super Authake"
        }
        /**
        * Default login action
        */
        if(Configure::read('Authake.loginAction') == null){
            Configure::write('Authake.loginAction', array('plugin'=>'authake', 'controller'=>'user', 'action'=>'login'));
        }
        /**
         * Used to redirect the users if the current user is logged out. Basically, this
         * is used in case when The login page is the home page. If this is not set to different location, then it's going into recursion.
        */
        if(Configure::read('Authake.loggedAction') == null){
            Configure::write('Authake.loggedAction', array('plugin'=>'authake', 'controller'=>'users', 'action'=>'index'));
        }
        /**
        * Session timeout in seconds, if managed by Authake (or null to disable)
        */
        //if(Configure::read('Authake.sessionTimeout') == null){
        //    Configure::write('Authake.sessionTimeout', null);
        //}
        /**
        * Default page when access is denied (should be allowed by ACLs...)
        */
        if(Configure::read('Authake.defaultDeniedAction') == null){
            Configure::write('Authake.defaultDeniedAction', array('plugin'=>'authake', 'controller'=>'user', 'action'=>'denied'));
        }
        /**
        * Reload all rules every x seconds
        */
        if(Configure::read('Authake.rulesCacheTimeout') == null){
            Configure::write('Authake.rulesCacheTimeout', 300);
        }
    	/**
        * Reload all permissions every x seconds
        */
        if(Configure::read('Authake.permissionsCacheTimeout') == null){
            Configure::write('Authake.permissionsCacheTimeout', 300);
        }
        /**
        * Email which sends the system mails
        */
        if(Configure::read('Authake.systemEmail') == null){
            Configure::write('Authake.systemEmail', 'Cake Test Account <noreply@example.com>');
        }
        if(Configure::read('Authake.systemReplyTo') == null){
            Configure::write('Authake.systemReplyTo', 'noreply@example.com');
        }
        /**
        * User need to authenticate that he requested the password change
        * (by receiving the confirmation link at his e-mail)
        */
        if(Configure::read('Authake.passwordVerify') == null){
            Configure::write('Authake.passwordVerify', true);
        }
        /**
        * Users can register
        */
        if(Configure::read('Authake.registration') == null){
            Configure::write('Authake.registration', false); //or false
        }
        /**
        * Default group for registered users
        * If set registered user will be inserted into specified group
        */
        if(Configure::read('Authake.defaultGroup') == null){
            Configure::write('Authake.defaultGroup', false); //could be array or single number
        }
        /**
        * Skip using authake layout for User controller.
        * This is used to display default layout of the application to actions
        * like login, register, change password etc.
        */
        if(Configure::read('Authake.useDefaultLayout') == null){
            Configure::write('Authake.useDefaultLayout', false); //could be true or false
        }
        
    	if(Configure::read('Authake.accessStorage') == null){
            Configure::write('Authake.accessStorage', 'DB'); //or FILE for csv file
            //in case of FILE
            //Configure::write('Authake.accessStorageFile', "app/config/access.csv");
        }
    }

    function beforeFilter(&$controller) { //pr($this);
        
        //Getting vars
        $this->startup();
        //$accessArray = $this->getPermissions();

        // get action path
        // used when the action is called through requestAction()
        if(!isset($controller->params['url']['url'])){
            if(isset($controller->params['plugin'])){
                $url = ''.$controller->params['plugin'];
            } else {
                $url = '';
            }
            $controller->params['url']['url'] = $url.DS.$controller->params['controller'].DS.$controller->params['action'];
        }
        $path = $controller->params['url']['url'];
        if ($path != '/') {
            $path = '/'.$path;
        }
        
        $loginAction = Configure::read('Authake.loginAction');
        if(is_array(Configure::read('Authake.loginAction'))){
            $loginAction = "/".implode("/", Configure::read('Authake.loginAction'));
        }
        if ($path != $loginAction) {
            $this->setPreviousUrl(null);
        }

		$tm = Configure::read('Authake.sessionTimeout');
        if ($tm && $this->isLogged()) {        	
            $ts = $this->Session->read('Authake.timestamp');
            if ((time()-$ts) > $tm) {
                $this->setPreviousUrl($path);
                $this->logout();
                $this->Session->setFlash(__('Your session expired', true), 'warning');
                $controller->redirect($loginAction);                
            }
            $this->setTimestamp();
        }
        
        if($this->isAuthakePage($controller)) {
        	if (!$this->isLogged()) {
        		$this->setPreviousUrl($path);
                $this->Session->setFlash(sprintf(__('You have to log in to access %s', true), $path), 'warning');
                $controller->redirect($loginAction);
        	}
        }
        
        if (!$this->isAllowed($controller)) { // check for permissions
        	//print "authake page";
            if ($this->isLogged()) { // if denied & logged, write a message
            	//print "logged";
                if ($this->_flashmessage) { // message from the rule (accept path in %s)
                    $this->Session->setFlash(sprintf(__($this->_flashmessage, true), $path), 'error');    // Set Flash message
                }

                $fw = $this->_forward ? $this->_forward : Configure::read('Authake.defaultDeniedAction');
                $controller->redirect($fw);
            } else { // if denied & not loggued, propose to log in
                $this->setPreviousUrl($path);
                $this->Session->setFlash(sprintf(__('You have to log in to access %s', true), $path), 'warning');
                $controller->redirect($loginAction);
            }
            $this->_flashmessage = '';
        }
    }
    
    function isAuthakePage(&$controller) {
		if(isset($controller->params['plugin'])){
			if($controller->params['controller'] != 'user') {
				return true;
			}
		}
		return false;
    }

    /**
     * API functions
    */
    function setPreviousUrl($url) {
        $this->Session->write('Authake.previousUrl', $url);
    }

    function getPreviousUrl() {
        return $this->Session->read('Authake.previousUrl');
    }

    function isLogged() {
		return ($this->getUserId() !== null);
    }

    function getLogin() {
        return $this->Session->read('Authake.login');
    }
    
	function getSsnNo() {
        return $this->Session->read('Authake.ssn_no');
    }

    function getUserId() {
        return $this->Session->read('Authake.id');
    }
    
    function getUserEmail() {
        return $this->Session->read('Authake.email');
    }
    
    function getGroupIds() {
        $gid = $this->Session->read('Authake.group_ids');
        return (empty($gid) ? null : $gid); //If not logged in (or no groups - return null)
    }

    function getGroupNames() {
        $gn = $this->Session->read('Authake.group_names');
        return (is_array($gn) ? $gn : array(__('Guest', true)));
    }

    function isMemberOf($gid) {
        return in_array($gid, $this->getGroupIds());
    }

    function setTimestamp() {
		$ts = $this->Session->write('Authake.timestamp', time());
	}

    function login($user) {
            $this->Session->write('Authake', $user);
            $this->setTimestamp();
        }

    function logout() {
    	$cachePermissions = $this->Session->read('Authake.Permissions');
        $this->Session->delete('Authake');
        if($cachePermissions) {
        	$this->Session->write('Authake.Permissions', $cachePermissions);
        	$this->Session->write('Authake.cachePermissionsTime', time());
        }
    }

    function getRules($group_ids = null) {
		return array();
    }

    // Function to check the access for the controller / action
    function isAllowed($controller) { // $checkStr: "/name/action/" $group_ids: check again thess groups

    	$personId = '';
    	$groupIds = '';
    	if($this->isLogged()) {
    		$personId = $this->getUserId();
    		$groupIds = $this->getGroupIds();
    		
    		//temp
    		return true;
    		//is user is super-admin (user id = 1) return true
    		if($personId == 1) {
    			return true;
    		}
    	}
    	$access = $this->checkAccessPermission($controller, $personId, $groupIds);
    	return $access; 
    }

	/*
	 * this function lists the actions that can be accessed by user/group. used in users and groups conroller
	 */
    function getActionsPermissions($group_ids) {
        $actionList = '';
        return $actionsList;
    }

	/*
	 * used in getActionsPermissions 
	 */
	function _getControllers($lowercase = false) {
        $controllerList = array();
        $controllers = Configure::listObjects('controller');
        App::import('Controller', $controllers);
        
/*  To improve...
        $controllers[]='User';
        $controllers[]='Users';
        $controllers[]='Groups';
        $controllers[]='Rules';
        $controllers[]='Denied';
        App::import('Controller', array('Authake.User', 'Authake.Users', 'Authake.Groups', 'Authake.Rules', 'Authake.Denied'));
*/

        foreach($controllers as $controller) {
            if ($controller != "App") {
                $className = $controller . 'Controller';
                $actions = get_class_methods($className);
                foreach($actions as $k => $v)
                    if ($v{0} == '_') unset($actions[$k]);

                $parentActions = get_class_methods('AppController');
                if ($lowercase) $controller = strtolower($controller);
                $controllersList[$controller] = array_diff($actions, $parentActions);
            }
        }
        
        return $controllersList;
    }



    // Function to check the access for the controller / action
    function _areGroupsAllowed($url = "", $rules) { // $checkStr: "/name/action/" $group_ids: check again thess groups
        $allow = false;
        foreach( $rules as $data ) {
        if(preg_match("/{$data['Rule']['action']}/i", $url, $matches)) {
            $allow = $data['Rule']['permission'];
            if ($allow == 'Deny')
                $allow = false;
            else
                $allow = true;
            }
        }
        return $allow;
    }

    function getPermissions($reset = '') {
        //$force_reload = (time() - $this->Session->read('Authake.cachePermissionsTime')) > Configure::read('Authake.permissionsCacheTimeout');
        //currently the Permission cache will not timeout
		$force_reload = false;		
        if($force_reload || $reset == 'reset' 
        || ($cachePermissions = $this->Session->read('Authake.Permissions')) === null
            ) {
            if(Configure::read('Authake.accessStorage') == 'DB') {
	            App::import("Model", "Authake.Permission");
	            $permission = new Permission;
	            $cachePermissions = $permission->getPermissions(); // use groups provided or take groups of the users
            } else {
            	$cachePermissions = $this->getAccessArray();
            }

			$this->Session->write('Authake.Permissions', $cachePermissions);
			$this->Session->write('Authake.cachePermissionsTime', time());
        }
        return $cachePermissions;
    }
    
    
    /*
     * Function Name	:	getAccessArray()
     * Parameter		:	 No
     * Return type		:	array containing access information
     * 
     * This function reads the file as defined in Authake.accessStorageFile for the access definition
     */
	function getAccessArray() {
		$accessArray = array();		
		$file = Configure::read('Authake.accessStorageFile');

		if(file_exists($file)) {
			if (($handle = fopen($file, "r")) !== FALSE) {
			    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
			    	$controller = $data[0];
			    	$action = $data[1];
					if(count($data) == 2) {
						//if group, allowed and denied are not defined, then no authentication needed
						//<controller>,<action>
						$accessArray[$controller][$action] = 0;
					} else {
						$groups = $data[2];
						$allow_persons = $data[3];
						$deny_persons = $data[4];
						
		        		$allowedGroupArray = array();
		        		if(isset($groups) && ( $groups != '-' && $groups != '' )) {
		        			$allowedGroupArray = explode(':',$groups);
		        		}
		        		
		        		$allowedPersonArray = array();
		        		if(isset($allow_persons) && ($allow_persons != '-' || $allow_persons != '')) {
		        			$allowedPersonArray = explode(':',$allow_persons);
		        		}
		        		
		        		$deniedPersonArray = array();
		        		if(isset($deny_persons) && ($allow_persons != '-' || $allow_persons != '')) {
		        			$deniedPersonArray = explode(':',$deny_persons);
		        		}
		
		        		$actionArray = array("groups" => $allowedGroupArray, "allow" => $allowedPersonArray, "deny" => $deniedPersonArray);
						$accessArray[$controller][$action] = $actionArray;
					}		
				}
	    		fclose($handle);
			}
		} else {
			$this->Session->setFlash(sprintf(__('Access Configuration file  %s not found.', true), $file), 'warning');
		}
		return $accessArray;
	}

	function checkAccessPermission($controller, $personId = '', $groupId = array()){
		$accessArray = $this->getPermissions('reset');
		$pathArray = $controller->params;
		$controllerCheck = $pathArray['controller'];
		$actionCheck = $pathArray['action'];
		
		if($pathArray['action'] == 'login') {
			return true;
		}
/*		
		foreach($accessArray as $controller => $v){
			foreach ($v as $action => $access) {
				print $controller . " => " . $action . " => ";
				print_r($access);
				print "<br><br>";
		
			}
		}
		print "<br>";
		print $controller . " => " . $action;
		print "<br><br><hr>";
		print_r($accessArray[$controllerCheck]);
		print "<br><br><hr>";
		print_r($accessArray[$controllerCheck][$actionCheck]);
		
*/
		//if there is no permission information for the controller and particular action
		//then by default, then every one can access it.
		//print_r($accessArray[$controller]);
		
		//if by default no access, false; otherwise true;
		if(!isset($accessArray[$controllerCheck]) || !isset($accessArray[$controllerCheck][$actionCheck])) {
			return false;
		}
	
		$accessDetail = $accessArray[$controllerCheck][$actionCheck];
		//if group, allowed and denied are not defined, then no authentication needed
		//<controller>,<action>
		if(!is_array($accessDetail) && $accessDetail == 0) {
			return true;
		}

		//from now on, login required. so if person id and group id are not set, then return false
		if($personId == '' || count($groupId) == 0) {
			return false;
		}
		
		//If above all conditions are not met, now check the access permission setting
		
		$arrAllowedGroupIds = $accessDetail['groups'];
		$arrAllowedPersonIds = $accessDetail['allow'];
		$arrDeniedPersonIds = $accessDetail['deny'];
		

		$accessFlg = false;		
		$groupAccessFlg = false;
		$personAccessFlg = false;
	
		foreach($groupId as $k) {
			if(in_array($k, $arrAllowedGroupIds)) {
				$groupAccessFlg = true;
				break;
			}
		}
		$groupAccessFlg = (count($arrAllowedGroupIds) == 0) || $groupAccessFlg;
		//if there is no person in deny list or the person id exist in allow list
		if( 
		(count($arrAllowedPersonIds) == 0 && !in_array($personId, $arrDeniedPersonIds)) ||
	
		(count($arrDeniedPersonIds) == 0 && in_array($personId, $arrAllowedPersonIds))  ||
		
		(in_array($personId, $arrAllowedPersonIds) || !in_array($personId, $arrDeniedPersonIds))
	
		){
			$personAccessFlg = true;
		} else {
			$personAccessFlg = false;
		}
		
		$accessFlg = $groupAccessFlg && $personAccessFlg;
	
		return $accessFlg;	
	}
}
?>
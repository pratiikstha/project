<?php
/**
 * Routes configuration
 *
 * In this file, you set up routes to your controllers and their actions.
 * Routes are very important mechanism that allows you to freely connect
 * different urls to chosen controllers and their actions (functions).
 *
 * PHP versions 4 and 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2010, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2010, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       cake
 * @subpackage    cake.app.config
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
/**
 * Here, we are connecting '/' (base path) to controller called 'Pages',
 * its action called 'display', and we pass a param to select the view file
 * to use (in this case, /app/views/pages/home.ctp)...
 */
	Router::connect('/', array('controller' => 'pages', 'action' => 'display', 'home'));
	//Router::connect('/', array('plugin'=>'authake', 'controller' => 'user', 'action' => 'login'));
/**
 * ...and connect the rest of 'Pages' controller's urls.
 */
	Router::connect('/pages/*', array('controller' => 'pages', 'action' => 'display'));
	
	Router::connect('/register', array('plugin'=>'authake', 'controller' => 'user', 'action' => 'register'));
	Router::connect('/login', array('plugin'=>'authake', 'controller' => 'user', 'action' => 'login'));
	Router::connect('/logout', array('plugin'=>'authake', 'controller' => 'user', 'action' => 'logout'));
	Router::connect('/lost-password', array('plugin'=>'authake', 'controller' => 'user', 'action' => 'lost_password'));
	Router::connect('/verify/*', array('plugin'=>'authake', 'controller' => 'user', 'action' => 'verify'));
	Router::connect('/pass/*', array('plugin'=>'authake', 'controller' => 'user', 'action' => 'pass'));
	Router::connect('/profile', array('plugin'=>'authake', 'controller' => 'user', 'action' => 'index'));
	Router::connect('/denied', array('plugin'=>'authake', 'controller'=>'user', 'action'=>'denied'));
	Router::connect('/users', array('plugin'=>'authake', 'controller'=>'users'));
	Router::connect('/rules', array('plugin'=>'authake', 'controller'=>'rules'));
	Router::connect('/groups', array('plugin'=>'authake', 'controller'=>'groups'));
	Router::connect('/permissions', array('plugin'=>'authake', 'controller'=>'permissions'));

<?php
/**
 * This file is loaded automatically by the app/webroot/index.php file after the core bootstrap.php
 *
 * This is an application wide file to load any function that is not used within a class
 * define. You can also use this to include or require any files in your application.
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
 * @since         CakePHP(tm) v 0.10.8.2117
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

/**
 * The settings below can be used to set additional paths to models, views and controllers.
 * This is related to Ticket #470 (https://trac.cakephp.org/ticket/470)
 *
 * App::build(array(
 *     'plugins' => array('/full/path/to/plugins/', '/next/full/path/to/plugins/'),
 *     'models' =>  array('/full/path/to/models/', '/next/full/path/to/models/'),
 *     'views' => array('/full/path/to/views/', '/next/full/path/to/views/'),
 *     'controllers' => array('/full/path/to/controllers/', '/next/full/path/to/controllers/'),
 *     'datasources' => array('/full/path/to/datasources/', '/next/full/path/to/datasources/'),
 *     'behaviors' => array('/full/path/to/behaviors/', '/next/full/path/to/behaviors/'),
 *     'components' => array('/full/path/to/components/', '/next/full/path/to/components/'),
 *     'helpers' => array('/full/path/to/helpers/', '/next/full/path/to/helpers/'),
 *     'vendors' => array('/full/path/to/vendors/', '/next/full/path/to/vendors/'),
 *     'shells' => array('/full/path/to/shells/', '/next/full/path/to/shells/'),
 *     'locales' => array('/full/path/to/locale/', '/next/full/path/to/locale/')
 * ));
 *
 */

/**
 * As of 1.3, additional rules for the inflector are added below
 *
 * Inflector::rules('singular', array('rules' => array(), 'irregular' => array(), 'uninflected' => array()));
 * Inflector::rules('plural', array('rules' => array(), 'irregular' => array(), 'uninflected' => array()));
 *
 */

define('INSTALL_FILE_PATH', ROOT . DS . APP_DIR . DS . 'config/install.php');

define('VDCS', 'गा.वि.स');
define('VDC', 'गाउँ विकास समिति');
define('MUNICIPALITY', 'नगरपालिका');
define('METROPOLITAN', 'महानगरपालिका');
define('SUBMETROPOLITAN', 'उप-महानगरपालिका');
define('DDC', 'जिल्ला विकास समिति');
/*===========================================================
 * 
 * Account IDs
 * 
 *==========================================================*/
define('ASSETS', 1);
define('INCOME', 3);
define('EXPENDITURES', 4);
define('LIABILITIES', 2);
define('BANK_ID', 110);
define('CASH_ID', 111);
define('ADVANCE_AC_ID', 112);
//define('BUDGET_RELEASES', 84);
//define('BUDGET_RELEASE_1', 65);
//define('BUDGET_RELEASE_2', 66);
//define('BUDGET_RELEASE_3', 67);
//define('BUDGET_RELEASE_4', 68);
//define('BUDGET_RELEASE_5', 69);
define('CF_ID', 81);

define('CF_VOUCHER_TYPE_ID', 5);

define('FY_START_MONTH', 4);

/*===========================================================
 * 
 * CONSTANTS USED FOR NEPALI MESSAGE AND LABELS
 * 
 ===========================================================*/
define('ADD', 'नयाँ');

define('BALANCE', 'मौज्दात');

define('COPYRIGHT', 'सर्वाधिकार %sमा सुरक्षित ।');

define('HEADER_1', 'नेपाल सरकार');
define('HEADER_2', 'स्थानीय विकास मन्त्रालय');
define('HEADER_3', 'गाउँ विकास समितिको कार्यालय');
define('HEADER_3_E', 'Office of the Village Development Committee');

define('YES', 'हो');

define('MANY', 'हरु');

define('NAME', 'नाम');
define('NO', 'होईन');

define('OF', 'को');
define('OTHERS', 'अन्य');

/***********BUTTONS*****************/
define('VIEW', 'हेर्नुहोस');
define('EDIT', 'परिवर्तन');
define('DELETE', 'हटाउनुहोस');
define('SAVE', 'सेभ गर्नुहोस');
define('ACTIONS', 'कार्यहरु');
define('RECORD', 'रेकर्ड');
define('ADDS', 'थप्नुहोस');
define('CREATE', 'नयाँ');
define('PREVIOUS', 'अगाडि');
define('NEXT', 'पछाडी');
define('SEARCH', 'खोज्नुहोस');

/***********************************
 * MENU LABELS 
 * *********************************/

define('ACCOUNT', 'खाता');
define('ACCOUNTS_MENU', 'एकाउन्ट');
define('ACCOUNTS_RECORD', 'एकाउन्ट रेकर्डहरु');
define('ADMIN', 'प्रशासन');
define('ADMIN_PAGE', 'प्रशासनिक पृष्ठ');
define('ALL', 'सबै');

define('BANK', 'बैङ्‌क');
define('BANK_CASH_BOOK', 'बैङ्‌क नगदी किताब');
define('BUDGET_CODE', 'बजेट हिसाब नं.');

define('CITIZEN', 'नागरिक');

define('DESCRIPTION', 'विवरण');
define('DOCUMENT', 'डक्युमेन्ट');

define('HOME_PAGE', 'गृह पृष्ठ');

define('LOGIN', 'लग ईन');
define('LOGOUT', 'लग आउट');

define('REPORT', 'रिपोर्ट');

define('TODAY_VOUCHER', 'आजका भौचरहरु');
define('TYPE', 'प्रकार');

define('VOUCHER', 'गोश्वारा भौचर');
define('VOUCHER_ENTRY', 'साधारण भौचर');

define('BIRTH_PLACE','जन्म स्थान');
define('PERMANENT_ADDRESS','स्थाई बास स्थान');







/***********************************
 * DATABASE FIELD LABELS 
 * *********************************/

/************Account****************/
define('AMOUNT', 'रकम');
define('ADVANCE', 'पेश्की');
define('NEW_ADVANCE_VOUCHER', 'नयाँ पेश्की भौचर');
define('ALLOCATION', '');


define('BUDGET', 'बजेट');
define('BUDGET_EXPENSE_ALLOCATE', 'बजेटखर्च विनियोजन');
define('ANNUAL', 'वार्षिक');

define('CARRIED_FORWARD', 'अल्या.');
define('CASH', 'नगद');
define('CHECKED_BY', 'सदर गर्ने');
define('CHEQUE_NO', 'चेक नं');
define('CLOSING_BALENCE', 'अन्तिम  मौज्दात');
define('CREDIT', 'क्रेडिट');
define('CURRENT', 'हालसम्मको');


define('DEBIT', 'डेबिट');

define('INCOME_ACCOUNT', 'आम्दानी खाता');

define('MONTHLY', 'मासिक');

//define('NEW_ADVANCE_VOUCHER', 'नयाँ पेश्की भौचर');

define('OPENING_BALENCE', 'सुरुको मौज्दात');

define('POSTED_BY', 'पेश गर्ने');

define('RELEASE', 'निकासा');
define('REMARK', 'कैफियत');

define('SOURCE', 'स्रोत');

define('USER_ACCOUNT_CODE', 'बजेट खर्च नं');


/************Citizens****************/
define('CITIZENSHIP_NO','नागरिकता नं.');
define('REGION','विकास क्षेत्र');
define('DISTRICT','जिल्ला');
define('VMS_OPTION','गा.वि.स / नगरपालिका');
define('WARD_NO','वडा न.');
define('ZONE','अन्चल');
define('STATE','इस्टेट');
define('VMS_NAME','गा.वि.स.को नाम');
define('BIRTH_DATE','जन्म मिति');
define('FIRST_NAME','पहिलो नाम');
define('LAST_NAME','थर');
define('RH_FINGERPRINT','दायाँ छाप');
define('LH_FINGERPRINT','बायाँ छाप');
define('SIGNATURE','सिग्नेचर');
define('PREPARED_BY','तयार पारेको व्यक्ति');
define('VERIFIED_BY','प्रमाणित गरेको व्यक्ति');
define('ISSUED_BY','निकालेको व्यक्ति');
define('ISSUED_DATE','निकालेको मिती');

define('LISTS', 'सूची');
define('RELATION', 'नाता');

define('RELATIVE', 'नातेदार');
define('RELATIONWITH', 'नाता गासेको व्यक्ति');
define('ADVANCE_SEARCH', 'अत्याधुनिक खोज');

/*********** REVENUE MODULE CONSTANS ***************/
define('RELATED', 'सम्बधित');
define('SN', 'क्र.सं.');
define('SOURCE_GROUP_LIST', 'आम्दानी समुह सूची');
define('SOURCE_GROUP_NEW', 'नयाँ आम्दानी समुह सुची');
define('INCOME_SOURCE_LIST', 'आम्दानीको किसिम');
define('INCOME_SOURCE_NEW', 'नयाँ आम्दानीको किसिम');
define('DAY_BOOK_LIST', ' दैनिक कारोबार खाता सूची');
define('DAY_BOOK_NEW', 'नयाँ  दैनिक कारोबार खाता');

/********** SOURCE_GROUP ***********************/

define('SOURCE_GROUP', 'आम्दानी समूह');
define('SOURCE_GROUP_NAME', 'आम्दानी समूह नाम');
define('ACCOUNT_ID', 'ACCOUNT_ID');
define('DELETE_MSG', 'के तपाईँ यो रेकर्ड हटाउन चाहनुहुन्छ ?');

/********** INCOME_SOURCE ***********************/
define('INCOME_SOURCE', 'आम्दानीको किसिम');
define('INCOME_SOURCE_NAME', 'आम्दानी किसिमको नाम');
define('TENTATIVE_COST', 'शुल्क');
define('DOCUMENT_FILE','फाइल');

/********** DAY BOOK ***********************/
define('DAY_BOOK', ' दैनिक कारोबार खाता');
define('DISCOUNT', 'छुट');
define('FINE', 'जरिवाना');
define('SSN_NO', 'नागरिकको नाम');
define('TRANSACTED_BY', 'बुझिलिनेको नाम');
define('TRANSACTION_DATE', 'कारोबार मिति');
define('TRANSACTION_AMOUNT', 'रकम');
define('POSTED_ON', 'पोष्ट मिति');
define('VOUCHER_ID', 'भौचर नं.');
define('PREPARE_REPORT', 'रिर्पोट');
/***********************************
 * MESSAGES
 * *********************************/

define('LOGGED_USER_MSG', 'तपाईले %s को रुपमा लग ईन गर्नुभएको छ ।');
define('ACCOUNT_DELETE_MSG', 'के तपाईँ %s खाता हटाउन चाहनुहुन्छ ?');

/*****
 *
 */
define('EMPLOYEE','कर्मचारी');
define('OFFICIALS','पदाधिकारी');
define('CONTRACTORS','ठेकेदार');
define('ORGANIZATIONS','स‌ंस्था');
define('OTHER_PERSON','अन्य व्यक्ति');
define('OTHER_ORGANIZATION','अन्य संस्था');
define('COMMITTEES', "समिति");


/*===========================================================
 * 
 * FUNCTIONS
 * 
 ===========================================================*/

function getMessage($constName, $params = array()){
	array_unshift($params, $constName);
	if (is_array($params) && sizeof($params) > 1) {
		$ret = call_user_func_array('sprintf', $params);
	} else {
		$ret = $params[0];
	}
	return $ret;
}

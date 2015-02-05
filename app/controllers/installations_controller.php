<?php
class InstallationsController extends AppController {

	var $name = 'Installations';
	var $uses = array();
	var $components = array('RequestHandler');
	var $paginate = array('limit'=>'10');
	
	function beforeFilter() {
		
	}

	function index() {
		$this->redirect('/installations/add');
	}
	function add() {
		if(file_exists(INSTALL_FILE_PATH)) {
			$this->redirect('/');
		}
		$this->layout = '';
		if (!empty($this->data)) {
			if($this->validates($this->data)) {
				$this->writeInstall();
				$this->redirect('/');
			} else {
				$this->Session->setFlash(__('Data Invalid', true));
			}
		}
		
	}

	function validates() {
		if(!isset($this->data['Installation']['office_type']) || $this->data['Installation']['office_type'] == '') {
			return false;
		}
		if(!isset($this->data['Installation']['office_name_nepali']) || $this->data['Installation']['office_name_nepali'] == '') {
			return false;
		}
		if(!isset($this->data['Installation']['office_name_english']) || $this->data['Installation']['office_name_english'] == '') {
			return false;
		}
		return true;
	}

	function writeInstall() {
		$installFile = INSTALL_FILE_PATH;
		if (!$handle = fopen($installFile, 'a')) {
			echo "Cannot open file";
			exit;
	    }
		
	    $content = "<?php\r\n";
	    $content .= "define('GOVT_TYPE', " . $this->data['Installation']['office_type'] . ");\r\n";
	    $content .= "define('NAME_NEPALI', \"" . $this->data['Installation']['office_name_nepali'] . "\");\r\n";
	    $content .= "define('NAME_ENGLISH', \"" . $this->data['Installation']['office_name_english'] . "\");\r\n";
	    $content .= "define('VDC_NAME', \"" . $this->data['Installation']['office_name_nepali'] . "\");\r\n";
	    $content .= "define('VDC_NAME_E', \"" . $this->data['Installation']['office_name_english'] . "\");\r\n";
	    $content .= "?>";
	    // Write $somecontent to our opened file.
	    if (fwrite($handle, $content) === FALSE) {
	        echo "Cannot write to file ($filename)";
	        exit;
	    }
	    fclose($handle);
	    $handle = fopen(ROOT . DS . APP_DIR . DS . 'config/bootstrap.php', 'a+');
	    $content = "require_once('" . INSTALL_FILE_PATH . "');";
	    fwrite($handle, $content);
	    fclose($handle);
	}
}
?>
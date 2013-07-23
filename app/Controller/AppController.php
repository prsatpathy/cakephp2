<?php
App::uses('Controller', 'Controller');
class AppController extends Controller {
	/*public $components = array(
        'Acl',
        'Auth' => array(
            'authorize' => array(
                'Actions' => array('actionPath' => 'controllers')
            )
        ),
        'Session','Email', 'Cookie'
    );*/
	public $components = array('Security','Auth', 'Session','Email', 'Cookie');
	public $helpers = array('Html', 'Form', 'Text','Cache','Session');
	public $ext = '.html';
	
	function beforeFilter() {
		parent::beforeFilter();
		
		if ($this->Session->read('Auth.User')) {
			//echo $this->Auth->loggedIn();
        }
		else {
			Security::setHash('md5'); // Security salt and cipherSeed are changed to blank in core.php
			
			/*$this->Auth->authorize = array(
				'Controller',
				'Actions' => array('actionPath' => 'controllers')
			);*/
			
			#(cakePHP 2.3)# $this->Auth->fields = array('username' => 'email', 'password' => 'password'); 
			$this->Auth->authenticate = array('Form' => array('fields' => array('username' => 'email', 'password' => 'password')));
			
			#(optional)# $this->Auth->userModel = 'User';
			#(optional)# $this->Auth->loginAction = array('controller' => 'users', 'action' => 'login', 'admin' => false, 'plugin' => false);
			$this->Auth->logoutRedirect = array('controller' => 'users', 'action' => 'index', 'admin' => false, 'plugin' => false);
			$this->Auth->loginRedirect = array('controller' => 'users', 'action' => 'dashboard', 'admin' => false, 'plugin' => false);
		}
	}
	function downloadFile($filename)
	{
		define('DIR_FILES',WWW_ROOT.'files/');
		set_time_limit(0);
		
		if (!isset($filename) || empty($filename)) {
			$var = "<table align='center' width='100%'><tr><td style='font:bold 14px verdana;color:#FF0000;' align='center'>Please specify a file name for download.</td></tr></table>";
		  die($var);
		}

		if (strpos($filename, "\0") !== FALSE) die('');
		$fname = basename($filename);
		
		if(file_exists(DIR_FILES.$fname))
		{
			$file_path = DIR_FILES.$fname;
		}
		else
		{
			$var = "<table align='center' width='100%'><tr><td style='font:bold 12px verdana;color:#FF0000;' align='center'>Oops! File not found.<br/> File may be deleted or make sure you specified correct file name.</td></tr></table>";
			die($var); 
		}
		$fsize = filesize($file_path); 
		
		$fext = strtolower(substr(strrchr($fname,"."),1));
		
		if (!isset($_GET['fc']) || empty($_GET['fc'])) {
		  $asfname = $fname;
		}
		else {
		  $asfname = str_replace(array('"',"'",'\\','/'), '', $_GET['fc']);
		  if ($asfname === '') $asfname = 'NoName';
		}

		header("Pragma: public");
		header("Expires: 0");
		header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
		header("Cache-Control: public");
		header("Content-Description: File Transfer");
		header("Content-Type: ");
		header("Content-Disposition: attachment; filename=\"$asfname\"");
		header("Content-Transfer-Encoding: binary");
		header("Content-Length: ".$fsize);

		$file = @fopen($file_path,"rb");
		if ($file) {
		  while(!feof($file)) {
			print(fread($file, 1024*8));
			flush();
			if (connection_status()!=0) {
			  @fclose($file);
			  die();
			}
		  }
		  @fclose($file);
		}
	}
}

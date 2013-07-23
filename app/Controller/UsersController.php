<?php
App::uses('AppController', 'Controller');
class UsersController extends AppController {
	
	public $name = 'Users'; //Controller name
	public $uses = array('User','Project'); //Model names
	var $actsAs = array('Acl' => array('type' => 'requester'));
	public $components = array('Format'); //Also can be define on AppControler
	public $helpers = array('Format'); //Also can be define on AppControler
	
	function beforeFilter(){
       parent::beforeFilter();
       $this->Auth->allow('*');
	   if (!$this->Session->read('Auth.User')) {
	   		$this->Auth->allow('signup','login','index','index','twitter','getTwitterData','facebook');
	   }
    }
	
	public function index() {
		$users = $this->User->getUserList();
		$this->set('users',$users);
		
		$categories = $this->User->getCategories();
		$this->set('categories',$categories);
	}
	public function dashboard() {
	
		$options = array(
			array('name' => 'United states', 'value' => 'USA'),
			array('name' => 'USA', 'value' => 'USA'),
		);
		$this->set('options',$options);
 
		$uniq_no = $this->Format->generateUniqNumber();
		$this->set('uniq_no',$uniq_no);
		
		$ip = $this->Format->getRealIpAddr();
		$this->set('ip',$ip);
		
		$email = $this->Format->getUserEmail($this->Session->read('Auth.User.id'));
		$this->set('email',$email);
	}
	public function login() {
		if ($this->request->is('post')) {
            if ($this->Auth->login()) {
                $this->redirect($this->Auth->redirect());
            } else {
                $this->Session->setFlash('Your Email or Password was incorrect.');
            }
        }
		// check for login and redirect to dashboard
		if ($this->Session->read('Auth.User')) {
            $this->Session->setFlash('You are logged in!');
            $this->redirect('../users/dashboard', null, false);
        }
	}
	function twitter() {
		App::import('Vendor', 'twitter', array('file' => 'twitter/twitteroauth/twitteroauth.php'));
		App::import('Vendor', 'twitter', array('file' => 'twitter/tw_login_config.php'));
		
		$twitteroauth = new TwitterOAuth(Configure::read("TWITTER_CONSUMER_KEY"), Configure::read("TWITTER_CONSUMER_SECRET"));
		// Requesting authentication tokens, the parameter is the URL we will be redirected to
		$request_token = $twitteroauth->getRequestToken('http://localhost/cakephp/users/getTwitterData');
		
		// Saving them into the session
		$this->Session->write('oauth_token',$request_token['oauth_token']);
		$this->Session->write('oauth_token_secret',$request_token['oauth_token_secret']);
		
		// If everything goes well..
		if ($twitteroauth->http_code == 200) {
			// Let's generate the URL and redirect
			$url = $twitteroauth->getAuthorizeURL($request_token['oauth_token']);
			$this->redirect($url);
		} else {
			// It's a bad idea to kill the script, but we've got to know when there's an error.
			die('Something wrong happened.');
		}
	}
	function getTwitterData() {
		App::import('Vendor', 'twitter', array('file' => 'twitter/twitteroauth/twitteroauth.php'));
		App::import('Vendor', 'twitter', array('file' => 'twitter/tw_login_config.php'));
		
		$oauth_token = $this->Session->read('oauth_token');
		$oauth_token_secret = $this->Session->read('oauth_token_secret');
		
		if (!empty($this->params['url']['oauth_verifier']) && !empty($oauth_token) && !empty($oauth_token_secret)) {
			// We've got everything we need
			$twitteroauth = new TwitterOAuth(Configure::read("TWITTER_CONSUMER_KEY"), Configure::read("TWITTER_CONSUMER_SECRET"), $oauth_token, $oauth_token_secret);
			// Let's request the access token
			$access_token = $twitteroauth->getAccessToken($this->params['url']['oauth_verifier']);
			// Save it in a session var
			$this->Session->write('access_token', $access_token);
			// Let's get the user's info
			$user_info = $twitteroauth->get('account/verify_credentials');
			$this->checkTwitterData($user_info);
		}
	}
	public function logout() {
        $this->Session->setFlash('Good-Bye');
        $this->redirect($this->Auth->logout());
    }
}

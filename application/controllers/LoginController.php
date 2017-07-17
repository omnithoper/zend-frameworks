<?php
class LoginController extends Zend_Controller_Action {
	protected $_fb;
	protected $_gCLient;
	protected $_redirectURL;
	protected $_googleService;
	
	public function indexAction() {
		

		$loginType = Request::getParam('loginType');

		$this->__setupFacebookCredentials();
		$this->__setupGoogleCredentials();

		$this->__getFacebookURL();
		$this->__getGoogleURL();


		if(!empty($_GET['code']) && empty($loginType)){
			$loginType = 'google';
		}

		if (!empty($loginType)) {
			call_user_func('self::__'.$loginType.'Login');
		}

		/*
		$connection = getConnectionWithAccessToken("447588865-0D7CFC7uhYxULcYLnnEeaTTI7eKxn9zBtUSZCFjK", "VXR0mlrx57BOEzg3On8qjRUUHWZRFPKub6ZzYSnSDrBcW");
		$content = $connection->get("statuses/home_timeline");	
	*/

	}

	protected function getConnectionWithAccessToken($oauth_token, $oauth_token_secret) {
	  $connection = new TwitterOAuth('2irRW5VTuaEi8lGXNSCbDbQEb', 'tnl4d6DDVn2lqyaOCKSM4c7D9pGfaFRT8YcwcIJtsvWwmmrpWW', $oauth_token, $oauth_token_secret);
	  return $connection;
	}

	
	protected function __setupFacebookCredentials() {
		if (!empty($this->_fb)) {
			return true;
		}
		
		date_default_timezone_set('America/Los_Angeles');

		$this->_fb = new Facebook\Facebook([
		  'app_id' => '1729933903964760',
		  'app_secret' => 'af7d04a68993ac028425a4daa3c154a4',
		  'default_graph_version' => 'v2.5',
		]);		
	}

	protected function __setupGoogleCredentials() {
		//Include Google client library 
		require_once 'google/Google_Client.php';
		require_once 'google/contrib/Google_Oauth2Service.php';
		
		/*
		 * Configuration and setup Google API
		 */
		$clientId = '86800409401-u4ol0t7jbegcpvle0taev56lnospsbfh.apps.googleusercontent.com'; //Google client ID
		$clientSecret = 'DWZZ8rIg85r2KBEF-BoPPhtU'; //Google client secret
		$this->_redirectURL = 'http://sample.enrollment.com'; //Callback URL

		//Call Google API
		$this->_gClient = new Google_Client();
		$this->_gClient->setApplicationName('Login to CodexWorld.com');
		$this->_gClient->setClientId($clientId);
		$this->_gClient->setClientSecret($clientSecret);
		$this->_gClient->setRedirectUri($this->_redirectURL);
	}

	protected function __getFacebookURL() {
		
		if (!empty($_SESSION['facebook_access_token'])) {
			return false;
		}

		$url = 'http://sample.enrollment.com/?loginType=facebook';
		$helper = $this->_fb->getRedirectLoginHelper();
		$permissions = ['email', 'user_likes']; // optional
		try {
			$loginUrl = $helper->getLoginUrl($url, $permissions);
		} catch (Exception $e) {
			Zend_Debug::dump($e->getMessage()); die();
		}

		$this->view->fbloginurl = $loginUrl;
	}

	protected function __getGoogleURL() {
		$this->_googleService = new Google_Oauth2Service($this->_gClient);
		$authUrl = $this->_gClient->createAuthUrl();
		$this->view->googleLoginUrl = $authUrl;
	}

	protected function __googleLogin() {
		if(isset($_GET['code'])){
			$this->_gClient->authenticate($_GET['code']);
			$_SESSION['google_access_token'] = $this->_gClient->getAccessToken();
		}

		if (isset($_SESSION['google_access_token'])) {
			$this->_gClient->setAccessToken($_SESSION['google_access_token']);
		}

		if ($this->_gClient->getAccessToken()) {
			//Get user profile data from google
			$gpUserProfile = $this->_googleService->userinfo->get();
			
			//Initialize User class
					
			//Insert or update user data to the database
		    $gpUserData = array(
		        'oauth_provider'=> 'google',
		        'id'     		=> $gpUserProfile['id'],
		        'first_name'    => $gpUserProfile['given_name'],
		        'last_name'     => $gpUserProfile['family_name'],
		        //'email'         => $gpUserProfile['email'],
		       // 'gender'        => $gpUserProfile['gender'],
		        //'locale'        => $gpUserProfile['locale'],
		       // 'picture'       => $gpUserProfile['picture'],
		        //'link'          => $gpUserProfile['link']
		    );
		} else {	
			$authUrl = $this->_gClient->createAuthUrl();
			echo '<a href="'.filter_var($authUrl, FILTER_SANITIZE_URL).'">login in gmail</a>';
		}
		

		
		if (!empty($gpUserData)){
			$data = array(
				'google_id' => $gpUserData['id'],  
		    	'first_name' => $gpUserData['first_name'],
		    	'last_name' => $gpUserData['last_name'],
			);

			$student = new Student();
			$result = [];
			$result = $student->getAddGoogleStudent($data, $gpUserData['id']);
			$studentID = $student->googleStudentExist($gpUserData['id']);
			$_SESSION['student_id'] = $studentID;
	   		$_SESSION['login_user'] = $gpUserData['first_name'];
			$_SESSION['user_type'] = 'student';
			$this->_redirect('/index');
		}
	}

	protected function __facebookLogin() {
	
		if (!empty($_SESSION['facebook_access_token'])) {
			$fields = [
				'first_name',
			];
			$response = $this->_fb->get('/me?fields='.join(',', $fields), $_SESSION['facebook_access_token']);
			$user = $response->getGraphUser();
			$_SESSION['login_user'] = $user['first_name'];
  			$_SESSION['user_type'] = 'student';

	  					//die('logged in 2');
			$this->_redirect('/index');
		}

		$helper = $this->_fb->getRedirectLoginHelper();
			if(isset($_GET['state'])) {
 			if($_SESSION['FBRLH_' . 'state']) {
    			  $_SESSION['FBRLH_' . 'state'] = $_GET['state'];
  			}
		}

		try {
  			$accessToken = $helper->getAccessToken();

			if (!empty($accessToken)) {
				$_SESSION['facebook_access_token'] = (string)$accessToken;
				try {
					$fields = [
						'first_name',
					];
					$response = $this->_fb->get('/me?fields='.join(',', $fields), $_SESSION['facebook_access_token']);
					$user = $response->getGraphUser();
					#Zend_Debug::dump($user);
					#die();
					$_SESSION['login_user'] = $user['first_name'];
		  			$_SESSION['user_type'] = 'student';
  			
  					if (!empty($accessToken)) {
						$data = array(
							'facebook_id' => $user['id'],  
					    	'first_name' => $user['first_name'],
					    	'last_name' => $user['last_name'],
						);

						$student = new Student();
						$result = [];
						$result = $student->getAddFacebookStudent($data, $user['id']);
						$studentID = $student->facebookStudentExist($user['id']);
						$_SESSION['student_id'] = $studentID;
					}	
  					// die('logged in 1');
					$this->_redirect('/index');
					return;
				} catch(Facebook\Exceptions\FacebookSDKException $e) {
				  echo 'Facebook SDK returned an error: ' . $e->getMessage();
				  exit;
				}
			}
		} catch(Facebook\Exceptions\FacebookResponseException $e) {
 		 // When Graph returns an error
  		echo 'Graph returned an error: ' . $e->getMessage();
  		exit;
		} catch(Facebook\Exceptions\FacebookSDKException $e) {
  		// When validation fails or other local issues
 		 	echo 'Facebook SDK returned an error: ' . $e->getMessage();
  			exit;
		}
	}
	
	public function loginAction() {		
	    $userName = Request::getParam('username');
	    $password = Request::getParam('password'); 

	    $admin = new Admin();

	    $result = $admin->getAdminUserPassword($userName, $password);
 
 		if (!$result['status']) {
	    	$student = new Student();
	    	$result = $student->getStudentUserPassword($userName, $password);
		} 

	    $error = $result['error'];
	    $this->view->error = $error;
	    header('Location: /index');
	}
	
	public function logoutAction() {
		unset($_SESSION['login_user']);
		unset($_SESSION['user_type']);
		unset($_SESSION['student_id']);
		unset($_SESSION['facebook_access_token']);
		unset($_SESSION['google_access_token']);
		unset($_SESSION['FBRLH_state']);
		session_write_close();
	    header('Location: /');
	}
}
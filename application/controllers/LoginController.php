<?php
class LoginController extends Zend_Controller_Action {
	protected $_fb;
	
	public function indexAction() {
		$loginType = Request::getParam('loginType');

		$this->__setupFacebookCredentials();
		$this->__setupGoogleCredentials();

		$this->__getFacebookURL();
		$this->__getGoogleURL();


		if (!empty($loginType)) {
			call_user_method('__'.$loginType.'Login', $this);
		}
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
		
	}

	protected function __googleLogin() {
		die('google this');
		//Include Google client library 
		require_once 'google/Google_Client.php';
		require_once 'google/contrib/Google_Oauth2Service.php';
		
		/*
		 * Configuration and setup Google API
		 */
		$clientId = '86800409401-u4ol0t7jbegcpvle0taev56lnospsbfh.apps.googleusercontent.com'; //Google client ID
		$clientSecret = 'DWZZ8rIg85r2KBEF-BoPPhtU'; //Google client secret
		$redirectURL = 'http://sample.enrollment.com'; //Callback URL

		//Call Google API
		$gClient = new Google_Client();
		$gClient->setApplicationName('Login to CodexWorld.com');
		$gClient->setClientId($clientId);
		$gClient->setClientSecret($clientSecret);
		$gClient->setRedirectUri($redirectURL);

		$google_oauthV2 = new Google_Oauth2Service($gClient);

		if(isset($_GET['code'])){
			$gClient->authenticate($_GET['code']);
			$_SESSION['google_access_token'] = $gClient->getAccessToken();
			header('Location: ' . filter_var($redirectURL, FILTER_SANITIZE_URL));
		}

		if (isset($_SESSION['google_access_token'])) {
			$gClient->setAccessToken($_SESSION['google_access_token']);
		}

		if ($gClient->getAccessToken()) {
			//Get user profile data from google
			$gpUserProfile = $google_oauthV2->userinfo->get();
			
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
			$authUrl = $gClient->createAuthUrl();
			echo '<a href="'.filter_var($authUrl, FILTER_SANITIZE_URL).'">login in gmail</a>';
		}
		
		if (!empty($gpUserData)) {
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

		}	
		
		if (!empty($gpUserData)){
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
  			
  					$student = new Student();
  					$_SESSION['student_id'] = $student->facebookStudentExist($user['id']);
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
		session_write_close();
	    header('Location: /');
	}
}
<?php
class LoginController extends Zend_Controller_Action {
	public function indexAction() {
		date_default_timezone_set('America/Los_Angeles');
		$url = 'http://sample.enrollment.com/';

		$fb = new Facebook\Facebook([
		  'app_id' => '1729933903964760',
		  'app_secret' => 'af7d04a68993ac028425a4daa3c154a4',
		  'default_graph_version' => 'v2.5',
		]);

		// step 2
		if (empty($_SESSION['facebook_access_token'])) {
			$helper = $fb->getRedirectLoginHelper();
			try {
	  			$accessToken = $helper->getAccessToken();

				if (!empty($accessToken)) {
					$_SESSION['facebook_access_token'] = (string)$accessToken;

					try {
						$fields = [
							'first_name',
						];
						$response = $fb->get('/me?fields='.join(',', $fields), $_SESSION['facebook_access_token']);
						$user = $response->getGraphUser();
						$_SESSION['login_user'] = $user['name'];
			  			$_SESSION['user_type'] = 'student';
	  			
	  					$student = new Student();
	  					$_SESSION['student_id'] = $student->facebookStudentExist($user['id']);
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

		// step 1
		if (empty($_SESSION['facebook_access_token'])) {
			$helper = $fb->getRedirectLoginHelper();
			$permissions = ['email', 'user_likes']; // optional
			try {
				$loginUrl = $helper->getLoginUrl($url.'login/login', $permissions);
			} catch (Exception $e) {
				Zend_Debug::dump($e->getMessage()); die();
			}

			echo '<a href="' . $loginUrl . '">Log in with Facebook!</a>';	

			$this->view->fbloginurl = $loginUrl;
		}

		if (!empty($_SESSION['facebook_access_token'])) {
			$fields = [
				'first_name',
			];
			$response = $fb->get('/me?fields='.join(',', $fields), $_SESSION['facebook_access_token']);
			$user = $response->getGraphUser();
			$_SESSION['login_user'] = $user['first_name'];
  			$_SESSION['user_type'] = 'student';
			$this->_redirect('/index');
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
		if (!empty($_SESSION['login_user'])) {
			unset($_SESSION['login_user']);
			unset($_SESSION['user_type']);
			unset($_SESSION['student_id']);
			unset($_SESSION['facebook_access_token']);
		}
		session_write_close();
	    header('Location: /');
	}
}
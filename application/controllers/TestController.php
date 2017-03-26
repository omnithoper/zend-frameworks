<?php
class TestController extends Zend_Controller_Action {
	public function indexAction() {
		phpinfo();
		die('end');
	}
	
	public function g2Action() {
		$id = '86800409401-1rtftn4eek1r2t8mlvune9srfbnm40j9.apps.googleusercontent.com';
		$secret = 'V49N5ZMe6Cw_NU1tH98JvZVw';
		require_once 'Google/Client.php';
		#require_once 'Google/contrib/Google_AnalyticsService.php';

		$scriptUri = "http://".$_SERVER["HTTP_HOST"].$_SERVER['PHP_SELF'];

		$client = new Google_Client();
		$client->setAccessType('online'); // default: offline
		$client->setApplicationName('My Application name');
		$client->setClientId($id);
		$client->setClientSecret($secret);
		$client->setRedirectUri($scriptUri);
		$client->setDeveloperKey('INSERT HERE'); // API key

		// $service implements the client interface, has to be set before auth call
		#$service = new Google_AnalyticsService($client);
		#if (isset($_GET['code'])) { // we received the positive auth callback, get the token and store it in session
		    $client->authenticate();
		    $accessToken = $client->getAccessToken();

			Zend_Debug::dump($accessToken);
		    $_SESSION['token'] = $accessToken;
		#}
		Zend_Debug::dump($client);
		die('end');

	}
	public function googleAction(){
//		session_start();
		require_once 'Google/Client.php';
		//require_once 'Google/Service/Google_AnalyticsService.php';

		$scriptUri = "http://".$_SERVER["HTTP_HOST"].$_SERVER['PHP_SELF'];

		$client = new Google_Client();
		$client->setAccessType('online'); // default: offline
		$client->setApplicationName('My Application name');
		$client->setClientId('INSERT HERE');
		$client->setClientSecret('INSERT HERE');
		$client->setRedirectUri($scriptUri);
		$client->setDeveloperKey('INSERT HERE'); // API key

		// $service implements the client interface, has to be set before auth call
		// $service = new Google_AnalyticsService($client);

		if (isset($_GET['logout'])) { // logout: destroy token
		    unset($_SESSION['token']);
			die('Logged out.');
		}

		if (isset($_GET['code'])) { // we received the positive auth callback, get the token and store it in session
		    $client->authenticate();
		    $_SESSION['token'] = $client->getAccessToken();
		}

		if (isset($_SESSION['token'])) { // extract token from session and configure client
		    $token = $_SESSION['token'];
		    $client->setAccessToken($token);
		}

		if (!$client->getAccessToken()) { // auth call to google
		    $authUrl = $client->createAuthUrl();
		    header("Location: ".$authUrl);
		    die;
		}
		echo 'Hello, world.';
	}
	
	public function fbAction() {
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
	  				  			Zend_Debug::dump($accessToken); 

			} catch(Facebook\Exceptions\FacebookResponseException $e) {
	 		 // When Graph returns an error
	  		echo 'Graph returned an error: ' . $e->getMessage();
	  		exit;
			} catch(Facebook\Exceptions\FacebookSDKException $e) {
	  		// When validation fails or other local issues
	 		 	echo 'Facebook SDK returned an error: ' . $e->getMessage();
	  			exit;
			}

		//	$this->_redirect('/test/fb');
		}

		if (empty($_SESSION['facebook_access_token']) && isset($accessToken)) {
			$_SESSION['facebook_access_token'] = (string)$accessToken;
		}

		// step 1
		if (empty($_SESSION['facebook_access_token'])) {

			$helper = $fb->getRedirectLoginHelper();
			$permissions = ['email', 'user_likes']; // optional
			$loginUrl = $helper->getLoginUrl($url.'test/fb', $permissions);

			echo '<a href="' . $loginUrl . '">Log in with Facebook!</a>';	
		}
	
		// step 3	
		// Sets the default fallback access token so we don't have to pass it to each request
		if (!empty($_SESSION['facebook_access_token'])) {
			$fb->setDefaultAccessToken($_SESSION['facebook_access_token']);

			try {
			  $response = $fb->get('/me');
			  $userNode = $response->getGraphUser();
			} catch(Facebook\Exceptions\FacebookResponseException $e) {
			  // When Graph returns an error
			  echo 'Graph returned an error: ' . $e->getMessage();
			  exit;
			} catch(Facebook\Exceptions\FacebookSDKException $e) {
			  // When validation fails or other local issues
			  echo 'Facebook SDK returned an error: ' . $e->getMessage();
			  exit;
			}

			//echo 'Logged in as ' . $userNode->getName();
			try {
			// Returns a `Facebook\FacebookResponse` object

				$fields = [
					'id',
					'name',
					'cover',
					'birthday',
					'email',
					'gender',
					'picture',
					'first_name',
					'last_name',
				];
			$response = $fb->get('/me?fields='.join(',', $fields), $_SESSION['facebook_access_token']);
			} catch(Facebook\Exceptions\FacebookResponseException $e) {
			  echo 'Graph returned an error: ' . $e->getMessage();
			  exit;
			} catch(Facebook\Exceptions\FacebookSDKException $e) {
			  echo 'Facebook SDK returned an error: ' . $e->getMessage();
			  exit;
			}

			$user = $response->getGraphUser();

			//echo 'Name: ' . $user['name'];
			//echo '<img src="//graph.facebook.com/'.$user['id'].'/picture?type=large" />';
			//Zend_Debug::dump($user);
			//Zend_Debug::dump('/me?'.join(',', $fields));
		}
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
		#if (isset($accessToken)) {
  		// Logged in!
  		#$_SESSION['facebook_access_token'] = (string) $accessToken;

 		 // Now you can redirect to another page and use the
  		// access token from $_SESSION['facebook_access_token']
		#}					
		//Zend_Debug::dump('$accessToken');
		//if (!empty($_SESSION['facebook_access_token'])) {
		//	Zend_Debug::dump($_SESSION['facebook_access_token']);
		//}
		//Zend_Debug::dump($fb);


		//Zend_Debug::dump($firstName);	
		//Zend_Debug::dump($user['first_name']);
		
	}
}

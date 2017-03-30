<?php
class TestController extends Zend_Controller_Action {
	public function indexAction() {
		phpinfo();
		die('end');
	}
	public function googleIDAction(){


		
	}
	public function g2Action() {
		include_once 'google/Google_Client.php';
		include_once 'google/contrib/Google_Oauth2Service.php';

		$clientId = '662849423141-3vuo44osa65tf2p0qdlctgpfpdb57ofr.apps.googleusercontent.com';
		$clientSecret = '9mx90fubwpwCY8JpicSzdBKq';
		$redirectURL = 'http://sample.enrollment.com';

		//Call Google API
		$gClient = new Google_Client();
		$gClient->setApplicationName('sample enrollment');
		$gClient->setClientId($clientId);
		$gClient->setClientSecret($clientSecret);
		$gClient->setRedirectUri($redirectURL);

		$google_oauthV2 = new Google_Oauth2Service($gClient);
		Zend_Debug::dump($google_oauthV2); 
		die();

set_include_path(__DIR__.'/../' . PATH_SEPARATOR . get_include_path());
	    $client = new Google_Client();
	    $client->setApplicationName('sample enrollment');
	    #$client->setScopes(SCOPES);
	    $client->setAuthConfigFile(APPLICATION_PATH.'/configuration/client_credentials.json');
	    $client->setAccessType('offline');

	    #$credentialsPath = expandHomeDirectory(APPLICATION_PATH.'/configuration/client_credentials.json');
        $accessToken = file_get_contents(APPLICATION_PATH.'/configuration/client_credentials.json');
        #Zend_Debug::dump($accessToken); die();

		#define('APPLICATION_NAME', 'sample enrollment');
		#define('CREDENTIALS_PATH', APPLICATION_PATH.'/configuration');
		#define('CLIENT_SECRET_PATH', APPLICATION_PATH.'/configuration/client_credentials.json');

		#require_once APPLICATION_PATH.'/../vendor/google/apiclient/src/Google/autoload.php';
		#require_once APPLICATION_PATH.'/../vendor/google/auth/autoload.php';

		$client = new Google_Client();
		#$client->setAuthConfig(APPLICATION_PATH.'/configuration/client_credentials.json');
		#$client->useApplicationDefaultCredentials();
		#ar_dump(CLIENT_SECRET_PATH); die();

		#$authUrl = $client->createAuthUrl();
		#Zend_Debug::dump($authUrl);
		#die('end');
		$redirect_uri = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'];
		$client->setRedirectUri($redirect_uri);
		#$token = $client->fetchAccessTokenWithAuthCode();

	    #$client->authenticate($accessToken);
    	$token = $client->getAccessToken();

		Zend_Debug::dump($client);
		Zend_Debug::dump($token);
		die('end');
		#$id = '662849423141-3vuo44osa65tf2p0qdlctgpfpdb57ofr.apps.googleusercontent.com';
		#$id = '86800409401-1rtftn4eek1r2t8mlvune9srfbnm40j9.apps.googleusercontent.com';
		#$secret = '9mx90fubwpwCY8JpicSzdBKq';
		#$secret = 'V49N5ZMe6Cw_NU1tH98JvZVw';
		#require_once 'Google/Client.php';
		#require_once 'Google/contrib/Google_AnalyticsService.php';

		$scriptUri = "http://".$_SERVER["HTTP_HOST"].$_SERVER['PHP_SELF'];

		$client = new Google_Client();
		$client->setAccessType('online'); // default: offline
		$client->setApplicationName('sample enrollment');
		$client->setClientId($id);
		$client->setClientSecret($secret);
		$client->setRedirectUri($scriptUri);
		#$client->setDeveloperKey('INSERT HERE'); // API key

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
		//Include Google client library 
		require_once 'google/Google_Client.php';
		require_once 'google/contrib/Google_Oauth2Service.php';
		


		/*
		 * Configuration and setup Google API
		 */
		$clientId = '86800409401-u4ol0t7jbegcpvle0taev56lnospsbfh.apps.googleusercontent.com'; //Google client ID
		$clientSecret = 'DWZZ8rIg85r2KBEF-BoPPhtU'; //Google client secret
		$redirectURL = 'http://sample.enrollment.com/test/google'; //Callback URL

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

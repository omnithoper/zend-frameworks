<?php
class TestController extends Zend_Controller_Action {
	public function indexAction() {
		phpinfo();
		die('end');
	}
	public function twitterAction(){
		require_once "twitter/autoload.php";
		require_once "twitter/abraham/TwitterOAuth/src/TwitterOAuth.php";
	
		$connection = new TwitterOAuth("2irRW5VTuaEi8lGXNSCbDbQEb", 
				"tnl4d6DDVn2lqyaOCKSM4c7D9pGfaFRT8YcwcIJtsvWwmmrpWW", 
				$access_token, $access_token_secret);
			die("here");
		$content = $connection->get("account/verify_credentials");
		
	}
	

    public function resumeAction() {
    	
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
		$gClient->setApplicationName('Login to sample.enrollment.com');
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

	public function testAction() {
		$this->view->url = 'https://www.facebook.com/zuck';
	}

	public function gplusAction() {

	}

	public function cesarAction()
	{
   		$this->_helper->viewRenderer->setNoRender();
   		$this->_helper->layout()->disableLayout();
		echo '
			<html>
				<head>
				<script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
				</head>
				<body>
					<h1>test JSON</h1>
					<div id="dummy">
					</div>
					<script type="text/javascript">
						var testJson = [{name: "cesar", student_id: 10001}, {name: "anthony", student_id: 20002}];
						console.log(testJson);

						for (ctr = 0; ctr < testJson.length; ctr++) {
							console.log(testJson[ctr]);
							var temp = "<dl><dt>" + testJson[ctr].name + "</dt><dd>" + testJson[ctr].student_id + "</dd></dl>";
							$("#dummy").append(temp);
						}
					</script>
				</body>
			</html>
		';
		exit();
	}

	public function testjsonAction() {
		$myObj = new stdClass();

		$myObj->name = "John";
		$myObj->age = 30;
		$myObj->city = "New York";

		$myJSON = Zend_Json::encode($myObj);

		$this->view->myJSON;
	}
	public function fbwhatAction() {
		$fb = new Facebook\Facebook([
		  'app_id' => '1729933903964760',
		  'app_secret' => 'af7d04a68993ac028425a4daa3c154a4',
		  'default_graph_version' => 'v2.5',
		]);

		$fb->setDefaultAccessToken($_SESSION['facebook_access_token']);
		$response = $fb->get('/me');
		$user = $response->getGraphUser();
		Zend_Debug::dump($user['id']);

		// GET /v2.8/{user-id} HTTP/1.1
		//$response = $fb->get('/'.$user['id'].'/friendlists');
		$response = $fb->get('/'.$user['id'].'/user_friends');
		$test = $response->getGraphUser();
		Zend_Debug::dump($test);
		die();
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

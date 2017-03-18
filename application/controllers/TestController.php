<?php
class TestController extends Zend_Controller_Action {
	public function indexAction() {
		phpinfo();
		die('end');
	}
	
	public function fbAction() {
		$fb = new Facebook\Facebook([
		  'app_id' => '1729933903964760',
		  'app_secret' => 'af7d04a68993ac028425a4daa3c154a4',
		  'default_graph_version' => 'v2.5',
		]);
		

		// step 2
		$helper = $fb->getRedirectLoginHelper();
		try {
  			$accessToken = $helper->getAccessToken();
		} catch(Facebook\Exceptions\FacebookResponseException $e) {
 		 // When Graph returns an error
  		echo 'Graph returned an error: ' . $e->getMessage();
  		exit;
		} catch(Facebook\Exceptions\FacebookSDKException $e) {
  		// When validation fails or other local issues
 		 echo 'Facebook SDK returned an error: ' . $e->getMessage();
  		exit;
		}

		// step 1
		if (empty($accessToken)) {
			$helper = $fb->getRedirectLoginHelper();
			$permissions = ['email', 'user_likes']; // optional
			$loginUrl = $helper->getLoginUrl('http://sample.enrollment.com/test/fb', $permissions);

			echo '<a href="' . $loginUrl . '">Log in with Facebook!</a>';	
		}
	
		// step 3	
		// Sets the default fallback access token so we don't have to pass it to each request
		if (!empty($accessToken)) {
			$fb->setDefaultAccessToken($accessToken);

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

			echo 'Logged in as ' . $userNode->getName();
			try {
			// Returns a `Facebook\FacebookResponse` object
			$response = $fb->get('/me?fields=id,name,cover', $accessToken);
			} catch(Facebook\Exceptions\FacebookResponseException $e) {
			  echo 'Graph returned an error: ' . $e->getMessage();
			  exit;
			} catch(Facebook\Exceptions\FacebookSDKException $e) {
			  echo 'Facebook SDK returned an error: ' . $e->getMessage();
			  exit;
			}

			$user = $response->getGraphUser();

			echo 'Name: ' . $user['name'];
			Zend_Debug::dump($user);
		}

		#if (isset($accessToken)) {
  		// Logged in!
  		#$_SESSION['facebook_access_token'] = (string) $accessToken;

 		 // Now you can redirect to another page and use the
  		// access token from $_SESSION['facebook_access_token']
		#}					
		//Zend_Debug::dump('$accessToken');
		Zend_Debug::dump($accessToken);
		//Zend_Debug::dump('$fb');
		Zend_Debug::dump($fb);
		die('here');
	}
}

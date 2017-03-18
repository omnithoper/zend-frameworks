<?php
class TestController extends Zend_Controller_Action {
	public function indexAction() {
		die('end');
	}
	
	public function fbAction() {
		$fb = new Facebook\Facebook([
		  'app_id' => '{app-id}',
		  'app_secret' => '{app-secret}',
		  'default_graph_version' => 'v2.5',
		]);
		die('end');
	}
}

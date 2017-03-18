<?php
class BaseController extends Zend_Controller_Action {
	public function render($template) {
		$fb = new Facebook\Facebook([
		  'app_id' => '{app-id}',
		  'app_secret' => '{app-secret}',
		  'default_graph_version' => 'v2.5',
		]);
	}
}

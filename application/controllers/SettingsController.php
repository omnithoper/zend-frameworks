<?php
class SettingsController extends Zend_Controller_Action {

	public function indexAction() {
		date_default_timezone_set("Asia/Manila");
		$date = date("Y-m-d");

		$settings = new Settings();

		$result = $settings->getViewSettings();
			var_dump($result);
		die("here");
		//$records = $settings->getViewAllSemester();

	   	$this->view->settings = $result;
	  	//$this->view->settings = $records;

	  
	}
}
?>
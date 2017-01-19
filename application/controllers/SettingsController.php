<?php
class SettingsController extends Zend_Controller_Action {

	public function indexAction() {
		date_default_timezone_set("Asia/Manila");
		$date = date("Y-m-d");

		$settings = new Application_Model_Settings();
		$semester = new Application_Model_Semester();

		$settings = $settings->getViewSettings();
	//	var_dump($settings);
	//	die("here");
		$semesters = $semester->getViewSemester();
		$this->view->semesters = $semesters;
		$this->view->settings = $settings;
		$this->view->date = $date;

	
	}
}
?>
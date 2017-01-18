<?php
class SettingsController extends Zend_Controller_Action {

	public function indexAction() {
		date_default_timezone_set("Asia/Manila");
		$date = date("Y-m-d");

		$semester = new Application_Model_Semester();

		$semesters = $semester->getViewSemester();
		$this->view->semesters = $semesters;

	
	}
}
?>
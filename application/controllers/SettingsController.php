<?php
class SettingsController extends Zend_Controller_Action  {

	public function indexAction() {
		date_default_timezone_set("Asia/Manila");
		$date = date("Y-m-d");

		$settings = new Settings();
		$semester = new Semester();

		$settings = $settings->getViewSettings();

		$semesters = $semester->getViewSemester();
		$this->view->semesters = $semesters;
		$this->view->settings = $settings;
		$this->view->date = $date;
	}
}
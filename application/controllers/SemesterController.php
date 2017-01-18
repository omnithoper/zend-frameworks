<?php
class SemesterController extends Zend_Controller_Action {

	public function addAction(){

		$dateStart = Application_Model_Request::getParam('date_start');
		$dateEnd = Application_Model_Request::getParam('date_end');

		
		
		if (isset($_POST['save'])){
		$data = array(
		    'date_start' => $dateStart,
		    'date_end' => $dateEnd
		);
		$semester = new Application_Model_Semester();
		$result = [];
			$result = $semester->getAddSemester($data);
			$this->view->semester = $result;
		

     	}

	}
	public function detailsAction() {
		
		$semesterID = Application_Model_Request::getParam('semesterID');

		$semester = new Application_Model_Semester();
		$details = $semester->getSemesterDetails($semesterID);
		echo Zend_Json::encode($details);
		exit;
	}

	public function editAction() {

		$semesterID = Application_Model_Request::getParam('semester_id');
		$semesterID = (empty($semestID) && !empty($_POST['semester_id']))?$_POST['semester_id']:$semesterID;


		$editObject = new Application_Model_Semester();
	//	$view = $editObject->getViewSemester($semesterID);


		if (isset($_POST['edit'])) {
			$dateStart = Application_Model_Request::getParam('date_start');
			$dateEnd = Application_Model_Request::getParam('date_end');

			$data = array(
		    	'date_start' => $dateStart,
		    	'date_end' => $dateEnd
			);


			$editObject = new Application_Model_Semester();
			$edit = [];
			$edit = $editObject->getEditSemester($data, $semesterID);
		
		
			$this->view->semester = $edit;

		}
	}
	public function deleteAction() {
			
	$semesterID = Application_Model_Request::getParam('semester_id');
	
	$deleteObject = new Application_Model_Semester();
	$delete = $deleteObject->getDeleteSemester($semesterID);

	}
}
?>
<?php
class SemesterController extends Zend_Controller_Action {

	public function addAction(){

		$dateStart = Request::getParam('date_start');
		$dateEnd = Request::getParam('date_end');

		
		
		if (isset($_POST['save'])){
		$data = array(
		    'date_start' => $dateStart,
		    'date_end' => $dateEnd
		);
		$semester = new Semester();
		$result = [];
			$result = $semester->getAddSemester($data);
			$this->view->semester = $result;	
     	}

	}
	public function detailsAction() {
		
		$semesterID = Request::getParam('semesterID');

		$semester = new Semester();
		$details = $semester->getSemesterDetails($semesterID);
		echo Zend_Json::encode($details);
		exit;
	}

	public function editAction() {

		$semesterID = Request::getParam('semester_id');
		$semesterID = (empty($semestID) && !empty($_POST['semester_id']))?$_POST['semester_id']:$semesterID;


		$editObject = new Semester();
	//	$view = $editObject->getViewSemester($semesterID);


		if (isset($_POST['edit'])) {
			$dateStart = Request::getParam('date_start');
			$dateEnd = Request::getParam('date_end');

			$data = array(
		    	'date_start' => $dateStart,
		    	'date_end' => $dateEnd
			);


			$editObject = new Semester();
			$edit = [];
			$edit = $editObject->getEditSemester($data, $semesterID);
		
		
			$this->view->semester = $edit;

		}
	}
	public function addsAction() {
		$this->_helper->viewRenderer->setNoRender();
		$this->_helper->layout()->disableLayout();

		$dateStart = Request::getParam('dateStart');
		$dateEnd = Request::getParam('dateEnd');

		$data = array(
	    	'date_start' => $dateStart,
	    	'date_end' => $dateEnd
		);

		$semester = new Semester();
		$details = $semester->addSemester($data);
	
		echo Zend_Json::encode($details);

	}
	public function updateAction() {
		$this->_helper->viewRenderer->setNoRender();
		$this->_helper->layout()->disableLayout();

		$semesterID = Request::getParam('semesterID');
		$dateStart = Request::getParam('dateStart');
		$dateEnd = Request::getParam('dateEnd');

		$data = array(
	    	'date_start' => $dateStart,
	    	'date_end' => $dateEnd
		);
	
		$semester = new Semester();
		$details = $semester->updateSemester($data, $semesterID);
	
		echo Zend_Json::encode($details);

	}
	public function deleteAction() {
			
	$semesterID = Request::getParam('semester_id');
	
	$deleteObject = new Semester();
	$delete = $deleteObject->getDeleteSemester($semesterID);

	}
}
?>
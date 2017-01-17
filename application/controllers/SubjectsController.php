<?php
class SubjectsController extends Zend_Controller_Action {
	public function indexAction() {
		$subjects = new Application_Model_Subject();
		$records = $subjects->getViewSubjects();
	    $this->view->subjects = $records;
	}
	public function detailsAction() {
		
		$subjectID = Application_Model_Request::getParam('subjectID');

		$subject = new Application_Model_Subject();
		$details = $subject->getSubjectDetails($subjectID);
		echo Zend_Json::encode($details);
		exit;
	}	
	public function addAction(){

		if (isset($_POST['save'])) {	 
			$subject = Application_Model_Request::getParam('subject');
			$lecUnit = Application_Model_Request::getParam('lec_unit');
			$labUnit = Application_Model_Request::getParam('lab_unit');
			$subjectUnit = Application_Model_Request::getParam('subject_unit');
			$subjects = new Application_Model_Subject();
		    $subjects->getAddSubject($subject, $lecUnit, $labUnit, $subjectUnit);
		
		}
	
	}	
	public function editAction() {
		$subjectID = Application_Model_Request::getParam('subject_id');
		$subjects = new Application_Model_Subject();
		$details = $subjects->getSubjectDetails($subjectID);
		$this->view->subject = $details;
	
		$edit = [];
		if (isset($_POST['edit'])) {
			$subject = Application_Model_Request::getParam('subject');
			$subjectUnit = Application_Model_Request::getParam('subject_unit');
			$lecUnit = Application_Model_Request::getParam('lec_unit');
			$labUnit = Application_Model_Request::getParam('lab_unit');
			$subjects->getEditSubject($subject, $lecUnit, $labUnit, $subjectUnit, $subjectID); 

	}

}
	function deleteAction() {
		$subjectID = Application_Model_Request::getParam('subject_id');
		
		$deleteObject = new Application_Model_Subject();
		$deleteObject->getDeleteSubject($subjectID);
	

	}
}	
?>	
<?php
	class SubjectsController extends Zend_Controller_Action {
		public function indexAction() {
		
		$subjects = new Subject();
		$records = $subjects->getViewSubjects();
	    $this->view->subjects = $records;

		}
	public function addAction(){

		if (isset($_POST['save'])) {	 
			$subject = Request::getParam('subject');
			$lecUnit = Request::getParam('lec_unit');
			$labUnit = Request::getParam('lab_unit');
			$subjectUnit = Request::getParam('subject_unit');
			$subjects = new Subject();
		    $subjects->getAddSubject($subject, $lecUnit, $labUnit, $subjectUnit);
		
		}
	
	}	
	public function editAction() {
		$subjectID = Request::getParam('subject_id');
		$subjectID = (empty($subjectID) && !empty($_POST['subject_id']))?$_POST['subject_id']:$subjectID;

		
		$edit = [];
		if (isset($_POST['edit'])) {
			$subject = Request::getParam('subject');
			$subjectUnit = Request::getParam('subject_unit');
			$lecUnit = Request::getParam('lec_unit');
			$labUnit = Request::getParam('lab_unit');
			$subjects = new Subject();
			$subjects->getEditSubject($subject, $lecUnit, $labUnit, $subjectUnit, $subjectID); 

	}

}
	function deleteAction() {
		$subjectID = Request::getParam('subject_id');
		
		$deleteObject = new Subject();
		$deleteObject->getDeleteSubject($subjectID);
	

	}
}	
?>	
<?php
	class SubjectsController extends Zend_Controller_Action {
		public function indexAction() {
		
		$subjects = new Subject();
		$records = $subjects->getViewSubjects();
	   $this->view->subjects = $records;

		}
	public function addAction(){

		$subject = Request::getParam('subject');
		$lecUnit = Request::getParam('lec_unit');
		$labUnit = Request::getParam('lab_unit');
		$subjectUnit = Request::getParam('subject_unit');
		
		$data = array(
		    'subject' => $subject,
		    'lec_unit' => $lecUnit,
		    'lab_unit' => $labUnit,
		    'subject_unit' => $subjectUnit
		);
		 
		$subjects = new Subject();

		$newRow = $subjects->createRow($data);
		if (isset($_POST['save'])) {	 
			// INSERT the new row to the database
			$newRow->save();
		header("Location: /subjects");	
		}
	
	}	
	public function editAction() {
		$subjectID = Request::getParam('subject_id');
		$subjectID = (empty($subjectID) && !empty($_POST['subject_id']))?$_POST['subject_id']:$subjectID;


		$editObject = new Subject();
		$view = $editObject->getViewSubject($subjectID);

		$edit = [];
		if (isset($_POST['edit'])) {
			$subject = Request::getParam('subject');
			$subjectUnit = Request::getParam('subject_unit');
			$lecUnit = Request::getParam('lec_unit');
			$labUnit = Request::getParam('lab_unit');
			$edit = $editObject->getEditSubject($subject, $lecUnit, $labUnit, $subjectUnit, $subjectID);
		}

		 $this->view->subjects = $records;
	
	}

	function deleteAction() {
		$subjectID = Request::getParam('subject_id');
		
		$deleteObject = new Subject();
		$deleteObject->getDeleteSubject($subjectID);
	

	}
	

}	
?>	
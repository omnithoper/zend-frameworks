<?php
class EnrollmentController extends Zend_Controller_Action {
	public function indexAction() {

	
		$studentName = Application_Model_Request::getParam('studentName');
		$studentID = Application_Model_Request::getParam('studentID');
		$getSubjectID = Application_Model_Request::getParam('getSubjectID');
		$subjectID = Application_Model_Request::getParam('subjectID');
		$students = [];
		$subject = new Application_Model_Subject();	
		$studentSubject = new Application_Model_StudentSubjectMatch();

		$student = new Application_Model_Student();
		//$settingObject = new Application_Model_Settings();
		
		$subject = $subject->getSubjects();

		$students = $student->getAllStudentInformation($studentName);

	
		if (count($students) == 1) {
			$selectedStudent = (!empty($students[0]))?$students[0]:NULL;
			$studentID = $students[0]['student_id'];
				$this->view->selectedStudent = $selectedStudent;
		}

		//$studentSubject  = $studentSubjectObject->getAddStudentSubjectID($studentID, $getSubjectID);
				 
		if (Application_Model_Request::getParam('action') == 'delete') {
			$delete = $studentSubject->getDeleteSubject($studentID, $subjectID);
		}

		$allSubject = $studentSubject->getStudentSubjects();
		var_dump($allSubjects);

		//$totalUnit = $subjectObject->getCurrentUnits($studentID);
		//$isStudentPayed = $studentLastNameObject->isStudentPayed($studentID);
		$this->view->students = $students;
		$this->view->studentID = $studentID;
		$this->view->subject = $subject;
		$this->view->allSubject = $allSubject;
	}	
}
?>
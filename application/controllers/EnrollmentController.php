<?php
class EnrollmentController extends Zend_Controller_Action {
	public function indexAction() {

		$studentName = Request::getParam('studentName');
		$studentID = Request::getParam('studentID');
		$getSubjectID = Request::getParam('getSubjectID');
		$subjectID = Request::getParam('subjectID');
		$students = [];
		$subject = new Subject();	
		$studentSubject = new StudentSubjectMatch();

		$student = new Student();
		//$settingObject = new Settings();
		
		$subject = $subject->getSubjects();
		#Zend_Debug::dump($subject); die();

		$students = $student->getAllStudentInformation($studentName);
		$selectedStudent = $student->getViewStudent($studentID);
		#Zend_Debug::dump($students); die();

		if (count($students) == 1) {
			$selectedStudent = (!empty($students[0]))?$students[0]:NULL;
			$studentID = $students[0]['student_id'];
		}

	//	$studentSubject  = $studentSubject->getAddStudentSubjectID($studentID, $getSubjectID);
				 
		if (Request::getParam('action') == 'delete') {
			$delete = $studentSubject->getDeleteSubject($studentID, $subjectID);
		}
		//if (isset($_POST['search'])){
			$allSubject = $studentSubject->getStudentSubjects($studentID);
	
		//}

		//$totalUnit = $subjectObject->getCurrentUnits($studentID);
		//$isStudentPayed = $studentLastNameObject->isStudentPayed($studentID);
		$this->view->students = $students;
		$this->view->studentID = $studentID;
		$this->view->subject = $subject;
		$this->view->allSubject = $allSubject;
		$this->view->selectedStudent = $selectedStudent;
	}	
}
?>
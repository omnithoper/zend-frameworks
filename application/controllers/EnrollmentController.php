<?php
class EnrollmentController extends Zend_Controller_Action {
	public function indexAction() {

		$studentName = Request::getParam('studentName');
		$studentID = Request::getParam('studentID');
		$sessionStudentID = (!empty($_SESSION['student_id']))?$_SESSION['student_id']:null;
		$getSubjectID = Request::getParam('getSubjectID');
		$subjectID = Request::getParam('subjectID');
	
		$students = [];
		$subjects = new Subject();	
		$studentSubject = new StudentSubjectMatch();
		$student = new Student();

		$subject = $subjects->getViewSubjects();
		#Zend_Debug::dump($subject); die();
		if (!empty($sessionStudentID)) {
			$students = $student->getAllStudentStudentID($sessionStudentID);
		}
		else { 
			$students = $student->getAllStudentInformation($studentName);
		}
		$selectedStudent = $student->getViewStudent($studentID);
		#Zend_Debug::dump($students); die();

		if (count($students) == 1) {
			$selectedStudent = (!empty($students[0]))?$students[0]:NULL;
			$studentID = $students[0]['student_id'];
		}

		$addStudentSubject = $studentSubject->getAddStudentSubjectID($studentID, $getSubjectID);

		if (Request::getParam('action') == 'delete') {
			$delete = $studentSubject->getDeleteSubject($studentID, $subjectID);
		}

		$allSubject = $studentSubject->getStudentSubjects($studentID);
		$totalUnit = $subjects->getCurrentUnits($studentID);
		$isStudentPayed = $student->isStudentPayed($studentID);
		$isStudentPayed = empty($isStudentPayed[0]['payment'])?NULL:$isStudentPayed[0]['payment'];

		$this->view->totalUnit = $totalUnit;
		$this->view->isStudentPayed = $isStudentPayed;
		$this->view->students = $students;
		$this->view->studentID = $studentID;
		$this->view->subject = $subject;
		$this->view->allSubject = $allSubject;
		$this->view->selectedStudent = $selectedStudent;
		$this->view->error = $addStudentSubject;
	}	
}
?>
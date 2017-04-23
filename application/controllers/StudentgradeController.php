<?php
class StudentgradeController extends Zend_Controller_Action  {
	public function indexAction() {
		$studentName = Request::getParam('studentName');
		$studentID = Request::getParam('studentID');
		$sessionStudentID = (!empty($_SESSION['student_id']))?$_SESSION['student_id']:null;
		$subjectID = Request::getParam('subjectID');
	
		$students = [];
		$subjects = new Subject();	
		$studentSubject = new StudentSubjectMatch();
		$student = new Student();

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
	
		$allSubject = $studentSubject->getStudentSubjects($studentID);
		
		$this->view->students = $students;
		$this->view->studentID = $studentID;
		$this->view->allSubject = $allSubject;
		$this->view->selectedStudent = $selectedStudent;
	}
		public function detailsAction() {
			
			$studentID = Request::getParam('studentID');
			$subjectID = Request::getParam('subjectID');
	
			$student = new StudentSubjectMatch();
			$details = $student->getStudentSubjectDetails($studentID,$subjectID);
			$this->view->studentGrade = $details;
			echo Zend_Json::encode($details);
			exit;	
		}
		public function editAction() {
			
		$studentID = Request::getParam('studentID');
		$subjectID = Request::getParam('subjectID');

		$studentGrade = new StudentSubjectMatch();		
		$details = $studentGrade->getStudentSubjectDetails($studentID,$subjectID);
		$this->view->student = $details;
		$edit = [];
		if (isset($_POST['edit'])){

			$midTerm = Request::getParam('mid_term');
			$finalTerm = Request::getParam('final_term');

			$data = array(
		    	'mid_term' => $midTerm,
		    	'final_Term' => $finalTerm,
			);

			$edit = $studentGrade->getEditStudentGrade($data, $studentID, $subjectID);
		}
	}
}
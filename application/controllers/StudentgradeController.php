<?php
class StudentgradeController extends Zend_Controller_Action  {
	public function indexAction() {
		$date = date("Y-m-d");

		$studentName = Request::getParam('studentName');
		$studentID = Request::getParam('studentID');
		$sessionStudentID = (!empty($_SESSION['student_id']))?$_SESSION['student_id']:null;
		$subjectID = Request::getParam('subjectID');
	
		$students = [];
		$subjects = new Subject();	
		$studentSubject = new StudentSubjectMatch();
		$student = new Student();
		$semester = new Semester();

		$semesterID = $semester->getSemesterID($date);
	
		if (!empty($sessionStudentID)) {
			$students = $student->getAllStudentStudentID($sessionStudentID);
		}
		else { 
			$students = $student->getAllStudentInformation($studentName);
		}
		$selectedStudent = $student->getViewStudent($studentID);

		if (count($students) == 1) {
			$selectedStudent = (!empty($students[0]))?$students[0]:NULL;
			$studentID = $students[0]['student_id'];
		}
	
		$allSubject = $studentSubject->getStudentSubjects($studentID, $semesterID);
		Zend_Debug::dump($studentID);
		Zend_Debug::dump($semesterID);
		Zend_Debug::dump($subjectID);
		die("here");
		$this->view->students = $students;
		$this->view->studentID = $studentID;
		$this->view->subjectID = $subjectID;
		$this->view->semesterID = $semesterID;
		$this->view->allSubject = $allSubject;
		$this->view->selectedStudent = $selectedStudent;
	}

	public function detailsAction() {
		
		$studentID = Request::getParam('studentID');
		$subjectID = Request::getParam('subjectID');
		$semesterID = Request::getParam('semesterID');

		$studentGrade = new StudentSubjectMatch();	


		$details = $studentGrade->getStudentSubjectDetails($studentID,$subjectID,$semesterID);
		$this->view->studentGrade = $details;
		echo Zend_Json::encode($details);
		exit
		;	
	}
	public function addsAction() {
		$this->_helper->viewRenderer->setNoRender();
		$this->_helper->layout()->disableLayout();

		$totalGrade = Request::getParam('totalGrade');
		$studentID = Request::getParam('studentID');
		$subjectID = Request::getParam('subjectID');
		$semesterID = Request::getParam('semesterID');
		Zend_Debug::dump($totalGrade);
		$data = array(
	    	'total_grade' => $totalGrade,
		);

		$subject = new StudentSubjectMatch();
		$subject->addSubjectGrade($data, $studentID, $subjectID, $semesterID);
		exit;
	}

	public function editAction() {
		
	$studentID = Request::getParam('studentID');
	$subjectID = Request::getParam('subjectID');
	$semesterID = Request::getParam('semesterID');
	$studentGrade = new StudentSubjectMatch();	


	$details = $studentGrade->getStudentSubjectDetails($studentID,$subjectID,$semesterID);

	$this->view->student = $details;
	$edit = [];
	if (isset($_POST['edit'])){

		$midTerm = Request::getParam('mid_term');
		$finalTerm = Request::getParam('final_term');

		$data = array(
	    	'mid_term' => $midTerm,
	    	'final_Term' => $finalTerm,
		);

		$edit = $studentGrade->getEditStudentGrade($data, $studentID, $subjectID, $semesterID);
	}
	}
}
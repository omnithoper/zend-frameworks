<?php
class EnrollmentController extends Zend_Controller_Action {
	public function indexAction() {
		$date = date("Y-m-d");
		$studentName = Request::getParam('studentName');
		$studentID = Request::getParam('studentID');
		$sessionStudentID = (!empty($_SESSION['student_id']))?$_SESSION['student_id']:null;
		$getSubjectID = Request::getParam('getSubjectID');
		$subjectID = Request::getParam('subjectID');
		$blockSection = Request::getParam('blockSection');
		$addStudentSubject = "";

		$blockSection = explode(',' , $blockSection);
		$sectionBlock = empty($blockSection[0])?NULL:$blockSection[0];
		$semesterNumber = empty($blockSection[1])?NULL:$blockSection[1];

		$subjects = new Subject();
		$studentSubject = new StudentSubjectMatch();
		$student = new Student();
		$semester = new Semester();
		$bSection = new BlockSection();

		$bbSection = $bSection->getViewBlockSection();
		$semesterID = $semester->getSemesterID($date);
		$viewSubjects = $bSection->getBlockSection($sectionBlock, $semesterNumber);

	//Zend_Debug::dump($viewSubjects);
	//Zend_Debug::dump($studentID);
	//Zend_Debug::dump($semesterID);	
	//	die("here");
		if (!empty($sessionStudentID)) {
			$students = $student->getAllStudentStudentID($sessionStudentID);
		} else {
			$students = $student->getAllStudentInformation($studentName);
		}
		$selectedStudent = $student->getViewStudent($studentID);

		if (count($students) == 1) {
			$selectedStudent = (!empty($students[0]))?$students[0]:NULL;
			$studentID = $students[0]['student_id'];
		}

		if (!empty($getSubjectID)) {
			$addStudentSubject = $studentSubject->getAddStudentSubjectID($studentID, $getSubjectID, $semesterID);
		} elseif (!empty($viewSubjects)) {
				foreach ($viewSubjects as $listSubject) {
		//			echo $listSubject['subject_id'];
					$addStudentSubject = $studentSubject->getAddStudentSubjectID($studentID, $listSubject['subject_id'], $semesterID);
			}	
				
		}	

		 	
		if (Request::getParam('action') == 'delete') {
			$delete = $studentSubject->getDeleteSubject($studentID, $subjectID, $semesterID);
		}
		$subject = $subjects->getListSubjects($studentID, $semesterID);
	
		$allSubject = $studentSubject->getStudentSubjects($studentID, $semesterID);
		$totalUnit = $subjects->getCurrentUnits($studentID, $semesterID);

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
		$this->view->bbSection = $bbSection;
	}
}
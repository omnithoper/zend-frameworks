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
		$checkBlockSection = empty($checkblockSection)?'blockSectionUnit':$checkblockSection;

		$blockSection = explode(',' , $blockSection);
		$sectionBlock = empty($blockSection[0])?NULL:$blockSection[0];
		$semesterNumber = empty($blockSection[1])?NULL:$blockSection[1];

		$subjects = new Subject();
		$studentSubject = new StudentSubjectMatch();
		$student = new Student();
		$semester = new Semester();
		$bSection = new BlockSection();
		$studentBlockSectionMatch = new StudentBlockSectionMatch();

		$bbSection = $bSection->getViewBlockSection();
		$semesterID = $semester->getSemesterID($date);

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

		$addBlockSection = $studentBlockSectionMatch->getAddBlockSection($studentID, $sectionBlock, $semesterNumber, $semesterID);
		$addStudentSubject = $studentSubject->getAddStudentSubjectID($studentID, $getSubjectID, $semesterID);
		$viewBlockSection = $studentBlockSectionMatch->getBlockSection($studentID, $semesterID);

		$subject = $subjects->getListSubjects($studentID, $semesterID);

		$totalUnit = $subjects->getCurrentUnits($studentID, $semesterID);
		$blockSectionUnit = $studentBlockSectionMatch->getBlockSectionUnits($studentID, $semesterID);
		$isStudentPayed = $student->isStudentPayed($studentID);
		$isStudentPayed = empty($isStudentPayed[0]['payment'])?NULL:$isStudentPayed[0]['payment'];

		if (!empty($viewBlockSection)) {
			$allSubject = $studentBlockSectionMatch->getBlockSection($studentID, $semesterID);
			$this->view->totalUnit = $blockSectionUnit;
			$this->view->checkBlockSection = $checkBlockSection;

		} else {
			$allSubject = $studentSubject->getStudentSubjects($studentID, $semesterID);
			$this->view->totalUnit = $totalUnit;

			/*
				foreach ($viewSubjects as $listSubject) {
		//			echo $listSubject['subject_id'];
					$addStudentSubject = $studentSubject->getAddStudentSubjectID($studentID, $listSubject['subject_id'], $semesterID);
			}
			*/		
		}	

		if (Request::getParam('action') == 'delete') {
			$delete = $studentSubject->getDeleteSubject($studentID, $subjectID, $semesterID);
		}
		
		
		$this->view->isStudentPayed = $isStudentPayed;
		$this->view->students = $students;
		$this->view->studentID = $studentID;
		$this->view->semesterID = $semesterID;
		$this->view->subject = $subject;
		$this->view->viewBlockSection = $viewBlockSection;
		$this->view->allSubject = $allSubject;
		$this->view->selectedStudent = $selectedStudent;
		$this->view->bbSection = $bbSection;

	}
}

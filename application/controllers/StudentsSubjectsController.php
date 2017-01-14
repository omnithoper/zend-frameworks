<?php
class StudentsSubjectsController extends BaseController {
	function indexAction(){
		$studentName = Request::getParam('studentName');
		$studentID = Request::getParam('studentID');
		$getSubjectID = Request::getParam('getSubjectID');
		$subjectID = Request::getParam('subjectID');
		$students = [];
		
		$subjectObject = new Subject();	
		$studentSubjectObject = new StudentSubjectMatch();
		$studentLastNameObject = new Student();
		$settingObject = new Settings();


		$subject = $subjectObject->getSubjects();

		$students = $studentLastNameObject->getAllStudentInformation($studentName);
		$selectedStudent = $studentLastNameObject->getViewStudent($studentID);

		if (count($students) == 1) {
			$selectedStudent = (!empty($students[0]))?$students[0]:NULL;
			$studentID = $students[0]['student_id'];
		}

		$studentSubject  = $studentSubjectObject->getAddStudentSubjectID($studentID, $getSubjectID);
				 
		if (Request::getParam('action') == 'delete') {
			$delete = $studentSubjectObject->getDeleteSubject($studentID, $subjectID);
		}
		$allSubject = $studentSubjectObject->getStudentSubjects($studentID);
		$totalUnit = $subjectObject->getCurrentUnits($studentID);
		$isStudentPayed = $studentLastNameObject->isStudentPayed($studentID);
		
		$this->assign('students', $students);
		$this->assign('selectedStudent', $selectedStudent);
		$this->assign('isStudentPayed',$isStudentPayed);
		$this->assign('subject', $subject);
		$this->assign('allSubject', $allSubject);
		$this->assign('studentID', $studentID);	
		$this->assign('totalUnit', $totalUnit);
		$this->assign('error', $studentSubject);
	}	

}
?>
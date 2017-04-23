<?php
class CashierController extends Zend_Controller_Action {
	public function indexAction() {
		$studentID = Request::getParam('studentID');
		$semesterID = Request::getParam('semesterID');
		$checkBlockSection = Request::getParam('checkBlockSection');
		Zend_Debug::dump($viewBlockSection);

		$setting = new Settings();
		$cashier =  new Cashier();
		$student = new Student();
		$studentBlockSectionMatch = new StudentBlockSectionMatch();

		$studentName = $student->getStudentName($studentID);

		$studentName = empty($studentName)?NULL:$studentName['fullName'];
	
		$priceMisc = $setting->getPriceMisc();
		$totalPrice = $cashier->getTotalPrice($studentID, $semesterID);

		$totalUnitPrice = $cashier->getTotalUnitPrice($studentID, $semesterID);
		$totalLecUnitPrice = $cashier->getTotalLecturePrice($studentID, $semesterID);
		$totalLabUnitPrice = $cashier->getTotalLaboratoryPrice($studentID, $semesterID);

		$studentSubject = new StudentSubjectMatch();
		
	//	$allSubject = $studentSubject->getStudentSubjects($studentID, $semesterID);
		
		if (!empty($checkBlockSection)) {
			$allSubject = $studentBlockSectionMatch->getBlockSection($studentID, $semesterID);

		} else {
			$allSubject = $studentSubject->getStudentSubjects($studentID, $semesterID);

		}	


		$subject = new  Subject();
		$totalUnit = $subject->getCurrentUnits($studentID, $semesterID);
		$totalLecUnit = $subject->getLectureUnits($studentID,$semesterID);
		$totalLabUnit = $subject->getLaboratoryUnits($studentID,$semesterID);
					
		$this->view->allSubject = $allSubject;
		$this->view->studentName = $studentName;
		$this->view->totalLecUnit = $totalLecUnit;
		$this->view->totalLabUnit = $totalLabUnit;
		$this->view->totalLecUnitPrice = $totalLecUnitPrice;
		$this->view->totalLabUnitPrice = $totalLabUnitPrice;	
		$this->view->studentID = $studentID;
		$this->view->totalUnit = $totalUnit;
		$this->view->totalUnitPrice = $totalUnitPrice;
		$this->view->priceMisc = $priceMisc;
		$this->view->totalPrice = $totalPrice;
	}
}
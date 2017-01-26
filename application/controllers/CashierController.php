<?php
class CashierController extends Zend_Controller_Action {

	public function indexAction() {

		$studentID = Request::getParam('studentID');

		$setting = new Settings();
		$cashier =  new Cashier();
		$student = new Student();
		$studentName = $student->getStudentName($studentID);

		$studentName = empty($studentName)?NULL:$studentName['fullName'];
	
		$priceMisc = $setting->getPriceMisc();
		$totalPrice = $cashier->getTotalPrice($studentID);

		$totalUnitPrice = $cashier->getTotalUnitPrice($studentID);
		$totalLecUnitPrice = $cashier->getTotalLecturePrice($studentID);
		$totalLabUnitPrice = $cashier->getTotalLaboratoryPrice($studentID);

		$studentSubject = new studentSubjectMatch();
		$allSubject = $studentSubject->getStudentSubjects($studentID);

		$subject = new  Subject();
		$totalUnit = $subject->getCurrentUnits($studentID);
		$totalLecUnit = $subject->getLectureUnits($studentID);
		$totalLabUnit = $subject->getLaboratoryUnits($studentID);
					
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
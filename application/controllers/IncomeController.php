<?php
class IncomeController extends Zend_Controller_Action  {
	public function indexAction() {
		$semDate = Request::getParam('semDate');

		$date = explode(',' , $semDate);
		$dateStart = empty($date[0])?NULL:$date[0];
		$dateEnd = empty($date[1])?NULL:$date[1];

		$semester = new Semester();
		$result = $semester->getPaymentDate($dateStart, $dateEnd);

		$semesterDate = $semester->getViewSemester();
		$studentPaid = $semester->getSemesterTotalIncome($dateStart, $dateEnd);
		$totalAmount = empty($studentPaid['total_income'])?null:$studentPaid['total_income'];
		$numberOfStudent =empty($studentPaid['total_student'])?null:$studentPaid['total_student'];
	
		$this->view->result = $result;
		$this->view->semesterDate = $semesterDate;
		$this->view->totalAmount = $totalAmount;
		$this->view->numberOfStudent = $numberOfStudent;
	}
}
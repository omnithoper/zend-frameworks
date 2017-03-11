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
		$totalAmount = $semester->getSemesterTotalIncome($dateStart, $dateEnd);

		$this->view->result = $result;
		$this->view->semesterDate = $semesterDate;
		$this->view->totalAmount = $totalAmount;
	}
}
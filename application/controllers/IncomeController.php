<?php
class IncomeController extends Zend_Controller_Action  {

	public function indexAction() {
		
		$semDate = Request::getParam('semDate');

		$semester = new Semester();
		$result = [];
		$income = 0;
		$totalAmount = 0;
		$change = 0;
		$totalPaid = 0;

		if (!empty($semDate)) {
			$date = explode(',' , $semDate);
			$dateStart = empty($date[0])?NULL:$date[0];
			$dateEnd = empty($date[1])?NULL:$date[1];

			$result = $semester->getPaymentDate($dateStart, $dateEnd);

			$income = $semester->getSemesterTotalIncome($dateStart, $dateEnd);
			$totalAmount = empty($income[0]['total_amount'])?NULL:$income[0]['total_amount'];
			$change = empty($income[0]['change'])?NULL:$income[0]['change'];
			$totalPaid = empty($income[0]['total_paid'])?NULL:$income[0]['total_paid'];
		}


		$semesterDate = $semester->getViewSemester();

	
		$this->view->result = $result;
		$this->view->semesterDate = $semesterDate;
		$this->view->totalAmount = $totalAmount;
		$this->view->change = $change;
		$this->view->totalPaid = $totalPaid;
		
	}
}		

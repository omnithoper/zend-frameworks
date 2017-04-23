<?php
class PaymentController extends Zend_Controller_Action{

	public function indexAction() {
		
		$studentID = Request::getParam('studentID');
		$totalAmount = Request::getParam('totalPrice');
		$change = Request::getParam('change');
		$cash = Request::getParam('cash');
		date_default_timezone_set("Asia/Manila");
		$transactionDate = date("Y-m-d H:i:s");

		$data = array(
		    'student_id' => $studentID,
		    'total_amount' => $totalAmount,
		    'change' => $change,
		);

		$payment = new Payment();
		$paymentID = $payment->getAddPayment($data); 
		$payment = $payment->getViewPayment($studentID, $totalAmount, $change, $transactionDate);

		$studentObject = new Student();
		$studentName = $studentObject->getViewStudent($studentID); 

		$this->view->payment = $payment;
		$this->view->studentName = $studentName;
		$this->view->studentID = $studentID;
		$this->view->cash = $cash;
	}

	public function payedAction() {
			$paymentID = Request::getParam('paymentID');
			$paymentObject = new Payment(); 
			$paymentObject->ifPayed($paymentID);
	}
}
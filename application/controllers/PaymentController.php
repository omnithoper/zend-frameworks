<?php
class PaymentController {

	public function indexAction() {

		$studentID = Request::getParam('studentID');
		$totalAmount = Request::getParam('totalPrice');
		$change = Request::getParam('change');
		$cash = Request::getParam('cash');

		$paymentObject = new Payment();
		$paymentObject->getAddPayment($studentID, $cash, $change); 
		$payment = $paymentObject->getViewPayment($studentID, $cash, $change);
		
		$studentObject = new Student();
		$studentName = $studentObject->getViewStudent($studentID); 

		$this->assign('payment', $payment);
		$this->assign('studentName', $studentName);
		$this->assign('studentID', $studentID);
		$this->assign('cash', $cash);
	}
		public function payedAction() {
			$paymentID = Request::getParam('paymentID');
			$paymentObject = new Payment(); 
			$paymentObject->ifPayed($paymentID);
	
	}
}	
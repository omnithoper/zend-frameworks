<?php
class  Payment extends BaseModel {
	protected $_name = 'payment';

	function getAddPayment($data) {
		$this->_db->insert($this->_name, $data);
	}

	function getViewPayment($studentID, $totalAmount, $change, $transactionDate) {
		
		$select = $this->_db->select()
			->from($this->_name)
			->where('student_id = ?' , $studentID )
			->where('total_amount = ?' , $totalAmount )
			->where('`change` = ?' , $change )
			->where('transaction_date = ?' , $transactionDate )
		;

		return $this->_db->fetchAll($select);
	}

	function ifPayed($paymentID) {
		//$select = 'UPDATE payment SET payment = 1 WHERE payment_id = ?';
        $data = array(
            'payment' => '1',
        );
		$this->_db->update($this->_name, $data, "payment_id =  '$paymentID'");	

		header("Location: /Students/");
	}

	function getViewAllPayment(){
		$select = $this->_db->select()
		->from($this->_name)
		;

		return $this->_db->fetchAll($select);
	}

	function getViewStudentPayment($studentID){
		$select = "SELECT * FROM payment WHERE student_id = $studentID AND payment = 1";
	
		$result = $result->_db->fetch_all(MYSQLI_ASSOC);
		return $result;
	}
}
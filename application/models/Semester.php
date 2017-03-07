<?php
class Semester extends BaseModel {
 
    protected $_name = 'semester';

	public function getViewSemester() {

		$select = $this->_db->select()
			->from('semester')
			->order('semester_id')	
		;
		return $this->_db->fetchAll($select);
	}
	public function getSemesterDetails($semesterID) {
		$select = $this->_db->select()
			->from($this->_name)
			->where('semester_id = ?', $semesterID)
		;
		return $this->_db->fetchRow($select);
	}
	public function getAddSemester($data) {
		$this->_db->insert($this->_name, $data);

		header("Location: /settings/");			
	}

	public function getDeleteSemester($semesterID) {
		$this->_db->delete($this->_name, "semester_id =  '$semesterID'");	

		header("Location: /settings/");
	}

	public function getEditSemester($data, $semesterID) {

		$this->_db->update($this->_name, $data, "semester_id =  '$semesterID'");

		header("Location: /settings/");
	}

	public function getPaymentDate($dateStart = NULL, $dateEnd = NULL) {
		
	
			
		$select = $this->_db->select()
			->from('student', [
				"CONCAT(student.first_name, ' ' , student.last_name) AS fullName"
			])
			->joinLeft(
				'payment', 
				'student.student_id = payment.student_id AND payment.transaction_date BETWEEN "'.$dateStart.'" AND "'.$dateEnd.'"',
				[
					'payment',
					'total_amount',
					'change',
					'transaction_date'
				]
			)
		
		;
		$results = $this->_db->fetchAll($select);


		$result = [];
		if (!empty($results)) {
			foreach ($results as $payment){
				$payment['paid'] = NULL;
 			    $payment['paid'] = $payment['total_amount'] - $payment['change'];
				$result[] = $payment;			
			}
		}

		return $result;
	}
	public function getSemesterTotalIncome($dateStart, $dateEnd) {
		$select = $this->_db->select()
			->from('payment', [
				'payment',
				'total_amount',
				'change',
				'transaction_date'
			])
			->where("transaction_date between '$dateStart' and '$dateEnd' ")

		;
		$results = $this->_db->fetchAll($select);

		$payment = [];
		$sumTotal = 0;
		$sumChange = 0;
		foreach ($results as $payment){
			$payment['total_paid'] = NULL;

			if ($payment['payment'] == 1 )  {
					$payment['total_amount'] = $sumTotal += $payment['total_amount'] ;
					$payment['change'] = $sumChange += $payment['change'];
			}			
				$payment['total_paid'] = $payment['total_amount'] - $payment['change'];			
		}	
			
		$result[] = $payment;	
		return $result;
	}
	public function addSemester($data) {

	
			$this->_db->insert($this->_name, $data);
			
	}
	

	public function updateSemester($data = null, $semesterID = null) {

		$this->_db->update($this->_name, $data, "semester_id =  '$semesterID'");	


	}
	/*

	public function isEcceededUnits($studentID = null, $subjectID = null) {
		$subjectObject = new Subject();
		$currentUnits = $subjectObject->getCurrentUnits($studentID);
		$subjectUnits = $subjectObject->getSubjectUnits($subjectID);
		$allowedUnits = $this->getAllowedUnits();

		return ($allowedUnits < ($currentUnits + $subjectUnits));
	}
	
	public function getSubjectUnits($subjectID = null) {
		$query = "
			SELECT
				subject_unit
			FROM subjects
			WHERE subject_id = ".$subjectID."
		";

		$results = $this->_db->connection->query($query);
		$results = $results->fetch_all(MYSQLI_ASSOC);
		return (empty($results))?0:$results[0]['subject_unit'];
	}

	public function getAllowedUnits() {
		$query = "
			SELECT
				number_of_allowed_units
			FROM settings
		";

		$results = $this->_db->connection->query($query);
		$results = $results->fetch_all(MYSQLI_ASSOC);
		return (empty($results))?0:$results[0]['number_of_allowed_units'];
	}

	public function getPriceMisc() {
		$query = "
			SELECT
				price_of_misc
			FROM settings
		";

		$results = $this->_db->connection->query($query);
		$results = $results->fetch_all(MYSQLI_ASSOC);
		return (empty($results))?0:$results[0]['price_of_misc'];
	}
	
	public function getPriceLabUnit() {
		$query = "
			SELECT
				price_per_lab_unit
			FROM settings
		";

		$results = $this->_db->connection->query($query);
		$results = $results->fetch_all(MYSQLI_ASSOC);
		return (empty($results))?0:$results[0]['price_per_lab_unit'];
	}
	
	public function getPricePerUnit() {
		$query = "
			SELECT
				price_per_unit
			FROM settings
		";

		$results = $this->_db->connection->query($query);
		$results = $results->fetch_all(MYSQLI_ASSOC);
		return (empty($results))?0:$results[0]['price_per_unit'];
	}

	public function isEnrolledThisSem($date) {
		$currentDate = date("Y-m-d");	
		$select = "
			SELECT
				*
			FROM semester
			WHERE 
				'$date' BETWEEN date_start AND date_end  
				 AND '$currentDate' BETWEEN date_start AND date_end 
		";
		$isEnrolled = $this->_db->connection->query($select);
		$isEnrolled = $isEnrolled->fetch_all(MYSQLI_ASSOC);
		return (bool)count($isEnrolled);
	}	
	
	public function getCurrentUnits() {	
		$query = "
			SELECT
				SUM(subjects.subject_unit) AS total_units
			FROM subjects
		
		";

		$results = $this->_db->connection->query($query);
		$results = $results->fetch_all(MYSQLI_ASSOC);
		var_dump($results);
		return (empty($results))?0:$results[0]['total_units'];		
	}
	
	public function getSemesterDate($studentID = NULL) {
		$date = date("20y-m-d");
		$query = "
			SELECT
				payment,
				student_id
			FROM semester
			JOIN payment WHERE '$date' BETWEEN date_start AND date_end  AND transaction_date BETWEEN date_start AND date_end AND student_id = '$studentID'
		";
	
		$results = $this->_db->connection->query($query);
		$results = $results->fetch_all(MYSQLI_ASSOC);
		$result = [];
		foreach ($results as $payment){
			$result = $payment;
		}
		return $result;
	}
	*/
	public function getCurrentSemester() {
		$date = date("Y-m-d");

		$fields = [
			'semester.date_start',
			'semester.date_end',
		];

		$select = $this->_db->select()
			->from('semester', $fields)
			->where('? BETWEEN date_start AND date_end', $date)
		;


		return $this->_db->fetchAll($select);

	}
}
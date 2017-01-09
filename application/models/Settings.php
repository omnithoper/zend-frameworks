<?php
class Settings {
	private $_db = null;
	
	public function __construct() {
		$this->_db = new DatabaseConnect();
	}
	
	public function getViewTotalPayment() {
		$select = "SELECT * FROM settings ";
		$tp = $this->_db->connection->query($select);
		$result = $tp->fetch_all(MYSQLI_ASSOC);
		return $tp;
	}

	public function getViewAllSemester($semesterID = NULL) {
		$select = "SELECT * FROM semester ";
		$result = $this->_db->connection->query($select);
		$result = $result->fetch_all(MYSQLI_ASSOC);
		return $result;
	}
	
	public function getViewSemester($semesterID = null){
		if (empty($semesterID)) {
			return false;
		}

		$select = "SELECT * FROM semester WHERE semester_id = $semesterID" ;
		$result = $this->_db->connection->query($select);
		$result = $result->fetch_all(MYSQLI_ASSOC);
		return $result;
	}	

	public function getAddSemester($dateStart, $dateEnd) {
		if (empty($dateStart)) {
			return [
			'error' => 'Please Date Start And Date End',
			];	
		}

		if (empty($dateEnd)) {
			return [
			'error' => 'Please Date Start And Date End',
			];	
		}	
		if ($dateEnd < $dateStart ) {
			return [
			'error' => 'Start of Semester is Less than End of Semester',
			];	
		}	
		$prepared = $this->_db->connection->prepare("
			INSERT INTO semester(date_start, date_end)
			VALUES (?,?)
		");	

		$prepared->bind_param('ss', $dateStart, $dateEnd);
		$prepared->execute();	

		print $prepared->error;
	
		
		header("Location: /Settings/");			
	}
	
	public function getEditSemester($dateStart, $dateEnd, $semesterID) {
		if (empty($dateStart)) {
			return [
			'error' => 'please input subject and unit'
			];
		}
		
		if (empty($dateEnd)) {
			return [
			'error' => 'please input subject and unit'
			];
		}
	
		$prepared = $this->_db->connection->prepare("UPDATE semester SET date_start = ?, date_end = ? WHERE semester_id = ? ");
		$prepared->bind_param("ssi", $dateStart, $dateEnd, $semesterID);
		$prepared->execute();
		$prepared->close();
	
		header("Location: /Settings/");
	}
	
	public function getDeleteSemester($semesterID) {
		if (empty($semesterID)){
			return true;
		}
	
		$query = "DELETE FROM semester WHERE semester_id = ".$semesterID;

		if ($this->_db->connection->query($query) === true)
		{
		}

		header("Location: /Settings/");
	}

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
	public function getPaymentDate($dateStart, $dateEnd)
	{	
			$select = "
			SELECT
				CONCAT(student.first_name, ' ' , student.last_name) AS fullName,
				payment.payment,
				payment.total_amount,
				payment.change,
				payment.transaction_date
				FROM student 
				LEFT JOIN payment 
				ON student.student_id = payment.student_id  AND 	
				payment.transaction_date BETWEEN '$dateStart' AND '$dateEnd'
		";
		$results = $this->_db->connection->query($select);
		$results = $results->fetch_all(MYSQLI_ASSOC);
		$result = [];
		if (!empty($results)) {
			foreach ($results as $payment){
				$payment['paid'] = $payment['total_amount'] - $payment['change'];
				$result[] = $payment;			
			}
		}
		return $result;
	}
	
	public function getSemesterTotalIncome() {
		$query = "
			SELECT
				transaction_date,
				total_amount,
				payment,
				`change`
			FROM payment
		";
		$results = $this->_db->connection->query($query);
		$results = $results->fetch_all(MYSQLI_ASSOC);
		$result = [];
		$sumTotal = 0;
		$sumChange = 0;
		foreach ($results as $payment){
			$isEnrolledThisSem = $this->isEnrolledThisSem($payment['transaction_date']);
			if ($payment['payment'] == 1 && $isEnrolledThisSem)  {
					$payment['total_amount'] = $sumTotal += $payment['total_amount'] ;
					$payment['change'] = $sumChange += $payment['change'];
			}			
					
		}	$payment['total_paid'] = $payment['total_amount'] - $payment['change'];			
		
		$result[] = $payment;	
		return $result;
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
	public function getCurrentSemester() {
		$date = date("Y-m-d");
		$query = "
			SELECT
				date_start,
				date_end
			FROM semester
			WHERE '$date' BETWEEN date_start AND date_end
		";
	
		$results = $this->_db->connection->query($query);
		$results = $results->fetch_all(MYSQLI_ASSOC);
		return $results;
	}
}
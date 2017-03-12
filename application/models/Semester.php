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
 			    $payment['paid'] = $payment['total_amount'];
				$result[] = $payment;			
			}
		}

		return $result;
	}
	
	public function getSemesterTotalIncome($dateStart, $dateEnd) {
		if (empty($dateStart) && empty($dateEnd)) {
			return false;
		}

		$select = $this->_db->select()
			->from('payment', ['total_income' => new Zend_Db_Expr('SUM(total_amount)'),
					'total_student' => new Zend_Db_Expr("COUNT(student_id)")])
			->where("transaction_date between '$dateStart' and '$dateEnd' ")
		;
		
		return $this->_db->fetchRow($select);
	}
	public function getAllSemesterIncome(){

	$select = $this->_db->select()	
	->from('payment',
		[
			'number_of_student' => new Zend_Db_Expr("COUNT(DISTINCT(payment.student_id))"),
			'payment_per_student' => new Zend_Db_Expr("SUM(payment.total_amount)"),
			'semester_period' => new Zend_Db_Expr("CONCAT(semester.date_start, ' to ', semester.date_end)")
		])
	->join('semester',
		'semester.date_start <= payment.transaction_date AND semester.date_end >= payment.transaction_date')
	->group('semester.semester_id')		
	;
	return $this->_db->fetchAll($select);
	
	}
	public function getpaymentPerStudent(){

	$select = $this->_db->select()	
	
	->from('student',[
		'student_name' => new Zend_Db_Expr("CONCAT(student.first_name, ' ', student.last_name)")])
	->join('payment',
		'student.student_id = payment.student_id',[
			'payment_per_student' => new Zend_Db_Expr("SUM(payment.total_amount)"),
		])
	->join('student_subject_match',
		'student_subject_match.student_id = payment.student_id',[
		'number_of_subject' => new Zend_Db_Expr("COUNT(student_subject_match.student_id)")])
	->where('payment.payment = 1')
	->group('student.student_id')		
	;

	return $this->_db->fetchAll($select);
	
	}
<<<<<<< HEAD
	public function getSemesterSubject() {
		$select = $this->_db->select()
			->from('student',[
			'student_name' => new Zend_Db_Expr("CONCAT(student.first_name, ' ', student.last_name)")])
			->join('student_subject_match',
			'student_subject_match.student_id = student.student_id')
			->join('semester',
				'semester.semester_id = 35')
			->where('student.student_id = 49')
			;
		return $this->_db->fetchAll($select);
	}
=======

>>>>>>> fe58b8596712aebb7c67109512f39d83f57e74c7
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
<?php
class Student {
	private $_db = null;
	
	public function __construct() {
		$this->_db = new DatabaseConnect();
	}
	
	public function getViewStudents() {
		$select = "SELECT * FROM student";
		$student = $this->_db->connection->query($select);
		
		return $student;
	}

	function getViewStudentPaid() {
		$semesterObject = new Settings();
		$semDate = $semesterObject->getCurrentSemester();
		$dateStart = $semDate[0]['date_start'];
		$dateEnd = $semDate[0]['date_end'];
		$select = "
			SELECT 
				student.student_id,
				student.first_name,
				student.last_name,
				payment.payment,
				payment.transaction_date
				FROM student
				LEFT JOIN payment ON student.student_id = payment.student_id AND 	
				payment.transaction_date BETWEEN '$dateStart' AND '$dateEnd'
		";
		$student = $this->_db->connection->query($select);
		$student = $student->fetch_all(MYSQLI_ASSOC);
		$result = [];
		foreach ($student as $students){ 
			$students['payed'] ='not yet paid';	
			if ($students['payment'] == 1)  {
				$students['payed'] ='paid';
			}			
			$result[] = $students;		
		}	
		return $result;
	}
	function isStudentPayed($studentID) {
		$semesterObject = new Settings();
		$semDate = $semesterObject->getCurrentSemester();
		$dateStart = $semDate[0]['date_start'];
		$dateEnd = $semDate[0]['date_end'];
		$select = "
			SELECT
				student.student_id,
				payment.payment,
				payment.transaction_date
				FROM student 
				LEFT JOIN payment 
				ON student.student_id = payment.student_id  AND 	
				payment.transaction_date BETWEEN '$dateStart' AND '$dateEnd'
				WHERE student.student_id = '".$studentID."'
		";
		$student = $this->_db->connection->query($select);
		$student = $student->fetch_all(MYSQLI_ASSOC);
		$result = [];
		foreach ($student as $students){ 
			$students['payed'] ='not yet paid';
			if ($students['payment'] == 1)  {
				$students['payed'] ='paid';
			}			
			$result[] = $students;		
		}	
		return $result;
	}

	public function getViewStudentsPaginated($per_page) {
		$select ="SELECT * FROM student LIMIT $per_page,5 ";
		$student = $this->_db->connection->query($select);
		return $student;
	}
	
	public function getStudentInformation($studentName) {
		$select = "
			SELECT 
				first_name, 
				last_name 
			FROM student 
		";
		
		$students = $this->_db->connection->query($select);
		
		$studentLastName = NULL;	
		
		foreach ($students as $student){
			
			if ($student['first_name'] == $studentName) {
				$studentLastName = $student['last_name'];
			}

		}
		
		return $studentLastName;
	}
	
	public function getAllStudentInformation($studentName) {
		if (empty($studentName)) {
			return [];
		}
		
		$select = "
			SELECT 
				student_id,
				first_name, 
				last_name,
				CONCAT(last_name, ', ', first_name) AS full_name
			FROM student 
			WHERE 
				first_name LIKE '$studentName%' OR
				last_name LIKE '$studentName%'
		";
		
		$students = $this->_db->connection->query($select);
		$students = $students->fetch_all(MYSQLI_ASSOC);
		

		return $students;
	}
	
	public function studentExist($firstName, $lastName, $studentID = null) {
		if (empty($firstName)) {
			return false;
		}
		
		if (empty($lastName)) {
			return false;
		}

		$query = "
			SELECT
				student_id
			FROM student
			WHERE first_name = ?
			AND last_name = ?
		";

		if (!empty($studentID)) {
			$query .= "
				AND student_id != ?
			";
		}

		$prepared = $this->_db->connection->prepare($query);	

		if (empty($studentID)) {
			$prepared->bind_param('ss', $firstName, $lastName);
		} else {
			$prepared->bind_param('ssi', $firstName, $lastName, $studentID);
		}

		$prepared->execute();	
		$prepared->bind_result($studentID);
		$prepared->fetch();


		return !empty($studentID);
	} 
	
	public function getAddStudent($firstName, $lastName) {
		var_dump($firstName);
		if (empty($firstName)) {
			return [
			'error' => 'Please Input Name And Lastname',
			];	
		}

		if (empty($lastName)) {
			return [
			'error' => 'Please Input Name And Lastname',
			];	
		}	

		if ($this->studentExist($firstName, $lastName)) {
			return [
				'error' => 'Student Already Exist',	
			];
		}

		$prepared = $this->_db->connection->prepare("
			INSERT INTO student(first_name, last_name)
			VALUES (?,?)
		");	
		
		$prepared->bind_param('ss', $firstName, $lastName);
		$prepared->execute();	
		
		header("Location: /students");			
	}
	
	public function getViewStudent($studentID = null){
		
		if (empty($studentID)) {
			return false;
		}
		
		$result = [];
		if (!empty($studentID)) {
			$select = '
				SELECT 
					student_id,
					first_name,
					last_name,
					CONCAT(last_name, ", ", first_name) AS full_name
				FROM student
				WHERE student_id = ?
			';
			$prepared = $this->_db->connection->prepare($select);
			$prepared->bind_param('i', $studentID);
			$prepared->execute();
			$prepared->bind_result($studentID, $firstName, $lastName, $fullName);
			$prepared->fetch();
			$result['student_id'] = $studentID;
			$result['first_name'] = $firstName;
			$result['last_name'] = $lastName;
			$result['full_name'] = $fullName;
			
		} 
		
		return $result;
	}
	
	public function getEditStudent($firstName, $lastName, $studentID) {
		if (empty($firstName)) {
			return [
				'error' => 'Please Input Name',
			];	
		}

		if (empty($lastName)) {
			return [
				'error' => 'Please Input Lastname',
			];	
		}	

		if ($this->studentExist($firstName, $lastName, $studentID)) {
			return [
				'error' => 'Student Already Exist',	
			];
		}
	
		if ($prepared = $this->_db->connection->prepare("UPDATE student SET first_name = ?, last_name = ? WHERE student_id=?;"))
		{
			$prepared->bind_param("sss", $firstName, $lastName,$studentID);
			$prepared->execute();
			$prepared->close();
		} else {
			return false;
		}	
		return true;
	}

	public function getDeleteStudent($studentID) {
		var_dump($studentID);
		if (empty($studentID)) {
			return true;
		}
		$query = "DELETE FROM student WHERE student_id = ".$studentID;
		$this->_db->connection->query($query);


		header("Location: /students");
	}
}
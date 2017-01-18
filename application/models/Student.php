<?php
class Application_Model_Student extends Zend_Db_Table {
	protected $_db = null;
	protected $_name = 'student';

	public function getStudentDetails($studentID) {
		$select = $this->select()
			->from($this->_name)
			->setIntegrityCheck(false)
			->where('student_id = ?', $studentID)
		;
		return $this->fetchRow($select)->toArray();
	}
	
	public function getViewStudents() {
		$semesterObject = new Application_Model_Semester();
		$semDate = $semesterObject->getCurrentSemester();
		$dateStart = $semDate[0]['date_start'];
		$dateEnd = $semDate[0]['date_end'];

		$select = $this->select()
			->from('student', [
				'student_id',
				'first_name',
				'last_name'
			])
			->setIntegrityCheck(false)
			->joinLeft(
				'payment', 
				'student.student_id = payment.student_id AND payment.transaction_date BETWEEN "'.$dateStart.'" AND "'.$dateEnd.'"',
				[
					'payment',
					'transaction_date'
				]
			)
		;
		$students = $this->fetchAll($select);
		$result = [];
		foreach ($students as $student){ 
			$record = $student->toArray();
			$record['payed'] ='not yet paid';	
			if ($record['payment'] == 1)  {
				$record['payed'] = 'paid';
			}			
			$result[] = $record;		
		}
		return $result;
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
			$select = $this->select()
			->from('student', [
				'student_id',
				'first_name',
				'last_name'
			])

			->setIntegrityCheck(false)
			->where('first_name LIKE ?' , $studentName.'%' )
			->ORwhere('last_name LIKE ?' , $studentName.'%' )
		;

		return $students = $this->fetchAll($select);

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
	
	public function getAddStudent($data, $firstName, $lastName) {

		$select = $this->select()
			->from($this->_name)
			->setIntegrityCheck(false)
			->where('first_name = ?' , $firstName )
			->where('last_name = ?' , $lastName )
		;
		
		 $check = $this->fetchRow($select);
	
		if (!empty($check)) {

			return [
				'error' => 'Student Already Exist',	
			];
		}

		if (empty($check)) {
			$newRow = $this->createRow($data);

			$newRow->save();
		}

		header("Location: /students");			
	}
	/*
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
	*/
	
	public function getEditStudent($data, $firstName, $lastName, $studentID) {
		$select = $this->select()
			->from($this->_name)
			->setIntegrityCheck(false)
			->where('first_name = ?' , $firstName )
			->where('last_name = ?' , $lastName )
		;
		
		 $check = $this->fetchRow($select);
	
		if (!empty($check)) {

			return [
				'error' => 'Student Already Exist',	
			];
		}

		if (empty($check)) {
		
			$where = $this->getAdapter()->quoteInto('student_id = ?', $studentID);
			$this->update($data, $where);	
		}
		header("Location: /students");
	}


	public function getDeleteStudent($studentID) {
		$where = $this->getAdapter()->quoteInto('student_id = ?', $studentID);
	 
		$this->delete($where);	
	
		header("Location: /students");
	}
}
<?php
class Student {
	protected $_db = null;
	protected $_name = 'student';
	
	public function __construct() {
		$this->_db = Zend_Registry::get('db');
	}	
	
	public function getStudentDetails($studentID) {
		$select = $this->_db->select()
			->from($this->_name)
			->where('student_id = ?', $studentID)
		;
		return $this->_db->fetchRow($select);
	}
	
	public function getViewStudents() {
		$semesterObject = new Semester();
		$semDate = $semesterObject->getCurrentSemester();
		$dateStart = $semDate[0]['date_start'];
		$dateEnd = $semDate[0]['date_end'];

		$select = $this->_db->select()
			->from('student', [
				'student_id',
				'first_name',
				'last_name'
			])
			->joinLeft(
				'payment', 
				'student.student_id = payment.student_id AND payment.transaction_date BETWEEN "'.$dateStart.'" AND "'.$dateEnd.'"',
				[
					'payment',
					'transaction_date'
				]
			)
		;
		$students = $this->_db->fetchAll($select);
		$result = [];
		foreach ($students as $student){ 
			$student['payed'] ='not yet paid';	
			if ($student['payment'] == 1)  {
				$student['payed'] = 'paid';
			}			
			$result[] = $student;		
		}
		return $result;
	}


	public function isStudentPayed($studentID = NULL) {
		$semesterObject = new Semester();
		$semDate = $semesterObject->getCurrentSemester();
		$dateStart = $semDate[0]['date_start'];
		$dateEnd = $semDate[0]['date_end'];


		$studentID = empty($studentID)?0:$studentID;
	
		$select = $this->_db->select()
			->from($this->_name, [
				'student_id',		
			])
			->joinLeft(
				'payment', 
				'student.student_id = payment.student_id AND payment.transaction_date BETWEEN "'.$dateStart.'" AND "'.$dateEnd.'"',
				[
					'payment',
					'transaction_date'	
				]
			)
			->where('student.student_id = ?', $studentID)
		;

		return $students = $this->_db->fetchAll($select);

	}

	public function getViewStudentsPaginated($per_page) {
		$select ="SELECT * FROM student LIMIT $per_page,5 ";
		$student = $this->_db->connection->query($select);
		return $student;
	}
		
	public function getAllStudentInformation($studentName) {
		if (empty($studentName)) {
			return [];
		}
			$select = $this->_db->select()
			->from('student', [
				'student_id',
				'first_name',
				'last_name'
			])

			->where('first_name LIKE ?' , $studentName.'%' )
			->ORwhere('last_name LIKE ?' , $studentName.'%' )
		;

		return $students = $this->_db->fetchAll($select);

	}
	
	public function studentExist($firstName, $lastName, $studentID = null) {
		
		$select = $this->_db->select()
			->from($this->_name)
			->where('first_name = ?' , $firstName )
			->where('last_name = ?' , $lastName )
		;
		
		 return $this->_db->fetchRow($select);
	
	} 
	
	public function getAddStudent($data, $firstName, $lastName) {

		if ($this->studentExist($firstName, $lastName)) {
			return [
				'error' => 'Student Already Exist',	
			];
		}
	
			$this->_db->insert($this->_name, $data);
			header("Location: /students");			
	}
	
	public function getViewStudent($studentID = null){
		
		if (empty($studentID)) {
			return false;
		}
		
		$select = $this->_db->select()
			->from($this->_name)
			->where('student_id = ?', $studentID)
		;
		return $this->_db->fetchRow($select);
			
	}
	
	
	public function getEditStudent($data, $firstName, $lastName, $studentID) {

		if ($this->studentExist($firstName, $lastName)) {
			return [
				'error' => 'Student Already Exist',	
			];
		}
	
		$this->_db->update($this->_name, $data, "student_id =  '$studentID'");
		
		header("Location: /students");
	}


	public function getDeleteStudent($studentID) {
		//$where = $this->getAdapter()->quoteInto('student_id = ?', $studentID);
	 
		$this->_db->delete($this->_name, "student_id =  '$studentID'");	

		header("Location: /students");
	}
}
<?php
class Student extends BaseModel {
	const PAGE_SIZE = 5;

	protected $_name = 'student';

	public function getStudentDetails($studentID) {
		$select = $this->_db->select()
			->from($this->_name)
			->where('student_id = ?', $studentID)
		;
		return $this->_db->fetchRow($select);
	}

	public function getStudentName($studentID) {

			$select = $this->_db->select()
			->from('student', [
				"CONCAT(first_name, ' ' , last_name) AS fullName"
			])
			->where('student_id = ?', $studentID)
		;
		return $this->_db->fetchRow($select);
	}

	public static function getNumberOfPages($studentCount) {
		return ceil($studentCount/Student::PAGE_SIZE);
	}

	public function getViewStudents($page = 1) {
		$page = empty($page)?1:$page;
		$semesterObject = new Semester();
		$semDate = $semesterObject->getCurrentSemester();

        $dateStart = $semDate[0]['date_start'];
		$dateEnd = $semDate[0]['date_end'];

		$select = $this->_db->select()
			->from('student', [
				'student_id',
				'first_name',
				'last_name',
				'payed' => new Zend_Db_Expr("IF(payment.payment = '1', 'paid', 'not yet paid' )")
			])
			->joinLeft(
				'payment', 
				'student.student_id = payment.student_id AND payment.transaction_date BETWEEN "'.$dateStart.'" AND "'.$dateEnd.'"',
				[
					'payment',
					'transaction_date'
				]
			)
			->limit(self::PAGE_SIZE, ($page - 1) * self::PAGE_SIZE)
			->order('first_name')
		;
		$students = $this->_db->fetchAll($select);

		return $students;
	}

	public function getViewStudentsCount() {
		$semesterObject = new Semester();
		$semDate = $semesterObject->getCurrentSemester();
        if (empty($semDate)) {
            return false;
        }

        $dateStart = $semDate[0]['date_start'];
		$dateEnd = $semDate[0]['date_end'];

		$select = $this->_db->select()
			->from('student', [
				'total' => new Zend_Db_Expr("COUNT(student.student_id)")
			])
			->joinLeft(
				'payment', 
				'student.student_id = payment.student_id AND payment.transaction_date BETWEEN "'.$dateStart.'" AND "'.$dateEnd.'"',
				[]
			)
		;
		$total = $this->_db->fetchOne($select);

		return $total;
	}

	public function isStudentPayed($studentID = NULL) {

		$semesterObject = new Semester();
		$semDate = $semesterObject->getCurrentSemester();

		if (empty($semDate)) {
			return false;
		}

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

	public function getAllStudentStudentID($studentID) {
			$select = $this->_db->select()
			->from('student', [
				'student_id',
				'first_name',
				'last_name'
			])

			->where('student_id = ?', $studentID)
		;

    	return $students = $this->_db->fetchAll($select);
	}

	public function studentExist($firstName, $lastName) {

		$select = $this->_db->select()
			->from($this->_name)
			->where('first_name = ?' , $firstName )
			->where('last_name = ?' , $lastName )
		;
		
		 return $this->_db->fetchRow($select);
	}

	public function studentEmailExist($email) {

		$select = $this->_db->select()
			->from($this->_name)
			->where('email = ?' , $email )
		;
		
		 return $this->_db->fetchRow($select);
	}

	public function studentUserExist($userName) {

		$select = $this->_db->select()
			->from($this->_name)
			->where('username = ?' , $userName )
		;
		
		 return $this->_db->fetchRow($select);
	}

	public function facebookStudentExist($facebookID = null) {

		$select = $this->_db->select()
			->from($this->_name,['student_id'])
			->where('facebook_id = ?' , $facebookID)
		;
		
		 return $this->_db->fetchOne($select);
	}

	public function googleStudentExist($googleID = null) {

		$select = $this->_db->select()
			->from($this->_name,['student_id'])
			->where('google_id = ?' , $googleID)
		;
		 return $this->_db->fetchOne($select);
	}

	public function getAddStudent($data, $firstName, $lastName ) {


		if ($this->studentExist($firstName, $lastName)) {
			return [
				'error' => 'Student Already Exist',	
			];
		}

        $this->_db->insert($this->_name, $data);
        header("Location: /students");
	}
	
	public function getSignUpStudent($data, $firstName, $lastName, $email, $psw, $pswRepeat, $userName ) {

		if ($this->studentEmailExist($email)) {
			return [
				'error' => 'Email Already Exist',	
			];
		}

		if ($this->studentUserExist($userName)) {
			return [
				'error' => 'User Already Exist',	
			];
		}

		if ($psw != $pswRepeat ) {
			return [
				'error' => 'password and confirm password is  not the same',
			];
		}


        $this->_db->insert($this->_name, $data);
        $_SESSION['login_user'] = $userName;
        $_SESSION['user_type'] = 'admin';
        header("Location: /students");
	}

	public function getAddFacebookStudent($data, $facebookID) {
		if ($this->facebookStudentExist($facebookID)) {
			return [
				'error' => 'Student Already Exist',	
			];
		}

        $this->_db->insert($this->_name, $data);
       
	}
	public function getAddGoogleStudent($data = null, $googleID = null) {
		if ($this->googleStudentExist($googleID)) {
			return [
				'error' => 'Student Already Exist',	
			];
		}
		
        $this->_db->insert($this->_name, $data);
       
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

	public function updateStudent($data = null, $studentID = null, $first_name = null, $last_name = null) {
		$params = [];

		if (!empty($first_name)) {
			$params['first_name'] = $first_name;
		}

		if (!empty($last_name)) {
			$params['last_name'] = $last_name;
		}

		$this->_db->update($this->_name, $data, "student_id =  '$studentID'");

		return [
			'studentID' => $studentID,
			'first_name' => $first_name,
			'last_name' => $last_name,
		];
	}

	public function addStudent($data, $firstName, $lastName) {

		if ($this->studentExist($firstName, $lastName)) {
			return [
				'error' => 'Student Already Exist',	
			];
		}

			$this->_db->insert($this->_name, $data);
	}

	public function getStudentUserPassword($userName, $password) {
 		if (empty($userName)) {
 			return [
 			'error' => 'Please input username and password',
 			];
 		}
 
 		if (empty($password)) {
 			return [
 			'error' => 'Please input username and password',
 			];
 		}
 
 		$select = $this->_db->select()
 			->from($this->_name, ['student_id'] )
 			->where('username = ?' , $userName )
 			->where('password = ?' , sha1($password) ) 
 		;

 		$result = $this->_db->fetchAll($select);
       	$count = count($result);
 
 		if($count == 1) {
 			$_SESSION['login_user'] = $userName;
 			$_SESSION['user_type'] = 'student';
 			$_SESSION['student_id'] = $result[0]['student_id'];
 
 			return [
 				'status' => true,
 				'error' => null
 			];
 		} else {
 			return [
 				'status' => false,
 		  		'error' => 'Your Login Name or Password is invalid'
 			];
 		}
 	}   
}
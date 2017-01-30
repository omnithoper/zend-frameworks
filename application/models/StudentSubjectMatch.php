<?php
class StudentSubjectMatch extends BaseModel {

	protected $_name = 'student_subject_match';
	
	public function getStudentSubjects($studentID = NUll){
	
		if (empty($studentID)) {
			return false;
		}
		
		$select = $this->_db->select()
			->from($this->_name)
			->join(
				'subjects', 
				'student_subject_match.subject_id = subjects.subject_id'
			)
			->where('student_subject_match.student_id = ?' , $studentID )

		;
		return $this->_db->fetchAll($select);
	
	}
	function subjectExist($studentID = NULL , $subjectID = NULL) {
	
		$select = $this->_db->select()
			->from($this->_name)
			->where('student_id = ?' , $studentID )
			->where('subject_id = ?' , $subjectID )
		;
		
		 return $this->_db->fetchRow($select);
	} 
	
	function getAddStudentSubjectID($studentID, $subjectID) {

		if (empty($studentID)) {
			return true;
		}

		if (empty($subjectID)) {
			return true;
		}
	

		if ($this->subjectExist($studentID, $subjectID)) {
			return [
				'error' => 'Subject Already Exist',	
			];
		}

		
		$settings = new Settings();
		if ($settings->isEcceededUnits($studentID, $subjectID)) {
			return [
				'error' => 'ERROR: Number of allowed units has exceeded!',
				'status' => 'failed',
			];
		}
		
		$data = array(
			'student_id' => $studentID,
			'subject_id' => $subjectID,
		);
		
		$this->_db->insert($this->_name, $data);
		

	}
		function getDeleteSubject($studentID, $subjectID) {
	
		
		if (empty($studentID)) {
			return true;
		}
		
		if (empty($subjectID)) {
			return true;
		}

		$where['student_id = ?'] = $studentID;
		$where['subject_id = ?']  = $subjectID;
		$this->_db->delete($this->_name, $where);	
	}
	/*
	function getStudentSubjects($studentID){
			$db = new DatabaseConnect();
		if (empty($studentID)) {
			return true;
		}


		$select="
			SELECT
			*
			FROM student_subject_match 
			JOIN subjects ON student_subject_match.subject_id = subjects.subject_id
			WHERE student_id =" .$studentID." 
		";
		
		$subjects = $db->connection->query($select);
		$result = $subjects->fetch_all(MYSQLI_ASSOC);
		return $result;
					
	}

	
*/
}	
	
?>

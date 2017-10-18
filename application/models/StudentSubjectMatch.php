<?php
class StudentSubjectMatch extends BaseModel {
	protected $_name = 'student_subject_match';

	public function getStudentSubjectDetails($studentID = null,$subjectID = null,$semesterID = null) {
		

		$select = $this->_db->select()
			->from($this->_name)
			->where('student_id = ?', $studentID)
			->where('subject_id = ?', $subjectID)
			->where('semester_id = ?', $semesterID)
		;
		return $this->_db->fetchRow($select);
	}

	public function isThereSubjects($studentID,$semesterID) {
		$select = $this->_db->select()
			->from($this->_name)
			->where('student_id = ?', $studentID)
			->where('semester_id = ?', $semesterID )
		;
		return $this->_db->fetchRow($select);
	}

	public function getStudentSubjects($studentID = NUll, $semesterID = NULL){

		if (empty($studentID)) {
			return true;
		}

		if (empty($semesterID)) {
			return true;
		}
				
		$select = $this->_db->select()
			->from($this->_name)
			->join(
				'subjects', 
				'student_subject_match.subject_id = subjects.subject_id'
			)
			->where('student_subject_match.student_id = ?' , $studentID )
			->where('student_subject_match.semester_id = ?' , $semesterID )

		;	
		return $this->_db->fetchAll($select);
	}

	function subjectExist($studentID = NULL , $subjectID = NULL, $semesterID = NULL) {
		$select = $this->_db->select()
			->from($this->_name)
			->where('student_id = ?' , $studentID )
			->where('subject_id = ?' , $subjectID )
			->where('semester_id = ?' , $semesterID )
		;

		 return $this->_db->fetchRow($select);
	} 

	function getAddStudentSubjectID($studentID, $subjectID, $semesterID) {
		if (empty($studentID)) {
			return true;
		}

		if (empty($subjectID)) {
			return true;
		}

		if (empty($semesterID)) {
			return true;
		}

		if ($this->subjectExist($studentID, $subjectID, $semesterID)) {
			return [
				'error' => 'Subject Already Exist',	
			];
		}

		$settings = new Settings();
		$studentBlockSectionMatch = new StudentBlockSectionMatch();

		if ($studentBlockSectionMatch->isStudentBlockSectionMatchExist($studentID, $semesterID)) {
			return [
				'error' => ' Already Selected Block Section!!',
				'status' => 'failed',	
			];
		}

		if ($settings->isEcceededUnits($studentID, $subjectID, $semesterID)) {
			return [
				'error' => 'ERROR: Number of allowed units has exceeded!',
				'status' => 'failed',
			];
		}

		$data = array(
			'student_id' => $studentID,
			'subject_id' => $subjectID,
			'semester_id' => $semesterID,
		);

		$this->_db->insert($this->_name, $data);
	}


	function addSubjectGrade($data, $studentID, $subjectID, $semesterID) {
		if (empty($studentID)) {
			return true;
		}

		if (empty($subjectID)) {
			return true;
		}

		if (empty($semesterID)) {
			return true;
		}

		$this->_db->insert($this->_name, $data);
	}

    public function getEditStudentGrade($data, $studentID, $subjectID,$semesterID) {
		$where['student_id = ?'] = $studentID;
		$where['subject_id = ?']  = $subjectID;
		$where['semester_id = ?']  = $semesterID;
		$this->_db->update($this->_name, $data, $where);

		header("Location: /studentgrade");
	}

    public function getDeleteSubject($studentID, $subjectID, $semesterID) {
		if (empty($studentID)) {
			return true;
		}

		if (empty($subjectID)) {
			return true;
		}
		if(empty($semesterID)){
			return true;
		}
		$where['student_id = ?'] = $studentID;
		$where['subject_id = ?']  = $subjectID;
		$where['semester_id= ?'] = $semesterID;
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
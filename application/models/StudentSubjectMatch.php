<?php
class StudentSubjectMatch {
	private $_db = null;
	
	function __construct() {
		$this->_db = new DatabaseConnect();
	}
	
	function getAddStudentSubjectID($studentID, $subjectID) {
		if (empty($studentID)) {
			return true;
		}

		if (empty($subjectID)) {
			return true;
		}

		if ($this->subjectExist($studentID, $subjectID)) {
			return true;
		}

		$settings = new Settings();
		if ($settings->isEcceededUnits($studentID, $subjectID)) {
			return [
				'message' => 'ERROR: Number of allowed units has exceeded!',
				'status' => 'failed',
			];
		}
		
		$prepared = $this->_db->connection->prepare("
			INSERT INTO student_subject_match(student_id, subject_id)
			VALUES (?,?)
		");	

		$prepared->bind_param('ii', $studentID, $subjectID);

		$status = $prepared->execute();	
		$this->_db->connection->close();
	}
	
	function subjectExist($studentID, $subjectID) {
		$db = new DatabaseConnect();
		if (empty($studentID)) {
			return false;
		}
	
		if (empty($subjectID)) {
			return false;
		}
		
		$prepared = $db->connection->prepare("
			SELECT * FROM student_subject_match WHERE student_id = ? AND subject_id = ?
		");	
		
		$prepared->bind_param('ii', $studentID, $subjectID);
		$prepared->execute();	
		$prepared->bind_result($subjectID, $studentID);
		$prepared->fetch();
		$db->connection->close();
		
		return !empty($subjectID);
	} 
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
		function getDeleteSubject($studentID, $subjectID) {
			var_dump($studentID);
		
		if (empty($studentID)) {
			return true;
		}
		
		if (empty($subjectID)) {
			return true;
		}
		
		$db = new DatabaseConnect();
	
		$query = "DELETE FROM student_subject_match WHERE subject_id = ".$subjectID . " AND student_id = ".$studentID;

		if ($db->connection->query($query) === true)
		{
		}

		$db->connection->close();
	}
	

}	
	
?>

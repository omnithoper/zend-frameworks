<?php
class Subject extends Zend_Db_Table_Abstract {
	protected $_name = 'subjects';
	

	function getViewSubjects() {
	return $this->fetchAll();
	}

	function getEditSubject($subject, $lecUnit, $labUnit, $subjectUnit, $subjectID) {
				
		
		if (empty($subject)) {
			return [
			'error' => 'please input subject and unit'
			];
		}
		if (empty($subjectUnit)) {
			return [
			'error' => 'please input subject and unit'
			];
		}

		if ($prepared = prepare("UPDATE subjects SET subject = ?, lec_unit = ?, lab_unit = ?, subject_unit = ? WHERE subject_id=?;"))
			{
				$prepared->bind_param("siiii", $subject, $lecUnit, $labUnit, $subjectUnit, $subjectID);
				$prepared->execute();
				$prepared->close();
			}
			else {
			var_dump($subject);
			var_dump($subjectUnit);
			var_dump($subjectID);
			die();

		}	
	
			header("Location: /subjects");
	}	
		
	function getViewSubject($subjectID){

			$result = [];
			if (!empty($subjectID)) {
				$select = '
					SELECT 
						subject_id,
						subject,
						lec_unit,
						lab_unit,
						subject_unit
					FROM subjects
					WHERE subject_id = ?
				';
				$prepared = prepare($select);
				$prepared->bind_param('i', $subjectID);
				$prepared->execute();
				$prepared->bind_result($subjectID, $subject, $lecUnit, $labUnit, $subjectUnit);
				$prepared->fetch();
				$result['subject_id'] = $subjectID;
				$result['subject'] = $subject;
				$result['lec_unit'] = $lecUnit;
				$result['lab_unit'] = $labUnit;
				$result['subject_unit'] = $subjectUnit;
			} 
				return $result;
		}	/*	
	function getAddSubject(array $data = array()) {
	
	// INSERT the new row to the database

		
		header("Location: /subjects");		
	}
	*/
	function getDeleteSubject($subjectID) {

		$row = $this->fetchRow('subject_id ='.$subjectID);

		$row->delete();
			header("Location: /subjects");		
	
	}

		
	/*
	function getSubjects(){
		$db = new DatabaseConnect();
		$subjects = $db->connection->query("SELECT * FROM subjects");
		$subjectss = [];
		foreach($subjects as $subject){
			$subjectss[] = $subject;
		}
		
		return $subjectss;
		$db->connection->close();
	}   
	function subjectExist($subject) {
		if (empty($subject)) {
			return false;
		}
		
		
		$prepared = $this->_db->connection->prepare("
			SELECT subject_id FROM subjects WHERE subject = ?
		");	
		
		$prepared->bind_param('s', $subject);
		$prepared->execute();	
		$prepared->bind_result($subjectID);
		$prepared->fetch();
		$this->_db->connection->close();
		
		return !empty($subjectID);
	} 
	
	function getAddSubject($subject, $lecUnit, $labUnit, $subjectUnit) {
		$db = new DatabaseConnect();
		
		if (empty($subject)) {
			return [
			'error' => 'please input subject and unit'
			];
		}
		if (empty($subjectUnit)) {
			return [
			'error' => 'please input subject and unit'
			];
		}
		if ($this->subjectExist($subject)) {
		return [
			'error' => 'subject Already Exist',	
			];
		}

		$prepared = $db->connection->prepare("
			INSERT INTO subjects(subject, lec_unit, lab_unit, subject_unit)
			VALUES (?,?,?,?)
		");	
		$prepared->bind_param('siii', $subject, $lecUnit, $labUnit, $subjectUnit);

		$prepared->execute();	
		header("Location: /subjects");
		$db->connection->close();
	}
		
	function getViewSubject($subjectID){

		$db = new DatabaseConnect();
		$result = [];
		if (!empty($subjectID)) {
			$select = '
				SELECT 
					subject_id,
					subject,
					lec_unit,
					lab_unit,
					subject_unit
				FROM subjects
				WHERE subject_id = ?
			';
			$prepared = $db->connection->prepare($select);
			$prepared->bind_param('i', $subjectID);
			$prepared->execute();
			$prepared->bind_result($subjectID, $subject, $lecUnit, $labUnit, $subjectUnit);
			$prepared->fetch();
			$result['subject_id'] = $subjectID;
			$result['subject'] = $subject;
			$result['lec_unit'] = $lecUnit;
			$result['lab_unit'] = $labUnit;
			$result['subject_unit'] = $subjectUnit;
		} 
			return $result;
		$db->connection->close();	
	}
		
	function getEditSubject($subject, $lecUnit, $labUnit, $subjectUnit, $subjectID) {
				
		
		if (empty($subject)) {
			return [
			'error' => 'please input subject and unit'
			];
		}
		if (empty($subjectUnit)) {
			return [
			'error' => 'please input subject and unit'
			];
		}
	
		$db = new DatabaseConnect();
		if ($prepared = $this->_db->connection->prepare("UPDATE subjects SET subject = ?, lec_unit = ?, lab_unit = ?, subject_unit = ? WHERE subject_id=?;"))
			{
				$prepared->bind_param("siiii", $subject, $lecUnit, $labUnit, $subjectUnit, $subjectID);
				$prepared->execute();
				$prepared->close();
			}
			else {
			var_dump($subject);
			var_dump($subjectUnit);
			var_dump($subjectID);
			die();

		}	
	
			header("Location: /subjects");
		
		

	}
	
	function getDeleteSubject($subjectID) {
		
		if (empty($subjectID)){
			return true;
		}
		
	
		$query = "DELETE FROM subjects WHERE subject_id = ".$subjectID;
		$this->_db->connection->query($query);
	
		header("Location: /subjects");
	}
	public function getCurrentUnits($studentID = null)
	{	
		$query = "
			SELECT
				SUM(subjects.subject_unit) AS total_units
			FROM student_subject_match
			JOIN subjects ON student_subject_match.subject_id = subjects.subject_id
			WHERE student_subject_match.student_id = '".$studentID."'
		";

		$results = $this->_db->connection->query($query);
		$results = $results->fetch_all(MYSQLI_ASSOC);
		return (empty($results))?0:$results[0]['total_units'];		
	}
	public function getLectureUnits($studentID = null)
	{	
		$query = "
			SELECT
				SUM(subjects.lec_unit) AS lecture_units
			FROM student_subject_match
			JOIN subjects ON student_subject_match.subject_id = subjects.subject_id
			WHERE student_subject_match.student_id = '".$studentID."'
		";

		$results = $this->_db->connection->query($query);
		$results = $results->fetch_all(MYSQLI_ASSOC);
		return (empty($results))?0:$results[0]['lecture_units'];		
	}
	public function getLaboratoryUnits($studentID = null)
	{	
		$query = "
			SELECT
				SUM(subjects.lab_unit) AS laboratory_units
			FROM student_subject_match
			JOIN subjects ON student_subject_match.subject_id = subjects.subject_id
			WHERE student_subject_match.student_id = '".$studentID."'
		";

		$results = $this->_db->connection->query($query);
		$results = $results->fetch_all(MYSQLI_ASSOC);
		return (empty($results))?0:$results[0]['laboratory_units'];		
	}
	public function getSubjectUnits($subjectID = null)
	{
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
*/
	
}
?>
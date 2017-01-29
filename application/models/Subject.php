<?php
class Subject {
	protected $_db = NULL;
	protected $_name = 'subjects';
	
	public function __construct() {
		$this->_db = Zend_Registry::get('db');
	}
/* this is with zend db table with db connection
	function getViewSubjects() {
		$select = "SELECT * FROM subjects";
		$select = $this->_db->query($select);
		return $select->fetchAll(Zend_Db::FETCH_ASSOC);
	}
*/


	public function getLaboratoryUnits($studentID = null)
	{	
		$select = "
			SELECT
				SUM(subjects.lab_unit) AS laboratory_units
			FROM student_subject_match
			JOIN subjects ON student_subject_match.subject_id = subjects.subject_id
			WHERE student_subject_match.student_id = '".$studentID."'
		";

		$results = $this->_db->fetchAll($select);
		return (empty($results))?0:$results[0]['laboratory_units'];		
	}	
	public function getLectureUnits($studentID = null)
	{	
		$select = "
			SELECT
				SUM(subjects.lec_unit) AS lecture_units
			FROM student_subject_match
			JOIN subjects ON student_subject_match.subject_id = subjects.subject_id
			WHERE student_subject_match.student_id = '".$studentID."'
		";

		
		$results = $this->_db->fetchAll($select);
		return (empty($results))?0:$results[0]['lecture_units'];		
	}
	
	public function getCurrentUnits($studentID = null)
	{	// this is with zend db table with db connection
		if (empty($studentID)) {
			return 0;
		}
		$select = "
			SELECT
				SUM(subjects.subject_unit) AS total_units
			FROM student_subject_match
			JOIN subjects ON student_subject_match.subject_id = subjects.subject_id
			WHERE student_subject_match.student_id = '".$studentID."'
		";

		$select = $this->_db->select()
			->from('student_subject_match', ['total_units' => 'SUM(subjects.subject_unit)'])
			->join('subjects', 'student_subject_match.subject_id = subjects.subject_id', [])
			->where('student_subject_match.student_id = ?', $studentID)
			;

		return $this->_db->fetchOne($select);
		
		Zend_Debug::dump($result);
		die();
		/*
		$studentID = empty($studentID)?0:$studentID;
		$select = $this->_db->select()
			->from('student_subject_match',[
				"SUM(subjects.subject_unit) AS total_units"
			])	

			->join(
				'subjects', 
				'student_subject_match.subject_id = subjects.subject_id'

				)
			->where('student_subject_match.student_id = ?', $studentID)
		;

var_dump($this->_db->fetchAll($select));
 die("here");
	*/	
 
		$results = $this->_db->fetchAll($select);
		return (empty($results))?0:$results[0]['total_units'];	
	}
	public function getSubjectUnits($subjectID = null)
	{
		$select = $this->_db->select()
			->from($this->_name, ['subject_unit',
			])
			->where('subject_id = ?', $subjectID)
		;	
		$results = $this->_db->fetchAll($select);
	
		return (empty($results))?0:$results[0]['subject_unit'];
	}
	public function getViewSubjects() {
		#$select = $this->select()->from($this->_name);
		$select = "SELECT * FROM subjects";
		$select = $this->_db->query($select);
		return $select->fetchAll(Zend_Db::FETCH_ASSOC);
	}
	
	public function getSubjectDetails($subjectID) {
		$select = $this->_db->select()
			->from($this->_name)
			->where('subject_id = ?', $subjectID)
		;
		return $this->_db->fetchRow($select);
	}	
	function getAddSubject($subject, $lecUnit, $labUnit, $subjectUnit) {


		$data = array(
		    'subject' => $subject,
		    'lec_unit' => $lecUnit,
		    'lab_unit' => $labUnit,
		    'subject_unit' => $subjectUnit
		);
		
		$this->_db->insert($this->_name, $data);
	
		header("Location: /subjects");	
		
	}



	function getEditSubject($subject, $lecUnit, $labUnit, $subjectUnit, $subjectID) {
				
		$data = array(
		    'subject' => $subject,
		    'lec_unit' => $lecUnit,
		    'lab_unit' => $labUnit,
		    'subject_unit' => $subjectUnit
		);
	
		$this->_db->update($this->_name, $data, "subject_id =  '$subjectID'");	
		header("Location: /subjects");	
	}
	

	function getDeleteSubject($subjectID) {


		$this->_db->delete($this->_name, "subject_id =  '$subjectID'");	
		header("Location: /subjects");		
	
	}
	/*
 
	function getSubjects(){
		return $subjects=$this->fetchAll();
		$subjects = [];
		foreach($subjects as $subject){
			$subjectss[] = $subject;
		}
		
		return $subjectss;
	
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


*/
	
}
?>
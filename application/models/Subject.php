<?php
class Subject extends BaseModel {
	const PAGE_SIZE = 5;

	protected $_name = 'subjects';

/* this is with zend db table with db connection
	function getViewSubjects() {
		$select = "SELECT * FROM subjects";
		$select = $this->_db->query($select);
		return $select->fetchAll(Zend_Db::FETCH_ASSOC);
	}
*/

	public function getLaboratoryUnits($studentID = null, $semesterID = null)	
	{
		if (empty($studentID)) {
			return 0;
		}

		if (empty($semesterID)) {
			return 0;
		}

		$select = $this->_db->select()
			->from('student_subject_match', ['laboratory_units' => 'SUM(subjects.lab_unit)'])
			->join('subjects', 'student_subject_match.subject_id = subjects.subject_id', [])
			->where('student_subject_match.student_id = ?', $studentID)
			->where('student_subject_match.semester_id = ?', $semesterID)
			;
		return $this->_db->fetchOne($select);
	}	

	public function getLectureUnits($studentID = null, $semesterID = null)
	{
		if (empty($studentID)) {
			return 0;
		}

		if (empty($semesterID)) {
			return 0;
		}
		$select = $this->_db->select()
			->from('student_subject_match', ['lecture_units' => 'SUM(subjects.lec_unit)'])
			->join('subjects', 'student_subject_match.subject_id = subjects.subject_id', [])
			->where('student_subject_match.student_id = ?', $studentID)
			->where('student_subject_match.semester_id = ?', $semesterID)
			;
		return $this->_db->fetchOne($select);
	}

	public function getCurrentUnits($studentID = null, $semesterID = null)
	{
		if (empty($studentID)) {
			return 0;
		}

		$select = $this->_db->select()
			->from('student_subject_match', ['total_units' => 'SUM(subjects.subject_unit)'])
			->join('subjects', 'student_subject_match.subject_id = subjects.subject_id', [])
			->where('student_subject_match.student_id = ?', $studentID)
			->where('student_subject_match.semester_id = ?', $semesterID)
			;

		return $this->_db->fetchOne($select);
	}

	public function getBSectionCurrentUnits($bSectionID = null)
	{
		if (empty($bSectionID)) {
			return 0;
		}

		$select = $this->_db->select()
			->from($this->_name, ['total_units' => 'SUM(subjects.subject_unit)'])
			->join('bsection_subject_match', 'subjects.subject_id = bsection_subject_match.subject_id', [])
			->where('bsection_subject_match.bsection_id = ?', $bSectionID)
			;

		return $this->_db->fetchOne($select);
	}
	public function addSubjectyy($data, $subjectName) {
        $this->_db->insert($this->_name, $data);
	}

	public function addSubject($data, $SubjectName) {
        $this->_db->insert($this->_name, $data);
	}

	public function updateSubject($data = null, $subjectID = null, $subjectName = null) {
		$this->_db->update($this->_name, $data, "subject_id =  '$subjectID'");
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

	public function getViewSubjectsCount() {
		$select = $this->_db->select()
			->from($this->_name, [
				'total' => new Zend_Db_Expr("COUNT(subjects.subject_id)")
			])
			;
        $total = $this->_db->fetchOne($select);

		return $total;
	}

	
	public function getBsectionSubjects($bSectionID = null) {
	
		if (empty($bSectionID)) {
				return false;
			} 
			
	      $select = $this->_db->select()
				->from($this->_name,[
					'subjects.subject_id',
					'subjects.subject'])
				->joinLeft (
					'bsection_subject_match', 
					'subjects.subject_id = bsection_subject_match.subject_id AND
					bsection_subject_match.bsection_id = "'.$bSectionID.'"',[]
				)
				
				->where('bsection_subject_match.bsection_id IS NULL')
				->order('subjects.subject_id')
			;	
		return $this->_db->fetchAll($select);
	}
	
	public function getBsectionSubjectsDetails($bSectionID = null) {
	
		if (empty($bSectionID)) {
				return false;
			} 
	
	      $select = $this->_db->select()
				->from($this->_name,[
					'subjects.subject_id',
					'subjects.subject'])
				->joinLeft (
					'bsection_subject_match', 
					'subjects.subject_id = bsection_subject_match.subject_id',['bsection_subject_match.bsection_id',]
				)
				
				->where('bsection_subject_match.bsection_id = ? ', $bSectionID)
				->order('subjects.subject_id')
			;	
		return $this->_db->fetchAll($select);
	}
	public static function getNumberOfPages($subjectsCount) {
		return ceil($subjectsCount/Subject::PAGE_SIZE);
	}

	public function getViewSubjects($page = 1) {
		$page = empty($page)?1:$page;
		$select = $this->_db->select()
			->from($this->_name)
			->limit(self::PAGE_SIZE, ($page - 1) * self::PAGE_SIZE)
			->order('subject')
			;	
		return $this->_db->fetchAll($select);
	}

	public function getListSubjects($studentID = NULL, $semesterID = NULL) {
		if (empty($studentID)) {
			return false;
		} 

	      $select = $this->_db->select()
				->from('student_subject_match')
				->joinRight (
					'subjects', 
					'student_subject_match.subject_id = subjects.subject_id AND
					student_subject_match.student_id = "'.$studentID.'" AND
					student_subject_match.semester_id = "'.$semesterID.'"'
				)
				
				->where('student_subject_match.student_id IS NULL')
				->order('subjects.subject_id')
			;
			
		return $this->_db->fetchAll($select);
	}

	public function getSubjectDetails($subjectID) {
		$select = $this->_db->select()
			->from($this->_name)
			->where('subject_id = ?', $subjectID)
		;

		return $this->_db->fetchRow($select);
	}

	public function getAddSubject($subject, $lecUnit, $labUnit, $subjectUnit) {
		$data = array(
		    'subject' => $subject,
		    'lec_unit' => $lecUnit,
		    'lab_unit' => $labUnit,
		    'subject_unit' => $subjectUnit
		);

		$this->_db->insert($this->_name, $data);

		header("Location: /subjects");
	}

	public function getEditSubject($subject, $lecUnit, $labUnit, $subjectUnit, $subjectID) {
		$data = array(
		    'subject' => $subject,
		    'lec_unit' => $lecUnit,
		    'lab_unit' => $labUnit,
		    'subject_unit' => $subjectUnit
		);

		$this->_db->update($this->_name, $data, "subject_id =  '$subjectID'");	
		header("Location: /subjects");	
	}

	public function getDeleteSubject($subjectID) {
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
<?php
class  StudentBlockSectionMatch extends BaseModel {
	protected $_name = 'student_bsection_match';

	public function getViewStudentBlockSection() {
		$select = $this->_db->select()
		->from($this->_name)
		;	
		return $this->_db->fetchAll($select);
	}

	public function isStudentBlockSectionMatchExist($studentID = NULL , $semesterID = null) {
		$select = $this->_db->select()
			->from($this->_name)
			->where('student_id = ?' , $studentID )
			->where('semester_id = ?' , $semesterID )
		;

		 return $this->_db->fetchRow($select);
	} 

	public function getAddBlockSection($studentID = null, $bSection = null, $semesterNumber = null , $semesterID) {

		if (empty($studentID)) {
			return true;
		}

		if (empty($bSection)) {
			return true;
		}
		if (empty($semesterNumber)) {
			return true;
		}
		if (empty($semesterID)) {
			return true;
		}

		$studentSubjectMatch = new StudentSubjectMatch();
		if ($studentSubjectMatch->isThereSubjects($studentID, $semesterID)) {
			return [
				'error' => 'ERROR: There is Already a Subject!',
				'status' => 'failed',
			];
		}

		if ($this->isStudentBlockSectionMatchExist($studentID, $semesterID)) {
			return [
				'error' => ' Already Selected Block Section!!',
				'status' => 'failed',	
			];
		}

		$data = array(
			'student_id' => $studentID,
			'block_section' => $bSection,
			'semester_number' => $semesterNumber,
			'semester_id' => $semesterID,
		);

		$this->_db->insert($this->_name, $data);
	
	}

	public function getBlockSection($studentID = null, $semesterID = null) {

		if (empty($studentID)) {
			return true;
		}

		if (empty($semesterID)) {
			return true;
		}


		$select = $this->_db->select()
		->from($this->_name,[])
		->join('block_section', '  block_section.block_section = student_bsection_match.block_section and 
				 block_section.semester_number = student_bsection_match.semester_number ',[])
		->join('student', 'student_bsection_match.student_id=student.student_id',[])
		->join('subjects', 'subjects.subject_id = block_section.subject_id',['subjects.subject_id','subjects.lec_unit','subjects.lab_unit','subjects.subject','subjects.subject_unit'])
		->where('student_bsection_match.student_id = ?', $studentID)
		->where('student_bsection_match.semester_id = ?', $semesterID)
		;
		return $this->_db->fetchAll($select);
	}

	public function getBlockSectionUnits($studentID = null, $semesterID = null) {

		if (empty($studentID)) {
			return true;
		}

		if (empty($semesterID)) {
			return true;
		}


		$select = $this->_db->select()
		->from('subjects',['total_units' => new Zend_Db_Expr('SUM(subjects.subject_unit)')])
		->join('block_section', 'block_section.subject_id = subjects.subject_id',[])
		->join('student_bsection_match', '  block_section.block_section = student_bsection_match.block_section and 
				 block_section.semester_number = student_bsection_match.semester_number ',[])
		->where('student_bsection_match.student_id = ?', $studentID)
		->where('student_bsection_match.semester_id = ?', $semesterID)
		;	

		return $this->_db->fetchOne($select);
	}
}
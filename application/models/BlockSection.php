<?php
class  BlockSection extends BaseModel {
	protected $_name = 'block_section';

	public function getViewBlockSection() {
		$select = $this->_db->select()
		->from($this->_name,[
			'block_section',
			'semester_number'
			])
		->distinct()
		;	
		return $this->_db->fetchAll($select);
	}
	/*
	public function getBlockSection($studentID = null, $bSection = null, $semesterNumber = null) {
		
		if (empty($studentID)) {
			return true;
		}

		if (empty($bSection)) {
			return true;
		}
		if (empty($semesterNumber)) {
			return true;
		}
				Zend_Debug::dump($studentID);
				Zend_Debug::dump($bSection);
				Zend_Debug::dump($semesterNumber);


		//die("here");


		$select = $this->_db->select()
		->from($this->_name,['subject_id'])
		->join('subjects', 'subjects.subject_id = block_section.subject_id',[])
		->where('block_section.block_section = ?', $bSection)
		->where('block_section.semester_number = ?', $semesterNumber)
		;
		

		$select = $this->_db->select()
		->from($this->_name)
		->join('student_bsection_match', ' student_bsection_match.block_section = block_section.block_section' and 
				'student_bsection_match.semester_number=block_section.semester_number ')
		->join('student', 'student_bsection_match.student_id=student.student_id',['student.first_name','student.last_name'])
		->where('student_bsection_match.student_id = ?', $studentID)
		->where('student_bsection_match.block_section = ?', $bSection )
		->where('student_bsection_match.semester_number = ?', $semesterNumber)
		;
		Zend_Debug::dump($this->_db->fetchAll($select));
		die("here");
		return $this->_db->fetchAll($select);
	} 
	*/
}	
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
	public function getBlockSection($bSection = null, $semesterNumber = null) {
	
		if (empty($bSection)) {
			return ;
		}

		if (empty($semesterNumber)) {
			return ;
		}

		$select = $this->_db->select()
		->from($this->_name,['subject_id'])
		->join('subjects', 'subjects.subject_id = block_section.subject_id',[])
		->where('block_section.block_section = ?', $bSection)
		->where('block_section.semester_number = ?', $semesterNumber)
		;
		return $this->_db->fetchAll($select);
	}
}	
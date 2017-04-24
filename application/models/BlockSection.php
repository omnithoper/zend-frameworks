<?php
class  BlockSection extends BaseModel {
	protected $_name = 'block_section';
	const PAGE_SIZE = 5;

	public static function getNumberOfPages($blockSectionCount) {
		return ceil($blockSectionCount/BlockSection::PAGE_SIZE);
	}

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

	public function getBlockSection($page = 1) {
		$page = empty($page)?1:$page;
		$select = $this->_db->select()
			->from($this->_name)
			->limit(self::PAGE_SIZE, ($page - 1) * self::PAGE_SIZE)
			->order('block_section')
			;	
		return $this->_db->fetchAll($select);
	}
	
	public function getViewBlockSecionCount() {
		$select = $this->_db->select()
			->from($this->_name, [
				'total' => new Zend_Db_Expr("COUNT(block_section.subject_id)")
			])
			;
        $total = $this->_db->fetchOne($select);

		return $total;
	}

	public function getAddBlockSectionSubject($data, $subjectID, $blockSection, $semesterNumber) {
		

		if (empty($subjectID)) {
			return true;
		}

		if (empty($blockSection)) {
			return true;
		}
		if(empty($semesterNumber)){
			return true;
		}
		

		if ($this->blockSectionSubjectExist($subjectID, $blockSection, $semesterNumber)) {
			return [
				'error' => 'subject Already Exist',	
			];
		}

        $this->_db->insert($this->_name, $data);
        header("Location: /blocksection");
	}

	public function blockSectionSubjectExist($subjectID, $blockSection, $semesterNumber ) {

		
		if (empty($subjectID)) {
			return true;
		}

		if (empty($blockSection)) {
			return true;
		}
		if(empty($semesterNumber)){
			return true;
		}
		

		$select = $this->_db->select()
		->from($this->_name)
		->where('subject_id = ?' , $subjectID)
		->where('block_section = ?' , $blockSection)
		->where('semester_number = ?' , $semesterNumber)
		;
		return $this->_db->fetchRow($select);
	}
	
	public function delecteBlockSectionSubject($subjectID, $blockSection, $semesterNumber) {

		if (empty($subjectID)) {
			return true;
		}

		if (empty($blockSection)) {
			return true;
		}
		if(empty($semesterNumber)){
			return true;
		}

		$where['subject_id = ?'] = $subjectID;
		$where['block_section = ?']  = $blockSection;
		$where['semester_number= ?'] = $semesterNumber;
		$this->_db->delete($this->_name, $where);
		header("Location: /blocksection");
	}
		
	public function getBlockSectionSubjectDetails($subjectID, $blockSection, $semesterNumber ) {
	
		if (empty($subjectID)) {
			return true;
		}

		if (empty($blockSection)) {
			return true;
		}
		if(empty($semesterNumber)){
			return true;
		}
		$select = $this->_db->select()
			->from($this->_name)
			->where('subject_id = ?', $subjectID)
			->where('block_section = ?', $blockSection)
			->where('semester_number = ?', $semesterNumber)
		;

		return $this->_db->fetchRow($select);
	
	}	
	public function getEditblockSectionSubject($data, $subjectID, $blockSection, $semesterNumber) {
		

		if (empty($subjectID)) {
			return true;
		}

		if (empty($blockSection)) {
			return true;
		}
		if(empty($semesterNumber)){
			return true;
		}
		
	
		if ($this->blockSectionSubjectExist($subjectID, $blockSection, $semesterNumber)) {
			return [
				'error' => 'subject Already Exist',	
			];
		}

		$where['subject_id = ?']  = $subjectID;
		$where['block_section = ?'] = $blockSection;
		$where['semester_number = ?']  = $semesterNumber;
		$this->_db->update($this->_name, $data, $where);

		header("Location: /blocksection");


	
	}
}	
<?php
class  BSection extends BaseModel {
	protected $_name = 'bsection';

		public function getViewBSection() {
		$select = $this->_db->select()
		->from($this->_name)
		;	
		return $this->_db->fetchAll($select);
	}
	

	public function getBSectionDetails($bSectionID) {
	
		if (empty($bSectionID)) {
			return true;
		}
		
		$select = $this->_db->select()
			->from($this->_name)
			->where('bsection_id = ?', $bSectionID)
		;

		return $this->_db->fetchRow($select);
	
	}	
	public function bSectionExist($bSection, $semesterNumber ) {

		if (empty($bSection)) {
			return true;
		}
		if(empty($semesterNumber)){
			return true;
		}
		

		$select = $this->_db->select()
		->from($this->_name)
		->where('bsection = ?' , $bSection)
		->where('semester_number = ?' , $semesterNumber)
		;
		return $this->_db->fetchRow($select);
	}

	public function getAddBSection($data, $bSection, $semesterNumber) {
		
		if (empty($bSection)) {
			return true;
		}
		if(empty($semesterNumber)){
			return true;
		}
		

		if ($this->bSectionExist($bSection, $semesterNumber)) {
			return [
				'error' => 'subject Already Exist',	
			];
		}

        $this->_db->insert($this->_name, $data);
        header("Location: /bsection");
	}

	public function getEditbSection($data, $bSectionID, $bSection, $semesterNumber) {
		
		if (empty($bSectionID)) {
			return true;
		}
		if (empty($bSection)) {
			return true;
		}
		if(empty($semesterNumber)){
			return true;
		}
	
		if ($this->bSectionExist($bSection, $semesterNumber)) {
			return [
				'error' => 'subject Already Exist',	
			];
		}

		$where['bsection_id = ?'] = $bSectionID;
		$this->_db->update($this->_name, $data, $where);

		header("Location: /bsection");
	}

	public function delecteBSection($bSection, $semesterNumber) {

		if (empty($bSection)) {
			return true;
		}
		if(empty($semesterNumber)){
			return true;
		}

		$where['bsection = ?']  = $bSection;
		$where['semester_number= ?'] = $semesterNumber;
		$this->_db->delete($this->_name, $where);
		header("Location: /bsection");
	}
		
}	
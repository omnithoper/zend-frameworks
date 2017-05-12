<?php
class  BSectionSubjectMatch extends BaseModel {
	protected $_name = 'bsection_subject_match';
	public function getViewBsectionSubjectMatch() {

		$select = $this->_db->select()
		->from($this->_name, [])
		->join('bsection','bsection.bsection_id = bsection_subject_match.bsection_id', 
			['bsection',
			  'bsection.semester_number'])
		->join('subjects', 'subjects.subject_id = bsection_subject_match.subject_id', 
			[ 'subjects.subject',
			  'subjects.lec_unit',
			  'subjects.lab_unit',
			  'subjects.subject_unit',
			] )
		;	
		return $this->_db->fetchAll($select);
	}


	public function addBSectionSubject($data, $bSectionID = null, $subjectID = null) {

		if (empty($bSectionID)) {
			return true;
		}
		
		if(empty($subjectID)){
			return true;
		}

		if ($this->bSectionSubjectExist($bSectionID, $subjectID )) {
			return [
				'error' => 'Student Already Exist',	
			];
		}
		$settings = new Settings();

		if ($settings->isBSectionEcceededUnits($bSectionID, $subjectID)) {
			return [
				'error' => 'ERROR: Number of allowed units has exceeded!',
				'status' => 'failed',
			];
		}

	
		$this->_db->insert($this->_name, $data);
    //    header("Location: /bsection");	
		}

	public function deleteBSectionSubject($bSectionID = null, $subjectID = null) {

		if (empty($bSectionID)) {
			return true;
		}
		
		if(empty($subjectID)){
			return true;
		}

		$where['bsection_id= ?'] = $bSectionID;
		$where['subject_id = ?']  = $subjectID;

		$this->_db->delete($this->_name, $where);
	
		//$this->_db->insert($this->_name, $data);
    //    header("Location: /bsection");	
		}	
	public function bSectionSubjectExist($bSectionID, $subjectID ) {

		if (empty($bSectionID)) {
			return true;
		}
		if(empty($subjectID)){
			return true;
		}
		

		$select = $this->_db->select()
		->from($this->_name)
		->where('bsection_id = ?' , $bSectionID)
		->where('subject_id = ?' , $subjectID)
		;
		return $this->_db->fetchRow($select);
	}

	public function getAddBSectionSubjectMatch($data, $bSectionID, $subjectID) {
		
		if (empty($bSectionID)) {
			return true;
		}
		if(empty($subjectID)){
			return true;
		}
	
		if ($this->bSectionSubjectExist($bSectionID, $subjectID)) {
			return [
				'error' => 'subject Already Exist',	

			];
		}

	
        $this->_db->insert($this->_name, $data);
        header("Location: /bsectionsubject");
	}
}	
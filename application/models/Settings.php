<?php
class Settings extends BaseModel {
	protected $_name = 'settings';

	public function getViewSettings() {
		/* other way to view data table
		$fields = [
			'number_of_allowed_units',
			'price_per_unit',
			'price_per_lab_unit',
			'price_of_misc',
		];

		$select = $this->_db->select()
			->from('settings', $fields)
			;
		*/	

		$select = $this->_db->select()
			->from($this->_name)
			;
		return $this->_db->fetchAll($select);
	}

	public function isEcceededUnits($studentID = null, $subjectID = null, $semesterID = null) {
		
		$subjectObject = new Subject();

		$currentUnits = $subjectObject->getCurrentUnits($studentID,$semesterID);
		$subjectUnits = $subjectObject->getSubjectUnits($subjectID);
		$allowedUnits = $this->getAllowedUnits();

		return ($allowedUnits < ($currentUnits + $subjectUnits));
	}
	
	public function isBSectionEcceededUnits($bSectionID = null, $subjectID = null) {
		
		$subjectObject = new Subject();

		$currentUnits = $subjectObject->getBSectionCurrentUnits($bSectionID);
		$subjectUnits = $subjectObject->getSubjectUnits($subjectID);
		$allowedUnits = $this->getAllowedUnits();

		return ($allowedUnits < ($currentUnits + $subjectUnits));
	}
	public function getAllowedUnits() {
		$fields = ['number_of_allowed_units',
		];

		$select = $this->_db->select()
			->from($this->_name, $fields)
			;
		$results = $this->_db->fetchAll($select);
		return (empty($results))?0:$results[0]['number_of_allowed_units'];
	}

	public function getPricePerUnit() {
		$fields = ['price_per_unit',
		];

		$select = $this->_db->select()
			->from($this->_name, $fields)
			;
		$results = $this->_db->fetchAll($select);
		return (empty($results))?0:$results[0]['price_per_unit'];
	}

	public function getPriceLabUnit() {
		$fields = ['price_per_lab_unit',
		];

		$select = $this->_db->select()
			->from($this->_name, $fields)
			;
		$results = $this->_db->fetchAll($select);
		return (empty($results))?0:$results[0]['price_per_lab_unit'];
	}

	public function getPriceMisc() {
		$fields = ['price_of_misc',
		];

		$select = $this->_db->select()
			->from($this->_name, $fields)
			;
		$results = $this->_db->fetchAll($select);
		return (empty($results))?0:$results[0]['price_of_misc'];
	}
}
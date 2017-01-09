<?php
class Cashier {
	private $_db = null;
	
	function __construct() {
		$this->_db = new DatabaseConnect();
	}
	
	public function getTotalPrice($studentID) {
		$settingObject = new Settings();
		$subjectObject = new Subject();

		$totalLecPrice = $this->getTotalLecturePrice($studentID);
		$totalLabPrice = $this->getTotalLaboratoryPrice($studentID);
		$misc = $settingObject->getPriceMisc();
		$result = $totalLecPrice + $totalLabPrice + $misc;
		return $result;
	}
	public function getTotalUnitPrice($studentID) {
		$settingObject = new Settings();
		$subjectObject = new Subject();

		$totalLecPrice = $this->getTotalLecturePrice($studentID);
		$totalLabPrice = $this->getTotalLaboratoryPrice($studentID);
		$result = $totalLecPrice + $totalLabPrice;
		return $result;
	}
	public function getTotalLecturePrice($studentID) {
		$settingObject = new Settings();
		$subjectObject = new Subject();

		$totalUnits = $subjectObject->getLectureUnits($studentID);
		$perUnit = $settingObject->getPricePerUnit();
		$result = $totalUnits * $perUnit;
		return $result;
	}
	public function getTotalLaboratoryPrice($studentID) {
		$settingObject = new Settings();
		$subjectObject = new Subject();
		
		$totalUnits = $subjectObject->getLaboratoryUnits($studentID);
		$perUnit = $settingObject->getPriceLabUnit();
		$result = $totalUnits * $perUnit;
		return $result;
	}

}	
?>	
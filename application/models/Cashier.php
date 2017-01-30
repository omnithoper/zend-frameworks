<?php
class Cashier extends BaseModel{

	
	public function getTotalPrice($studentID) {
		$setting = new Settings();

		$totalLecPrice = $this->getTotalLecturePrice($studentID);
		$totalLabPrice = $this->getTotalLaboratoryPrice($studentID);
		$misc = $setting->getPriceMisc();
		$result = $totalLecPrice + $totalLabPrice + $misc;
		return $result;
	}
	public function getTotalLecturePrice($studentID) {
		$setting = new Settings();
		$subject = new Subject();

		$totalUnits = $subject->getLectureUnits($studentID);
		$perUnit = $setting->getPricePerUnit();
		$result = $totalUnits * $perUnit;
	
		return $result;
	}

	public function getTotalLaboratoryPrice($studentID) {
		$setting = new Settings();
		$subject = new Subject();
		
		$totalUnits = $subject->getLaboratoryUnits($studentID);
		$perUnit = $setting->getPriceLabUnit();
		$result = $totalUnits * $perUnit;
		return $result;
	}

	public function getTotalUnitPrice($studentID) {

		$totalLecPrice = $this->getTotalLecturePrice($studentID);
		$totalLabPrice = $this->getTotalLaboratoryPrice($studentID);
		$result = $totalLecPrice + $totalLabPrice;

		return $result;
	}

}	
?>	
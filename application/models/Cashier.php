<?php
class Cashier extends BaseModel{

	public function getTotalPrice($studentID = null, $semesterID = null) {
		$setting = new Settings();

		$totalLecPrice = $this->getTotalLecturePrice($studentID, $semesterID);
		$totalLabPrice = $this->getTotalLaboratoryPrice($studentID, $semesterID);
		$misc = $setting->getPriceMisc();
		$result = $totalLecPrice + $totalLabPrice + $misc;
		return $result;
	}

	public function getTotalLecturePrice($studentID = null, $semesterID = null) {
		$setting = new Settings();
		$subject = new Subject();

		$totalUnits = $subject->getLectureUnits($studentID, $semesterID);
		$perUnit = $setting->getPricePerUnit();
		$result = $totalUnits * $perUnit;
	
		return $result;
	}

	public function getTotalLaboratoryPrice($studentID = null, $semesterID = null) {
		$setting = new Settings();
		$subject = new Subject();

		$totalUnits = $subject->getLaboratoryUnits($studentID , $semesterID);
		$perUnit = $setting->getPriceLabUnit();
		$result = $totalUnits * $perUnit;
		return $result;
	}

	public function getTotalUnitPrice($studentID = null, $semesterID = null) {
		$totalLecPrice = $this->getTotalLecturePrice($studentID, $semesterID);
		$totalLabPrice = $this->getTotalLaboratoryPrice($studentID, $semesterID);
		$result = $totalLecPrice + $totalLabPrice;

		return $result;
	}

}
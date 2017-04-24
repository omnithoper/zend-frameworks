<?php
class BsectionController extends Zend_Controller_Action  {

	public function indexAction() {

		$blockSection = new BSection();
		$records = $blockSection->getViewBSection();
	
		$this->view->bSection = $records;
	}

	public function addAction() {
		if (isset($_POST['save'])){

			$bSection = Request::getParam('bSection');
			$semesterNumber = Request::getParam('semesterNumber');
					
			$data = array(
		    	'bsection' => $bSection,
		    	'semester_number' => $semesterNumber,
			);
	
			$blockSection = new BSection();
			$result = [];

			$result = $blockSection->getAddBSection($data, $bSection, $semesterNumber);
			$this->view->students = $result;
		}
    }
		
	public function editAction() {

		$bSectionID = Request::getParam('bSectionID');
			
		$blockSection = new BSection();
		$details = $blockSection->getBSectionDetails($bSectionID);
		$this->view->bSection = $details;
		
		$edit = [];
		if (isset($_POST['edit'])){

			$bSectionID = Request::getParam('bSectionID');
			$bSection = Request::getParam('bSection');
			$semesterNumber = Request::getParam('semesterNumber');
			$data = array(
		    	'bsection' => $bSection,
		    	'semester_number' => $semesterNumber,
			);
	
			$edit = $blockSection->getEditbSection($data, $bSectionID, $bSection, $semesterNumber);
			$this->view->students = $edit;
		}

	}
    public function deleteAction() {
	
		$bSection = Request::getParam('bSection');
		$semesterNumber = Request::getParam('semesterNumber');

		$blockSection = new BSection();
		$delete = $blockSection->delecteBSection($bSection, $semesterNumber);
	}
		
}
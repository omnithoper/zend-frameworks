<?php
class BsectionController extends Zend_Controller_Action  {
	protected $_bSectionID;

	public function indexAction() {
		$bSectionID =  Request::getParam('bSectionID');
		$bSectionID =  "30";
Zend_Debug::dump($bSectionID);
//die("here");
		$blockSection = new BSection();

	//	if (empty($bSectionID)) {
			$records = $blockSection->getViewBSection();
			$this->view->bSection = $records;
	//	} else 	{
			$details = $blockSection->getBSectionSubjectDetails($bSectionID);
			$this->view->bSectionSubject = $details;
			$this->view->studentID = $bSectionID;
	//	}
		//$this->__details();

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
		
	public function detailsAction() {
		$bSectionID =  Request::getParam('bSectionID');
//Zend_Debug::dump($bSectionID);
//die("here");
		$blockSection = new BSection();
		$details = $blockSection->getBSectionSubjectDetails($bSectionID);

		$this->view->bSectionSubject = $details;

	//	echo Zend_Json::encode($details);
	//	exit;
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
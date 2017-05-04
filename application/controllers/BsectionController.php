<?php
class BsectionController extends Zend_Controller_Action  {
	protected $_bSectionID;

	public function indexAction() {

		$blockSection = new BSection();
		$records = $blockSection->getViewBSection();
		$this->view->bSection = $records;

	}

	public function listsubjectsAction() {
		$bSectionID = Request::getParam('bSectionID');

		$subjects = new Subject();
		$listSubject = $subjects->getBsectionSubjects($bSectionID);
	
		echo Zend_Json::encode($listSubject);
		exit;

	}

    public function addsAction() {
			$this->_helper->viewRenderer->setNoRender();
			$this->_helper->layout()->disableLayout();

			$subjectID = Request::getParam('subjectID');
			$bSectionID = Request::getParam('bSectionID');
			
			$data = array(
		    	'bsection_id' => $bSectionID,
		    	'subject_id' => $subjectID,
			);

			$subject = new BSectionSubjectMatch();
			$subject->addBSectionSubject($data, $bSectionID, $subjectID);
			exit;
	}

    public function displayaddsubjectsAction() {
			$subjectID = Request::getParam('subjectID');

			$subjects = new Subject();
			$listSubject = $subjects->displayAddSubjects($subjectID);
	
			echo Zend_Json::encode($listSubject);
			exit;
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

		$blockSection = new BSection();
		$details = $blockSection->getBSectionSubjectDetails($bSectionID);

		echo Zend_Json::encode($details);
		exit;
	}

	public function totalunitsAction() {
		$bSectionID =  Request::getParam('bSectionID');

		$subject = new Subject();
		$totalUnits	=$subject->getBSectionCurrentUnits($bSectionID);

		echo Zend_Json::encode($totalUnits);
		exit;
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
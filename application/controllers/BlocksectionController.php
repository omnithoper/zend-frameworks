<?php
class BlocksectionController extends Zend_Controller_Action  {

	public function indexAction() {

		$page = Request::getParam('page');

		$bSection = new BlockSection();
		$records = $bSection->getBlockSection($page);
		$blockSectionCount = $bSection->getViewBlockSecionCount();
		
		$this->view->blockSection = $records;
	    $this->view->blockSectionCount = $blockSectionCount;
		$this->view->currentPage = $page;
	}

	public function addAction() {
		if (isset($_POST['save'])){

			$subjectID = Request::getParam('subjectID');
			$blockSection = Request::getParam('blockSection');
			$semesterNumber = Request::getParam('semesterNumber');
			$data = array(
		    	'subject_id' => $subjectID,
		    	'block_section' => $blockSection,
		    	'semester_number' => $semesterNumber,
			);
	
			$bSection = new BlockSection();
			$result = [];
			$result = $bSection->getAddBlockSectionSubject($data, $subjectID, $blockSection, $semesterNumber);
			$this->view->students = $result;
		}
    }
		
	public function editAction() {

		$subjectID = Request::getParam('subjectID');
		$blockSection = Request::getParam('blockSection');
		$semesterNumber = Request::getParam('semesterNumber');

		$bSection = new BlockSection();
		$details = $bSection->getBlockSectionSubjectDetails($subjectID, $blockSection, $semesterNumber);
		$this->view->bSection = $details;
		
		$edit = [];
		if (isset($_POST['edit'])){
			$subjectID = Request::getParam('subjectID');
			$blockSection = Request::getParam('blockSection');
			$semesterNumber = Request::getParam('semesterNumber');

			$data = array(
		    	'subject_id' => $subjectID,
		    	'block_section' => $blockSection,
		    	'semester_number' => $semesterNumber,
			);

			$edit = $bSection->getEditblockSectionSubject($data, $subjectID, $blockSection, $semesterNumber);
			$this->view->students = $edit;
		}

	}

	public function deleteAction() {
		$subjectID = Request::getParam('subjectID');
		$blockSection = Request::getParam('blockSection');
		$semesterNumber = Request::getParam('semesterNumber');

		$bSection = new BlockSection();
		$delete = $bSection->delecteBlockSectionSubject($subjectID, $blockSection, $semesterNumber);
	}

}
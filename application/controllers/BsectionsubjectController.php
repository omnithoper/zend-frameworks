<?php
class BsectionsubjectController extends Zend_Controller_Action  {

	public function indexAction() {
	

		$bsectionSubjectMatch = new BSectionSubjectMatch();
		$records = $bsectionSubjectMatch->getViewBsectionSubjectMatch();
		$bSection = $records[0]['bsection'];
		$semesterNumber = $records[0]['semester_number'];

		$this->view->BsectionSubject = $records;
		$this->view->bSection = $bSection;
		$this->view->semesterNumber = $semesterNumber;
	}
	public function addAction() { 
		if (isset($_POST['save'])){

			$bSectionID = Request::getParam('bSectionID');
			$subjectID = Request::getParam('subjectID');
					
			$data = array(
		    	'bsection_id' => $bSectionID,
		    	'subject_id' => $subjectID,
			);
	
			$bsectionSubjectMatch = new BSectionSubjectMatch();
			$result = [];

			$result = $bsectionSubjectMatch->getAddBSectionSubjectMatch($data, $bSectionID, $subjectID);
			$this->view->students = $result;
		}
    }
}	
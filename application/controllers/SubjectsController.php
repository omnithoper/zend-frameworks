<?php
class SubjectsController extends Zend_Controller_Action {
	public function indexAction() {
		$page = Request::getParam('page');

		$subjects = new Subject();
		$records = $subjects->getViewSubjects($page);
		$subjectsCount = $subjects->getViewSubjectsCount(); 
	
	    $this->view->subjects = $records;
	    $this->view->subjectsCount = $subjectsCount;
		$this->view->currentPage = $page;
	}

	public function detailsAction() {
	
		$subjectID = Request::getParam('subjectID');
	
		$subject = new Subject();
		$details = $subject->getSubjectDetails($subjectID);
		echo Zend_Json::encode($details);
		exit;
	}

	public function addAction(){
		if (isset($_POST['save'])) {
			$subject = Request::getParam('subject');
			$lecUnit = Request::getParam('lec_unit');
			$labUnit = Request::getParam('lab_unit');
			$subjectUnit = Request::getParam('subject_unit');
			$subjects = new Subject();
		    $subjects->getAddSubject($subject, $lecUnit, $labUnit, $subjectUnit);
		}
	}

	public function editAction() {
		$subjectID = Request::getParam('subject_id');
		$subjects = new Subject();
		$details = $subjects->getSubjectDetails($subjectID);
		$this->view->subject = $details;

		if (isset($_POST['edit'])) {
			$subject = Request::getParam('subject');
			$subjectUnit = Request::getParam('subject_unit');
			$lecUnit = Request::getParam('lec_unit');
			$labUnit = Request::getParam('lab_unit');
			$subjects->getEditSubject($subject, $lecUnit, $labUnit, $subjectUnit, $subjectID); 
    	}
    }

	public function updateAction() {
        $this->_helper->viewRenderer->setNoRender();
        $this->_helper->layout()->disableLayout();

        $subjectID = Request::getParam('subjectID');
        $subjectName = Request::getParam('subjectName');
        $subjectLec = Request::getParam('subjectLec');
        $subjectLab = Request::getParam('subjectLab');
        $subjectUnit = Request::getParam('subjectUnit');
        $semesterNumber = Request::getParam('semesterNumber');


        $data = array(
            'subject' => $subjectName,
            'lec_unit' => $subjectLec,
            'lab_unit' => $subjectLab,
            'subject_unit' => $subjectUnit,
           // 'semester_number' => $semesterNumber,
        );

        $subject = new Subject();
        $subject->updateSubject($data, $subjectID, $subjectName);

        exit;
    }


    public function addsAction() {
			$this->_helper->viewRenderer->setNoRender();
			$this->_helper->layout()->disableLayout();

			$subjectName = Request::getParam('subjectName');
			$subjectLec = Request::getParam('subjectLec');
			$subjectLab = Request::getParam('subjectLab');
			$subjectUnit = Request::getParam('subjectUnit');
			$semesterNumber = Request::getParam('semesterNumber');

			$data = array(
		    	'subject' => $subjectName,
		    	'lec_unit' => $subjectLec,
		    	'lab_unit' => $subjectLab,
		    	'subject_unit' => $subjectUnit,
		    //	'semester_number' => $semesterNumber
			);

			$subject = new Subject();
			$subject->addSubject($data, $subjectName);
			exit;
		}

	function deleteAction() {
		$subjectID = Request::getParam('subject_id');

		$deleteObject = new Subject();
		$deleteObject->getDeleteSubject($subjectID);
	}
}
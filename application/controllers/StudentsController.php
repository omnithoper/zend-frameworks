<?php
class StudentsController extends Zend_Controller_Action  {
	public function indexAction() {
		$page = Request::getParam('page');

		$student = new Student();
		$students = $student->getViewStudents($page); 
		$studentsCount = $student->getViewStudentsCount(); 
	
		$this->view->students = $students;
		$this->view->studentsCount = $studentsCount;
		$this->view->currentPage = $page;
	}

	public function apiAction() {
		$page = Request::getParam('page');

		$student = new Student();
		$students = $student->getViewStudents($page); 
		$studentsCount = $student->getViewStudentsCount();
 	
		$doc = new DOMDocument();
		$root_element = $doc->createElement("response");
	    $doc->appendChild($root_element);
		
		$statusElement = $doc->createElement("success");
	    $statusElement->appendChild($doc->createTextNode("true"));
	    $root_element->appendChild($statusElement);

        $studentsElement = $doc->createElement("students");
        $root_element->appendChild($studentsElement);

		foreach ($students as $student) { 
	        $studentElement = $doc->createElement("student");
	        $studentsElement->appendChild($studentElement);

	        $studentID = $doc->createElement("studentID");
	        $studentID->appendChild($doc->createTextNode($student['student_id']));
	        $studentElement->appendChild($studentID);

	        $firstName = $doc->createElement("firstName");
	        $firstName->appendChild($doc->createTextNode($student['first_name']));
	        $studentElement->appendChild($firstName);

	        $lastName = $doc->createElement("lastName");
	        $lastName->appendChild($doc->createTextNode($student['last_name']));
	        $studentElement->appendChild($lastName);

    	}
        header('Content-Type: application/xml');
        echo $doc->saveXML(); 
        exit;
	}

	public function apiForAction() {
		$page = Request::getParam('page');

		$student = new Student();
		$students = $student->getViewStudents($page); 

		$doc = new DOMDocument();
		$root_element = $doc->createElement("response");
	    $doc->appendChild($root_element);
		
		$statusElement = $doc->createElement("success");
	    $statusElement->appendChild($doc->createTextNode("true"));
	    $root_element->appendChild($statusElement);

        $studentsElement = $doc->createElement("students");
        $root_element->appendChild($studentsElement);

        for ($ctr = 0; $ctr < count($students); $ctr++) {
	        $studentElement = $doc->createElement("student");
	        $studentsElement->appendChild($studentElement);

	        $studentID = $doc->createElement("studentID");
	        $studentID->appendChild($doc->createTextNode($students[0]['student_id']));
	        $studentElement->appendChild($studentID);

	        $firstName = $doc->createElement("firstName");
	        $firstName->appendChild($doc->createTextNode($students[0]['first_name']));
	        $studentElement->appendChild($firstName);

	        $lastName = $doc->createElement("lastName");
	        $lastName->appendChild($doc->createTextNode($students[0]['last_name']));
	        $studentElement->appendChild($lastName);

    	}
        header('Content-Type: application/xml');
        echo $doc->saveXML(); 
        exit;
	}

	public function apiJsonAction() {
		$page = Request::getParam('page');

		$student = new Student();
		$students = $student->getViewStudents($page); 

		header('Content-Type: application/json');
		echo Zend_Json::encode($students);
		exit;
	}

	public function detailsAction() {
		$studentID = Request::getParam('studentID');

		$student = new Student();
		$details = $student->getStudentDetails($studentID);
		echo Zend_Json::encode($details);
		exit;
	}

	public function addAction() {
		if (isset($_POST['save'])){

			$firstName = Request::getParam('first_name');
			$lastName = Request::getParam('last_name');
			$userName = Request::getParam('user_name');
			$password = Request::getParam('password');
			$data = array(
		    	'first_name' => $firstName,
		    	'last_name' => $lastName,
		    	'username' => $userName,
		    	'password' => sha1($password),
			);
	
			$student = new Student();
			$result = [];
			$result = $student->getAddStudent($data, $firstName, $lastName);
			$this->view->students = $result;
		}
    }

	public function editAction() {
		$studentID = Request::getParam('student_id');

		$student = new Student();
		$details = $student->getStudentDetails($studentID);
		$this->view->student = $details;
		
		$edit = [];
		if (isset($_POST['edit'])){
			$firstName = Request::getParam('first_name');
			$lastName = Request::getParam('last_name');
			$userName = Request::getParam('user_name');
			$password = Request::getParam('password');	
		
			$data = array(
		    	'first_name' => $firstName,
		    	'last_name' => $lastName,
		    	'username' => $userName,
		    	'password' => sha1($password),
			);

			$edit = $student->getEditStudent($data, $firstName, $lastName, $studentID);
			$this->view->students = $edit;
		}
	}

	public function addsAction() {
		$this->_helper->viewRenderer->setNoRender();
		$this->_helper->layout()->disableLayout();

		$first_name = Request::getParam('first_name');
		$last_name = Request::getParam('last_name');
		$user_name = Request::getParam('user_name');
		$password = Request::getParam('password');

		$data = array(
	    	'first_name' => $first_name,
	    	'last_name' => $last_name,
	    	'username' => $user_name,
	    	'password' => sha1($password),
		);

		$student = new Student();
		$details = $student->addStudent($data, $first_name, $last_name);

		$this->view->error = $details;
		$this->indexAction();

		echo Zend_Json::encode($details);
	}

	public function updateAction() {
		$this->_helper->viewRenderer->setNoRender();
		$this->_helper->layout()->disableLayout();

		$studentID = Request::getParam('studentID');
		$first_name = Request::getParam('first_name');
		$last_name = Request::getParam('last_name');
		$user_name = Request::getParam('user_name');
		$password = Request::getParam('password');

		$data = array(
	    	'first_name' => $first_name,
	    	'last_name' => $last_name,
	    	'username' => $user_name,
	    	'password' => sha1($password),
		);

		$student = new Student();
		$details = $student->updateStudent($data, $studentID, $first_name, $last_name);

		echo Zend_Json::encode($details);

	}

	public function studenteditAction() {
		$studentID = Request::getParam('student_id');

		$student = new Student();
		$details = $student->getStudentDetails($studentID);
		$this->view->student = $details;
		
		$edit = [];
		if (isset($_POST['edit'])){
			$userName = Request::getParam('user_name');
			$password = Request::getParam('password');	
		
			$data = array(
		    	'username' => $userName,
		    	'password' => sha1($password),
			);

			$edit = $student->getEditStudentUserPassword($data, $studentID);
			$this->view->students = $edit;

		}
	}

	function deleteAction() {
		$studentID = Request::getParam('student_id');
		$deleteObject = new Student();
		$delete = $deleteObject->getDeleteStudent($studentID);
	}

	function downloadAction() {
		require '/lib/fpdf.php';
		$studentID = Request::getParam('student_id');
		$paymentObject = new Payment();
		$studentObject = new Student();
		$name = $studentObject->getViewStudent($studentID);
		$view = $paymentObject->getViewStudentPayment($studentID);


		$pdf = new FPDF();
		$pdf->AddPage();
		$pdf->SetFont('Arial','B',16);
		$pdf->Cell(110,10);
		$pdf->Cell(20,10, 'date:');
		$pdf->Cell(20,10, $view[0]['transaction_date'],0,1);
		$pdf->Cell(20,10, 'Name:');
		$pdf->Cell(20,10, $name['full_name'],0,1);
		$pdf->Cell(50,10, 'Invoice Number:');
		$pdf->Cell(20,10, $view[0]['payment_id'] ,0,1);
		$pdf->Cell(38,10, 'Amount Paid:');
		$pdf->Cell(20,10, $view[0]['total_amount'],0,1);
		$pdf->Cell(25,10, 'Change:');
		$pdf->Cell(20,10, $view[0]['change']);
		$pdf->Output();
	}
}
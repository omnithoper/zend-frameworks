<?php
class StudentsController extends Zend_Controller_Action  {
	public function indexAction() {
		$student = new Application_Model_Student();
		$students = $student->getViewStudents(); 
		
		$this->view->students = $students;
	}

	public function detailsAction() {
		
		$studentID = Application_Model_Request::getParam('studentID');

		$student = new Application_Model_Student();
		$details = $student->getStudentDetails($studentID);
		echo Zend_Json::encode($details);
		exit;
	}

	public function addAction() {
			
		if (isset($_POST['save'])){

			$firstName = Application_Model_Request::getParam('first_name');
			$lastName = Application_Model_Request::getParam('last_name');
			$data = array(
		    	'first_name' => $firstName,
		    	'last_name' => $lastName
			);
	
			$student = new Application_Model_Student();
			$result = [];
			$result = $student->getAddStudent($data, $firstName, $lastName);
			$this->view->students = $result;
			//var_dump($result['error']);
		
		}
     }
	public function editAction() {
		$studentID = Application_Model_Request::getParam('student_id');

		$student = new Application_Model_Student();
		$details = $student->getStudentDetails($studentID);
		$this->view->student = $details;
		
		$edit = [];
		if (isset($_POST['edit'])){
			$firstName = Application_Model_Request::getParam('first_name');
			$lastName = Application_Model_Request::getParam('last_name');

			$data = array(
		    	'first_name' => $firstName,
		    	'last_name' => $lastName
			);

			$edit = $student->getEditStudent($data, $firstName, $lastName, $studentID);
			$this->view->students = $edit;

		}

	}
	function deleteAction() {	
		$studentID = Application_Model_Request::getParam('student_id');
		$deleteObject = new Application_Model_Student();
		$delete = $deleteObject->getDeleteStudent($studentID);
	}

	function downloadAction() {
		require '/lib/fpdf.php';
		$studentID = Application_Model_Request::getParam('student_id');
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
<?php
class StudentsController extends Zend_Controller_Action  {
	public function indexAction() {
		$student = new Student();
		$students = $student->getViewStudents(); 

		$this->view->students = $students;
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
			$data = array(
		    	'first_name' => $firstName,
		    	'last_name' => $lastName
			);
	
			$student = new Student();
			$result = [];
			$result = $student->getAddStudent($data, $firstName, $lastName);
			$this->view->students = $result;
			//var_dump($result['error']);
		
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

			$data = array(
		    	'first_name' => $firstName,
		    	'last_name' => $lastName
			);

			$edit = $student->getEditStudent($data, $firstName, $lastName, $studentID);
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
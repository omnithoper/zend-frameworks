<?php
class StudentsController extends BaseController {
	public function indexAction() {
		$student = new Student();
		$students = $student->getViewStudentPaid(); 
		$this->assign('student', $students);

	}

	public function addAction() {
	
		$firstName = Request::getParam('first_name');
		$lastName = Request::getParam('last_name');

		$addObject = new Student();
		$result=[];
		
		if (isset($_POST['save'])){
			$result = $addObject->getAddStudent($firstName, $lastName);
		}

		$this->assign('result', $result);


		}
	public function editAction() {
		$studentID = Request::getParam('student_id');

		$student = new Student();
		$result = $student->getViewStudent($studentID);
		
		$edit = [];
		if (Request::isPost()) {
			$firstName = Request::getParam('first_name');
			$lastName = Request::getParam('last_name');
			$edit = $student->getEditStudent($firstName, $lastName, $studentID);

			header("Location: /students");
		}
		
		$this->assign('result', $result);
		$this->assign('edit', $edit);

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

	public function dispatch($controllerName, $actionName){

		if (empty($controllerName)) {
			$controllerName = 'index';
		}
		if (empty($actionName)) {
			$actionName = 'index';
		}

		$this->render($controllerName.'/'.$actionName.'.'.'phtml');
	}
}
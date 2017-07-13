<?php
class IncomeController extends Zend_Controller_Action  {
	public function indexAction() {
		$semDate = Request::getParam('semDate');

		$date = explode(',' , $semDate);
		$dateStart = empty($date[0])?NULL:$date[0];
		$dateEnd = empty($date[1])?NULL:$date[1];

		$semester = new Semester();
		$result = $semester->getPaymentDate($dateStart, $dateEnd);

		$semesterDate = $semester->getViewSemester();
		$studentPaid = $semester->getSemesterTotalIncome($dateStart, $dateEnd);
		$totalAmount = empty($studentPaid['total_income'])?null:$studentPaid['total_income'];
		$numberOfStudent =empty($studentPaid['total_student'])?null:$studentPaid['total_student'];

		$semesterIncome = $semester->getAllSemesterIncome();
		$studentIncome = $semester->getpaymentPerStudent();

		$this->view->result = $result;
		$this->view->studentIncome = $studentIncome;
		$this->view->semesterIncome = $semesterIncome;
		$this->view->semesterDate = $semesterDate;
		$this->view->totalAmount = $totalAmount;
		$this->view->numberOfStudent = $numberOfStudent;
	}

	public function debugAction()
	{
		ini_set('xdebug.var_display_max_depth', 20);
		$semester = new Semester();
		$sample = $semester->getSemesterSubject();

		$batch = [];
		foreach ($sample as $details) {
			$batch[$details['student_id']][$details['semester_id']][] = $details; 
		}
	Zend_Debug::dump($batch);

		die("here");
		$batch2 = [];
		foreach ($batch as $key => $details) {
			$batch2[$key] = array_values($details); 
		}

		foreach ($batch2 as $studentID => $semester) {
			foreach ($semester as $key => $subjects) {
				foreach ($subjects as $subject) {
					// Zend_Debug::dump($subject); continue;
					$sql = '';

					if ($key == 0) {
						$sql .= 'UPDATE student_subject_match SET ';
						$sql .= 'semester_id = '.$subject['semester_id'].' ';
						$sql .= 'WHERE student_id = '.$subject['student_id'].' AND subject_id = '.$subject['subject_id'];
					} else {
						$sql .= 'INSERT IGNORE INTO  student_subject_match SET ';
						$sql .= 'semester_id = '.$subject['semester_id'].', ';
						$sql .= 'student_id = '.$subject['student_id'].', ';
						$sql .= 'subject_id = '.$subject['subject_id'].' ';
					}
					$sql .= ';';

					echo $sql.'<br/>';
				}
			}
		}

		Zend_Debug::dump($batch2);

		die("here");

		foreach ($sample as $key => $details) {
			$sql = '';

			if ($studentID != $details['student_id']) {
				$sql .= 'UPDATE student_subject_match SET ';
				$sql .= 'semester_id = '.$details['semester_id'].' ';
				$sql .= 'WHERE student_id = '.$details['student_id'].' AND subject_id = '.$details['subject_id'];
			} else {
				$sql .= 'INSERT INTO student_subject_match SET ';
				$sql .= 'semester_id = '.$details['semester_id'].', ';
				$sql .= 'student_id = '.$details['student_id'].', ';
				$sql .= 'subject_id = '.$details['subject_id'].', ';
			}
			$sql .= ';';

			echo $sql.'<br/>';
		}

		Zend_Debug::Dump($sample);
		die("here");


	}
}
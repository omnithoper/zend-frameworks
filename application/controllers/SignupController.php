<?php
class SignupController extends Zend_Controller_Action  {

	public function indexAction() {

		if (isset($_POST['save'])) {

			$email = Request::getParam('email');
			$firstName = Request::getParam('name');
			$lastName = Request::getParam('lastname');
			$userName = Request::getParam('user');
			$psw = Request::getParam('psw');
			$pswRepeat = Request::getParam('psw-repeat');

			$data = array(
				'email' => $email,
		    	'first_name' => $firstName,
		    	'last_name' => $lastName,
		    	'username' => $userName,
		    	'password' => sha1($psw),
			);
	
			$student = new Student();
			$result = [];
			$result = $student->getSignUpStudent($data, $firstName, $lastName, $email, $psw, $pswRepeat, $userName);
			$this->view->students = $result;
			
		
		}	

	}

}
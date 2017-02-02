<?php
class LoginController extends Zend_Controller_Action {
	public function indexAction() {


	}
	public function loginAction() {
	    $userName = Request::getParam('username');
	    $password = Request::getParam('password'); 
     	
	    $admin = new Admin();
	
	    $result = $admin->getAdminUserPassword($userName, $password);

 		if (!$result['status']) {
	    	$student = new Student();
	    	$result = $student->getStudentUserPassword($userName, $password);
		} 
		
	    $error = $result['error'];
	    $this->view->error = $error;
	    header('Location: /index');
	}
	
	public function logoutAction() {
		if (!empty($_SESSION['login_user'])) {
			unset($_SESSION['login_user']);
			unset($_SESSION['user_type']);
		}
		session_write_close();
		//session_destroy();
	    header('Location: /');
	}


}
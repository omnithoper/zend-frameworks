<?php
class LoginController extends Zend_Controller_Action {
	public function indexAction() {

}
	public function loginAction() {
	    $myusername = Request::getParam('username');
	    $mypassword = Request::getParam('password'); 

	    $adminObject = new Admin();
	    $result = $adminObject->getUserPassword($myusername, $mypassword); 
	 
	    $error = $result['error'];
	    $this->view->error = $error;
	    header('Location: /index');
	}
	
	public function logoutAction() {
		if (!empty($_SESSION['login_user'])) {
			unset($_SESSION['login_user']);
		}
		//session_write_close();
		session_destroy();
	    header('Location: /');
	}

}
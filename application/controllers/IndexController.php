<?php
class IndexController extends Zend_Controller_Action  {
	public function indexAction() {
		Zend_Debug::dump($_SESSION);
		if (empty($_SESSION['login_user'])) {
			header('Location: /login');
		}
	}
}	
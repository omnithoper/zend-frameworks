<?php
class GlobalControllerPlugin extends Zend_Controller_Plugin_Abstract {
	public function preDispatch() {
		$params = $this->_request->getParams();
		if ($params['controller'] == 'login' && $params['action'] == 'index') {
			return;
		}
		
		if (empty($_SESSION['login_user'])) {
			header('Location: /login');
		}
	}
}
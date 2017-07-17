<?php
class GlobalControllerPlugin extends Zend_Controller_Plugin_Abstract {
	public function preDispatch(Zend_Controller_Request_Abstract $request) {
		$params = $this->_request->getParams();

	

		if ($params['controller'] == 'login' && $params['action'] == 'index') {
			return;
		}


		if ($params['controller'] == 'signup' && $params['action'] == 'index') {
			return;
		}

 
		if ($params['controller'] == 'version') {
			return;
		}

		if (empty($_SESSION['login_user'])) {
			header('Location: /login');
		}
	}
}
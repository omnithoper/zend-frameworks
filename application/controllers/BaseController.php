<?php
class BaseController {
	protected $_template;

	public function __construct() {
		$this->_template = new Smarty();
	    $this->_template->template_dir = BASE_PATH.'/views/scripts/';
	    $this->_template->compile_dir = BASE_PATH.'/compile/';

		if (empty($_SESSION['login_user'])) {
			header('Location: /login');
		}
	}

	public function render($template) {
		$this->_template->display($template);
	}

	public function assign($field, $value) {
		$this->_template->assign($field, $value);
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
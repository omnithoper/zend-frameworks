<?php
class IndexController extends BaseController {
	public function indexAction() {
		
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
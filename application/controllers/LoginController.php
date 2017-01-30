<?php
class LoginController {
	public function indexAction() {
		$config = parse_ini_file('../application/configuration/application.ini');
	//	$local = parse_ini_file('configuration/local.ini');
	//	$config = array_merge($config, $local);

	}

	public function loginAction() {
	    $myusername = Request::getParam('username');
	    $mypassword = Request::getParam('password'); 

	    $adminObject = new Admin();
	    $result = $adminObject->getUserPassword($myusername, $mypassword); 
	    $error = $result['error'];
	    header('Location: /');
	}
	
	public function logoutAction() {
		if (!empty($_SESSION['login_user'])) {
			unset($_SESSION['login_user']);
		}
		session_destroy();
	    header('Location: /');
	}

	public function dispatch($controllerName, $actionName){
		if (empty($controllerName)) {
			$controllerName = 'login';
		}
		
		if (empty($actionName)) {
			$actionName = 'index';
		}
		
		$config = parse_ini_file('../application/configuration/application.ini');
		//$local = parse_ini_file('configuration/local.ini');
		//$config = array_merge($config, $local);

		$smarty = new Smarty();	
	    $smarty->template_dir = $config['root'].'/views/scripts/';
	    $smarty->compile_dir = $config['root'].'/compile/';
		$smarty->display($controllerName.'/'.$actionName.'.'.'phtml');
	
	}	

}
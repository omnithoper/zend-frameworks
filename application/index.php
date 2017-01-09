
<?php

	date_default_timezone_set('UTC');

	define('BASE_PATH', __DIR__);
	set_include_path(get_include_path().PATH_SEPARATOR.__DIR__.DIRECTORY_SEPARATOR.'controllers'.PATH_SEPARATOR.__DIR__.DIRECTORY_SEPARATOR.'models');

	require '../public/smarty/Smarty.class.php'; 
	session_start();

	$baseUrl = 'http://zend.enrollement.com/';

	$requestUrl = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
	//var_dump($requestUrl);
	//	var_dump($baseUrl);
	$requestString = substr($requestUrl, strlen($baseUrl));
//	$requestString = explode('/', $requestString);
//	var_dump($requestString);

	list($urlParams, $queryParams) = array_pad(explode('?', $requestString), 2, '');
//	var_dump(array_pad(explode('?', $requestString), 2, ''));
//	var_dump($urlParams);
	$urlParams = explode('/', $urlParams);
//	var_dump($queryParams);
	parse_str($queryParams, $requestParams);
	foreach ($requestParams as $field => $value) {
		$_GET[$field] = $value;
	}

	$controllerTemplate = array_shift($urlParams);
	$controllerName = empty($controllerTemplate)?'Index':$controllerTemplate;
	$controllerName = ucfirst($controllerName.'Controller');
 // var_dump($controllerTemplate);
 // var_dump($controlName);
	$actionTemplate = array_shift($urlParams);
	$actionName = empty($actionTemplate)?'index':$actionTemplate;
	$actionName = strtolower($actionName.'Action');
//  var_dump($actionTemplate);
 // var_dump($actionName);
	spl_autoload_register(function ($class_name) {
	    require_once $class_name . '.php';
	});

	$controller = new $controllerName();
	$controller->$actionName();

	$controller->dispatch($controllerTemplate, $actionTemplate);
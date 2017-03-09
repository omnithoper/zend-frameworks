<?php

defined('APPLICATION_PATH')
        || define('APPLICATION_PATH', realpath(dirname(__FILE__) . '/../application'));

set_include_path(implode(PATH_SEPARATOR, array(
    realpath(APPLICATION_PATH . '/../'),
    get_include_path(),
)));

require_once 'Zend/Application.php';
require_once 'Zend/Config/Ini.php';
require_once 'Zend/Loader/Autoloader.php';


$loader = Zend_Loader_Autoloader::getInstance();
$loader->setFallbackAutoloader(true);

Zend_Session::start();

$application = new Zend_Application('dev', APPLICATION_PATH.'/configuration/application.ini');
$application->bootstrap();
$application->run();
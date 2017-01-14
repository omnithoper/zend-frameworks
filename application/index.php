 <?php
// Define path to application directory
defined('APPLICATION_PATH')
    || define('APPLICATION_PATH', realpath(dirname(__FILE__) . '/../application'));

// Define application environment
defined('APPLICATION_ENV')
    || define('APPLICATION_ENV', (getenv('APPLICATION_ENV') ? getenv('APPLICATION_ENV') : 'production'));

// Ensure library/ is on include_path
set_include_path(implode(PATH_SEPARATOR, array(
    get_include_path(),
    realpath(APPLICATION_PATH . '/../'),
    APPLICATION_PATH . '/models/',
)));

/** Zend_Application */
require_once 'Zend/Application.php';
require_once 'Zend/Loader/Autoloader.php';
Zend_Loader_Autoloader::getInstance();
#require_once 'Zend/Config.php';


#var_dump(APPLICATION_PATH . '/../library');
#	var_dump(get_include_path()); die();


// Create application, bootstrap, and run
$application = new Zend_Application('dev',APPLICATION_PATH.'/configuration/application.ini');
#var_dump(APPLICATION_PATH.'/configuration/application.ini'); die();
$application->bootstrap()
            ->run();

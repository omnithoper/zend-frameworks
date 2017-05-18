<?php
class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
	protected function _initExtraConfig() {

		if (file_exists(APPLICATION_PATH.'/configuration/application.ini')) {
			$config = new Zend_Config_Ini(APPLICATION_PATH.'/configuration/application.ini', 'dev', array('allowModifications'=>true));
		}
		
		if (file_exists(APPLICATION_PATH.'/configuration/local.ini')) {
			$config_extended = new Zend_Config_Ini(APPLICATION_PATH.'/configuration/local.ini', 'dev');
			$config->merge($config_extended);
		}
		
	    $db = Zend_Db::factory('Pdo_Mysql', $config->resources->db->params->toArray());
	    Zend_Registry::set('db', $db);
	    Zend_Registry::set('config', $config);
	}

	protected function _initErrorDisplay(){
        $frontController = Zend_Controller_Front::getInstance();
        $frontController->throwExceptions(true);
    }

	public function _initGlobalPlugin() {

		$this->bootstrap('frontController');

		$plugin = new GlobalControllerPlugin();

		$front = Zend_Controller_Front::getInstance();
		$front->registerPlugin($plugin);

		return $plugin;
	}
}

<?php
class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{

	protected function _initExtraConfig() {

		$config = [];
		if (file_exists('configuration/application.ini')) {
			$config = parse_ini_file('configuration/application.ini');
		} else {
			$config = parse_ini_file('configuration/application.ini');
		}
		
		$config_extended = [];
		if (file_exists('configuration/local.ini')) {
			$config_extended = parse_ini_file('configuration/local.ini');
		} else {
			$config_extended = parse_ini_file('configuration/local.ini');
		}

			$config = array_merge($config, $config_extended);
		//var_dump($config);
		//die("here");
	
		
		// to past the content of application.ini 
		
		// to past the content of application.ini 
	    $config = new Zend_Config($this->getOptions());
	    $db = Zend_Db::factory('Pdo_Mysql', $config->resources->db->params->toArray());
	    Zend_Registry::set('db', $db);
   
	}

	public function _initGlobalPlugin() {

		$this->bootstrap('frontController');

		$plugin = new GlobalControllerPlugin();

		$front = Zend_Controller_Front::getInstance();
		$front->registerPlugin($plugin);

		return $plugin;
	}

}
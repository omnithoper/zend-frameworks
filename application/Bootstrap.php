
<?php
class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{

	protected function _initExtraConfig() {
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
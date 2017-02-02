
<?php
class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{

	protected function _initExtraConfig() {
		// to past the content of application.ini 
	    $config = new Zend_Config($this->getOptions());
	    $db = Zend_Db::factory('Pdo_Mysql', $config->resources->db->params->toArray());
	    Zend_Registry::set('db', $db);
   
	}

}
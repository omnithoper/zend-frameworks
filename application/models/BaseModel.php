<?php
class BaseModel {
	protected $_db = NULL;
	
	public function __construct() {
		$this->_db = Zend_Registry::get('db');
		if (empty($_SESSION['login_user'])) {
			header('Location: /login');
		}
	}
}	
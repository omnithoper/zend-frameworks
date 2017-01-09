<?php
class Students extends Zend_Db_Table_Abstract {
	protected $_name = 'student';
	public function getStudents() {
		return $this->fetchAll();
	}
}
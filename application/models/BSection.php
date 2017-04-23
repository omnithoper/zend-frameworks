<?php
class  BSection extends BaseModel {
	protected $_name = 'bsection';

		public function getViewBSection() {
		$select = $this->_db->select()
		->from($this->_name)
		;	
		return $this->_db->fetchAll($select);
	}
}	
<?php
class BsectionController extends Zend_Controller_Action  {

	public function indexAction() {

		$blockSection = new BSection();
		$records = $blockSection->getViewBSection();
	
		$this->view->bSection = $records;
	}

}
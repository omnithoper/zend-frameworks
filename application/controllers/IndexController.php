<?php
class IndexController extends Zend_Controller_Action  {
	public function indexAction() {
		$this->view->url = 'https://www.facebook.com/anthony.cabrera.315';
	}
}
<?php
class AdminController extends Zend_Controller_Action  {

	public function indexAction() {

		$admin = new Application_Model_Admin();
		$records = $admin->getViewAdmin();
		$this->view->admin = $records;

	}
	public function detailsAction() {
	
		$adminID = Application_Model_Request::getParam('adminID');



		$admin = new Application_Model_Admin();
		$details = $admin->getAdminDetails($adminID);
		echo Zend_Json::encode($details);
		exit;
	}	
	
	public function addAction() {
		
		if (isset($_POST['save'])){

			$userName = Application_Model_Request::getParam('username');
			$password = Application_Model_Request::getParam('password');
			$admin = new Application_Model_Admin();
			$admin->getAddAdmin($userName, sha1($password));
		}


	}

	public function editAction() {
		$userID = Application_Model_Request::getParam('user_id');
		$userID = (empty($userID) && !empty($_POST['user_id']))?$_POST['user_id']:$userID;
		$admin = new Application_Model_Admin();
		$details = $admin->getAdminDetails($userID);
		$this->view->admin = $details;
	
		$result = [];
		if (isset($_POST['save'])) {
			$userName = Application_Model_Request::getParam('username');
			$password = Application_Model_Request::getParam('password');
			$edit = new Application_Model_Admin();
			$admin->getEditUser($userName, sha1($password), $userID);

		}
	
	}

	public function deleteAction() {
		$userID = Application_Model_Request::getParam('user_id');
		
		$delete = new Application_Model_Admin();
		$delete->getDeleteUser($userID);
	
	}
}
?>
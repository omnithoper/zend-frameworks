<?php
class AdminController extends Zend_Controller_Action  {

	public function indexAction() {

		$admin = new Admin();
		$records = $admin->getViewAdmin();
		$this->view->admin = $records;

	}

	public function detailsAction() {
	
		$adminID = Request::getParam('adminID');
		$admin = new Admin();
		$details = $admin->getAdminDetails($adminID);
		echo Zend_Json::encode($details);
		exit;
	}

	public function addAction() {
		$session = new Session();
		$session->getSession();

		if (isset($_POST['save'])){

			$userName = Request::getParam('username');
			$password = Request::getParam('password');
			$admin = new Admin();
			$admin->getAddAdmin($userName, sha1($password));
		}
	}

	public function editAction() {
		$userID = Request::getParam('user_id');
		$userID = (empty($userID) && !empty($_POST['user_id']))?$_POST['user_id']:$userID;
		$admin = new Admin();
		$details = $admin->getAdminDetails($userID);
		$this->view->admin = $details;
	
		if (isset($_POST['save'])) {
			$userName = Request::getParam('username');
			$password = Request::getParam('password');
			$admin->getEditUser($userName, sha1($password), $userID);
		}
	}

	public function deleteAction() {
		$userID = Request::getParam('user_id');

		$delete = new Admin();
		$delete->getDeleteUser($userID);
	
	}
}
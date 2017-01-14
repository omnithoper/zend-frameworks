<?php
class AdminController extends Zend_Controller_Action  {

	public function indexAction() {

		$admin = new Admin();
		$records = $admin->getViewAdmin();
		$this->view->admin = $records;

	}
	
	public function addAction() {
		
		if (isset($_POST['save'])){

			$userName = Request::getParam('username');
			$password = Request::getParam('password');
			$admin = new Admin();
			$admin->getAddAdmin($userName, sha1($password));
		}


	}

	public function editAction() {
		//$db = new DatabaseConnect();

		$userID = Request::getParam('user_id');
		$userID = (empty($userID) && !empty($_POST['user_id']))?$_POST['user_id']:$userID;

		$result = [];
		if (isset($_POST['save'])) {
			$userName = Request::getParam('username');
			$password = Request::getParam('password');
			$edit = new Admin();
			$edit->getEditUser($userName, sha1($password), $userID);

		}
	
	}

	public function deleteAction() {
		$userID = Request::getParam('user_id');
		
		$delete = new Admin();
		$delete->getDeleteUser($userID);
	
	}
}
?>
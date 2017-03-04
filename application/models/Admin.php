<?php
class Admin extends BaseModel {
	protected $_name = 'admin';

	public function getViewAdmin() {
		$select = $this->_db->select()
		->from($this->_name)
		;
		
		return $this->_db->fetchAll($select);
	}
	public function getAdminDetails($adminID) {
		$select = $this->_db->select()
			->from($this->_name)
			->where('user_id = ?', $adminID);

		return $this->_db->fetchRow($select);
	}

	public function getAddAdmin($userName, $password) {
		$data = array(
		    'username' => $userName,
		    'password' => $password
		);

		$this->_db->insert($this->_name, $data);

		header("Location: /Admin/");
	}

	public function getEditUser($userName, $password, $userID) {
		$data = array(
		    'username' => $userName,
		    'password' => $password
		);

		$this->_db->update($this->_name, $data, "user_id =  '$userID'");

		header("Location: /Admin/");
	}

	public function getDeleteUser($userID) {
		
		$this->_db->delete($this->_name, "user_id =  '$userID'");	
		header("Location: /Admin/");
	}

	public function getAdminUserPassword($userName, $password) {
		if (empty($userName)) {
			return [
			'error' => 'Please input username and password',
			];
		}

		if (empty($password)) {
			return [
			'error' => 'Please input username and password',
			];
		}

		$select = $this->_db->select()
			->from($this->_name, ['user_id'] )
			->where('username = ?' , $userName )
			->where('password = ?' , sha1($password) )
		;

		$result = $this->_db->fetchRow($select);

        $count = count($result);

		if(!empty($result)) {
			$_SESSION['login_user'] = $userName;
			$_SESSION['user_type'] = 'admin';

			return [
				'status' => true,
				'error' => null
			];
		} else {
			return [
				'status' => false,
		  		'error' => 'Your Login Name or Password is invalid'
			];
		}
	}   

	public function userSession() {
		if (session_id() === '') {
			return false;
		}
		return true;
	}
}
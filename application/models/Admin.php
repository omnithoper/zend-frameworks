<?php
class Admin  extends BaseModel {
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
			->where('user_id = ?', $adminID)
		;
	
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

	/*
	public function getUserPassword($userName, $password) {
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

		$sql = "SELECT user_id FROM admin WHERE username = '$userName' and password = sha1('$password')";
      	$result = $this->_db->connection->query($sql);
     	$row = $result->fetch_all(MYSQLI_ASSOC);

      	$count = mysqli_num_rows($result);

		if($count == 1) {
			#$_SESSION['userName'];
			$_SESSION['login_user'] = $userName;

			#session_start();
			#header("location: ../");

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


	public function getViewUser($userID = null) {
		if (empty($userID)) {
			return false;
		}
		$select = "SELECT * FROM admin WHERE user_id = $userID" ;
		$result = $this->_db->connection->query($select);
		$result = $result->fetch_all(MYSQLI_ASSOC);
		return $result;
	}	

	public function getAddAdmin($userName, $password) {
	
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

		if ($this->userExist($userName)) {
		return [
			'error' => 'username Already Exist',	
			];
		}
	
		$prepared = $this->_db->connection->prepare("
			INSERT INTO admin(username, password)
			VALUES (?,?)
		");	

		$prepared->bind_param('ss', $userName, $password);
		$prepared->execute();	

		print $prepared->error;
	
		
		header("Location: /Admin/");			
	}

	public function getEditUser($userName, $password, $userID) {
		if (empty($userName)) {
			return [
				'error' => 'please input subject and unit'
			];
		}
		if (empty($password)) {
			return [
				'error' => 'please input subject and unit'
			];
		}

		if ($this->userExist($userName)) {
			return [
				'error' => 'username Already Exist',	
			];
		}

		$prepared = $this->_db->connection->prepare("UPDATE admin SET username = ?, password = ? WHERE user_id = ? ");
		$prepared->bind_param("ssi", $userName, $password, $userID);
		$prepared->execute();
		$prepared->close();

		header("Location: /Admin/");
	}
	
	public function getDeleteUser($userID) {
		if (empty($userID)){
			return true;
		}

		$query = "DELETE FROM admin WHERE user_id = ".$userID;

		if ($this->_db->connection->query($query) === true)
		{
		}

		header("Location: /Admin/");
	}

	public function userExist($userName) {
		if (empty($userName)) {
			return false;
		}
		
		
		$prepared = $this->_db->connection->prepare("
			SELECT user_id FROM admin WHERE username = ?
		");	
		
		$prepared->bind_param('s', $userName);
		$prepared->execute();	
		$prepared->bind_result($userID);
		$prepared->fetch();
	
		return !empty($userID);
	} 

	public function userSession() {
		if (session_id() === '') {
			return false;
		}
		return true;
	}
	*/
}
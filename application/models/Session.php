<?php
class Session
{  
	public function getSession()
	{
		if(!isset($_SESSION['login_user'])){
			header("location: /");
		}
	}
}
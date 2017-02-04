<?php
die("here");
class GlobalControllerPlugin {
	public function __construct() {
		if (empty($_SESSION['login_user'])) {
			header('Location: /login');
		}
	}
}
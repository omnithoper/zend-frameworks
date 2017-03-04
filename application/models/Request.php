<?php
class Request {
	public static function getParam($name = null) {
		if (empty($name)) {
			return null;
		}

		$result = empty($_POST[$name])?null:$_POST[$name];

		if (empty ($result)) {
			$result = empty($_GET[$name])?null:$_GET[$name];
		} 

		return $result;
	}

	public static function isPost() {
		return ($_SERVER['REQUEST_METHOD'] == 'POST');
	}
}
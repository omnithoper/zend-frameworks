<?php
mysqli_report(MYSQLI_REPORT_ERROR);
class DatabaseConnect {
	public $connection = null;
	
	public function __construct()
	{
		$config = [];
		if (file_exists('/configuration/application.ini')) {
			$config = parse_ini_file('/configuration/application.ini');
		
		} else {
			$config = parse_ini_file(BASE_PATH.'/configuration/application.ini');
		}
		
		$config_extended = [];
		if (file_exists('/configuration/local.ini')) {
			$config_extended = parse_ini_file('/configuration/local.ini');
		} else {
			$config_extended = parse_ini_file(BASE_PATH.'/configuration/local.ini');
		}
		
	
		$config = array_merge($config, $config_extended);
          
		$this->connection = new mysqli($config['host'], $config['username'], $config['password'], $config['database']);
		$this->connection->query('SET sql_mode = ""');
	}
	
	public function addStudentPlusDefaultSubject()
	{
		$this->connection->query('INSERT INTO student SET first_name = '.$first_name.', last_name = '.$last_name.' default_subject_id = 9999');
	}
}
<?php

class DB {
	private static $instance = NULL;
	private function __construct() {}
	private function __clone() {}

	public static function getInstance() {
		//TODO: put these variables in a config file
		$dbname = 'PHP_TEST';
		$servername = 'localhost';
		$username = 'root';
		$password = '';

		if (!isset(self::$instance)) {
			try {
				$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
			 	self::$instance = new PDO('mysql:host='.$servername.';dbname='.$dbname, $username, $password, $pdo_options);
			}
			catch (PDOException $e) {
			    die('Connection Failed: ' . $e);
			}
		}
		return self::$instance;
	}
}

?>
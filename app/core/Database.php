<?php

class Database
{
	private $connection;
	private $host = "127.0.0.1";
	private $database = "genioo_challenge";
	private $password = "genioo_challenge";
	private $username = "genioo_challenge";
	private static $instance;

	public static function getInstance()
	{
		if (!self::$instance) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	private function __construct()
	{
		$this->connection = new mysqli($this->host, $this->username, 
			$this->password, $this->database);
	
		if (mysqli_connect_error()) {
			printf("Connect failed: %s\n", mysqli_connect_error());
			exit();
		}
	}

	public function getConnection() {
		return $this->connection;
	}
}
<?php
namespace app;

use PDO;
use PDOException;

class Database {
	/**
	 * @var PDO $connection
	 */
	private $connection;
	private $params;

	public function __construct($params) {
		$this->params = $params;
		$this->connect();
	}

	private function connect() {
		try {

			$user = $this->params['user'] ?? '';
			$pass = $this->params['pass'] ?? '';
			$host = $this->params['host'] ?? 'localhost';
			$dbname = $this->params['dbname'] ?? '';
			$this->connection = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass, [
				PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
				PDO::MYSQL_ATTR_INIT_COMMAND => 'set names utf8'
			]);
		} catch (PDOException $ex) {
			echo $ex->getMessage();
		}
	}

	public function getConnection(): PDO {
		return $this->connection;
	}
}
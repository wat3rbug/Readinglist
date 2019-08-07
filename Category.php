<?php


class Category {
	
	private $conn;

	function __construct() {
		include_once("DBConnection.php");
		$db = new DBConnection();
		$servername = $db->hostname;
		$username = $db->username;
		$password = $db->password;
		$charset = "utf8mb4";
		$database = $db->database;
		$dsn = "mysql:host=$servername;dbname=$database;charset=$charset";
		$options = [
			PDO::ATTR_ERRMODE				=> PDO::ERRMODE_EXCEPTION,
			PDO::ATTR_DEFAULT_FETCH_MODE	=> PDO::FETCH_ASSOC,
			PDO::ATTR_EMULATE_PREPARES		=> false,
		];
		try {
			$this->conn = new PDO($dsn, $username, $password);
		} catch (\PDOException $e) {
			throw new \PDOException($e->getMessage(), (int)$e->getCode());
		}
	}
	function getAllCategories() {
		$sql = "SELECT * from categories ORDER BY ID ASC";
		$statment = $this->conn->query($sql);
		while($row = $statment->fetch()) {
			$output[] = $row;
		}
		return $output;
	}
	
	function addCategory($category) {
		$statement = $this->conn->prepare("INSERT INTO categories (category) VALUES (?)");
		$statement->bindParam(1, $category);
		$statement->execute();
	}
	
	function removeCategory($category) {
		if (isset($category)) {
			$statement = $this->conn->prepare("DELETE FROM categories where category = ?");
			$statement->bindParam(1, $category);
			$statement->execute();
		}
	}
	
	function removeCategoryById($id) {
		if (isset($id) && $id > 0) {
			$statement = $this->conn->prepare("DELETE FROM categories where id = ?");
			$statement->bindParam(1, $id);
			$statement->execute();
		}
	}
}
?>
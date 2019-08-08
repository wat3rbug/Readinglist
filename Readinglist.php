<?php
class ReadingList
{
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
	
	function addListing($title, $link) {
		$statement = $this->conn->prepare("INSERT INTO readinglist (title, link, category) VALUES (?, ?, 1)");
		$statement->bindParam(1, $title);
		$statement->bindParam(2, $link);
		$statement->execute();
	}
	
	function getIdForLastInsert($title, $link) {
		$id = $this->conn->prepare("SELECT id FROM readinglist where title = :title AND link = :link ORDER BY id DESC LIMIT 1");
		$statement->execute(['title' => $title, 'link' => $link]);
		$data = $statement->fetchAll();
		foreach ($data as $row) {
			echo $row['id'];
		}
	}
	
	function getAllListings() {
		$sql = "SELECT readinglist.id, title, link, categories.category FROM readinglist JOIN categories ON readinglist.category = categories.id  ORDER BY categories.id ASC";
		$statment = $this->conn->query($sql);
		while($row = $statment->fetch()) {
			$output[] = $row;
		}
		return $output;
	}
	
	function removeListing($id) {
		if (isset($id) && $id > 0) {
			$statement = $this->conn->prepare("DELETE FROM readinglist WHERE id = ?");
			$statement->bindParam(1, $id);
			$statement->execute();
		}
	}
	
}
?>
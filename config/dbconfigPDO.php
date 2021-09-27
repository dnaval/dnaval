<?php
/* 
 * Company: DNAVAL
 * Author: Daniel Naval
 * Date: 20210909
 * PDO mysql connect
 */
require_once 'C:\wamp64\config\zen-config.php';
class dbconfigPDO {
	//DB Params
	private $host = DDB_HOST; // Server name
	private $db_name = DDB_APP_DE; // Database name
	private $username = DDB_USR_DE; // Database user name
	private $password = DDB_USR_DE_PWD; // Database user password
	private $conn;

	//DB connect
	public function connect() {
		try
		{
				$this->conn = new PDO('mysql:host='.$this->host.';dbname='.$this->db_name, $this->username, $this->password);
				$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		}
		catch(PDOException $e)
		{
				echo 'Connection Error: ' . $e->getMessage();
		}
		return $this->conn;
    }

}
<?php 
  class Database {
    // DB Params
    private $host = 'db5000191632.hosting-data.io';
    private $db_name = 'dbs186421';
    private $username = 'dbu93916';
    private $password = 'maderaPwd.74123';
    private $conn;

    // DB Connect
    public function connect() {
      $this->conn = null;

      try { 
        $this->conn = new PDO('mysql:host=' . $this->host . ';dbname=' . $this->db_name, $this->username, $this->password);
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      } catch(PDOException $e) {
        echo 'Connection Error: ' . $e->getMessage();
      }

      return $this->conn;
    }
  }
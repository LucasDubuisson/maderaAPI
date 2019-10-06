<?php
class Database{
 
    // specify your own database credentials
    private $host = "db5000155983.hosting-data.io";
    private $db_name = "dbs151070";
    private $username = "dbu156412";
    private $password = "WQCzxP.iVZ8SN3G";
    public $conn;
 
    // get the database connection
    public function getConnection(){
 
        $this->conn = null;
 
        try{
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->exec("set names utf8");
        }catch(PDOException $exception){
            echo "Connection error: " . $exception->getMessage();
        }
 
        return $this->conn;
    }
}
?>
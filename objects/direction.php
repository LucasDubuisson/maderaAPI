<?php
class Direction{
 
    // database connection and table name
    private $conn;
    private $table_name = "direction";
 
    // object properties
    public $idDirection;
    public $libelleDirection;
	
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }
}
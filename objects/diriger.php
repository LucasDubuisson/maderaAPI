<?php 
class Diriger{ 
  
    // database connection and table name 
    private $conn; 
    private $table_name = "Diriger"; 
  
    // object properties 
    public $idDirection; 
    public $idDirectionDiriger; 

	
    // constructor with $db as database connection 
    public function __construct($db){ 
        $this->conn = $db; 
    } 
}
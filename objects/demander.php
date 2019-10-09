<?php 
class Demander{ 
  
    // database connection and table name 
    private $conn; 
    private $table_name = "Demander"; 
  
    // object properties 
    public $idDevis; 
    public $idClient; 

	
    // constructor with $db as database connection 
    public function __construct($db){ 
        $this->conn = $db; 
    } 
}
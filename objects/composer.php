<?php 
class Composer{ 
  
    // database connection and table name 
    private $conn; 
    private $table_name = "Composer"; 
  
    // object properties 
    public $idModule; 
    public $idComposant; 

	
    // constructor with $db as database connection 
    public function __construct($db){ 
        $this->conn = $db; 
    } 
}
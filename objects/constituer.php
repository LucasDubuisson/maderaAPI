<?php 
class Constituer{ 
  
    // database connection and table name 
    private $conn; 
    private $table_name = "Constituer"; 
  
    // object properties 
    public $idMaison; 
    public $idModule; 

	
    // constructor with $db as database connection 
    public function __construct($db){ 
        $this->conn = $db; 
    } 
}
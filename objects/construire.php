<?php 
class Construire{ 
  
    // database connection and table name 
    private $conn; 
    private $table_name = "Construire"; 
  
    // object properties 
    public $idDossier; 
    public $idModule; 

	
    // constructor with $db as database connection 
    public function __construct($db){ 
        $this->conn = $db; 
    } 
}
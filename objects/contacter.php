<?php 
class Contacter{ 
  
    // database connection and table name 
    private $conn; 
    private $table_name = "Contacter"; 
  
    // object properties 
    public $idFournisseur; 
    public $idService; 

	
    // constructor with $db as database connection 
    public function __construct($db){ 
        $this->conn = $db; 
    } 
}
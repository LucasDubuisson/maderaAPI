<?php 
class Relier{ 
  
    // database connection and table name 
    private $conn; 
    private $table_name = "Relier"; 
  
    // object properties 
    public $idSite; 
    public $idFournisseur; 
	
    // constructor with $db as database connection 
    public function __construct($db){ 
        $this->conn = $db; 
    } 
}
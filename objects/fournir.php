<?php 
class Fournir{ 
  
    // database connection and table name 
    private $conn; 
    private $table_name = "Fournir"; 
  
    // object properties 
    public $idComposant; 
    public $idFournisseur; 

	
    // constructor with $db as database connection 
    public function __construct($db){ 
        $this->conn = $db; 
    } 
}
<?php 
class EtreRattacher{ 
  
    // database connection and table name 
    private $conn; 
    private $table_name = "EtreRattacher"; 
  
    // object properties 
    public $idClient; 
    public $idSite; 
	public $idMagasinSite;

	
    // constructor with $db as database connection 
    public function __construct($db){ 
        $this->conn = $db; 
    } 
}
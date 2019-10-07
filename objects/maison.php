<?php 
class Maison{ 
  
    // database connection and table name 
    private $conn; 
    private $table_name = "Maison"; 
  
    // object properties 
    public $idMaison; 
    public $libelleMaison; 
    public $dateCreationMaison; 
	public $createdByUserIdMaison;
	
    // constructor with $db as database connection 
    public function __construct($db){ 
        $this->conn = $db; 
    } 
}
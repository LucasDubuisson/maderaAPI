<?php 
class RegleCalcul{ 
  
    // database connection and table name 
    private $conn; 
    private $table_name = "Regle_Calcul"; 
  
    // object properties 
    public $idRegleCalcul; 
    public $ennonceRegleCalcul; 
    public $regleRegleCalcul;
	
    // constructor with $db as database connection 
    public function __construct($db){ 
        $this->conn = $db; 
    } 
}
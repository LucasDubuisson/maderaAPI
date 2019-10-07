<?php 
class Dossier{ 
  
    // database connection and table name 
    private $conn; 
    private $table_name = "Dossier"; 
  
    // object properties 
    public $idDossier; 
    public $libelleDossier; 
	public $resumeEnML; 
    public $idDevis; 

	
    // constructor with $db as database connection 
    public function __construct($db){ 
        $this->conn = $db; 
    } 
}
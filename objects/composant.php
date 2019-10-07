<?php 
class Composant{ 
  
    // database connection and table name 
    private $conn; 
    private $table_name = "Composant"; 
  
    // object properties 
    public $idComposant; 
    public $libelleComposant;
//caracteristiques	
    public $caracterComposant; 
	public $uniteUsageComposant;
	public $idFamille_Composant;

    // constructor with $db as database connection 
    public function __construct($db){ 
        $this->conn = $db; 
    } 
}
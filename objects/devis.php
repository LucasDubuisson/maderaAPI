<?php 
class Devis{ 
  
    // database connection and table name 
    private $conn; 
    private $table_name = "Devis"; 
  
    // object properties 
    public $idDevis; 
    public $prixDevis; 
    public $etatDevis; 
	public $dateDevis;
	public $dateEvolutionDevis; 
	public $avancementDevisByUserId;
	public $idDossier; 
	public $idMaison;
	
    // constructor with $db as database connection 
    public function __construct($db){ 
        $this->conn = $db; 
    } 
}
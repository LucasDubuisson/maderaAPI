<?php 
class Commande{ 
  
    // database connection and table name 
    private $conn; 
    private $table_name = "commande"; 
  
    // object properties 
    public $idCommande; 
    public $dateCommande; 
    public $dateLivraisonCommande; 
	public $margeCommercialCommande; 
    public $margeEntrepriseCommande; 
    public $statusCommande; 
	public $idDevis;

    // constructor with $db as database connection 
    public function __construct($db){ 
        $this->conn = $db; 
    } 
}
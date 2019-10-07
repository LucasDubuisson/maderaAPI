<?php 
class Fournisseur{ 
  
    // database connection and table name 
    private $conn; 
    private $table_name = "Fournisseur"; 
  
    // object properties 
    public $idFournisseur; 
    public $libelleFournisseur; 
	public $rueFournisseur;
	public $villeFournisseur; 
	public $cpFournisseur;
	public $telFournisseur; 
	public $mailFournisseur; 
	
    // constructor with $db as database connection 
    public function __construct($db){ 
        $this->conn = $db; 
    } 
}
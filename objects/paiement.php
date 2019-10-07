<?php 
class Paiement{ 
  
    // database connection and table name 
    private $conn; 
    private $table_name = "Paiement"; 
  
    // object properties 
    public $idPaiement; 
    public $signaturePaiement; 
    public $permisConstruirePaiement; 
	public $OuvertureChantierPaiement;
	public $achevementFondationPaiement; 
	public $achevementMurPaiement;
	public $misHorsDeauPaiement; 
	public $achevementTravauxPaiement,
	public $remiseClePaiement;
	public $statutPaiement;
	public $dateDernierPaiement;
	public $idCommande;
	
    // constructor with $db as database connection 
    public function __construct($db){ 
        $this->conn = $db; 
    } 
}
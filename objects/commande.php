<?php 
class Commande{ 
  
    // database connection and table name 
    private $conn; 
    private $table_name = "Commande"; 
  
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
	   public function read() {
      // Create query
      $query = 'SELECT
			idCommande, 
			dateCommande,
			dateLivraisonCommande,
			margeCommercialCommande, 
			margeEntrepriseCommande, 
			statusCommande,
			idDevis 
		FROM 
        ' . $this->table_name;

      // Prepare statement
      $stmt = $this->conn->prepare($query);

      // Execute query
      $stmt->execute();

      return $stmt;
    }

  public function read_one(){
    // Create query
    $query = 'SELECT
			dateCommande,
			dateLivraisonCommande,
			margeCommercialCommande, 
			margeEntrepriseCommande, 
			statusCommande,
			idDevis 
        FROM
          ' . $this->table_name . '
		WHERE idCommande = :commandeId ';

      //Prepare statement
      $stmt = $this->conn->prepare($query);

      // Bind ID
      $stmt->bindParam(':commandeId', $this->idCommande);

      // Execute query
      $stmt->execute();

      $row = $stmt->fetch(PDO::FETCH_ASSOC);

      // set properties
      $this->dateCommande = $row['dateCommande'];
      $this->dateLivraisonCommande = $row['dateLivraisonCommande'];
	  $this->margeCommercialCommande = $row['margeCommercialCommande'];
      $this->margeEntrepriseCommande = $row['margeEntrepriseCommande'];
	  $this->statusCommande = $row['statusCommande'];
	  $this->idDevis = $row['idDevis'];
  }

  // Create Category
  public function create() {
    // Create Query
    $query = 'INSERT INTO ' .
      $this->table_name . '
    SET
      dateCommande = :commandeDate,
	  dateLivraisonCommande= :commandeDateLivraison,
	  margeCommercialCommande= :commandeMargeCommercial,
	  margeEntrepriseCommande= :commandeMargeEntreprise,
	  statusCommande= :commandeStatus,
	  idDevis= :devisId';

  // Prepare Statement
  $stmt = $this->conn->prepare($query);

  // Clean data
  $this->dateCommande = htmlspecialchars(strip_tags($this->dateCommande));
  $this->dateLivraisonCommande = htmlspecialchars(strip_tags($this->dateLivraisonCommande));
  $this->margeCommercialCommande = htmlspecialchars(strip_tags($this->margeCommercialCommande));
  $this->margeEntrepriseCommande = htmlspecialchars(strip_tags($this->margeEntrepriseCommande));
  $this->statusCommande = htmlspecialchars(strip_tags($this->statusCommande));
  $this->idDevis = htmlspecialchars(strip_tags($this->idDevis));
  
  // Bind data
  $stmt-> bindParam(':commandeDate', $this->dateCommande);
  $stmt-> bindParam(':commandeDateLivraison', $this->dateLivraisonCommande);
  $stmt-> bindParam(':commandeMargeCommercial', $this->margeCommercialCommande);
  $stmt-> bindParam(':commandeMargeEntreprise', $this->margeEntrepriseCommande);
  $stmt-> bindParam(':commandeStatus', $this->statusCommande);
  $stmt-> bindParam(':devisId', $this->idDevis);
  
  // Execute query
  if($stmt->execute()) {
    return true;
  }

  // Print error if something goes wrong
  printf("Error: $s.\n", $stmt->error);

  return false;
  }

  // Update Category
  public function update() {
    // Create Query
    $query = 'UPDATE ' .
      $this->table_name . '
    SET
      dateCommande = :commandeDate,
	  dateLivraisonCommande= :commandeDateLivraison,
	  margeCommercialCommande= :commandeMargeCommercial,
	  margeEntrepriseCommande= :commandeMargeEntreprise,
	  statusCommande= :commandeStatus,
	  idDevis= :devisId
    WHERE idCommande = :commandeId';

  // Prepare Statement
  $stmt = $this->conn->prepare($query);

  // Clean data
  $this->dateCommande = htmlspecialchars(strip_tags($this->dateCommande));
  $this->dateLivraisonCommande = htmlspecialchars(strip_tags($this->dateLivraisonCommande));
  $this->margeCommercialCommande = htmlspecialchars(strip_tags($this->margeCommercialCommande));
  $this->margeEntrepriseCommande = htmlspecialchars(strip_tags($this->margeEntrepriseCommande));
  $this->statusCommande = htmlspecialchars(strip_tags($this->statusCommande));
  $this->idDevis = htmlspecialchars(strip_tags($this->idDevis));
  $this->idCommande = htmlspecialchars(strip_tags($this->idCommande));
  
  // Bind data
  $stmt-> bindParam(':commandeDate', $this->dateCommande);
  $stmt-> bindParam(':commandeDateLivraison', $this->dateLivraisonCommande);
  $stmt-> bindParam(':commandeMargeCommercial', $this->margeCommercialCommande);
  $stmt-> bindParam(':commandeMargeEntreprise', $this->margeEntrepriseCommande);
  $stmt-> bindParam(':commandeStatus', $this->statusCommande);
  $stmt-> bindParam(':devisId', $this->idDevis);
  $stmt-> bindParam(':commandeId', $this->idCommande);
  
  // Execute query
  if($stmt->execute()) {
    return true;
  }

  // Print error if something goes wrong
  printf("Error: $s.\n", $stmt->error);

  return false;
  }

	// Delete 
	public function delete() {
		// Create query
		$query = 'DELETE FROM ' . $this->table_name . ' WHERE idCommande = :commandeId';

		// Prepare Statement
		$stmt = $this->conn->prepare($query);

		// clean data
		$this->idCommande = htmlspecialchars(strip_tags($this->idCommande));

		// Bind Data
		$stmt-> bindParam(':commandeId', $this->idCommande);

		// Execute query
		if($stmt->execute()) {
		  return true;
		}

		// Print error if something goes wrong
		printf("Error: $s.\n", $stmt->error);

		return false;
    }
}
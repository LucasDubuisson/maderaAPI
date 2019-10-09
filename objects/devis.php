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
	
	public function read() {
      // Create query
      $query = 'SELECT
			idDevis, 
			prixDevis, 
			etatDevis, 
			dateDevis,
			dateEvolutionDevis, 
			avancementDevisByUserId,
			idDossier, 
			idMaison
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
			idDevis, 
			prixDevis, 
			etatDevis, 
			dateDevis,
			dateEvolutionDevis, 
			avancementDevisByUserId,
			idDossier, 
			idMaison
        FROM
          ' . $this->table_name . '
      WHERE idDevis = :devisId ';

      //Prepare statement
      $stmt = $this->conn->prepare($query);

      // Bind ID
      $stmt->bindParam(':devisId', $this->idDevis);

      // Execute query
      $stmt->execute();

      $row = $stmt->fetch(PDO::FETCH_ASSOC);

      // set properties
      $this->idDevis = $row['idDevis'];
      $this->prixDevis = $row['prixDevis'];
	  $this->etatDevis = $row['etatDevis'];
      $this->dateDevis = $row['dateDevis'];
	  $this->dateEvolutionDevis = $row['dateEvolutionDevis'];
	  $this->avancementDevisByUserId = $row['avancementDevisByUserId'];
      $this->idDossier = $row['idDossier'];
	  $this->idMaison = $row['idMaison'];
  }

  // Create Category
  public function create() {
    // Create Query
    $query = 'INSERT INTO ' .
      $this->table_name . '
    SET
		prixDevis=:devisPrix, 
		etatDevis=:devisEtat, 
		dateDevis=:devisDate,
		dateEvolutionDevis=:devisDateEvolution, 
		avancementDevisByUserId=:devisAvancementByUserId,
		idDossier=:dossierId, 
		idMaison=:maisonId';

  // Prepare Statement
  $stmt = $this->conn->prepare($query);

  // Clean data
  $this->prixDevis = htmlspecialchars(strip_tags($this->prixDevis));
  $this->etatDevis = htmlspecialchars(strip_tags($this->etatDevis));
  $this->dateDevis = htmlspecialchars(strip_tags($this->dateDevis));
  $this->dateEvolutionDevis = htmlspecialchars(strip_tags($this->dateEvolutionDevis));
  $this->avancementDevisByUserId = htmlspecialchars(strip_tags($this->avancementDevisByUserId));
  $this->idDossier = htmlspecialchars(strip_tags($this->idDossier));
  $this->idMaison = htmlspecialchars(strip_tags($this->idMaison));
  
  // Bind data
  $stmt-> bindParam(':devisPrix', $this->prixDevis);
  $stmt-> bindParam(':devisEtat', $this->etatDevis);
  $stmt-> bindParam(':devisDate', $this->dateDevis);
  $stmt-> bindParam(':devisDateEvolution', $this->dateEvolutionDevis);
  $stmt-> bindParam(':devisAvancementByUserId', $this->avancementDevisByUserId);
  $stmt-> bindParam(':dossierId', $this->idDossier);
  $stmt-> bindParam(':maisonId', $this->idMaison);
  
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
      prixDevis=:devisPrix, 
		etatDevis=:devisEtat, 
		dateDevis=:devisDate,
		dateEvolutionDevis=:devisDateEvolution, 
		avancementDevisByUserId=:devisAvancementByUserId,
		idDossier=:dossierId, 
		idMaison=:maisonId
      WHERE idDevis = :devisId';

  // Prepare Statement
  $stmt = $this->conn->prepare($query);

   // Clean data
  $this->prixDevis = htmlspecialchars(strip_tags($this->prixDevis));
  $this->etatDevis = htmlspecialchars(strip_tags($this->etatDevis));
  $this->dateDevis = htmlspecialchars(strip_tags($this->dateDevis));
  $this->dateEvolutionDevis = htmlspecialchars(strip_tags($this->dateEvolutionDevis));
  $this->avancementDevisByUserId = htmlspecialchars(strip_tags($this->avancementDevisByUserId));
  $this->idDossier = htmlspecialchars(strip_tags($this->idDossier));
  $this->idMaison = htmlspecialchars(strip_tags($this->idMaison));
  $this->idDevis = htmlspecialchars(strip_tags($this->idDevis));
  
  // Bind data
  $stmt-> bindParam(':devisPrix', $this->prixDevis);
  $stmt-> bindParam(':devisEtat', $this->etatDevis);
  $stmt-> bindParam(':devisDate', $this->dateDevis);
  $stmt-> bindParam(':devisDateEvolution', $this->dateEvolutionDevis);
  $stmt-> bindParam(':devisAvancementByUserId', $this->avancementDevisByUserId);
  $stmt-> bindParam(':dossierId', $this->idDossier);
  $stmt-> bindParam(':maisonId', $this->idMaison);
  $stmt-> bindParam(':devisId', $this->idDevis);
  
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
    $query = 'DELETE FROM ' . $this->table_name . ' WHERE idDevis = :devisId';

    // Prepare Statement
    $stmt = $this->conn->prepare($query);

    // clean data
    $this->idDevis = htmlspecialchars(strip_tags($this->idDevis));

    // Bind Data
    $stmt-> bindParam(':devisId', $this->idDevis);

    // Execute query
    if($stmt->execute()) {
      return true;
    }

    // Print error if something goes wrong
    printf("Error: $s.\n", $stmt->error);

    return false;
    }
}
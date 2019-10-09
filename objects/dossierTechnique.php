<?php 
class Dossier{ 
  
    // database connection and table name 
    private $conn; 
    private $table_name = "DossierTechnique"; 
  
    // object properties 
    public $idDossier; 
    public $libelleDossier; 
	public $resumeEnML; 
    public $idDevis; 

	
    // constructor with $db as database connection 
    public function __construct($db){ 
        $this->conn = $db; 
    } 
	
	
    public function read() {
      // Create query
      $query = 'SELECT
			idDossier, 
			libelleDossier,
			resumeEnML, 
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
			idDossier, 
			libelleDossier,
			resumeEnML, 
			idDevis 
        FROM
          ' . $this->table_name . '
      WHERE idDossier = :dossierId ';

      //Prepare statement
      $stmt = $this->conn->prepare($query);

      // Bind ID
      $stmt->bindParam(':dossierId', $this->idDossier);

      // Execute query
      $stmt->execute();

      $row = $stmt->fetch(PDO::FETCH_ASSOC);

      // set properties
      $this->idDossier = $row['idDossier'];
      $this->libelleDossier = $row['libelleDossier'];
	  $this->resumeEnML = $row['resumeEnML'];
      $this->idDevis = $row['idDevis'];
  }

  // Create Category
  public function create() {
    // Create Query
    $query = 'INSERT INTO ' .
      $this->table_name . '
    SET
      libelleDossier = :dossierLibelle,
	  resumeEnML= :dossierResumeEnML,
	  idDevis= :devisId';

  // Prepare Statement
  $stmt = $this->conn->prepare($query);

  // Clean data
  $this->libelleDossier = htmlspecialchars(strip_tags($this->libelleDossier));
  $this->resumeEnML = htmlspecialchars(strip_tags($this->resumeEnML));
  $this->idDevis = htmlspecialchars(strip_tags($this->idDevis));
  
  // Bind data
  $stmt-> bindParam(':dossierLibelle', $this->libelleDossier);
  $stmt-> bindParam(':dossierResumeEnML', $this->resumeEnML);
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
      libelleDossier = :dossierLibelle,
	  resumeEnML= :dossierResumeEnML,
	  idDevis= :devisId
      WHERE idDossier = :dossierId';

  // Prepare Statement
  $stmt = $this->conn->prepare($query);

  // Clean data
  $this->libelleDossier = htmlspecialchars(strip_tags($this->libelleDossier));
  $this->resumeEnML = htmlspecialchars(strip_tags($this->resumeEnML));
  $this->idDevis = htmlspecialchars(strip_tags($this->idDevis));
  $this->idDossier = htmlspecialchars(strip_tags($this->idDossier));

  // Bind data
  $stmt-> bindParam(':dossierLibelle', $this->libelleDossier);
  $stmt-> bindParam(':dossierResumeEnML', $this->resumeEnML);
  $stmt-> bindParam(':devisId', $this->idDevis);
  $stmt-> bindParam(':dossierId', $this->idDossier);
  
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
    $query = 'DELETE FROM ' . $this->table_name . ' WHERE idDossier = :dossierId';

    // Prepare Statement
    $stmt = $this->conn->prepare($query);

    // clean data
    $this->idDossier = htmlspecialchars(strip_tags($this->idDossier));

    // Bind Data
    $stmt-> bindParam(':dossierId', $this->idDossier);

    // Execute query
    if($stmt->execute()) {
      return true;
    }

    // Print error if something goes wrong
    printf("Error: $s.\n", $stmt->error);

    return false;
    }
}
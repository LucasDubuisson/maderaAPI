<?php
class Client{
 
    // database connection and table name
    private $conn;
    private $table_name = "Client";
 
    // object properties
    public $idClient;
    public $nomClient;
    public $prenomClient;
    public $societeClient;
    public $villeClient;
	public $rueClient;
	public $cpClient;
	public $telClient;
    public $mailClient;
	
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }
	   public function read() {
      // Create query
      $query = 'SELECT
					idClient,
					nomClient,
					prenomClient,
					societeClient,
					villeClient,
					rueClient,
					cpClient,
					telClient,
					mailClient
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
				idClient,
				nomClient,
				prenomClient,
				societeClient,
				villeClient,
				rueClient,
				cpClient,
				telClient,
				mailClient
        FROM
          ' . $this->table_name . '
      WHERE idClient = :clientId ';

      //Prepare statement
      $stmt = $this->conn->prepare($query);

      // Bind ID
      $stmt->bindParam(':clientId', $this->idClient);

      // Execute query
      $stmt->execute();

      $row = $stmt->fetch(PDO::FETCH_ASSOC);

      // set properties
      //$this->idService = $row['idService'];
      $this->nomClient = $row['nomClient'];
	  $this->prenomClient = $row['prenomClient'];
      $this->societeClient = $row['societeClient'];
	  $this->villeClient = $row['villeClient'];
	  $this->rueClient = $row['rueClient'];
      $this->cpClient = $row['cpClient'];
	  $this->telClient = $row['telClient'];
      $this->mailClient = $row['mailClient'];
  }

  // Create Category
  public function create() {
    // Create Query
    $query = 'INSERT INTO ' .
      $this->table_name . '
    SET
		nomClient= :clientNom,
		prenomClient= :clientPrenom,
		societeClient= :clientSociete,
		villeClient= :clientVille,
		rueClient= :clientRue,
		cpClient= :clientCP,
		telClient= :clientTel,
		mailClient= :clientMail';

  // Prepare Statement
  $stmt = $this->conn->prepare($query);

  // Clean data
  $this->nomClient = htmlspecialchars(strip_tags($this->nomClient));
  $this->prenomClient = htmlspecialchars(strip_tags($this->prenomClient));
  $this->societeClient = htmlspecialchars(strip_tags($this->societeClient));
  $this->villeClient = htmlspecialchars(strip_tags($this->villeClient));
  $this->rueClient = htmlspecialchars(strip_tags($this->rueClient));
  $this->cpClient = htmlspecialchars(strip_tags($this->cpClient));
  $this->telClient = htmlspecialchars(strip_tags($this->telClient));
  $this->mailClient = htmlspecialchars(strip_tags($this->mailClient));
  
  // Bind data
  $stmt-> bindParam(':clientNom', $this->nomClient);
  $stmt-> bindParam(':clientPrenom', $this->prenomClient);
  $stmt-> bindParam(':clientSociete', $this->societeClient);
  $stmt-> bindParam(':clientVille', $this->villeClient);
  $stmt-> bindParam(':clientRue', $this->rueClient);
  $stmt-> bindParam(':clientCP', $this->cpClient);
  $stmt-> bindParam(':clientTel', $this->telClient);
  $stmt-> bindParam(':clientMail', $this->mailClient);
  
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
		nomClient= :clientNom,
		prenomClient= :clientPrenom,
		societeClient= :clientSociete,
		villeClient= :clientVille,
		rueClient= :clientRue,
		cpClient= :clientCP,
		telClient= :clientTel,
		mailClient= :clientMail
      WHERE idClient = :clientId';

  // Prepare Statement
  $stmt = $this->conn->prepare($query);

   // Clean data
  $this->nomClient = htmlspecialchars(strip_tags($this->nomClient));
  $this->prenomClient = htmlspecialchars(strip_tags($this->prenomClient));
  $this->societeClient = htmlspecialchars(strip_tags($this->societeClient));
  $this->villeClient = htmlspecialchars(strip_tags($this->villeClient));
  $this->rueClient = htmlspecialchars(strip_tags($this->rueClient));
  $this->cpClient = htmlspecialchars(strip_tags($this->cpClient));
  $this->telClient = htmlspecialchars(strip_tags($this->telClient));
  $this->mailClient = htmlspecialchars(strip_tags($this->mailClient));
  $this->idClient = htmlspecialchars(strip_tags($this->idClient));
  
  // Bind data
  $stmt-> bindParam(':clientNom', $this->nomClient);
  $stmt-> bindParam(':clientPrenom', $this->prenomClient);
  $stmt-> bindParam(':clientSociete', $this->societeClient);
  $stmt-> bindParam(':clientVille', $this->villeClient);
  $stmt-> bindParam(':clientRue', $this->rueClient);
  $stmt-> bindParam(':clientCP', $this->cpClient);
  $stmt-> bindParam(':clientTel', $this->telClient);
  $stmt-> bindParam(':clientMail', $this->mailClient);
  $stmt-> bindParam(':clientId', $this->idClient);
  
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
    $query = 'DELETE FROM ' . $this->table_name . ' WHERE idClient = :clientId';

    // Prepare Statement
    $stmt = $this->conn->prepare($query);

    // clean data
    $this->idClient = htmlspecialchars(strip_tags($this->idClient));

    // Bind Data
    $stmt-> bindParam(':clientId', $this->idClient);

    // Execute query
    if($stmt->execute()) {
      return true;
    }

    // Print error if something goes wrong
    printf("Error: $s.\n", $stmt->error);

    return false;
    }
}
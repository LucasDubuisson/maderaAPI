<?php 
class Maison{ 
  
    // database connection and table name 
    private $conn; 
    private $table_name = "Maison"; 
  
    // object properties 
    public $idMaison; 
    public $libelleMaison; 
    public $dateCreationMaison; 
	public $createdByUserIdMaison;
	
    // constructor with $db as database connection 
    public function __construct($db){ 
        $this->conn = $db; 
    } 
	    public function read() {
      // Create query
      $query = 'SELECT
			idMaison,
			libelleMaison,
			dateCreationMaison,
			createdByUserIdMaison
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
			idMaison,
			libelleMaison,
			dateCreationMaison,
			createdByUserIdMaison
        FROM
          ' . $this->table_name . '
      WHERE idMaison = :maisonId ';

      //Prepare statement
      $stmt = $this->conn->prepare($query);

      // Bind ID
      $stmt->bindParam(':maisonId', $this->idMaison);

      // Execute query
      $stmt->execute();

      $row = $stmt->fetch(PDO::FETCH_ASSOC);

      // set properties
      $this->idMaison = $row['idMaison'];
      $this->libelleMaison = $row['libelleMaison'];
	  $this->dateCreationMaison = $row['dateCreationMaison'];
      $this->createdByUserIdMaison = $row['createdByUserIdMaison'];
  }

  // Create Category
  public function create() {
    // Create Query
    $query = 'INSERT INTO ' .
      $this->table_name . '
    SET
      libelleMaison = :maisonLibelle,
	  dateCreationMaison= :maisonDateCreation,
	  createdByUserIdMaison= :maisonCreatedByUserId';

  // Prepare Statement
  $stmt = $this->conn->prepare($query);

  // Clean data
  $this->libelleMaison = htmlspecialchars(strip_tags($this->libelleMaison));
  $this->dateCreationMaison = htmlspecialchars(strip_tags($this->dateCreationMaison));
  $this->createdByUserIdMaison = htmlspecialchars(strip_tags($this->createdByUserIdMaison));
  
  // Bind data
  $stmt-> bindParam(':maisonLibelle', $this->libelleMaison);
  $stmt-> bindParam(':maisonDateCreation', $this->dateCreationMaison);
  $stmt-> bindParam(':maisonCreatedByUserId', $this->createdByUserIdMaison);
  
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
      libelleMaison = :maisonLibelle,
	  dateCreationMaison= :maisonDateCreation,
	  createdByUserIdMaison= :maisonCreatedByUserId
      WHERE idMaison = :maisonId';

  // Prepare Statement
  $stmt = $this->conn->prepare($query);

    // Clean data
  $this->libelleMaison = htmlspecialchars(strip_tags($this->libelleMaison));
  $this->dateCreationMaison = htmlspecialchars(strip_tags($this->dateCreationMaison));
  $this->createdByUserIdMaison = htmlspecialchars(strip_tags($this->createdByUserIdMaison));
  $this->idMaison = htmlspecialchars(strip_tags($this->idMaison));
  
  // Bind data
  $stmt-> bindParam(':maisonLibelle', $this->libelleMaison);
  $stmt-> bindParam(':maisonDateCreation', $this->dateCreationMaison);
  $stmt-> bindParam(':maisonCreatedByUserId', $this->createdByUserIdMaison);
  $stmt-> bindParam(':maisonId', $this->idMaison);
  
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
    $query = 'DELETE FROM ' . $this->table_name . ' WHERE idMaison = :maisonId';

    // Prepare Statement
    $stmt = $this->conn->prepare($query);

    // clean data
    $this->idMaison = htmlspecialchars(strip_tags($this->idMaison));

    // Bind Data
    $stmt-> bindParam(':maisonId', $this->idMaison);

    // Execute query
    if($stmt->execute()) {
      return true;
    }

    // Print error if something goes wrong
    printf("Error: $s.\n", $stmt->error);

    return false;
    }
}
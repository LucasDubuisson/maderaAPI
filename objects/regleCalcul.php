<?php 
class RegleCalcul{ 
  
    // database connection and table name 
    private $conn; 
    private $table_name = "RegleCalcul"; 
  
    // object properties 
    public $idRegleCalcul; 
    public $ennonceRegleCalcul; 
    public $regleRegleCalcul;
	
    // constructor with $db as database connection 
    public function __construct($db){ 
        $this->conn = $db; 
    } 
	
    public function read() {
      // Create query
      $query = 'SELECT
			idRegleCalcul,
			ennonceRegleCalcul, 
			regleRegleCalcul
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
			idRegleCalcul,
			ennonceRegleCalcul, 
			regleRegleCalcul
        FROM
          ' . $this->table_name . '
      WHERE idRegleCalcul = :RegleCalculId ';

      //Prepare statement
      $stmt = $this->conn->prepare($query);

      // Bind ID
      $stmt->bindParam(':RegleCalculId', $this->idRegleCalcul);

      // Execute query
      $stmt->execute();

      $row = $stmt->fetch(PDO::FETCH_ASSOC);

      // set properties
      $this->idRegleCalcul = $row['idRegleCalcul'];
      $this->ennonceRegleCalcul = $row['ennonceRegleCalcul'];
	  $this->regleRegleCalcul = $row['regleRegleCalcul'];
  }

  // Create Category
  public function create() {
    // Create Query
    $query = 'INSERT INTO ' .
      $this->table_name . '
    SET
		ennonceRegleCalcul = :RegleCalculEnnonce, 
		regleRegleCalcul = :RegleCalculRegle';

  // Prepare Statement
  $stmt = $this->conn->prepare($query);

  // Clean data
  $this->ennonceRegleCalcul = htmlspecialchars(strip_tags($this->ennonceRegleCalcul));
  $this->regleRegleCalcul = htmlspecialchars(strip_tags($this->regleRegleCalcul));
  
  // Bind data
  $stmt-> bindParam(':RegleCalculEnnonce', $this->ennonceRegleCalcul);
  $stmt-> bindParam(':RegleCalculRegle', $this->regleRegleCalcul);
  
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
      ennonceRegleCalcul = :RegleCalculEnnonce, 
	  regleRegleCalcul = :RegleCalculRegle
    WHERE idRegleCalcul = :RegleCalculId';

  // Prepare Statement
  $stmt = $this->conn->prepare($query);

  // Clean data
  $this->ennonceRegleCalcul = htmlspecialchars(strip_tags($this->ennonceRegleCalcul));
  $this->regleRegleCalcul = htmlspecialchars(strip_tags($this->regleRegleCalcul));
  $this->idRegleCalcul = htmlspecialchars(strip_tags($this->idRegleCalcul));

  // Bind data
  $stmt-> bindParam(':RegleCalculEnnonce', $this->ennonceRegleCalcul);
  $stmt-> bindParam(':RegleCalculRegle', $this->regleRegleCalcul);
  $stmt-> bindParam(':RegleCalculId', $this->idRegleCalcul);
  
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
    $query = 'DELETE FROM ' . $this->table_name . ' WHERE idRegleCalcul = :RegleCalculId';

    // Prepare Statement
    $stmt = $this->conn->prepare($query);

    // clean data
    $this->idRegleCalcul = htmlspecialchars(strip_tags($this->idRegleCalcul));

    // Bind Data
    $stmt-> bindParam(':RegleCalculId', $this->idRegleCalcul);

    // Execute query
    if($stmt->execute()) {
      return true;
    }

    // Print error if something goes wrong
    printf("Error: $s.\n", $stmt->error);

    return false;
    }
}
<?php
class Direction{
 
    // database connection and table name
    private $conn;
    private $table_name = "direction";
 
    // object properties
    public $idDirection;
    public $libelleDirection;
	
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }
		
    public function read() {
      // Create query
      $query = 'SELECT
			idDirection,
			libelleDirection
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
			idDirection,
			libelleDirection
        FROM
          ' . $this->table_name . '
      WHERE idDirection = :directionId ';

      //Prepare statement
      $stmt = $this->conn->prepare($query);

      // Bind ID
      $stmt->bindParam(':directionId', $this->idDirection);

      // Execute query
      $stmt->execute();

      $row = $stmt->fetch(PDO::FETCH_ASSOC);

      // set properties
      //$this->idService = $row['idService'];
      $this->libelleDirection = $row['libelleDirection'];
	  
  }

  // Create Category
  public function create() {
    // Create Query
    $query = 'INSERT INTO ' .
      $this->table_name . '
    SET
	  libelleDirection= :directionLibelle';

  // Prepare Statement
  $stmt = $this->conn->prepare($query);

  // Clean data
  $this->libelleDirection = htmlspecialchars(strip_tags($this->libelleDirection));
  
  // Bind data
  $stmt-> bindParam(':directionLibelle', $this->libelleDirection);
  
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
      libelleDirection = :directionLibelle
      WHERE idDirection = :directionId ';

  // Prepare Statement
  $stmt = $this->conn->prepare($query);

  // Clean data
  $this->libelleDirection = htmlspecialchars(strip_tags($this->libelleDirection));
  $this->idDirection = htmlspecialchars(strip_tags($this->idDirection));

  // Bind data
  $stmt-> bindParam(':directionLibelle', $this->libelleDirection);
  $stmt-> bindParam(':directionId', $this->idDirection);
  
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
    $query = 'DELETE FROM ' . $this->table_name . ' WHERE idDirection = :directionId';

    // Prepare Statement
    $stmt = $this->conn->prepare($query);

    // clean data
    $this->idDirection = htmlspecialchars(strip_tags($this->idDirection));

    // Bind Data
    $stmt-> bindParam(':directionId', $this->idDirection);

    // Execute query
    if($stmt->execute()) {
      return true;
    }

    // Print error if something goes wrong
    printf("Error: $s.\n", $stmt->error);

    return false;
    }
}
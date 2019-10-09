<?php 
class FamilleComposant{ 
  
    // database connection and table name 
    private $conn; 
    private $table_name = "FamilleComposant"; 
  
    // object properties 
    public $idFamilleComposant; 
    public $libelleFamilleComposant;

	
    // constructor with $db as database connection 
    public function __construct($db){ 
        $this->conn = $db; 
    } 
		
    public function read() {
      // Create query
      $query = 'SELECT
			idFamilleComposant,
			libelleFamilleComposant
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
			idFamilleComposant,
			libelleFamilleComposant
        FROM
          ' . $this->table_name . '
      WHERE idFamilleComposant = :familleComposantId ';

      //Prepare statement
      $stmt = $this->conn->prepare($query);

      // Bind ID
      $stmt->bindParam(':familleComposantId', $this->idFamilleComposant);

      // Execute query
      $stmt->execute();

      $row = $stmt->fetch(PDO::FETCH_ASSOC);

      // set properties
      $this->idFamilleComposant = $row['idFamilleComposant'];
      $this->libelleFamilleComposant = $row['libelleFamilleComposant'];
  }

  // Create Category
  public function create() {
    // Create Query
    $query = 'INSERT INTO ' .
      $this->table_name . '
    SET
      libelleFamilleComposant = :familleComposantLibelle';

  // Prepare Statement
  $stmt = $this->conn->prepare($query);

  // Clean data
  $this->libelleFamilleComposant = htmlspecialchars(strip_tags($this->libelleFamilleComposant));
  
  // Bind data
  $stmt-> bindParam(':familleComposantLibelle', $this->libelleFamilleComposant);
  
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
      libelleFamilleComposant = :familleComposantLibelle
      WHERE idFamilleComposant = :familleComposantId';

  // Prepare Statement
  $stmt = $this->conn->prepare($query);

  // Clean data
  $this->libelleFamilleComposant = htmlspecialchars(strip_tags($this->libelleFamilleComposant));
  $this->idFamilleComposant = htmlspecialchars(strip_tags($this->idFamilleComposant));

  // Bind data
  $stmt-> bindParam(':familleComposantLibelle', $this->libelleFamilleComposant);
    $stmt-> bindParam(':familleComposantId', $this->idFamilleComposant);
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
    $query = 'DELETE FROM ' . $this->table_name . ' WHERE idFamilleComposant = :familleComposantId';

    // Prepare Statement
    $stmt = $this->conn->prepare($query);

    // clean data
    $this->idFamilleComposant = htmlspecialchars(strip_tags($this->idFamilleComposant));

    // Bind Data
    $stmt-> bindParam(':familleComposantId', $this->idFamilleComposant);

    // Execute query
    if($stmt->execute()) {
      return true;
    }

    // Print error if something goes wrong
    printf("Error: $s.\n", $stmt->error);

    return false;
    }
}
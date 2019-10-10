<?php 
class Composant{ 
  
    // database connection and table name 
    private $conn; 
    private $table_name = "Composant"; 
  
    // object properties 
    public $idComposant; 
    public $libelleComposant;
	//caracteristiques	
    public $caracterComposant; 
	public $uniteUsageComposant;
	public $idFamilleComposant;

    // constructor with $db as database connection 
    public function __construct($db){ 
        $this->conn = $db; 
    } 
		
    public function read() {
      // Create query
      $query = 'SELECT
			idComposant,
			libelleComposant,
			caracterComposant, 
			uniteUsageComposant,
			idFamilleComposant 
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
    		idComposant,
			libelleComposant,
			caracterComposant, 
			uniteUsageComposant,
			idFamilleComposant 
        FROM
          ' . $this->table_name . '
      WHERE idComposant = :composantId';

      //Prepare statement
      $stmt = $this->conn->prepare($query);

      // Bind ID
      $stmt->bindParam(':composantId', $this->idComposant);

      // Execute query
      $stmt->execute();

      $row = $stmt->fetch(PDO::FETCH_ASSOC);

      // set properties
      $this->idComposant = $row['idComposant'];
      $this->libelleComposant = $row['libelleComposant'];
	  $this->caracterComposant = $row['caracterComposant'];
      $this->uniteUsageComposant = $row['uniteUsageComposant'];
	  $this->idFamilleComposant = $row['idFamilleComposant'];
  }

  // Create Category
  public function create() {
    // Create Query
    $query = 'INSERT INTO ' .
      $this->table_name . '
    SET
		libelleComposant= :composantLibelle,
		caracterComposant= :composantCaracter, 
		uniteUsageComposant= :composantUniteUsage,
		idFamilleComposant= :composantFamilleId';

  // Prepare Statement
  $stmt = $this->conn->prepare($query);

  // Clean data
  $this->libelleComposant = htmlspecialchars(strip_tags($this->libelleComposant));
  $this->caracterComposant = htmlspecialchars(strip_tags($this->caracterComposant));
  $this->uniteUsageComposant = htmlspecialchars(strip_tags($this->uniteUsageComposant));
  $this->idFamilleComposant = htmlspecialchars(strip_tags($this->idFamilleComposant));
  
  // Bind data
  $stmt-> bindParam(':composantLibelle', $this->libelleComposant);
  $stmt-> bindParam(':composantCaracter', $this->caracterComposant);
  $stmt-> bindParam(':composantUniteUsage', $this->uniteUsageComposant);
  $stmt-> bindParam(':composantFamilleId', $this->idFamilleComposant);
  
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
		libelleComposant= :composantLibelle,
		caracterComposant= :composantCaracter, 
		uniteUsageComposant= :composantUniteUsage,
		idFamilleComposant= :composantFamilleId
    WHERE idComposant = :composantId';

  // Prepare Statement
  $stmt = $this->conn->prepare($query);

  // Clean data
  $this->libelleComposant = htmlspecialchars(strip_tags($this->libelleComposant));
  $this->caracterComposant = htmlspecialchars(strip_tags($this->caracterComposant));
  $this->uniteUsageComposant = htmlspecialchars(strip_tags($this->uniteUsageComposant));
  $this->idFamilleComposant = htmlspecialchars(strip_tags($this->idFamilleComposant));
  $this->idComposant = htmlspecialchars(strip_tags($this->idComposant));
  
  // Bind data
  $stmt-> bindParam(':composantLibelle', $this->libelleComposant);
  $stmt-> bindParam(':composantCaracter', $this->caracterComposant);
  $stmt-> bindParam(':composantUniteUsage', $this->uniteUsageComposant);
  $stmt-> bindParam(':composantFamilleId', $this->idFamilleComposant);
  $stmt-> bindParam(':composantId', $this->idComposant);
  
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
    $query = 'DELETE FROM ' . $this->table_name . ' WHERE idComposant = :composantId';

    // Prepare Statement
    $stmt = $this->conn->prepare($query);

    // clean data
    $this->idComposant = htmlspecialchars(strip_tags($this->idComposant));

    // Bind Data
    $stmt-> bindParam(':composantId', $this->idComposant);

    // Execute query
    if($stmt->execute()) {
      return true;
    }

    // Print error if something goes wrong
    printf("Error: $s.\n", $stmt->error);

    return false;
   }
	
}
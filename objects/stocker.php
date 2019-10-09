<?php
class Stocker{
 
    // database connection and table name
    private $conn;
    private $table_name = "Stocker";
 
    // object properties
    public $idSite;
    public $idProductionSite;
    public $idComposant;
	public $quantite;
	public $lastUpdateUserId;
	
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }
    public function read() {
        // Create query
        $query = 'SELECT
                idSite,
                idProductionSite,
                idComposant,
                quantite,
                lastUpdateUserId
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
                idSite,
                idProductionSite,
                idComposant,
                quantite,
                lastUpdateUserId
          FROM
            ' . $this->table_name . '
        WHERE idSite = :siteId 
        AND idProductionSite = :productionsiteId 
        AND idComposant = :composantId ';
  
        //Prepare statement
        $stmt = $this->conn->prepare($query);
  
        // Bind ID
        $stmt->bindParam(':siteId', $this->idSite);
        $stmt->bindParam(':productionsiteId', $this->idProductionSite);
        $stmt->bindParam(':composantId', $this->idComposant);
  
        // Execute query
        $stmt->execute();
  
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
  
        // set properties
        $this->idSite = $row['idSite'];
        $this->idProductionSite = $row['idProductionSite'];
        $this->idComposant = $row['idComposant'];
        $this->quantite = $row['quantite'];
        $this->lastUpdateUserId = $row['lastUpdateUserId'];
    }
  
    // Create Category
    public function create() {
      // Create Query
      $query = 'INSERT INTO ' .
        $this->table_name . '
      SET
            idSite = :siteId , 
            idProductionSite = :productionsiteId ,
            idComposant = :composantId ,
            quantite = :quantite ,
            lastUpdateUserId = :lastUpdateUserId ';
  
    // Prepare Statement
    $stmt = $this->conn->prepare($query);
  
    // Clean data
    $this->idSite = htmlspecialchars(strip_tags($this->idSite));
    $this->idProductionSite = htmlspecialchars(strip_tags($this->idProductionSite));
    $this->idComposant = htmlspecialchars(strip_tags($this->idComposant));
    $this->quantite = htmlspecialchars(strip_tags($this->quantite));
    $this->lastUpdateUserId = htmlspecialchars(strip_tags($this->lastUpdateUserId));

    // Bind data
    $stmt-> bindParam(':siteId', $this->idSite);
    $stmt-> bindParam(':productionsiteId', $this->idProductionSite);
    $stmt-> bindParam(':composantId', $this->idComposant);
    $stmt-> bindParam(':quantite', $this->quantite);
    $stmt-> bindParam(':lastUpdateUserId', $this->lastUpdateUserId);
    
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
      quantite = :quantite ,
      lastUpdateUserId = :lastUpdateUserId 
    WHERE idStocker = :stockerId 
        AND idProductionSite = :productionsiteId
        AND idComposant = :composantId';
  
    // Prepare Statement
    $stmt = $this->conn->prepare($query);
  
    // Clean data
    $this->quantite = htmlspecialchars(strip_tags($this->quantite));
    $this->lastUpdateUserId = htmlspecialchars(strip_tags($this->lastUpdateUserId));
    $this->idSite = htmlspecialchars(strip_tags($this->idSite));
    $this->idProductionSite = htmlspecialchars(strip_tags($this->idProductionSite));
    $this->idComposant = htmlspecialchars(strip_tags($this->idComposant));

    // Bind data
    $stmt-> bindParam(':quantite', $this->quantite);
    $stmt-> bindParam(':lastUpdateUserId', $this->lastUpdateUserId);
    $stmt-> bindParam(':siteId', $this->idSite);
    $stmt-> bindParam(':productionsiteId', $this->idProductionSite);
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
      $query = 'DELETE FROM ' . $this->table_name . ' WHERE idStocker = :stockerId AND idProductionSite = :productionsiteId AND idComposant = :composantId';
  
      // Prepare Statement
      $stmt = $this->conn->prepare($query);
  
      // clean data
      $this->idSite = htmlspecialchars(strip_tags($this->idSite));
      $this->idProductionSite = htmlspecialchars(strip_tags($this->idProductionSite));
      $this->idComposant = htmlspecialchars(strip_tags($this->idComposant));
  
      // Bind Data
      $stmt-> bindParam(':siteId', $this->idSite);
      $stmt-> bindParam(':productionsiteId', $this->idProductionSite);
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
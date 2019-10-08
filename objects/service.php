<?php
class Service{
 
    // database connection and table_name name
    private $conn;
    private $table_name = 'Service';
 
    // object properties
    public $idService;
    public $libelleService;
    public $commentaireService;
	public $idSite;
	public $idDirection;
	
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }
	
    public function read() {
      // Create query
      $query = 'SELECT
			idService,
			libelleService,
			commentaireService,
			idSite,
			idDirection
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
			idService,
			libelleService,
			commentaireService,
			idSite,
			idDirection
        FROM
          ' . $this->table_name . '
      WHERE idService = :serviceId ';

      //Prepare statement
      $stmt = $this->conn->prepare($query);

      // Bind ID
      $stmt->bindParam(':serviceId', $this->idService);

      // Execute query
      $stmt->execute();

      $row = $stmt->fetch(PDO::FETCH_ASSOC);

      // set properties
      $this->idService = $row['idService'];
      $this->libelleService = $row['libelleService'];
	  $this->commentaireService = $row['commentaireService'];
      $this->idSite = $row['idSite'];
	  $this->idDirection = $row['idDirection'];
  }

  // Create Category
  public function create() {
    // Create Query
    $query = 'INSERT INTO ' .
      $this->table_name . '
    SET
      libelleService = :serviceLibelle,
	  commentaireService= :serviceCommentaire,
	  idSite= :siteId,
	  idDirection= :directionId';

  // Prepare Statement
  $stmt = $this->conn->prepare($query);

  // Clean data
  $this->libelleService = htmlspecialchars(strip_tags($this->libelleService));
  $this->commentaireService = htmlspecialchars(strip_tags($this->commentaireService));
  $this->idSite = htmlspecialchars(strip_tags($this->idSite));
  $this->idDirection = htmlspecialchars(strip_tags($this->idDirection));
  
  // Bind data
  $stmt-> bindParam(':serviceLibelle', $this->libelleService);
  $stmt-> bindParam(':serviceCommentaire', $this->commentaireService);
  $stmt-> bindParam(':siteId', $this->idSite);
  $stmt-> bindParam(':directionId', $this->idDirection);
  
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
      libelleService = :serviceLibelle,
	  commentaireService= :serviceCommentaire,
	  idSite= :siteId,
	  idDirection= :directionId 
      WHERE idService = :serviceId';

  // Prepare Statement
  $stmt = $this->conn->prepare($query);

  // Clean data
  $this->libelleService = htmlspecialchars(strip_tags($this->libelleService));
  $this->commentaireService = htmlspecialchars(strip_tags($this->commentaireService));
  $this->idSite = htmlspecialchars(strip_tags($this->idSite));
  $this->idDirection = htmlspecialchars(strip_tags($this->idDirection));
  $this->idService = htmlspecialchars(strip_tags($this->idService));

  // Bind data
  $stmt-> bindParam(':serviceLibelle', $this->libelleService);
  $stmt-> bindParam(':serviceCommentaire', $this->commentaireService);
  $stmt-> bindParam(':siteId', $this->idSite);
  $stmt-> bindParam(':directionId', $this->idDirection);
    $stmt-> bindParam(':serviceId', $this->idService);
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
    $query = 'DELETE FROM ' . $this->table_name . ' WHERE idService = :serviceId';

    // Prepare Statement
    $stmt = $this->conn->prepare($query);

    // clean data
    $this->idService = htmlspecialchars(strip_tags($this->idService));

    // Bind Data
    $stmt-> bindParam(':serviceId', $this->idService);

    // Execute query
    if($stmt->execute()) {
      return true;
    }

    // Print error if something goes wrong
    printf("Error: $s.\n", $stmt->error);

    return false;
    }
}
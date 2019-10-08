<?php 
class Fournisseur{ 
  
    // database connection and table name 
    private $conn; 
    private $table_name = "Fournisseur"; 
  
    // object properties 
    public $idFournisseur; 
    public $libelleFournisseur; 
	public $rueFournisseur;
	public $villeFournisseur; 
	public $cpFournisseur;
	public $telFournisseur; 
	public $mailFournisseur; 
	
    // constructor with $db as database connection 
    public function __construct($db){ 
        $this->conn = $db; 
    } 
	
    public function read() {
      // Create query
      $query = 'SELECT
			idFournisseur,
			libelleFournisseur,
			rueFournisseur,
			villeFournisseur,
			cpFournisseur,
			telFournisseur, 
			mailFournisseur 
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
			idFournisseur,
			libelleFournisseur,
			rueFournisseur,
			villeFournisseur,
			cpFournisseur,
			telFournisseur, 
			mailFournisseur 
        FROM
          ' . $this->table_name . '
      WHERE idFournisseur = :fournisseurId ';

      //Prepare statement
      $stmt = $this->conn->prepare($query);

      // Bind ID
      $stmt->bindParam(':fournisseurId', $this->idFournisseur);

      // Execute query
      $stmt->execute();

      $row = $stmt->fetch(PDO::FETCH_ASSOC);

      // set properties
      $this->idFournisseur = $row['idFournisseur'];
      $this->libelleFournisseur = $row['libelleFournisseur'];
	  $this->rueFournisseur = $row['rueFournisseur'];
      $this->villeFournisseur = $row['villeFournisseur'];
	  $this->cpFournisseur = $row['cpFournisseur'];
	  $this->telFournisseur = $row['telFournisseur'];
	  $this->mailFournisseur = $row['mailFournisseur'];
  }

  // Create Category
  public function create() {
    // Create Query
    $query = 'INSERT INTO ' .
      $this->table_name . '
    SET
		  libelleFournisseur = :fournisseurLibelle,
		  rueFournisseur= :fournisseurRue,
		  villeFournisseur= :fournisseurVille,
		  cpFournisseur= :fournisseurCP,
		  telFournisseur= :fournisseurTel, 
		  mailFournisseur= :fournisseurMail ';

  // Prepare Statement
  $stmt = $this->conn->prepare($query);

  // Clean data
  $this->libelleFournisseur = htmlspecialchars(strip_tags($this->libelleFournisseur));
  $this->rueFournisseur = htmlspecialchars(strip_tags($this->rueFournisseur));
  $this->villeFournisseur = htmlspecialchars(strip_tags($this->villeFournisseur));
  $this->cpFournisseur = htmlspecialchars(strip_tags($this->cpFournisseur));
  $this->telFournisseur = htmlspecialchars(strip_tags($this->telFournisseur));
  $this->mailFournisseur = htmlspecialchars(strip_tags($this->mailFournisseur));
  
  // Bind data
  $stmt-> bindParam(':fournisseurLibelle', $this->libelleFournisseur);
  $stmt-> bindParam(':fournisseurRue', $this->rueFournisseur);
  $stmt-> bindParam(':fournisseurVille', $this->villeFournisseur);
  $stmt-> bindParam(':fournisseurCP', $this->cpFournisseur);
  $stmt-> bindParam(':fournisseurTel', $this->telFournisseur);
  $stmt-> bindParam(':fournisseurMail', $this->mailFournisseur);
  
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
      libelleFournisseur = :fournisseurLibelle,
	  rueFournisseur= :fournisseurRue,
	  villeFournisseur= :fournisseurVille,
	  cpFournisseur= :fournisseurCP,
	  telFournisseur= :fournisseurTel, 
	  mailFournisseur= :fournisseurMail 
    WHERE idFournisseur = :fournisseurId';

  // Prepare Statement
  $stmt = $this->conn->prepare($query);

    // Clean data
  $this->libelleFournisseur = htmlspecialchars(strip_tags($this->libelleFournisseur));
  $this->rueFournisseur = htmlspecialchars(strip_tags($this->rueFournisseur));
  $this->villeFournisseur = htmlspecialchars(strip_tags($this->villeFournisseur));
  $this->cpFournisseur = htmlspecialchars(strip_tags($this->cpFournisseur));
  $this->telFournisseur = htmlspecialchars(strip_tags($this->telFournisseur));
  $this->mailFournisseur = htmlspecialchars(strip_tags($this->mailFournisseur));
  $this->idFournisseur = htmlspecialchars(strip_tags($this->idFournisseur));
  
  // Bind data
  $stmt-> bindParam(':fournisseurLibelle', $this->libelleFournisseur);
  $stmt-> bindParam(':fournisseurRue', $this->rueFournisseur);
  $stmt-> bindParam(':fournisseurVille', $this->villeFournisseur);
  $stmt-> bindParam(':fournisseurCP', $this->cpFournisseur);
  $stmt-> bindParam(':fournisseurTel', $this->telFournisseur);
  $stmt-> bindParam(':fournisseurMail', $this->mailFournisseur);
  $stmt-> bindParam(':fournisseurId', $this->idFournisseur);
      
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
    $query = 'DELETE FROM ' . $this->table_name . ' WHERE idFournisseur = :fournisseurId';

    // Prepare Statement
    $stmt = $this->conn->prepare($query);

    // clean data
    $this->idFournisseur = htmlspecialchars(strip_tags($this->idFournisseur));

    // Bind Data
    $stmt-> bindParam(':fournisseurId', $this->idFournisseur);

    // Execute query
    if($stmt->execute()) {
      return true;
    }

    // Print error if something goes wrong
    printf("Error: $s.\n", $stmt->error);

    return false;
    }
}
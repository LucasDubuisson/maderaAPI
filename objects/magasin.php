<?php
class Magasin{
 
    // database connection and table name
    private $conn;
    private $table_name = "Magasin";
 
    // object properties
    public $idSite;
	public $idMagasinSiteSite;
    public $libelleSite;
    public $villeSite;
	public $rueSite;
    public $cpSite;
    public $mailSite;
	public $telSite;
    public $activiteSite;
    public $entrepotSite;
	public $locauxSite;
	
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }
    public function read() {
        // Create query
        $query = 'SELECT
                idSite,
                idMagasinSiteSite,
                libelleSite,
                villeSite,
                rueSite,
                cpSite,
                mailSite,
                telSite,
                activiteSite,
                entrepotSite,
                locauxSite
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
                idMagasinSite,
                libelleSite,
                villeSite,
                rueSite,
                cpSite,
                mailSite,
                telSite,
                activiteSite,
                entrepotSite,
                locauxSite
          FROM
            ' . $this->table_name . '
        WHERE idSite = :siteId AND idMagasinSite = :magasinsiteId';
  
        //Prepare statement
        $stmt = $this->conn->prepare($query);
  
        // Bind ID
        $stmt->bindParam(':siteId', $this->idSite);
        $stmt->bindParam(':magasinsiteId', $this->idMagasinSite);
  
        // Execute query
        $stmt->execute();
  
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
  
        // set properties
        $this->idSite = $row['idSite'];
        $this->idMagasinSite = $row['idMagasinSite'];
        $this->libelleSite = $row['libelleSite'];
        $this->villeSite = $row['villeSite'];
        $this->rueSite = $row['rueSite'];
        $this->cpSite = $row['cpSite'];
        $this->mailSite = $row['mailSite'];
        $this->telSite = $row['telSite'];
        $this->activiteSite = $row['activiteSite'];
        $this->entrepotSite = $row['entrepotSite'];
        $this->locauxSite = $row['locauxSite'];
    }
  
    // Create Category
    public function create() {
      // Create Query
      $query = 'INSERT INTO ' .
        $this->table_name . '
      SET
        libelleSite = :siteLibelle,
        villeSite = :siteVille,
        rueSite = :siteRue,
        cpSite = :siteCP,
        mailSite = :siteMail,
        telSite = :siteTel,
        activiteSite = :siteActivite,
        entrepotSite = :siteEntrepot,
        locauxSite = :siteLocaux';
  
    // Prepare Statement
    $stmt = $this->conn->prepare($query);
  
    // Clean data
    $this->libelleSite = htmlspecialchars(strip_tags($this->libelleSite));
    $this->villeSite = htmlspecialchars(strip_tags($this->villeSite));
    $this->rueSite = htmlspecialchars(strip_tags($this->rueSite));
    $this->cpSite = htmlspecialchars(strip_tags($this->cpSite));
    $this->mailSite = htmlspecialchars(strip_tags($this->mailSite));
    $this->telSite = htmlspecialchars(strip_tags($this->telSite));
    $this->activiteSite = htmlspecialchars(strip_tags($this->activiteSite));
    $this->entrepotSite = htmlspecialchars(strip_tags($this->entrepotSite));
    $this->locauxSite = htmlspecialchars(strip_tags($this->locauxSite));
    
    // Bind data
    $stmt-> bindParam(':siteLibelle', $this->libelleSite);
    $stmt-> bindParam(':siteVille', $this->villeSite);
    $stmt-> bindParam(':siteRue', $this->rueSite);
    $stmt-> bindParam(':siteCP', $this->cpSite);
    $stmt-> bindParam(':siteMail', $this->mailSite);
    $stmt-> bindParam(':siteTel', $this->telSite);
    $stmt-> bindParam(':siteActivite', $this->activiteSite);
    $stmt-> bindParam(':siteEntrepot', $this->entrepotSite);
    $stmt-> bindParam(':siteLocaux', $this->locauxSite);
    
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
        libelleSite = :siteLibelle,
        villeSite = :siteVille,
        rueSite = :siteRue,
        cpSite = :siteCP,
        mailSite = :siteMail,
        telSite = :siteTel,
        activiteSite = :siteActivite,
        entrepotSite = :siteEntrepot,
        locauxSite = :siteLocaux
      WHERE idSite = :siteId AND idMagasinSite= :magasinsiteId';
  
    // Prepare Statement
    $stmt = $this->conn->prepare($query);
  
        // Clean data
        $this->libelleSite = htmlspecialchars(strip_tags($this->libelleSite));
        $this->villeSite = htmlspecialchars(strip_tags($this->villeSite));
        $this->rueSite = htmlspecialchars(strip_tags($this->rueSite));
        $this->cpSite = htmlspecialchars(strip_tags($this->cpSite));
        $this->mailSite = htmlspecialchars(strip_tags($this->mailSite));
        $this->telSite = htmlspecialchars(strip_tags($this->telSite));
        $this->activiteSite = htmlspecialchars(strip_tags($this->activiteSite));
        $this->entrepotSite = htmlspecialchars(strip_tags($this->entrepotSite));
        $this->locauxSite = htmlspecialchars(strip_tags($this->locauxSite));
        $this->idSite = htmlspecialchars(strip_tags($this->idSite));
        $this->idMagasinSite = htmlspecialchars(strip_tags($this->idMagasinSite));

        // Bind data
        $stmt-> bindParam(':siteLibelle', $this->libelleSite);
        $stmt-> bindParam(':siteVille', $this->villeSite);
        $stmt-> bindParam(':siteRue', $this->rueSite);
        $stmt-> bindParam(':siteCP', $this->cpSite);
        $stmt-> bindParam(':siteMail', $this->mailSite);
        $stmt-> bindParam(':siteTel', $this->telSite);
        $stmt-> bindParam(':siteActivite', $this->activiteSite);
        $stmt-> bindParam(':siteEntrepot', $this->entrepotSite);
        $stmt-> bindParam(':siteLocaux', $this->locauxSite);      
        $stmt-> bindParam(':siteId', $this->idSite);
        $stmt-> bindParam(':magasinsiteId', $this->idMagasinSite);

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
      $query = 'DELETE FROM ' . $this->table_name . ' WHERE idSite = :siteId AND idMagasinSite= :magasinsiteId';
  
      // Prepare Statement
      $stmt = $this->conn->prepare($query);
  
      // clean data
      $this->idSite = htmlspecialchars(strip_tags($this->idSite));
      $this->idMagasinSite = htmlspecialchars(strip_tags($this->idMagasinSite));
  
      // Bind Data
      $stmt-> bindParam(':siteId', $this->idSite);
      $stmt-> bindParam(':magasinsiteId', $this->idMagasinSite);
  
      // Execute query
      if($stmt->execute()) {
        return true;
      }
  
      // Print error if something goes wrong
      printf("Error: $s.\n", $stmt->error);
  
      return false;
      }
}
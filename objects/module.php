<?php 
class Module{ 
  
    // database connection and table name 
    private $conn; 
    private $table_name = "Module"; 
  
    // object properties 
    public $idModule; 
    public $libelleModule; 
    public $natureModule; 
	public $caractModule;
	public $uniteUsageModule; 
	public $finitionModule;
	public $typeIsolantModule; 
	public $typeCouvertureModule,
	public $huisseriesModule;
	public $idRegleCalcul;
	
    // constructor with $db as database connection 
    public function __construct($db){ 
        $this->conn = $db; 
    } 
	   public function read() {
      // Create query
      $query = 'SELECT
			idModule,
			libelleModule,
			natureModule,
			caractModule,
			uniteUsageModule, 
			finitionModule,
			typeIsolantModule,
			typeCouvertureModule,
			huisseriesModule,
			idRegleCalcul
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
			idModule,
			libelleModule,
			natureModule,
			caractModule,
			uniteUsageModule, 
			finitionModule,
			typeIsolantModule,
			typeCouvertureModule,
			huisseriesModule,
			idRegleCalcul
        FROM
          ' . $this->table_name . '
      WHERE idModule = :moduleId ';

      //Prepare statement
      $stmt = $this->conn->prepare($query);

      // Bind ID
      $stmt->bindParam(':moduleId', $this->idModule);

      // Execute query
      $stmt->execute();

      $row = $stmt->fetch(PDO::FETCH_ASSOC);

      // set properties
      $this->idModule = $row['idModule'];
      $this->libelleModule = $row['libelleModule'];
	  $this->natureModule = $row['natureModule'];
      $this->caractModule = $row['caractModule'];
	  $this->uniteUsageModule = $row['uniteUsageModule'];
	  $this->finitionModule = $row['finitionModule'];
      $this->typeIsolantModule = $row['typeIsolantModule'];
	  $this->typeCouvertureModule = $row['typeCouvertureModule'];
	  $this->huisseriesModule = $row['huisseriesModule'];
      $this->idRegleCalcul = $row['idRegleCalcul'];
  }

  // Create Category
  public function create() {
    // Create Query
    $query = 'INSERT INTO ' .
      $this->table_name . '
    SET
		libelleModule = :moduleLibelle,
		natureModule= :moduleNature,
		caractModule= :moduleCaract,
		uniteUsageModule= :moduleUniteUsage, 
		finitionModule= :moduleFinition,
		typeIsolantModule= :moduleTypeIsolant,
		typeCouvertureModule= :moduleTypeCouverture,
		huisseriesModule= :moduleHuisseries,
		idRegleCalcul= :regleCalculId';

  // Prepare Statement
  $stmt = $this->conn->prepare($query);

  // Clean data
  $this->libelleModule = htmlspecialchars(strip_tags($this->libelleModule));
  $this->natureModule = htmlspecialchars(strip_tags($this->natureModule));
  $this->caractModule = htmlspecialchars(strip_tags($this->caractModule));
  $this->uniteUsageModule = htmlspecialchars(strip_tags($this->uniteUsageModule));
  $this->finitionModule = htmlspecialchars(strip_tags($this->finitionModule));
  $this->typeIsolantModule = htmlspecialchars(strip_tags($this->typeIsolantModule));
  $this->typeCouvertureModule = htmlspecialchars(strip_tags($this->typeCouvertureModule));
  $this->huisseriesModule = htmlspecialchars(strip_tags($this->huisseriesModule));
  $this->idRegleCalcul = htmlspecialchars(strip_tags($this->idRegleCalcul));
  
  // Bind data
  $stmt-> bindParam(':moduleLibelle', $this->libelleModule);
  $stmt-> bindParam(':moduleNature', $this->natureModule);
  $stmt-> bindParam(':moduleCaract', $this->caractModule);
  $stmt-> bindParam(':moduleUniteUsage', $this->uniteUsageModule);
  $stmt-> bindParam(':moduleFinition', $this->finitionModule);
  $stmt-> bindParam(':moduleTypeIsolant', $this->typeIsolantModule);
  $stmt-> bindParam(':moduleTypeCouverture', $this->typeCouvertureModule);
  $stmt-> bindParam(':moduleHuisseries', $this->huisseriesModule);
  $stmt-> bindParam(':regleCalculId', $this->idRegleCalcul);
  
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
        libelleModule = :moduleLibelle,
	    natureModule= :moduleNature,
		caractModule= :moduleCaract,
		uniteUsageModule= :moduleUniteUsage, 
		finitionModule= :moduleFinition,
		typeIsolantModule= :moduleTypeIsolant,
		typeCouvertureModule= :moduleTypeCouverture,
		huisseriesModule= :moduleHuisseries,
		idRegleCalcul= :regleCalculId
      WHERE idModule = :moduleId';

  // Prepare Statement
  $stmt = $this->conn->prepare($query);

    // Clean data
  $this->libelleModule = htmlspecialchars(strip_tags($this->libelleModule));
  $this->natureModule = htmlspecialchars(strip_tags($this->natureModule));
  $this->caractModule = htmlspecialchars(strip_tags($this->caractModule));
  $this->uniteUsageModule = htmlspecialchars(strip_tags($this->uniteUsageModule));
  $this->finitionModule = htmlspecialchars(strip_tags($this->finitionModule));
  $this->typeIsolantModule = htmlspecialchars(strip_tags($this->typeIsolantModule));
  $this->typeCouvertureModule = htmlspecialchars(strip_tags($this->typeCouvertureModule));
  $this->huisseriesModule = htmlspecialchars(strip_tags($this->huisseriesModule));
  $this->idRegleCalcul = htmlspecialchars(strip_tags($this->idRegleCalcul));
  $this->idModule = htmlspecialchars(strip_tags($this->idModule));
  
  // Bind data
  $stmt-> bindParam(':moduleLibelle', $this->libelleModule);
  $stmt-> bindParam(':moduleNature', $this->natureModule);
  $stmt-> bindParam(':moduleCaract', $this->caractModule);
  $stmt-> bindParam(':moduleUniteUsage', $this->uniteUsageModule);
  $stmt-> bindParam(':moduleFinition', $this->finitionModule);
  $stmt-> bindParam(':moduleTypeIsolant', $this->typeIsolantModule);
  $stmt-> bindParam(':moduleTypeCouverture', $this->typeCouvertureModule);
  $stmt-> bindParam(':moduleHuisseries', $this->huisseriesModule);
  $stmt-> bindParam(':regleCalculId', $this->idRegleCalcul);
  $stmt-> bindParam(':moduleId', $this->idModule);


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
    $query = 'DELETE FROM ' . $this->table_name . ' WHERE idModule = :moduleId';

    // Prepare Statement
    $stmt = $this->conn->prepare($query);

    // clean data
    $this->idModule = htmlspecialchars(strip_tags($this->idModule));

    // Bind Data
    $stmt-> bindParam(':moduleId', $this->idModule);

    // Execute query
    if($stmt->execute()) {
      return true;
    }

    // Print error if something goes wrong
    printf("Error: $s.\n", $stmt->error);

    return false;
    }
}
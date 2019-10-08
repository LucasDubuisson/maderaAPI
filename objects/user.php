<?php
  class User {
    // DB Stuff
    private $conn;
    private $table = 'User';

    // Properties
    public $idUser;
    public $nomUser;
    public $prenomUser;
    public $passwordUser;
    public $telUser;
    public $mailUser;
    public $villeUser;
	public $rueUser;
	public $cpUser;
	public $dateDeNaissanceUser;
	public $idService;

    // Constructor with DB
    public function __construct($db) {
      $this->conn = $db;
    }

    // Get categories
    public function read() {
      // Create query
      $query = 'SELECT
        idUser,
		nomUser,
		prenomUser,
		passwordUser,
		telUser,
		mailUser,
		villeUser,
		rueUser,
		cpUser,
		dateDeNaissanceUser,
		idService
      FROM
        ' . $this->table . '
      ORDER BY
        idUser ASC';

      // Prepare statement
      $stmt = $this->conn->prepare($query);

      // Execute query
      $stmt->execute();

      return $stmt;
    }
	  public function read_one(){
    // Create query
    $query = 'SELECT
		  idUser,
		  nomUser,
		  prenomUser,
		  passwordUser,
		  telUser,
		  mailUser,
		  villeUser,
		  rueUser,
		  cpUser,
		  dateDeNaissanceUser,
		  idService
        FROM
          ' . $this->table . '
      WHERE idUser = :userID ';

      //Prepare statement
      $stmt = $this->conn->prepare($query);

      // Bind ID
      $stmt->bindParam(':userID', $this->idUser);

      // Execute query
      $stmt->execute();

      $row = $stmt->fetch(PDO::FETCH_ASSOC);
	  
	  // set properties
      //$this->idUser = $row['idUser'];
      $this->nomUser = $row['nomUser'];
      $this->prenomUser = $row['prenomUser'];
      $this->passwordUser = $row['passwordUser'];
      $this->telUser = $row['telUser'];
      $this->mailUser = $row['mailUser'];
      $this->rueUser = $row['rueUser'];
      $this->villeUser = $row['villeUser'];
      $this->cpUser = $row['cpUser'];
      $this->dateDeNaissanceUser = $row['dateDeNaissanceUser'];
      $this->idService = $row['idService'];
  }	
}

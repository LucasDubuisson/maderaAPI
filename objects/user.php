<?php
class User{
 
    // database connection and table name
    private $conn;
    private $table_name = "user";
 
    // object properties
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
	
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }
	// read products
	function read(){
	 
		// select all query
		$query = "SELECT idSite,nomUser,prenomUser,passwordUser,telUser,mailUser,villeUser,rueUser,cpUser,dateDeNaissanceUser,idService
				FROM " . $this->table_name;
	 
		// prepare query statement
		$stmt = $this->conn->prepare($query);
	 
		// execute query
		$stmt->execute();
	 
		return $stmt;
	}
	/*public function read(){
      $query="SELECT * FROM user"; //. $table_name; //" idSite,nomUser,prenomUser,passwordUser,telUser,mailUser,villeUser,rueUser,cpUser,dateDeNaissanceUser,idService;

      $stmt = $this->conn->prepare($query);
      $stmt->execute();

      return $stmt;
    }
	    public function readOne(){

        // query to read single record
        $query = "SELECT * FROM user WHERE idUser = ?";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // bind id of product to be updated
        $stmt->bindParam(1, $this->idUser);

        // execute query
        $stmt->execute();

        // get retrieved row
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // set values to object properties
        $this->nomUser = $row['nomUser'];
        $this->prenomUser = $row['prenomUser'];
    }*/
}
<?php
class Service{
 
    // database connection and table name
    private $conn;
    private $table_name = "service";
 
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
	
	public function read(){
      $query="SELECT * FROM service"; //. $table_name; //" idSite,nomUser,prenomUser,passwordUser,telUser,mailUser,villeUser,rueUser,cpUser,dateDeNaissanceUser,idService;

      $stmt = $this->conn->prepare($query);
      $stmt->execute();

      return $stmt;
    }
}
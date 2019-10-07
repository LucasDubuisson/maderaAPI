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
	
	public function read(){
      $query="SELECT idSite,nomUser,prenomUser,passwordUser,telUser,mailUser,villeUser,rueUser,cpUser,dateDeNaissanceUser,idService FROM user" //" + $table_name;

      $stmt = $this->conn->prepare($query);
      $stmt->execute();

      return $stmt;
    }
}
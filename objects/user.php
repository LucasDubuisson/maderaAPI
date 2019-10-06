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
	
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }
}
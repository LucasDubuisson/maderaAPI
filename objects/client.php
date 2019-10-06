<?php
class Client{
 
    // database connection and table name
    private $conn;
    private $table_name = "Client";
 
    // object properties
    public $idClient;
    public $nomClient;
    public $prenomClient;
    public $societeClient;
    public $villeClient;
	public $rueClient;
	public $cpClient;
	public $telClient;
    public $mailClient;
	
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }
}
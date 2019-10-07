<?php
class Stocker{
 
    // database connection and table name
    private $conn;
    private $table_name = "Stocker";
 
    // object properties
    public $idSite;
    public $idProductionSite;
    public $idComposant;
	public $quantite;
	public $lastUpdateUserId;
	
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }
}
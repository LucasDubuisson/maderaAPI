<?php
class Magasin{
 
    // database connection and table name
    private $conn;
    private $table_name = "Magasin";
 
    // object properties
    public $idSite;
	public $idMagasinSite;
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
}
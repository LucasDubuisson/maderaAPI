<?php
class Production{
 
    // database connection and table name
    private $conn;
    private $table_name = "production";
 
    // object properties
    public $idSite;
	public $idProductionSite;
	public $productionSite;
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
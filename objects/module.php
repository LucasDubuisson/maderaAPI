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
}
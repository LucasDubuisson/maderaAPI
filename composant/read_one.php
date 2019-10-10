<?php

  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../config/database.php';
  include_once '../objects/composant.php';
  include_once '../objects/stocker.php';
  
  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();
  // Instantiate blog category object
	$composant = new Composant($db);
	
	
	$stockerLille= new Stocker($db);
	$stockerLille->idSite=1;
	$stockerLille->idProduction=1;

	$stockerDax= new Stocker($db);
	$stockerDax->idSite=2;
	$stockerDax->idProduction=2;

	$stockerAnnecy=new Stocker($db);
	$stockerAnnecy->idSite=3;
	$stockerAnnecy->idProduction=3;

  // Get ID
  $composant->idComposant = isset($_GET['composantId']) ? $_GET['composantId'] : die();

  // Get post
  $composant->read_one();
 
  $stockerLille->idComposant=$composant->idComposant;
  $stockerLille->readStockComposantBySite();
  $stockerDax->idComposant=$composant->idComposant;
  $stockerDax->readStockComposantBySite();
  $stockerAnnecy->idComposant=$composant->idComposant;
  $stockerAnnecy->readStockComposantBySite();
  
  if($composant->libelleComposant!=null){ 
  // Create array
  $composant_arr = array(
		"idComposant" => $composant->idComposant,
		"libelleComposant" => $composant->libelleComposant,
		"caracterComposant" => $composant->caracterComposant,
		"uniteUsageComposant" => $composant->uniteUsageComposant,
		"quantite" => array("Lille" =>$stockerLille->quantite,"Dax" =>$stockerDax->quantite,"Annecy" =>$stockerAnnecy->quantite),
		"idFamilleComposant" => $composant->idFamilleComposant
  );
  // Make JSON
  http_response_code(200);
  print_r(json_encode($composant_arr));
   // set response code - 200 OK 
}
 
else{
    // set response code - 404 Not found
    http_response_code(404);
 
    // tell the user product does not exist
    echo json_encode(array("message" => "Composant does not exist."));
}

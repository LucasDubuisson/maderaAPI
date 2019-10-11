<?php

  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../config/database.php';
  include_once '../objects/devis.php';
  
  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();
  // Instantiate blog category object
  $devis = new Devis($db);

  // Get ID
  $devis->idDevis = isset($_GET['devisId']) ? $_GET['devisId'] : die();

  // Get post
  $devis->read_one();
  
if ($devis->prixDevis!=null)
{
  // Create array
  $devis_arr = array(
      		"idDevis" => $devis->idDevis, 
			"prixDevis" =>  $devis->prixDevis,
			"etatDevis" =>  $devis->etatDevis, 
			"dateDevis" =>  $devis->dateDevis,
			"dateEvolutionDevis" =>  $devis->dateEvolutionDevis, 
			"avancementDevisByUserId" =>  $devis->avancementDevisByUserId,
			"idDossier" =>  $devis->idDossier, 
			"idMaison" =>  $devis->idMaison
			);

  // Make JSON
  http_response_code(200);
  print_r(json_encode($devis_arr));
   // set response code - 200 OK 
}

else{
    // set response code - 404 Not found
    http_response_code(404);
 
    // tell the user product does not exist
    echo json_encode(array("message" => "Devis does not exist."));
}

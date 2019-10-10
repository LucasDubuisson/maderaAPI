<?php

  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../config/database.php';
  include_once '../objects/fournisseur.php';
  
  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();
  // Instantiate blog category object
  $fournisseur = new Fournisseur($db);

  // Get ID
  $fournisseur->idFournisseur = isset($_GET['fournisseurId']) ? $_GET['fournisseurId'] : die();

  // Get post
  $fournisseur->read_one();

  // Create array
  $fournisseur_arr = array(
			"idFournisseur" => $fournisseur->idFournisseur,
            "libelleFournisseur" => $fournisseur->libelleFournisseur,
            "rueFournisseur" => $fournisseur->rueFournisseur,
            "villeFournisseur" => $fournisseur->villeFournisseur,
			"cpFournisseur" => $fournisseur->cpFournisseur,
            "telFournisseur" => $fournisseur->telFournisseur,
            "mailFournisseur" => $fournisseur->mailFournisseur
  );

  // Make JSON
  http_response_code(200);
  print_r(json_encode($fournisseur_arr));
   // set response code - 200 OK 
}
 
else{
    // set response code - 404 Not found
    http_response_code(404);
 
    // tell the user product does not exist
    echo json_encode(array("message" => "Client does not exist."));
}
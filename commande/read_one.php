<?php

  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../config/database.php';
  include_once '../objects/commande.php';
  
  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();
  // Instantiate blog category object
  $commande = new Commande($db);

  // Get ID
  $commande->idCommande = isset($_GET['commandeId']) ? $_GET['commandeId'] : die();

  // Get post
  $commande->read_one();
if ($commande->dateCommande!=null)
{
  // Create array
  $commande_arr = array(
	"idCommande" => $commande->idCommande,
	"dateCommande" => $commande->dateCommande,
	"dateLivraisonCommande" => $commande->dateLivraisonCommande,
	"margeCommercialCommande" => $commande->margeCommercialCommande,
	"margeEntrepriseCommande" => $commande->margeEntrepriseCommande,
	"statusCommande" => $commande->statusCommande,
	"idDevis" => $commande->idDevis
  );

  // Make JSON
  http_response_code(200);
  print_r(json_encode($commande_arr));
   // set response code - 200 OK 
}
 
else{
    // set response code - 404 Not found
    http_response_code(404);
 
    // tell the user product does not exist
    echo json_encode(array("message" => "Commande does not exist."));
}

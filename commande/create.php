<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: POST');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

  include_once '../config/database.php';
  include_once '../objects/commande.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate blog service object
  $commande = new Commande($db);

  // Get raw serviceed data
  $data = json_decode(file_get_contents("php://input"));

  $commande->idCommande = $data->idCommande;
  $commande->dateCommande = $data->dateCommande;
  $commande->dateLivraisonCommande = $data->dateLivraisonCommande;
  $commande->margeCommercialCommande = $data->margeCommercialCommande;
  $commande->margeEntrepriseCommande = $data->margeEntrepriseCommande;
  $commande->statusCommande = $data->statusCommande;
  $commande->idDevis = $data->idDevis;

  // Create service
  if($commande->create()) {
	    http_response_code(200);
    echo json_encode(
      array('message' => 'commande Created')
    );
  } else {
	    http_response_code(404);
    echo json_encode(
      array('message' => 'commande Not Created')
    );
  }


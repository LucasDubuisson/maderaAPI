<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: PUT');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

  include_once '../config/database.php';
  include_once '../objects/devis.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate blog devis object
  $devis = new Devis($db);

  // Get raw devised data
  $data = json_decode(file_get_contents("php://input"));

  // Set ID to update
  $devis->prixDevis = $data->prixDevis;
  $devis->etatDevis = $data->etatDevis;
  $devis->dateDevis = $data->dateDevis;
  $devis->dateEvolutionDevis = $data->dateEvolutionDevis;
  $devis->avancementDevisByUserId = $data->avancementDevisByUserId;
  $devis->idDossier = $data->idDossier;
  $devis->idMaison = $data->idMaison;
  $devis->idDevis = $data->idDevis;

  // Update devis
  if($devis->update()) {
	    http_response_code(200);
    echo json_encode(
      array('message' => 'devis Updated')
    );
  } else {
	    http_response_code(404);
    echo json_encode(
      array('message' => 'devis Not Updated')
    );
  }


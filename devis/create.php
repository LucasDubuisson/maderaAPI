<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: POST');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

  include_once '../config/database.php';
  include_once '../objects/devis.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate blog service object
  $devis = new Devis($db);

  // Get raw serviceed data
  $data = json_decode(file_get_contents("php://input"));

  $devis->prixDevis = $data->prixDevis;
  $devis->etatDevis = $data->etatDevis;
  $devis->dateDevis = $data->dateDevis;
  $devis->dateEvolutionDevis = $data->dateEvolutionDevis;
  $devis->avancementDevisByUserId = $data->avancementDevisByUserId;
  $devis->idDossier = $data->idDossier;
  $devis->idMaison = $data->idMaison;

  // Create service
  if($devis->create()) {
    echo json_encode(
      array('message' => 'Devis Created')
    );
  } else {
    echo json_encode(
      array('message' => 'Devis Not Created')
    );
  }


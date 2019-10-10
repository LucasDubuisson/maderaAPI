<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: DELETE');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

  include_once '../config/database.php';
  include_once '../objects/fournisseur.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate blog fournisseur object
  $fournisseur = new Fournisseur($db);

  // Get raw fournisseured data
  $data = json_decode(file_get_contents("php://input"));

  // Set ID to update
  $fournisseur->idFournisseur = $data->idFournisseur;

  // Delete fournisseur
  if($fournisseur->delete()) {
	      http_response_code(200);
    echo json_encode(
      array('message' => 'fournisseur Deleted')
    );
  } else {
	      http_response_code(404);
    echo json_encode(
      array('message' => 'fournisseur Not Deleted')
    );
  }


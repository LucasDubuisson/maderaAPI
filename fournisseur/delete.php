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
    echo json_encode(
      array('message' => 'fournisseur Deleted')
    );
  } else {
    echo json_encode(
      array('message' => 'fournisseur Not Deleted')
    );
  }


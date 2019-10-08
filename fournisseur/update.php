<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: PUT');
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
  $fournisseur->libelleFournisseur = $data->libelleFournisseur;
  $fournisseur->rueFournisseur = $data->rueFournisseur;
  $fournisseur->villeFournisseur = $data->villeFournisseur;
  $fournisseur->cpFournisseur = $data->cpFournisseur;
  $fournisseur->telFournisseur = $data->telFournisseur;
  $fournisseur->mailFournisseur = $data->mailFournisseur;
  $fournisseur->idFournisseur = $data->idFournisseur;

  // Update fournisseur
  if($fournisseur->update()) {
    echo json_encode(
      array('message' => 'fournisseur Updated')
    );
  } else {
    echo json_encode(
      array('message' => 'fournisseur Not Updated')
    );
  }


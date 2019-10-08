<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: DELETE');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

  include_once '../config/database.php';
  include_once '../objects/maison.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate blog maison object
  $maison = new Maison($db);

  // Get raw maisoned data
  $data = json_decode(file_get_contents("php://input"));

  // Set ID to update
  $maison->idMaison = $data->idMaison;

  // Delete maison
  if($maison->delete()) {
    echo json_encode(
      array('message' => 'maison Deleted')
    );
  } else {
    echo json_encode(
      array('message' => 'maison Not Deleted')
    );
  }


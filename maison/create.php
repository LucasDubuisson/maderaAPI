<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: POST');
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

  $maison->libelleMaison = $data->libelleMaison;
  $maison->dateCreationMaison = $data->dateCreationMaison;
  $maison->createdByUserIdMaison = $data->createdByUserIdMaison;

  // Create maison
  if($maison->create()) {
    echo json_encode(
      array('message' => 'maison Created')
    );
  } else {
    echo json_encode(
      array('message' => 'maison Not Created')
    );
  }


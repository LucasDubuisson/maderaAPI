<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: POST');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

  include_once '../config/database.php';
  include_once '../objects/direction.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate blog service object
  $direction = new Direction($db);

  // Get raw serviceed data
  $data = json_decode(file_get_contents("php://input"));

  $direction->libelleDirection = $data->libelleDirection;
  $direction->idDirection = $data->idDirection;

  // Create service
  if($direction->create()) {
    echo json_encode(
      array('message' => 'direction Created')
    );
  } else {
    echo json_encode(
      array('message' => 'direction Not Created')
    );
  }


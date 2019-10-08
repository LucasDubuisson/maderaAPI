<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: POST');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

  include_once '../config/database.php';
  include_once '../objects/service.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate blog service object
  $service = new Service($db);

  // Get raw serviceed data
  $data = json_decode(file_get_contents("php://input"));

  $service->libelleService = $data->libelleService;
  $service->commentaireService = $data->commentaireService;
  $service->idSite = $data->idSite;
  $service->idDirection = $data->idDirection;

  // Create service
  if($service->create()) {
    echo json_encode(
      array('message' => 'service Created')
    );
  } else {
    echo json_encode(
      array('message' => 'service Not Created')
    );
  }


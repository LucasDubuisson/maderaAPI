<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: PUT');
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

  // Set ID to update
 
  $service->libelleService = $data->libelleService;
  $service->commentaireService = $data->commentaireService;
  $service->idSite = $data->idSite;
  $service->idDirection = $data->idDirection;
  $service->idService = $data->idService;

  // Update service
  if($service->update()) {
    echo json_encode(
      array('message' => 'service Updated')
    );
  } else {
    echo json_encode(
      array('message' => 'service Not Updated')
    );
  }


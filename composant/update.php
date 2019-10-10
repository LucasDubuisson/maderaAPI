<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: PUT');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

  include_once '../config/database.php';
  include_once '../objects/composant.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate blog service object
  $composant = new Composant($db);

  // Get raw serviceed data
  $data = json_decode(file_get_contents("php://input"));

  // Set ID to update
 
  
  $composant->libelleComposant = $data->libelleComposant;
  $composant->caracterComposant = $data->caracterComposant;
  $composant->uniteUsageComposant = $data->uniteUsageComposant;
  $composant->idFamilleComposant = $data->idFamilleComposant;
  

  // Update service
  if($composant->update()) {
	    http_response_code(200);
    echo json_encode(
      array('message' => 'composant Updated')
    );
  } else {
	    http_response_code(404);
    echo json_encode(
      array('message' => 'composant Not Updated')
    );
  }


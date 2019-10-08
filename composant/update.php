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
  $composant->idFamille_Composant = $data->idFamille_Composant;
  

  // Update service
  if($composant->update()) {
    echo json_encode(
      array('message' => 'composant Updated')
    );
  } else {
    echo json_encode(
      array('message' => 'composant Not Updated')
    );
  }


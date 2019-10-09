<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: PUT');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

  include_once '../config/database.php';
  include_once '../objects/module.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate blog module object
  $module = new Module($db);

  // Get raw moduleed data
  $data = json_decode(file_get_contents("php://input"));

  // Set ID to update
  $module->libelleModule = $data->libelleModule;
  $module->natureModule = $data->natureModule;
  $module->caractModule = $data->caractModule;
  $module->uniteUsageModule = $data->uniteUsageModule;
  $module->finitionModule = $data->finitionModule;
  $module->typeIsolantModule = $data->typeIsolantModule;
  $module->typeCouvertureModule = $data->typeCouvertureModule;
  $module->huisseriesModule = $data->huisseriesModule;
  $module->idRegleCalcul = $data->idRegleCalcul;
  $module->idModule = $data->idModule;

  // Update module
  if($module->update()) {
    echo json_encode(
      array('message' => 'module Updated')
    );
  } else {
    echo json_encode(
      array('message' => 'module Not Updated')
    );
  }


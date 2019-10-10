<?php

  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../config/database.php';
  include_once '../objects/module.php';
  
  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();
  // Instantiate blog category object
  $module = new Module($db);

  // Get ID
  $module->idModule = isset($_GET['moduleId']) ? $_GET['moduleId'] : die();

  // Get post
  $module->read_one();

  // Create array
  $module_arr = array(
      "idModule" => $module->idModule,
      "libelleModule" => $module->libelleModule,
      "natureModule" => $module->natureModule,
      "uniteUsageModule" => $module->uniteUsageModule,
      "moduleFinition" => $module->moduleFinition,
	  "typeIsolantModule" => $module->typeIsolantModule,
      "typeCouvertureModule" => $module->typeCouvertureModule,
      "huisseriesModule" => $module->huisseriesModule,
      "idRegleCalcul" => $module->idRegleCalcul
  );

  // Make JSON
  http_response_code(200);
  print_r(json_encode($module_arr));
   // set response code - 200 OK 
}
 
else{
    // set response code - 404 Not found
    http_response_code(404);
 
    // tell the user product does not exist
    echo json_encode(array("message" => "Module does not exist."));
}

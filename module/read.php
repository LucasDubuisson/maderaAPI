<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../config/database.php';
  include_once '../objects/module.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate category object
  $module = new Module($db);

  // Category read query
  $result = $module->read();
  
  // Get row count
  $num = $result->rowCount();

  // Check if any categories
  if($num > 0) {
        // Cat array
        $module_arr = array();
        $module_arr['data'] = array();

        while($row = $result->fetch(PDO::FETCH_ASSOC)) {
          extract($row);

          $module_item = array(
			  "idModule" => $idModule,
			  "libelleModule" => $libelleModule,
			  "natureModule" => $natureModule,
			  "caractModule" => $caractModule,
			  "uniteUsageModule" => $uniteUsageModule,
			  "finitionModule" => $finitionModule,
			  "typeIsolantModule" => $typeIsolantModule,
			  "typeCouvertureModule" => $typeCouvertureModule,
			  "huisseriesModule" => $huisseriesModule,
			  "idRegleCalcul" => $idRegleCalcul
          );

          // Push to "data"
          array_push($module_arr['data'], $module_item);
        }
    http_response_code(200);
        // Turn to JSON & output
        echo json_encode($module_arr);

  } else {
	      http_response_code(404);
        // No Categories
        echo json_encode(
          array('message' => 'No Modules Found')
        );
  }

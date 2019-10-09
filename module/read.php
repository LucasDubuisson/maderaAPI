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

          // Push to "data"
          array_push($module_arr['data'], $module_item);
        }

        // Turn to JSON & output
        echo json_encode($module_arr);

  } else {
        // No Categories
        echo json_encode(
          array('message' => 'No Modules Found')
        );
  }

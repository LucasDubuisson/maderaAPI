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
  print_r(json_encode($module_arr));

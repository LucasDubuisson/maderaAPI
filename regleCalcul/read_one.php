<?php

  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../config/database.php';
  include_once '../objects/service.php';
  
  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();
  // Instantiate blog category object
  $service = new Service($db);

  // Get ID
  $service->idService = isset($_GET['serviceId']) ? $_GET['serviceId'] : die();

  // Get post
  $service->read_one();

  // Create array
  $service_arr = array(
      "idService" => $service->idService,
      "libelleService" => $service->libelleService,
      "commentaireService" => $service->commentaireService,
      "idSite" => $service->idSite,
      "idDirection" => $service->idDirection
  );

  // Make JSON
  print_r(json_encode($service_arr));

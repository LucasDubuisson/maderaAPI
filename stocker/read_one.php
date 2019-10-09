<?php

  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../config/database.php';
  include_once '../objects/stocker.php';
  
  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();
  // Instantiate blog category object
  $stocker = new Stocker($db);

  // Get ID
  $stocker->idStocker = isset($_GET['siteId']) ? $_GET['siteId'] : die();
  $stocker->idStocker = isset($_GET['productionsiteId']) ? $_GET['productionsiteId'] : die();
  $stocker->idStocker = isset($_GET['composantId']) ? $_GET['composantId'] : die();

  // Get post
  $stocker->read_one();

  // Create array
  $stocker_arr = array(
      "idSite" => $stocker->idSite,
      "idProductionSite" => $stocker->idProductionSite,
      "idComposant" => $stocker->idComposant,
      "quantite" => $stocker->quantite,
      "lastUpdateUserId" => $stocker->lastUpdateUserId
  );

  // Make JSON
  print_r(json_encode($stocker_arr));

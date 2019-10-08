<?php

  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../config/database.php';
  include_once '../objects/direction.php';
  
  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();
  // Instantiate blog category object
  $direction = new Direction($db);

  // Get ID
  $direction->idDirection = isset($_GET['directionId']) ? $_GET['directionId'] : die();

  // Get post
  $direction->read_one();

  // Create array
  $direction_arr = array(
      "idDirection" => $direction->idDirection,
      "libelleDirection" => $direction->libelleDirection
      
  );

  // Make JSON
  print_r(json_encode($direction_arr));

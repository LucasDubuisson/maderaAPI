<?php

  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../config/database.php';
  include_once '../objects/familleComposant.php';
  
  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();
  // Instantiate blog category object
  $familleComposant = new FamilleComposant($db);

  // Get ID
  $familleComposant->idFamilleComposant = isset($_GET['familleComposantId']) ? $_GET['familleComposantId'] : die();

  // Get post
  $familleComposant->read_one();

  // Create array
  $familleComposant_arr = array(
      "idFamilleComposant" => $familleComposant->idFamilleComposant,
      "libelleFamilleComposant" => $familleComposant->libelleFamilleComposant
  );

  // Make JSON
  print_r(json_encode($familleComposant_arr));

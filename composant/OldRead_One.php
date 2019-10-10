<?php

  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../config/database.php';
  include_once '../objects/composant.php';
  
  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();
  // Instantiate blog category object
  $composant = new Composant($db);

  // Get ID
  $composant->idComposant = isset($_GET['composantId']) ? $_GET['composantId'] : die();

  // Get post
  $composant->read_one();

  // Create array
  $composant_arr = array(
		"idComposant" => $composant->idComposant,
		"libelleComposant" => $composant->libelleComposant,
		"caracterComposant" => $composant->caracterComposant,
		"uniteUsageComposant" => $composant->uniteUsageComposant,
		"idFamilleComposant" => $composant->idFamilleComposant
  );

  // Make JSON
  print_r(json_encode($composant_arr));

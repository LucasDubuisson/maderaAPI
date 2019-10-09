<?php

  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../config/database.php';
  include_once '../objects/regleCalcul.php';
  
  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();
  // Instantiate blog category object
  $regleCalcul = new RegleCalcul($db);

  // Get ID
  $regleCalcul->idRegleCalcul = isset($_GET['regleCalculId']) ? $_GET['regleCalculId'] : die();

  // Get post
  $regleCalcul->read_one();

  // Create array
  $regleCalcul_arr = array(
            "idRegleCalcul" => $idRegleCalcul,
            "ennonceRegleCalcul" => $ennonceRegleCalcul,
            "regleRegleCalcul" => $regleRegleCalcul
  );

  // Make JSON
  print_r(json_encode($regleCalcul_arr));

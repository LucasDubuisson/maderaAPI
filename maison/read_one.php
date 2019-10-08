<?php

  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../config/database.php';
  include_once '../objects/maison.php';
  
  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();
  // Instantiate blog category object
  $maison = new Maison($db);

  // Get ID
  $maison->idMaison = isset($_GET['maisonId']) ? $_GET['maisonId'] : die();

  // Get post
  $maison->read_one();

  // Create array
  $maison_arr = array(
      "idMaison" => $maison->idMaison,
      "libelleMaison" => $maison->libelleMaison,
      "dateCreationMaison" => $maison->dateCreationMaison,
      "createdByUserIdMaison" => $maison->createdByUserIdMaison
  );

  // Make JSON
  print_r(json_encode($maison_arr));

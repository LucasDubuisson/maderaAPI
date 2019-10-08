<?php

  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../config/database.php';
  include_once '../objects/dossierTechnique.php';
  
  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();
  // Instantiate blog category object
  $dossier = new Dossier($db);

  // Get ID
  $dossier->idDossier = isset($_GET['dossierId']) ? $_GET['dossierId'] : die();

  // Get post
  $dossier->read_one();

  // Create array
  $dossier_arr = array(
      "idDossier" => $dossier->idDossier,
      "libelleDossier" => $dossier->libelleDossier,
      "resumeEnML" => $dossier->resumeEnML,
      "idDevis" => $dossier->idDevis
  );

  // Make JSON
  print_r(json_encode($dossier_arr));

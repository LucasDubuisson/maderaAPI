<?php

  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../config/database.php';
  include_once '../objects/devis.php';
  
  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();
  // Instantiate blog category object
  $devis = new Devis($db);

  // Get ID
  $devis->idDevis = isset($_GET['devisId']) ? $_GET['devisId'] : die();

  // Get post
  $devis->read_one();

  // Create array
  $devis_arr = array(
      		"idDevis" => $idDevis, 
			"prixDevis" =>  $prixDevis,
			"etatDevis" =>  $etatDevis, 
			"dateDevis" =>  $dateDevis,
			"dateEvolutionDevis" =>  $dateEvolutionDevis, 
			"avancementDevisByUserId" =>  $avancementDevisByUserId,
			"idDossier" =>  $idDossier, 
			"idMaison" =>  $idMaison
			);

  // Make JSON
  print_r(json_encode($devis_arr));

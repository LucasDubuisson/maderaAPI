<?php

  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../config/database.php';
  include_once '../objects/fournisseur.php';
  
  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();
  // Instantiate blog category object
  $fournisseur = new Fournisseur($db);

  // Get ID
  $fournisseur->idFournisseur = isset($_GET['fournisseurId']) ? $_GET['fournisseurId'] : die();

  // Get post
  $fournisseur->read_one();

  // Create array
  $fournisseur_arr = array(
			"idFournisseur" => $fournisseur->idFournisseur,
            "libelleFournisseur" => $fournisseur->libelleFournisseur,
            "rueFournisseur" => $fournisseur->rueFournisseur,
            "villeFournisseur" => $fournisseur->villeFournisseur,
			"cpFournisseur" => $fournisseur->cpFournisseur,
            "telFournisseur" => $fournisseur->telFournisseur,
            "mailFournisseur" => $fournisseur->mailFournisseur
  );

  // Make JSON
  print_r(json_encode($fournisseur_arr));

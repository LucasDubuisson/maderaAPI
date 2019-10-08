<?php

  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../config/database.php';
  include_once '../objects/commande.php';
  
  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();
  // Instantiate blog category object
  $commande = new Commande($db);

  // Get ID
  $commande->idCommande = isset($_GET['commandeId']) ? $_GET['commandeId'] : die();

  // Get post
  $commande->read_one();

  // Create array
  $commande_arr = array(
	"idCommande" => $commande->idCommande,
	"dateCommande" => $commande->dateCommande,
	"dateLivraisonCommande" => $commande->dateLivraisonCommande,
	"margeCommercialCommande" => $commande->margeCommercialCommande,
	"margeEntrepriseCommande" => $commande->margeEntrepriseCommande,
	"statusCommande" => $commande->statusCommande,
	"idDevis" => $commande->idDevis
  );

  // Make JSON
  print_r(json_encode($commande_arr));

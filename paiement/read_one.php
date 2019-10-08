<?php

  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../config/database.php';
  include_once '../objects/paiement.php';
  
  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();
  // Instantiate blog category object
  $paiement = new Paiement($db);

  // Get ID
  $paiement->idPaiement = isset($_GET['paiementId']) ? $_GET['paiementId'] : die();

  // Get post
  $paiement->read_one();

  // Create array
  $paiement_arr = array(
            "idPaiement" => $paiement->idPaiement,
            "signaturePaiement" => $paiement->signaturePaiement,
            "permisConstruirePaiement" => $paiement->permisConstruirePaiement,
            "OuvertureChantierPaiement" => $paiement->OuvertureChantierPaiement,
            "achevementFondationPaiement" => $paiement->achevementFondationPaiement,
			"achevementMurPaiement" => $paiement->achevementMurPaiement,
            "misHorsDeauPaiement" => $paiement->misHorsDeauPaiement,
            "achevementTravauxPaiement" => $paiement->achevementTravauxPaiement,
			"remiseClePaiement" => $paiement->remiseClePaiement,
			"statutPaiement" => $paiement->statutPaiement,
            "dateDernierPaiement" => $paiement->dateDernierPaiement,
            "idCommande" => $paiement->idCommande

  );

  // Make JSON
  print_r(json_encode($paiement_arr));

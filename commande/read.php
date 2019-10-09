<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../config/database.php';
  include_once '../objects/commande.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate category object
  $commande = new Commande($db);

  // Category read query
  $result = $commande->read();
  
  // Get row count
  $num = $result->rowCount();

  // Check if any categories
  if($num > 0) {
        // Cat array
        $commande_arr = array();
        $commande_arr['data'] = array();

        while($row = $result->fetch(PDO::FETCH_ASSOC)) {
          extract($row);

          $commande_item = array(
			"idCommande" => $idCommande,
            "dateCommande" => $dateCommande,
            "dateLivraisonCommande" => $dateLivraisonCommande,
            "margeCommercialCommande" => $margeCommercialCommande,
            "margeEntrepriseCommande" => $margeEntrepriseCommande,
			"statusCommande" => $statusCommande,
            "idDevis" => $idDevis
          );

          // Push to "data"
          array_push($commande_arr['data'], $commande_item);
        }

        // Turn to JSON & output
        echo json_encode($commande_arr);

  } else {
        // No Categories
        echo json_encode(
          array('message' => 'No Services Found')
        );
  }

<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../config/database.php';
  include_once '../objects/devis.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate category object
  $devis = new Devis($db);

  // Category read query
  $result = $devis->read();
  
  // Get row count
  $num = $result->rowCount();

  // Check if any categories
  if($num > 0) {
        // Cat array
        $devis_arr = array();
        $devis_arr['data'] = array();

        while($row = $result->fetch(PDO::FETCH_ASSOC)) {
          extract($row);

          $devis_item = array(
			"idDevis" => $idDevis, 
			"prixDevis" =>  $prixDevis,
			"etatDevis" =>  $etatDevis, 
			"dateDevis" =>  $dateDevis,
			"dateEvolutionDevis" =>  $dateEvolutionDevis, 
			"avancementDevisByUserId" =>  $avancementDevisByUserId,
			"idDossier" =>  $idDossier, 
			"idMaison" =>  $idMaison
          );

          // Push to "data"
          array_push($devis_arr['data'], $devis_item);
        }
		  http_response_code(200);
        // Turn to JSON & output
        echo json_encode($devis_arr);

  } else {
	    http_response_code(404);
        // No Categories
        echo json_encode(
          array('message' => 'No Devis Found')
        );
  }

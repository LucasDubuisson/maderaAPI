<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../config/database.php';
  include_once '../objects/fournisseur.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate category object
  $fournisseur = new Fournisseur($db);

  // Category read query
  $result = $fournisseur->read();
  
  // Get row count
  $num = $result->rowCount();

  // Check if any categories
  if($num > 0) {
        // Cat array
        $fournisseur_arr = array();
        $fournisseur_arr['data'] = array();

        while($row = $result->fetch(PDO::FETCH_ASSOC)) {
          extract($row);

          $fournisseur_item = array(
            "idFournisseur" => $idFournisseur,
            "libelleFournisseur" => $libelleFournisseur,
            "rueFournisseur" => $rueFournisseur,
            "villeFournisseur" => $villeFournisseur,
			"cpFournisseur" => $cpFournisseur,
            "telFournisseur" => $telFournisseur,
            "mailFournisseur" => $mailFournisseur
          );

          // Push to "data"
          array_push($fournisseur_arr['data'], $fournisseur_item);
        }
		    http_response_code(200);
        // Turn to JSON & output
        echo json_encode($fournisseur_arr);

  } else {
	      http_response_code(404);
        // No Categories
        echo json_encode(
          array('message' => 'No Fournisseurs Found')
        );
  }

<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../config/database.php';
  include_once '../objects/paiement.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate category object
  $paiement = new Paiement($db);

  // Category read query
  $result = $paiement->read();
  
  // Get row count
  $num = $result->rowCount();

  // Check if any categories
  if($num > 0) {
        // Cat array
        $paiement_arr = array();
        $paiement_arr['data'] = array();

        while($row = $result->fetch(PDO::FETCH_ASSOC)) {
          extract($row);

          $paiement_item = array(
            "idPaiement" => $idPaiement,
            "signaturePaiement" => $signaturePaiement,
            "permisConstruirePaiement" => $permisConstruirePaiement,
            "OuvertureChantierPaiement" => $OuvertureChantierPaiement,
            "achevementFondationPaiement" => $achevementFondationPaiement,
			"achevementMurPaiement" => $achevementMurPaiement,
            "misHorsDeauPaiement" => $misHorsDeauPaiement,
            "achevementTravauxPaiement" => $achevementTravauxPaiement,
			"remiseClePaiement" => $remiseClePaiement,
			"statutPaiement" => $statutPaiement,
            "dateDernierPaiement" => $dateDernierPaiement,
            "idCommande" => $idCommande
          );

          // Push to "data"
          array_push($paiement_arr['data'], $paiement_item);
        }
		    http_response_code(200);
        // Turn to JSON & output
        echo json_encode($paiement_arr);

  } else {
	      http_response_code(404);
        // No Categories
        echo json_encode(
          array('message' => 'No Paiements Found')
        );
  }

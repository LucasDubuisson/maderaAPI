<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: PUT');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

  include_once '../config/database.php';
  include_once '../objects/paiement.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate blog paiement object
  $paiement = new Paiement($db);

  // Get raw paiemented data
  $data = json_decode(file_get_contents("php://input"));

  // Set ID to update
 
  
  $paiement->signaturePaiement = $data->signaturePaiement;
  $paiement->permisConstruirePaiement = $data->permisConstruirePaiement;
  $paiement->OuvertureChantierPaiement = $data->OuvertureChantierPaiement;
  $paiement->achevementFondationPaiement = $data->achevementFondationPaiement;
  $paiement->achevementMurPaiement = $data->achevementMurPaiement;
  $paiement->misHorsDeauPaiement = $data->misHorsDeauPaiement;
  $paiement->achevementTravauxPaiement = $data->achevementTravauxPaiement;
  $paiement->remiseClePaiement = $data->remiseClePaiement;
  $paiement->statutPaiement = $data->statutPaiement;
  $paiement->idCommande = $data->idCommande;
  $paiement->idPaiement= $data->idPaiement;


  // Update paiement
  if($paiement->update()) {
	      http_response_code(200);
    echo json_encode(
      array('message' => 'paiement Updated')
    );
  } else {
	      http_response_code(404);
    echo json_encode(
      array('message' => 'paiement Not Updated')
    );
  }


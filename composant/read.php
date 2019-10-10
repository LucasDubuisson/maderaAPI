<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../config/database.php';
  include_once '../objects/composant.php';
  include_once '../objects/stocker.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate category object
  $composant = new Composant($db);
  
  		$stockerLille= new Stocker($db);
		$stockerLille->idSite=1;
		$stockerLille->idProduction=1;
		
		$stockerDax= new Stocker($db);
		$stockerDax->idSite=2;
		$stockerDax->idProduction=2;
		
		$stockerAnnecy=new Stocker($db);
		$stockerAnnecy->idSite=3;
		$stockerAnnecy->idProduction=3;

  // Category read query
  $result = $composant->read();
  
  // Get row count
  $num = $result->rowCount();

  // Check if any categories
  if($num > 0) {
        // Cat array
        $composant_arr = array();
        $composant_arr['data'] = array();
		

		
        while($row = $result->fetch(PDO::FETCH_ASSOC)) {
          extract($row);
		  
		  $stockerLille->idComposant=$idComposant;
		  $stockerLille->readStockComposantBySite();
		  $stockerDax->idComposant=$idComposant;
		  $stockerDax->readStockComposantBySite();
		  $stockerAnnecy->idComposant=$idComposant;
		  $stockerAnnecy->readStockComposantBySite();
		  
          $composant_item = array(
            "idComposant" => $idComposant,
            "libelleComposant" => $libelleComposant,
            "caracterComposant" => $caracterComposant,
            "uniteUsageComposant" => $uniteUsageComposant,
			"quantite" => array("Lille" =>$stockerLille->quantite,"Dax" =>$stockerDax->quantite,"Annecy" =>$stockerAnnecy->quantite),
            "modifier"=>"http://localhost:8100/stock-detail/".$idComposant,
            "idFamilleComposant" => $idFamilleComposant
          );

          // Push to "data"
          array_push($composant_arr['data'], $composant_item);
        }
		  http_response_code(200);
        // Turn to JSON & output
        echo json_encode($composant_arr);

  } else {
	    http_response_code(404);
        // No Categories
        echo json_encode(
          array('message' => 'No composant Found')
        );
  }

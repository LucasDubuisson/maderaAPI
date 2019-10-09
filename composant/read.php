<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../config/database.php';
  include_once '../objects/composant.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate category object
  $composant = new Composant($db);

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

          $composant_item = array(
            "idComposant" => $idComposant,
            "libelleComposant" => $libelleComposant,
            "caracterComposant" => $caracterComposant,
            "uniteUsageComposant" => $uniteUsageComposant,
            "idFamilleComposant" => $idFamilleComposant
          );

          // Push to "data"
          array_push($composant_arr['data'], $composant_item);
        }

        // Turn to JSON & output
        echo json_encode($composant_arr);

  } else {
        // No Categories
        echo json_encode(
          array('message' => 'No composant Found')
        );
  }

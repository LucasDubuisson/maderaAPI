<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../config/database.php';
  include_once '../objects/regleCalcul.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate category object
  $regleCalcul = new RegleCalcul($db);

  // Category read query
  $result = $regleCalcul->read();
  
  // Get row count
  $num = $result->rowCount();

  // Check if any categories
  if($num > 0) {
        // Cat array
        $regleCalcul_arr = array();
        $regleCalcul_arr['data'] = array();

        while($row = $result->fetch(PDO::FETCH_ASSOC)) {
          extract($row);

          $regleCalcul_item = array(
            "idRegleCalcul" => $idRegleCalcul,
            "ennonceRegleCalcul" => $ennonceRegleCalcul,
            "regleRegleCalcul" => $regleRegleCalcul
          );

          // Push to "data"
          array_push($regleCalcul_arr['data'], $regleCalcul_item);
        }

        // Turn to JSON & output
        echo json_encode($regleCalcul_arr);

  } else {
        // No Categories
        echo json_encode(
          array('message' => 'No RegleCalculs Found')
        );
  }

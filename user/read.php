<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../config/database.php';
  include_once '../objects/user.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate category object
  $user = new User($db);

  // Category read query
  $result = $user->read();
  
  // Get row count
  $num = $result->rowCount();

  // Check if any categories
  if($num > 0) {
        // Cat array
        $user_arr = array();
        $user_arr['data'] = array();

        while($row = $result->fetch(PDO::FETCH_ASSOC)) {
          extract($row);

          $user_item = array(
			  "idUser" => $idUser,
			  "nomUser" => $nomUser,
			  "prenomUser" => $prenomUser,
			  "passwordUser" => $passwordUser,
			  "telUser" => $telUser,
			  "mailUser" => $mailUser,
			  "villeUser" => $villeUser,
			  "rueUser" => $rueUser,
			  "cpUser"=>$cpUser,
			  "dateDeNaissanceUser"=>$dateDeNaissanceUser,
			  "idService" => $idService
          );

          // Push to "data"
          array_push($user_arr['data'], $user_item);
        }
		http_response_code(200);
        // Turn to JSON & output
        echo json_encode($user_arr);

  } else {
	  http_response_code(404);
        // No Categories
        echo json_encode(
          array('message' => 'No Users Found')
        );
  }

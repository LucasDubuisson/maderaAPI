<?php

  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../config/database.php';
  include_once '../objects/user.php';
  
  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();
  // Instantiate blog category object
  $utilisateur = new User($db);

  // Get ID
  $utilisateur->idUser = isset($_GET['userId']) ? $_GET['userId'] : die();

  // Get post
  $utilisateur->read_one();
if ($utilisateur->nomUser!=null)
{
  // Create array
  $user_arr = array(
    	"idUser" => $utilisateur->idUser,
		"nomUser" => $utilisateur->nomUser,
		"prenomUser" => $utilisateur->prenomUser,
		"passwordUser" => $utilisateur->passwordUser,
		"telUser" => $utilisateur->telUser,
		"mailUser" => $utilisateur->mailUser,
		"villeUser" => $utilisateur->villeUser,
		"rueUser" => $utilisateur->rueUser,
		"cpUser"=>$utilisateur->cpUser,
		"dateDeNaissanceUser"=>$utilisateur->dateDeNaissanceUser,
		"idService" => $utilisateur->idService
  );

  // Make JSON
  http_response_code(200);
  print_r(json_encode($user_arr));
   // set response code - 200 OK 
}
 
else{
    // set response code - 404 Not found
    http_response_code(404);
 
    // tell the user product does not exist
    echo json_encode(array("message" => "User does not exist."));
}

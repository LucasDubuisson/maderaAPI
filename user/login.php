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
  $message="";
  // Get ID
  $utilisateur->usernameUser = isset($_GET['username']) ? $_GET['username'] : die();
  $utilisateur->passwordUser = isset($_GET['pwd']) ? $_GET['pwd'] : die();
  
  $utilisateur->loginByUsernameAndPwd();

  // Check if any categories
  if($utilisateur->idUser <> "") {
     $utilisateur_arr = array(
        "idUser" => $utilisateur->idUser,
		"nomUser" => $utilisateur->nomUser,
		"prenomUser" => $utilisateur->prenomUser,
       	"usernameUser" => $utilisateur->usernameUser,
		"passwordUser" => $utilisateur->passwordUser

  );

  // Make JSON
  print_r(json_encode($utilisateur_arr));
	//$message='Bonjour '.$utilisateur->nomUser.' '.$utilisateur->prenomUser.' ('.$utilisateur->idUser.')';
  } 
  else 
  {	
	  $user=new User($db);
	  $user->usernameUser = isset($_GET['username']) ? $_GET['username'] : die();
	  // Category read query
	  $result = $user->findUserByUsername();
	  // Get row count
	  $num = $result->rowCount();

	  if($num > 0) {
		$message='Mot de passe incorrect';
	  }
	  else
	  {		 
		$message='Username incorrect ou inexistant';
	  }
      print_r(json_encode(array('Connexion' => $message)));
  }
 

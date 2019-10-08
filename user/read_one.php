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
  print_r(json_encode($user_arr));

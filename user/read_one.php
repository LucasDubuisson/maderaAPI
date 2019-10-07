<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');

// include database and object files
include_once '../config/database.php';
include_once '../objects/user.php';

// get database connection
$database = new Database();
$db = $database->getConnection();

// prepare product object
$UnUser = new User($db);

// set ID property of product to be edited
$UnUser->idUser = isset($_GET['idUser']) ? $_GET['idUser'] : die();

// read the details of product to be edited
$UnUser->readOne();

// create array
$UnUser_arr = array(
  "idUser" =>  $UnUser->idUser,
  "nomUser" => $UnUser->nomUser,
  "prenomUser" => $UnUser->prenomUser
);

// make it json format
print_r(json_encode($UnUser_arr));
?>

<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json; charset=UTF-8');

include_once '../config/database.php';
include_once '../objects/user.php';

$database = new Database();
$db = $database->getConnection();

$user = new user($db);

$stmt = $user->read();
$num = $stmt->rowCount();

if($num>0){
  $user_arr=array();
  $user_arr["users"]=array();

  while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
    extract($row);

    $user_item=array(
      "PRA_NUM" => $PRA_NUM,
      "PRA_NOM" => $PRA_NOM,
      "PRA_PRENOM" => $PRA_PRENOM,
      "PRA_CP" => $PRA_CP,
      "PRA_ADRESSE" => $PRA_ADRESSE,
      "PRA_VILLE" => $PRA_VILLE,
      "PRA_COEFNOTORIETE" => $PRA_COEFNOTORIETE,
      "dep" => $dep,
      "TYP_LIEU" => $TYP_LIEU
    );

    array_push($user_arr["users"], $user_item);
  }

  echo json_encode($user_arr);
}
else{
  echo json_encode(
    array("message" => "Aucun users trouvés.")
  );
}
?>

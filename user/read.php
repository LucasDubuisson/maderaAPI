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
      "idSite" => $idSite,
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

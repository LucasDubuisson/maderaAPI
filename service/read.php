<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json; charset=UTF-8');

include_once '../config/database.php';
include_once '../objects/service.php';

$database = new Database();
$db = $database->getConnection();

$service = new Service($db);

$stmt = $service->read();
//$num = $stmt->rowCount();
echo $stmt;
//if($num>0){
  $service_arr=array();
  $service_arr["services"]=array();

  while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
    extract($row);

    $service_item=array(
      "idService" => $idService,
      "libelleService" => $libelleService,
      "commentaireService" => $commentaireService,
      "idSite" => $idSite,
      "idDirection" => $idDirection
    );

    array_push($service_arr["services"], $service_item);
  }

  echo json_encode($service_arr);
/*}
else{
  echo json_encode(
    array("message" => "Aucun services trouvés.")
  );
}*/
?>

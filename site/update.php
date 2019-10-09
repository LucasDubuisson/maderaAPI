<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: PUT');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

  include_once '../config/database.php';
  include_once '../objects/site.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate blog site object
  $site = new Site($db);

  // Get raw siteed data
  $data = json_decode(file_get_contents("php://input"));

  // Set ID to update

  $site->libelleSite = $data->libelleSite;
  $site->villeSite = $data->villeSite;
  $site->rueSite = $data->rueSite;
  $site->cpSite = $data->cpSite;
  $site->mailSite = $data->mailSite;
  $site->telSite = $data->telSite;
  $site->activiteSite = $data->activiteSite;
  $site->entrepotSite = $data->entrepotSite;
  $site->locauxSite = $data->locauxSite;

  $site->idSite = $data->idSite;

  // Update site
  if($site->update()) {
    echo json_encode(
      array('message' => 'site Updated')
    );
  } else {
    echo json_encode(
      array('message' => 'site Not Updated')
    );
  }


<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: POST');
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

  $site->libelleSite = $data->libelleSite;
  $site->villeSite = $data->villeSite;
  $site->rueSite = $data->rueSite;
  $site->cpSite = $data->cpSite;
  $site->mailSite = $data->mailSite;
  $site->telSite = $data->telSite;
  $site->activiteSite = $data->activiteSite;
  $site->entrepotSite = $data->entrepotSite;
  $site->locauxSite = $data->locauxSite;

  // Create site
  if($site->create()) {
	  http_response_code(200);
    echo json_encode(
      array('message' => 'site Created')
    );
  } else {
	  http_response_code(404);
    echo json_encode(
      array('message' => 'site Not Created')
    );
  }


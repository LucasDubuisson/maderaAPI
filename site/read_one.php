<?php

  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../config/database.php';
  include_once '../objects/site.php';
  
  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();
  // Instantiate blog category object
  $site = new Site($db);

  // Get ID
  $site->idSite = isset($_GET['siteId']) ? $_GET['siteId'] : die();

  // Get post
  $site->read_one();

  // Create array
  $site_arr = array(
            "idSite" => $site->idSite,
            "libelleSite" => $site->libelleSite,
            "villeSite" => $site->villeSite,
            "rueSite" => $site->rueSite,
            "cpSite" => $site->cpSite,
            "mailSite" => $site->mailSite,
            "telSite" => $site->telSite,
            "activiteSite" => $site->activiteSite,
            "entrepotSite" => $site->entrepotSite,
            "locauxSite" => $site->locauxSite
     
  );

  // Make JSON
  http_response_code(200);
  print_r(json_encode($site_arr));
   // set response code - 200 OK 
}
 
else{
    // set response code - 404 Not found
    http_response_code(404);
 
    // tell the user product does not exist
    echo json_encode(array("message" => "Site does not exist."));
}

<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../config/database.php';
  include_once '../objects/site.php';

  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();

  // Instantiate category object
  $site = new Site($db);

  // Category read query
  $result = $site->read();
  
  // Get row count
  $num = $result->rowCount();

  // Check if any categories
  if($num > 0) {
        // Cat array
        $site_arr = array();
        $site_arr['data'] = array();

        while($row = $result->fetch(PDO::FETCH_ASSOC)) {
          extract($row);
          
          $site_item = array(
            "idSite" => $idSite,
            "libelleSite" => $libelleSite,
            "villeSite" => $villeSite,
            "rueSite" => $rueSite,
            "cpSite" => $cpSite,
            "mailSite" => $mailSite,
            "telSite" => $telSite,
            "activiteSite" => $activiteSite,
            "entrepotSite" => $entrepotSite,
            "locauxSite" => $locauxSite
          );

          // Push to "data"
          array_push($site_arr['data'], $site_item);
        }
		http_response_code(200);
        // Turn to JSON & output
        echo json_encode($site_arr);

  } else {
	  http_response_code(404);
        // No Categories
        echo json_encode(
          array('message' => 'No Sites Found')
        );
  }

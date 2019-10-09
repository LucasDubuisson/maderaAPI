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
  print_r(json_encode($site_arr));

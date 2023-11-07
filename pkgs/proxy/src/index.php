<?php

	
  try{

    ini_set('error_log', './error.log');
    error_reporting(E_ALL);

    require_once('./vendor/autoload.php');

    require_once('./lib/debug.php');
    require_once('./lib/session.php');

    $service = $_GET['service'];
    $call = $_GET['call'];

    $res = new stdClass();
    $debug = set_debug_mode();

    $sss = session_init();

    $debug->service = $service;
    $debug->call = $call;

    $res->debug = $debug;
    $res->session = $sss;


    switch ($service) {
      case 'ping':
          // Handle ping...
          header('Content-Type: application/json');
          echo json_encode($res);
          break;
      case 'reset':
          // Handle reset...
          break;
      case 'mirror':
          // Handle reset...
          break;
      case 'playground':
          // Handle playground
          require_once('./api/playground.php');
          break;
      case 'auth':
          // Handle auth...
          require_once('./api/auth.php');
          break;
      case 'forward':
          // Handle forward...
          break;
      default:
        // Handle unknown route...
        header('Content-Type: application/json');
        header("HTTP/1.0 404 Not Found");
        echo json_encode(['error' => 'Unknown route','debug' => $debug]);
        break;
    }

  } catch (Exception $e) {

    error_log($e->getMessage());

    // Return an error response...
    //header('Content-Type: application/json');
    //echo json_encode(['error' => 'An error occurred while processing your request.' + $e]);
    echo "An error occurred: " . $e->getMessage();


  }

?>
<?php

  try{

    include 'session.php';
    include 'proxy.php';
    include 'firebase.php';


    header('Content-Type: application/json');

    // create session id and csrf token
    sessionInit();

    $uri = ltrim($_SERVER['REQUEST_URI'], '/');

    switch ($uri) {
        case 'ping':
            // Handle ping...
            echo json_encode(['ping' => 'hello']);
            break;
        case 'reset':
            // Handle reset...
            break;
        case 'forward':
            // Handle forward...
            break;
        default:
          // Handle unknown route...
          header("HTTP/1.0 404 Not Found");
          echo json_encode(['error' => 'Unknown route']);
    }

    echo "$_SERVER['REQUEST_URI']";
        

  } catch (Exception $e) {

    error_log($e->getMessage());

    // Return an error response...
    header('Content-Type: application/json');
    echo json_encode(['error' => 'An error occurred while processing your request.']);


  }

?>
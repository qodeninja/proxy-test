<?php

function proxyFactory($baseUrl, $headers = []) {

  return function($endpoint, $data) use ($baseUrl, $headers) {
      $ch = curl_init("$baseUrl/$endpoint");
      
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
      
      if (!empty($headers)) {
          curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
      }

      $response = curl_exec($ch);
      
      curl_close($ch);

      return $response;
  };
  
}


  function proxy_request($url,$method = 'POST'){
    // Initialize a CURL session
    $ch = curl_init();

    // Set the options for the CURL session
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $requestMethod);

    // If the request method is POST or PUT, add the request body
    if ($requestMethod == 'POST' || $requestMethod == 'PUT') {
        curl_setopt($ch, CURLOPT_POSTFIELDS, file_get_contents('php://input'));
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
    }

    // Execute the CURL session and fetch the response
    $response = curl_exec($ch);

    // If there was an error, print it
    if (curl_errno($ch)) {
        $error = 'Error:' . curl_error($ch);
        echo json_encode(['error' => $error]);
        file_put_contents('errors.log', $error . "\n", FILE_APPEND);
        exit();
    }

    // Close the CURL session
    curl_close($ch);
  }

?>
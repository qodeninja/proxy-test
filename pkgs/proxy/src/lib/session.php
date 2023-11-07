<?php



  // Verify CSRF token for POST requests
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $clientToken = $_SERVER['HTTP_X_CSRF_TOKEN'] ?? '';
    if (!hash_equals($csrfToken, $clientToken)) {
        http_response_code(403);
        echo json_encode(['error' => 'Invalid CSRF token']);
        exit();
    }
  }

  function createCookie(){
    return true;
  }

  function requireCookie(){
    return true;
  }

  function cookie_nuke(){
    if (isset($_SERVER['HTTP_COOKIE'])) {
      $cookies = explode(';', $_SERVER['HTTP_COOKIE']);
      foreach($cookies as $cookie) {
        $parts = explode('=', $cookie);
        $name = trim($parts[0]);
        setcookie($name, '', time()-1000);
        setcookie($name, '', time()-1000, '/');
      }
    }
  }

  function gen_csrf($size=32){
    return bin2hex(random_bytes($size));
  }

  function set_csrf(){
    $token =cookie_csrf();
    return $token;
  }

  function cookie_csrf(){
    if (!isset($_COOKIE['CSRF_TOKEN'])) {
      $csrfToken = gen_csrf();
      setcookie('CSRF_TOKEN', $csrfToken, [
        'expires' => time() + 3600,
        'path' => '/',
        'secure' => true,  // using HTTPS
        'httponly' => true,
        'samesite' => 'Strict',
      ]);
    } else {
      $csrfToken = $_COOKIE['CSRF_TOKEN'];
    }
    session_csrf($csrfToken);
    return $csrfToken;
  }

  function session_csrf($token){
    if (!isset($_SESSION['CSRF_TOKEN'])) {
      $_SESSION['CSRF_TOKEN'] = $token;
    }
    return $_SESSION['CSRF_TOKEN'];
  }

  function session_kill(){
    //setcookie(session_name(), session_id(), 1); // to expire the session
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
    $_SESSION = [];
    cookie_nuke();
  }

  function session_init(){
    session_start();
    $id = session_id();
    $sss = new stdClass();
    $sss->id = $id;
    $sss->csrf = set_csrf();
    return $sss;
  }


?>
<?

	header('Content-Type: application/json');

    switch ($call) {
      case 'login':
        $res->msg = "did you login";
        break;
      case 'logout':
        $res->msg  = "did you logout";
        break;
      default:
        // Handle unknown route...
      	$res->msg  = "nope";
    }

    print_r($res);

?>
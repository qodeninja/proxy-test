<?

	function set_debug_mode($force_dev_mode = false){

		$debug = new stdClass();


		if ( isset($_GET['dev_mode']) || $force_dev_mode ){
			$debug->dev_mode = true;
			if (isset($_GET['debug'])) {
		    if ($_GET['debug'] == '1'){ setcookie('DEBUG', '1', time() + 3600 * 8, '/'); }
		    if ($_GET['debug'] == '0'){ setcookie('DEBUG', '', -1, '/'); }
			}
		}


	  if ( isset($_GET['debug']) && $_GET['debug'] == '1' || isset($_COOKIE['DEBUG'])) {
	    define('DEBUG', true);
	  } else {
	    define('DEBUG', false);
	  }


	  // Check if we're in development mode
	  if (DEBUG) {
	  	error_reporting(E_ALL);
      	ini_set('display_errors', 1);
      	ini_set('display_startup_errors', 1);
      //$debug->error=false;
	  } else {
	  	error_reporting(0);
      	ini_set('display_errors', 0);
      	ini_set('display_startup_errors', 0);
	  }

	  $debug->uri = ltrim($_SERVER['REQUEST_URI'], '/');

	  $debug->base_url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
	  $debug->cookies = $_COOKIE;

		return $debug;

	}


?>
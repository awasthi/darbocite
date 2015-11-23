<?php
/**
@author muni
@copyright http:www.smarttutorials.net
 */

require_once 'messages.php';

//site specific configuration declartion
define( 'BASE_PATH', 'http://www.darbocite.com/google_login/');
define( 'DB_HOST', 'localhost' );
define( 'DB_USERNAME', 'root');
define( 'DB_PASSWORD', '');
define( 'DB_NAME', 'user_login');

//Google App Details
define('GOOGLE_APP_NAME', 'Darbocite');
define('GOOGLE_OAUTH_CLIENT_ID', '1007180659946-gsekk8nj57iio0752d0i0pigehct2l4a.apps.googleusercontent.com');
define('GOOGLE_OAUTH_CLIENT_SECRET', 'pwqCrmUolHYEEpK88JazK_0V');
define('GOOGLE_OAUTH_REDIRECT_URI', 'http://www.darbocite.com/google_login');
define("GOOGLE_SITE_NAME", 'http://www.darbocite.com'); 

function __autoload($class)
{
	$parts = explode('_', $class);
	$path = implode(DIRECTORY_SEPARATOR,$parts);
	require_once $path . '.php';
}

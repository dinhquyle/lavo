<?php
date_default_timezone_set('Asia/Tokyo'); // For Japan
// date_default_timezone_set('Asia/Ho_Chi_Minh'); // For Vietnam

// Define Environment.
if($_SERVER['SERVER_ADDR'] == '127.0.0.1' || strpos($_SERVER['SERVER_NAME'], 'alive-web') !== false) define('ENVIRONMENT', 'dev');
else define('ENVIRONMENT', 'production');

// Get dist folder.
$script_name = str_replace($_SERVER['QUERY_STRING'], '', $_SERVER['SCRIPT_NAME']);
$script_filename = str_replace(dirname(__FILE__), '', $_SERVER['SCRIPT_FILENAME']);
$dist = trim(str_replace($script_filename, '', $script_name), "/");
if(!empty($dist)) $dist .= '/';
if (strpos($dist,".php") !== false || strpos($dist,".html") !== false || strpos($dist,".htm") !== false) $dist = "";

// Get protocol.
$protocol = empty($_SERVER["HTTPS"]) ? 'http://' : 'https://';

// Get host.
$app_url = $protocol.$_SERVER['HTTP_HOST'].'/'.$dist;

// Define constants.
define('APP_URL', $app_url);
define('APP_PATH', dirname(__FILE__).'/');
define('APP_ASSETS', APP_URL.'assets/');

define('GOOGLE_MAP_API_KEY', '');
define('GOOGLE_RECAPTCHA_KEY_API', '');
define('GOOGLE_RECAPTCHA_KEY_SECRET', '');

/* email list for forms */
if(ENVIRONMENT == 'dev') {
  //contact
  $aMailtoContact = array('vntesttongali@gmail.com', 'vntesthatch@gmail.com');
  $aBccToContact = array('vntesttongali2@gmail.com');
  $fromContact = "vntesttongali@gmail.com";
} else {
  //contact
  $aMailtoContact = array('vntesttongali@gmail.com', 'vntesthatch@gmail.com');
  $aBccToContact = array('vntesttongali2@gmail.com');
  $fromContact = "vntesttongali@gmail.com";
}
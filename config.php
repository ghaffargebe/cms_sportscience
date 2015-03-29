<?php
ini_set( "display_errors", true );
date_default_timezone_set( "Asia/Jakarta" );  // http://www.php.net/manual/en/timezones.php
define( "DB_DSN", "mysql:host=localhost;dbname=db_sportscience" );
define( "DB_USERNAME", "root" );
define( "DB_PASSWORD", "" );
define( "CLASS_PATH", "classes" );
define( "TEMPLATE_PATH", "templates" );
define( "UPLOAD_PATH", "upload/" );
define( "HOMEPAGE_NUM_ARTICLES", 5 );
require_once "library/security/HTMLPurifier.auto.php";
$config = HTMLPurifier_Config::createDefault();
$purifier = new HTMLPurifier($config);
//$clean_html = $purifier->purify($dirty_html);

require(CLASS_PATH . "/Connect.php");
require( CLASS_PATH . "/Article.php" );
require( CLASS_PATH . "/Users.php" );
 
function handleException( $exception ) {
  echo "Sorry, a problem occurred. Please try later.";
  error_log( $exception->getMessage() );
}
 
set_exception_handler( 'handleException' );
?>
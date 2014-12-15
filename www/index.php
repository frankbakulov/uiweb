<?
error_reporting(E_ALL);
ini_set('display_errors', 1);
//echo "Initial: ".memory_get_usage()." bytes \n";

error_reporting( E_CORE_ERROR | E_CORE_WARNING | E_COMPILE_ERROR | E_ERROR | E_WARNING | E_PARSE | E_USER_ERROR | E_USER_WARNING | E_RECOVERABLE_ERROR );

require_once $_SERVER['DOCUMENT_ROOT'] . "/php/config/db.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/php/config/defines.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/php/Autoloader.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/php/Route.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/php/Auth.php";

Autoloader::init();
Route::start();

//echo "Final: ".memory_get_usage()." bytes <br>";
//echo "Peak: ". memory_get_peak_usage()." bytes \n";
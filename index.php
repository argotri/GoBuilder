<?php
if(isset($_GET['php-benchmark-test']) && isset($_GET['display-data'])){
// parameternya ?php-benchmark-test=1&display-data=1
include("plugin/phpbenchmark/init.php");
\PHPBenchmark\Monitor::instance()->snapshot('Bootstrap finished');
}
//Mendefiniskan URL 
include 'config.php';
define("BASE_PATH", HOST);
//Mendefiniskan basepath
$path = "/".PATH_FOLDER;
//Mendapatkan inisial PATH.
$url = $_SERVER['REQUEST_URI'];
$url = str_replace($path, "", $url);
//$url = str_replace($path, "", $url);
//membuat array dari URL
$array_tmp_uri = preg_split('[\\/]', $url, 3, PREG_SPLIT_NO_EMPTY);

//Disini, ditentukan peran masing-masing segmen dalam URL
$array_uri['controller'] = $array_tmp_uri[0]; // adalah class
$array_uri['method'] = $array_tmp_uri[1]; // adalah fungsi
$array_uri['var'] =preg_split('[\\/]', $array_tmp_uri[2], -1, PREG_SPLIT_NO_EMPTY); //adalah variabel/parameter

//memuat base API
require_once("application/base.php");
//memuat controller
$application = new Application($array_uri);
$application->loadController($array_uri['controller']);
/*var_dump(get_included_files());*/
$time_elapsed_us = microtime(true) - $start;
?>
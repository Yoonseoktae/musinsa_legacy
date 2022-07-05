<?php
// query string에 DEBUG시만 개발에러 표시
ini_set("display_errors", 0);
if (isset($_REQUEST["debug"]) && $_REQUEST["debug"]) ini_set("display_errors", 1);

// 기본 루트 관련 상수 선언
define("DS", DIRECTORY_SEPARATOR);
define("HOME", dirname(__DIR__) );
define("CONFIG", HOME . DS . "Config");
define("LIB", HOME . DS . "Lib" );
define("CONTROLLER", HOME . DS . LIB . DS ."Controller");
define("API", HOME . DS . LIB . DS . CONTROLLER . DS . "Api");
define("ROOT", HOME . DS . "root");

include_once CONFIG . DS . "config.php";
include_once LIB . DS ."autoload.php";
<?php
// query string에 DEBUG시만 개발에러 표시
ini_set("display_errors", 0);
if (isset($_REQUEST["debug"]) && $_REQUEST["debug"]) ini_set("display_errors", 1);

// 기본 루트 관련 상수 선언
define("DS", DIRECTORY_SEPARATOR);
define("HOME", dirname(__DIR__) );
define("APP", HOME . DS . "App");
define("CONFIG", HOME . DS . APP . DS . "Config");
define("CONTROLLER", HOME . DS . APP . DS . "Controller");
define("ROOT", HOME . DS . "root");

include_once CONFIG . DS . "config.php";
include_once APP . DS ."autoload.php";
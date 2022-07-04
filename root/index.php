<?php
include "define.php";

global $_ROUTE;

// URI Route
function getRoute() {
	$request_uri = trim($_SERVER['REQUEST_URI'], "/");
	$RequestURI = explode("?", $request_uri);
	
	if (!$RequestURI[0]) $Route = array("index");
	else $Route = explode("/", $RequestURI[0]);
	
	return implode(DS , $Route);
}

$_ROUTE = getRoute();

<?php
namespace Lib\Common;

/**
* @file Lib/Common/App.class.php
* @brief MVC 패턴 라우트 기능을 위한 클래스
* @author 윤석태 (seknman123@naver.com)
*/
class App
{
	function __construct() {}

	/**
	* @brief view파일 경로설정을 위한 라우트함수
	* @return string
	*/
	public function getRoute() {
		$request_uri = trim($_SERVER['REQUEST_URI'], "/");
		$RequestURI = explode("?", $request_uri);
		
		if (!$RequestURI[0]) $Route = array("index");
		else $Route = explode("/", $RequestURI[0]);
		
		return implode(DS , $Route);
	}

	/**
	* @brief class파일 경로설정을 위한 라우트함수
	* @return object
	*/
	public function initApp()
	{
		$URL = parse_url($_SERVER["REQUEST_URI"]);
		$__URL_PATH = substr($URL["path"], 1);
		$this->Menu = explode("/", $__URL_PATH);
		if (!$this->Menu[0]) $this->Menu[0] = "index";

		$Menu = $this->Menu;
		
		if ( isset($_REQUEST["mode"]) && ( $_REQUEST["mode"] == "api") ) {
			array_unshift($Menu, "Api");
			array_unshift($Menu, "Controller");
			array_unshift($Menu, "Lib");
		} else {
			throw new \Exception("Invalid URL", 998000);
		}
		
		foreach($Menu as &$m) { $m = ucfirst($m); }
		
		$class_name = implode("\\", $Menu);
		
		if (!class_exists($class_name)) {
			throw new \Exception("Class {$class_name} not exists", 999000);
		}

		$this->class_name = $class_name;


		$R = new $class_name($this);

		return $R->run();

	}

}
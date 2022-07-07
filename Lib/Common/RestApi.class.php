<?php
namespace Lib\Common;

/**
* @file Lib/Common/RestApi.class.php
* @brief REST API 관련 모음 클래스파일
* @author 윤석태 (seknman123@naver.com)
*/
class RestApi 
{

	var $error_code;
	var $error_message;	
	var $http_method;
	var $input;

	function __construct()
	{
		$this->http_method = ucfirst(strtolower( $_SERVER['REQUEST_METHOD'] ));

		$json = file_get_contents("php://input");
		$this->input = json_decode($json, true );
		
		$this->error_code = 0;
		$this->error_message = '';
	}

	/**
	* @brief REST API 에러처리 함수.
	* @param int $code
	* @param string $message
	* @param array $Params
	* @return array
	*/
	public function throwError($code, $message, $Params = null)
	{
		$response_code = http_response_code();
		
		$this->setErrorCode($code, $message);
		$this->setErrorParams($Params);

		$Ret = array(
			"result" => false,
			"response_code" => $response_code,
			"error" => array(
				"code" => $this->error_code,
				"message" => $this->error_message,
				"params" => $this->error_params
			)
		);

		Header("Content-type: application/json");
		echo json_encode($Ret);
		exit(0);
	}

	/**
	* @brief REST API 정상처리 함수.
	* @param array $Params
	* @return array
	*/
	public function throwSuccess($Params = null)
	{
		$Ret = array(
			"result" => true,
			"data" => $Params
		);

		Header("Content-type: application/json");
		echo json_encode($Ret);
		exit(0);
	}

	/**
	* @brief 요청받은 매개변수들 유효성처리 및 없을경우 default값 설정함수
	* @param string $key
	* @param object $default
	* @return object
	*/
	public function getRequest($key, $default = null)
	{
		$ret = isset($_REQUEST[$key])?$_REQUEST[$key]:null;
		if ($ret) return $ret;

		$ret = isset($this->input[$key])?$this->input[$key]:null;
		if ($ret) return $ret;

		if (!$ret) $ret = $default;
		
		return $ret;
	}

	/**
	* @brief REST API 에러시 변수 세팅
	* @param object $Params
	* @return void
	*/
	public function setErrorParams($Params)
	{
		$this->error_params = $Params;
	}
	
	/**
	* @brief REST API 에러시 에러코드 세팅
	* @param int $code
	* @param string $message
	* @return void
	*/
	public function setErrorCode($code, $message)
	{
		$this->error_code = $code;
		$this->error_message = $message;
	}

	/**
	* @brief REST API 메소드에 따른 분기처리 함수
	* @return void
	*/
	public function run()
	{
		return $this->{"_on{$this->http_method}"}();
	}

	/**
	* @brief REST API GET방식 메소드에 따른 분기처리 함수
	* @return void
	*/
	public function _onGet()
	{
		if (method_exists($this, "onGet")) return $this->onGet();
		else throw new \Exception("method not found.");
	}
	
	/**
	* @brief REST API POST방식 메소드에 따른 분기처리 함수
	* @return void
	*/
	public function _onPost()
	{
		if (method_exists($this, "onPost")) return $this->onPost();
		else throw new \Exception("method not found.");
	}

}
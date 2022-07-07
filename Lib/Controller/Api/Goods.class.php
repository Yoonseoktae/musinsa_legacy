<?php
namespace Lib\Controller\Api;

use Lib\Common\RestApi;

use Lib\Container\Model\Api\GoodsModel;

/**
* @file Lib/Controller/Api/Goods.class.php
* @brief 상품 관련 컨트롤러 클래스
* @author 윤석태 (seknman123@naver.com)
*/
class Goods extends RestApi
{

	function __construct()
	{
		parent::__construct();
	}

	public function run()
	{
		parent::run();
	}

	/**
	 * @brief 상품 정보 조회 Controller
	 * @param int $goods_no
	 * @return array
	 */
	public function onGet()
	{
		// Step 1. 변수 세팅
		$goods_no = $this->getRequest("goods_no", false);

		$Res = [];

		// Step 2. 유효성 체크하기
		if ($goods_no !== false && (int)$goods_no === 0) $this->throwError(1100001, "잘못된 상품번호를 입력하셨습니다.");

		// Step 3. 상품 정보 가져오기
		$goods = new GoodsModel($this);
		$Res = $goods->getGoodsList($goods_no);

		$this->throwSuccess($Res);
	}

	/**
	 * @brief 상품 정보 등록 Controller
	 * @param int $goods_nm
	 * @param string $goods_cont
	 * @param string $com_id
	 * @return int
	 */
	public function onPost()
	{
		// Step 1. 변수 세팅
		$goods_nm = $this->getRequest("goods_nm");
		$goods_cont = $this->getRequest("goods_cont", "");
		$com_id = $this->getRequest("com_id", "");

		$Res = [];

		// Step 2. 유효성 체크하기
		if (!$goods_nm) $this->throwError(1200001, "상품이름이 입력되지 않았습니다.");
		
		// Step 3. 상품 정보 등록하기
		$goods = new GoodsModel($this);
		
		$Res = $goods->setGoods($goods_nm, $goods_cont, $com_id);
		if(!$Res) $this->throwError(1200002, "데이터 입력에 실패하였습니다." );
		
		$this->throwSuccess($goods->insert_id);
	}
	
}
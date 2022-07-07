<?php
namespace Lib\Container\Model\Api;

use Lib\Common\Model;

/**
* @file Lib/Container/Model/Api/Goods.class.php
* @brief 상품 관련 DB 데이타처리 모음 클래스
* @author 윤석태 (seknman123@naver.com)
*/
class GoodsModel extends Model
{

	function __construct() 
	{
		parent::__construct();
	}

	/**
	* @brief 상품 정보 조회
	*
	* @param string $goods_no
	*
	* @return array
	*/
	public function getGoodsList($goods_no = false)
	{
		$sql = "SELECT * 
				FROM goods
				";

		if ($goods_no != false) {
			$sql .= " WHERE goods_no = ?" ;
			return $this->getList($sql, $goods_no);
		} else {
			return $this->getList($sql);
		}

	}

	/**
	* @brief 상품 정보 등록
	*
	* @param string $goods_nm
	* @param string $goods_cont
	* @param string $com_id
	*
	* @return array
	*/
	public function setGoods($goods_nm, $goods_cont = "", $com_id = "")
	{

		$now = date("Y-m-d H:i:s");

		$sql = "INSERT INTO goods (`goods_nm`, `goods_cont`, `com_id`, `upd_dm`, `reg_dm`)
		VALUES (?, ?, ?, ?, ?)";
		
		return $this->execute($sql, $goods_nm, $goods_cont, $com_id, $now, $now);

	}


}
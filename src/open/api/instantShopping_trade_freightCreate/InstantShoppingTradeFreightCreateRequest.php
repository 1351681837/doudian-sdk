<?php
namespace Long\DoudianSdk\open\api\instantShopping_trade_freightCreate;



//auto generated code
use Long\DoudianSdk\open\core\DoudianOpClient;
use Long\DoudianSdk\open\core\GlobalConfig;

class InstantShoppingTradeFreightCreateRequest
{

	private $param;

	private $config;


	public function setParam($param)
	{
		$this->param = $param;
	}

	public function getParam()
	{
		return $this->param;
	}

	public function setConfig($config)
	{
		$this->config = $config;
	}

	public function getConfig()
	{
		return $this->config;
	}

	public function getUrlPath()
	{
		return "/instantShopping/trade/freightCreate";
	}

	public function execute($accessToken)
	{
		return DoudianOpClient::getInstance()->request($this, $accessToken);
	}

	public function __construct()
	{
		$this->config = GlobalConfig::getGlobalConfig();
	}
}

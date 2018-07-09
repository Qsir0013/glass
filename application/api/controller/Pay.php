<?php
namespace app\api\controller;

use Wxpay\Wxpay;
use think\config;

class Pay {
	public function index()  
    {  
        $weixinpay = new Wxpay($appid='123',$openid='oBcI95U_H9VwZqACeMG7ZWd8W0T4',$mch_id='123',$key='222',$out_trade_no='11111231',$body='测试',$total_fee='1');  
		$return=$weixinpay->pay();  
		echo json_encode($return);
	}
	
	public function callBack()
	{
		$postXml = $GLOBALS["HTTP_RAW_POST_DATA"]; //接收微信参数  
		if (empty($postXml)) {  
			return false;  
		}  
		//将xml格式转换成数组  
		function xmlToArray($xml) {  
		  
			//禁止引用外部xml实体   
			libxml_disable_entity_loader(true);  
		  
			$xmlstring = simplexml_load_string($xml, 'SimpleXMLElement', LIBXML_NOCDATA);  
		  
			$val = json_decode(json_encode($xmlstring), true);  
		  
			return $val;  
		}
		$attr = xmlToArray($postXml);  
		  
		$total_fee = $attr[total_fee];  
		$open_id = $attr[openid];  
		$out_trade_no = $attr[out_trade_no];  
		$time = $attr[time_end];
	}
}
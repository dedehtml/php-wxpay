<?php
ini_set('date.timezone','Asia/Shanghai');
require_once "lib/WxPay.Api.php";
require_once "lib/WxPay.Data.php";
require_once "service/WxPay.Config.php";

//接收wx回调的xml数据
$postXml = file_get_contents("php://input");
//xml转array
$postArr = json_decode(json_encode(simplexml_load_string($postXml, 'SimpleXMLElement', LIBXML_NOCDATA), JSON_UNESCAPED_UNICODE), true);
//微信api查询订单
$input = new \WxPayOrderQuery();
$input->SetTransaction_id($postArr['transaction_id']);
$config = new \WxPayConfig();
$notify = new \WxPayApi();
$result = $notify->orderQuery($config, $input);
//通信成功&&校验成功&&订单完成
if($result['return_code'] == 'SUCCESS' && $result['result_code'] == 'SUCCESS' && $result['trade_state'] == 'SUCCESS'){
    //todo业务逻辑处理
    echo 'success';
    exit;
}
echo 'fail';
exit;
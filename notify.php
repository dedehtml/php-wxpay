<?php
ini_set('date.timezone','Asia/Shanghai');
require_once "lib/WxPay.Api.php";
require_once "lib/WxPay.Data.php";
require_once "service/WxPay.Config.php";

//接收wx回调的xml数据
$postXml = file_get_contents("php://input");
//xml转array
$postArr = json_decode(json_encode(simplexml_load_string($postXml, 'SimpleXMLElement', LIBXML_NOCDATA), JSON_UNESCAPED_UNICODE), true);

$input = new \WxPayOrderQuery();
$input->SetTransaction_id($postArr['transaction_id']);
$config = new \WxPayConfig();
$notify = new \WxPayApi();
$result = $notify->orderQuery($config, $input);

if($result['return_code'] == 'SUCCESS' && $result['result_code'] == 'SUCCESS'){
    echo 'success';
    exit;
}
echo 'fail';
exit;
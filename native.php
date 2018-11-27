<?php
ini_set('date.timezone','Asia/Shanghai');
require_once "lib/WxPay.Api.php";
require_once "service/WxPay.NativePay.php";

$notify = new \NativePay();
$input = new \WxPayUnifiedOrder();

$subject = 'lalallaala';
$oid = time();//商户订单号，商户网站订单系统中唯一订单号
$total_fee = 1;//分为单位
$pid = time();
$notify_url = '';

$input->SetBody($subject);
$input->SetOut_trade_no($oid);
$input->SetTotal_fee($total_fee);
$input->SetTime_start(date("YmdHis"));
$input->SetTime_expire(date("YmdHis", time() + 600));
$input->SetNotify_url($notify_url);
$input->SetTrade_type("NATIVE");
$input->SetProduct_id($pid);

$result = $notify->GetPayUrl($input);
$url = $result["code_url"];//支付链接

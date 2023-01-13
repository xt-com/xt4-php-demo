<?php
 header( 'Content-Type:text/html;charset=utf-8 ');
 include("HttpAPI.php");


// +------------------------------------------------------------
// test -> public
// +------------------------------------------------------------
// getServerTime -> public
$domain = "http://sapi.xt-qa.com";
// $publicHttpAPI = new PublicHttpAPI($domain);
// // $param["symbol"] = "btc_usdt";
// $param = array();
// $publicHttpAPI->getBestTicker($param);


// +------------------------------------------------------------
// test - > signed
// +------------------------------------------------------------
$accesskey = "XXXXXXXXXXXXXXXXXXXXXXXXXXX";
$secretkey = "YYYYYYYYYYYYYYYYYYYYYYYYYYY";

// getBalance -> signed
// $signedHttpAPI = new SignedHttpAPI($domain, $accesskey, $secretkey);
// $param["symbol"] = "btc_usdt";
// // $param = array();
// $signedHttpAPI->getOpenOrder($param);


// +------------------------------------------------------------
// test - > signed
// +------------------------------------------------------------
// sendOrder -> signed
// $signedHttpAPI = new SignedHttpAPI($domain, $accesskey, $secretkey);

// $param["symbol"] = "btc_usdt";
// $param["side"] = "BUY";
// $param["type"] = "LIMIT";
// $param["timeInForce"] = "IOC";
// $param["bizType"] = "SPOT";
// $param["price"] = "18818";
// $param["quantity"] = "1";
// // $param = array();
// $signedHttpAPI->sendOrder($param);


// +------------------------------------------------------------
// test - > signed
// +------------------------------------------------------------
// getOrderList -> signed
// $signedHttpAPI = new SignedHttpAPI($domain, $accesskey, $secretkey);

// $param["orderId"] = "184084725722584960";

// // $param = array();
// $signedHttpAPI->getOrderList($param);


// +------------------------------------------------------------
// test - > signed
// +------------------------------------------------------------
// getBatchOrder -> signed
// $signedHttpAPI = new SignedHttpAPI($domain, $accesskey, $secretkey);

// $param["orderIds"] = "184084725722584960";

// // $param = array();
// $signedHttpAPI->getBatchOrder($param);


// +------------------------------------------------------------
// test - > signed
// +------------------------------------------------------------
// batchCancelOrder -> signed
// $signedHttpAPI = new SignedHttpAPI($domain, $accesskey, $secretkey);

// $param["orderIds"] = array(184084725722584960);

// // $param = array();
// $signedHttpAPI->batchCancelOrder($param);

?>
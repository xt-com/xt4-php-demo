<?php
 header( 'Content-Type:text/html;charset=utf-8 ');
 include("HttpUtil.php");


 // +---------------------------------------------
 // public request
 // +---------------------------------------------
class PublicHttpAPI
{
    var string $host;

    function __construct($domain) {
        $this->host = $domain;
    }

    protected function getUri($path)
    {
        return $this->host . $path;
    }

    function getServerTime()
    {
        $uri = $this->getUri(XTPlatConfig::$GET_SERVER);
        return request(RequestMethod::$OPTION_GET, $uri);
    }

    function getCoinsInfo()
    {
        $uri = $this->getUri(XTPlatConfig::$GET_COINS_INFO);
        return request(RequestMethod::$OPTION_GET, $uri);
    }

    function getMarketConfig($param)
    {

        $uri = $this->getUri(XTPlatConfig::$GET_MARKET_CONFIG);
        $uri = httpBuildQuery($uri, $param);

        return request(RequestMethod::$OPTION_GET, $uri);
    }

    function getDepth($param)
    {
        $uri = $this->getUri(XTPlatConfig::$GET_DEPTH);
        $uri = httpBuildQuery($uri, $param);

        return request(RequestMethod::$OPTION_GET, $uri);

    }

    function getKline($param)
    {

        $uri = $this->getUri(XTPlatConfig::$GET_KLINE);
        $uri = httpBuildQuery($uri, $param);

        return request(RequestMethod::$OPTION_GET, $uri);

    }

    function getTrades($param)
    {
        $uri = $this->getUri(XTPlatConfig::$GET_TRADES);
        $uri = httpBuildQuery($uri, $param);

        return request(RequestMethod::$OPTION_GET, $uri);

    }

    function getTicker($param)
    {
        $uri = $this->getUri(XTPlatConfig::$GET_TICKER);
        $uri = httpBuildQuery($uri, $param);

        return request(RequestMethod::$OPTION_GET, $uri);
    }

    function getFullTicker($param)
    {

        $uri = $this->getUri(XTPlatConfig::$GET_FULL_TICKER);
        $uri = httpBuildQuery($uri, $param);

        return request(RequestMethod::$OPTION_GET, $uri);
    }

    function getBestTicker($param)
    {

        $uri = $this->getUri(XTPlatConfig::$GET_BEST_TICKER);
        $uri = httpBuildQuery($uri, $param);

        return request(RequestMethod::$OPTION_GET, $uri);

    }  

    function get24hTicker($param)
    {

        $uri = $this->getUri(XTPlatConfig::$GET_24H_TICKER);
        $uri = httpBuildQuery($uri, $param);

        return request(RequestMethod::$OPTION_GET, $uri);
    }  
}


 // +---------------------------------------------
 // signed request
 // +---------------------------------------------
class SignedHttpAPI
{

    var string $host;
    var string $accesskey;
    var string $secretkey;

    protected function getUri($path)
    {
        return $this->host . $path;
    }

    function __construct($domain, $accesskey, $secretkey) {
        $this->host = $domain;
        $this->accesskey = $accesskey;
        $this->secretkey = $secretkey;
    }

    function getDatas($param)
    {
        $param["accesskey"] = $this->accesskey;
        $param["secretkey"] = $this->secretkey;
        return $param;
    }

    function getOrder($data)
    {
        $_data = $this->getDatas($data);
        $uri = $this->getUri(XTPlatConfig::$GET_ORDER);
        $_data["urlencoded"] = True;
        $method = RequestMethod::$OPTION_GET;
        $payload = getAuthPayload(new Payload($_data, $uri, $method, XTPlatConfig::$GET_ORDER));
        $uri = httpBuildQuery($uri, $payload->param);

        return request($method, $uri, $payload->header);
    }

    function getOrderList($data)
    {
        $_data = $this->getDatas($data);
        $uri = $this->getUri(XTPlatConfig::$GET_ORDER);
        $_data["urlencoded"] = True;
        $method = RequestMethod::$OPTION_GET;
        $payload = getAuthPayload(new Payload($_data, $uri, $method, XTPlatConfig::$GET_ORDER));
        $uri = httpBuildQuery($uri, $payload->param);

        return request($method, $uri, $payload->header);
    }

    function cancelOrder($data)
    {
        $_data = $this->getDatas($data);
        $uri = $this->getUri(XTPlatConfig::$GET_ORDER);
        $method = RequestMethod::$OPTION_DELETE;
        $payload = getAuthPayload(new Payload($_data, $uri, $method, XTPlatConfig::$GET_ORDER));

        return request($method, $uri, $payload->header, $payload->param);
    }

    function sendOrder($data)
    {
        $_data = $this->getDatas($data);
        $uri = $this->getUri(XTPlatConfig::$GET_ORDER);
        $method = RequestMethod::$OPTION_POST;
        $payload = getAuthPayload(new Payload($_data, $uri, $method, XTPlatConfig::$GET_ORDER));

        return request($method, $uri, $payload->header, $payload->param);

    }
    function getBatchOrder($data)
    {
        $_data = $this->getDatas($data);
        $uri = $this->getUri(XTPlatConfig::$GET_BATCH_ORDERS);
        $_data["urlencoded"] = True;
        $method = RequestMethod::$OPTION_GET;
        $payload = getAuthPayload(new Payload($_data, $uri, $method, XTPlatConfig::$GET_BATCH_ORDERS));
        $uri = httpBuildQuery($uri, $payload->param);

        return request($method, $uri, $payload->header);

    }

    function sendBatchOrder($data)
    {

        $_data = $this->getDatas($data);
        $uri = $this->getUri(XTPlatConfig::$BATCH_ORDER);
        $method = RequestMethod::$OPTION_POST;
        $payload = getAuthPayload(new Payload($_data, $uri, $method, XTPlatConfig::$BATCH_ORDER));

        return request($method, $uri, $payload->header, $payload->param);
    }

    function batchCancelOrder($data)
    {

        $_data = $this->getDatas($data);
        $uri = $this->getUri(XTPlatConfig::$BATCH_CANCEL);
        $method = RequestMethod::$OPTION_DELETE;
        $payload = getAuthPayload(new Payload($_data, $uri, $method, XTPlatConfig::$BATCH_CANCEL));

        return request($method, $uri, $payload->header, $payload->param);
    }

    function getOpenOrder($data)
    {
        $_data = $this->getDatas($data);
        $uri = $this->getUri(XTPlatConfig::$GET_OPEN_ORDERS);
        $_data["urlencoded"] = True;
        $method = RequestMethod::$OPTION_GET;
        $payload = getAuthPayload(new Payload($_data, $uri, $method, XTPlatConfig::$GET_OPEN_ORDERS));
        $uri = httpBuildQuery($uri, $payload->param);

        return request($method, $uri, $payload->header);

    }

    function cancelOpenOrder($data)
    {
        $_data = $this->getDatas($data);
        $uri = $this->getUri(XTPlatConfig::$DELETE_OPEN_ORDERS);
        $method = RequestMethod::$OPTION_DELETE;
        $payload = getAuthPayload(new Payload($_data, $uri, $method, XTPlatConfig::$DELETE_OPEN_ORDERS));

        return request($method, $uri, $payload->header, $payload->param);

    }

    function getHistoryOrder($data)
    {
        $_data = $this->getDatas($data);
        $uri = $this->getUri(XTPlatConfig::$GET_ACCOUNT_HISTORY_ORDER);
        $_data["urlencoded"] = True;
        $method = RequestMethod::$OPTION_GET;
        $payload = getAuthPayload(new Payload($_data, $uri, $method, XTPlatConfig::$GET_ACCOUNT_HISTORY_ORDER));
        $uri = httpBuildQuery($uri, $payload->param);

        return request($method, $uri, $payload->header);
    }

    function getTrade($data)
    {
        $_data = $this->getDatas($data);
        $uri = $this->getUri(XTPlatConfig::$GET_ACCOUNT_TRADES);
        $_data["urlencoded"] = True;
        $method = RequestMethod::$OPTION_GET;
        $payload = getAuthPayload(new Payload($_data, $uri, $method, XTPlatConfig::$GET_ACCOUNT_TRADES));
        $uri = httpBuildQuery($uri, $payload->param);

        return request($method, $uri, $payload->header);
    }

    function getBalance($data)
    {
        $_data = $this->getDatas($data);
        $uri = $this->getUri(XTPlatConfig::$GET_BALANCE);
        $_data["urlencoded"] = True;
        $method = RequestMethod::$OPTION_GET;
        $payload = getAuthPayload(new Payload($_data, $uri, $method, XTPlatConfig::$GET_BALANCE));
        $uri = httpBuildQuery($uri, $payload->param);

        return request($method, $uri, $payload->header);
    }

    function getFunds($data)
    {
        $_data = $this->getDatas($data);
        $uri = $this->getUri(XTPlatConfig::$GET_FUNDS);
        $_data["urlencoded"] = True;
        $method = RequestMethod::$OPTION_GET;
        $payload = getAuthPayload(new Payload($_data, $uri, $method, XTPlatConfig::$GET_FUNDS));
        $uri = httpBuildQuery($uri, $payload->param);

        return request($method, $uri, $payload->header);
    }

    function getListenKey($data)
    {
        $_data = $this->getDatas($data);
        $uri = $this->getUri(XTPlatConfig::$GET_ACCOUNT_LISTENKEY);
        $_data["urlencoded"] = True;
        $method = RequestMethod::$OPTION_POST;
        $payload = getAuthPayload(new Payload($_data, $uri, $method, XTPlatConfig::$GET_ACCOUNT_LISTENKEY));

        return request($method, $uri, $payload->header);
    }
}

?>
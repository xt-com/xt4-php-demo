<?php
 header( 'Content-Type:text/html;charset=utf-8 ');
 require '../vendor/autoload.php';
 use GuzzleHttp\Client;
 use GuzzleHttp\Psr7\Request;

 include("HttpCFG.php");

/**
 * create  signed
 *
 * @param string $param 
 * @param string $secretkey 
 */
function createSigned($param, $secretkey)
{
    $algo = "sha256";

    $signature = hash_hmac($algo, $param, $secretkey);
    return $signature;
}



// +---------------------------------------------
// Gets the current number of milliseconds
// +---------------------------------------------
function getMillisecond() {
	list($microsecond , $time) = explode(' ', microtime()); //' 'In the middle is a space
	return (float)sprintf('%.0f',(floatval($microsecond)+floatval($time))*1000);
}


// +---------------------------------------------
// payload
// +---------------------------------------------
class Payload
{

    var array $data;
    var string $uri;
    var string $method;
    var string $path;
    
    function __construct($data, $uri, $method, $path) {
        $this->data = $data;
        $this->uri = $uri;
        $this->method = $method;
        $this->path = $path;
    }

    function getIsData(){
        return empty($this->data);
    }

    function getIsUrlencode()
    {

        $isEmpty = empty($this->data);
        $isExists = array_key_exists("urlencoded", $this->data);
        if ($isEmpty || !$isExists) {
            return false;
        }

        $isurlencoded = $this->data["urlencoded"];
        if( $isurlencoded){
            unset($this->data["urlencoded"]);
            return true;
        }else{
            return false;
        }
    }

}

// +---------------------------------------------
// payload
// +---------------------------------------------
class RequestParam
{
    var array $header;
    var $param;

    function __construct($header, $param)
    {
        $this->header = $header;
        $this->param = $param;
    } 

}

// +---------------------------------------------
// auth
// +---------------------------------------------
class Auth
{
    protected string $accesskey;
    protected string $secretkey;

    function __construct($accesskey, $secretkey) {
        $this->accesskey = $accesskey;
        $this->secretkey = $secretkey;
    }

    protected  function createHeader()
    {
        $header["xt-validate-algorithms"] = HeaderConfig::$XT_VALIDATE_ALGORITHMS;
        $header["xt-validate-appkey"] = $this->accesskey;
        $header["xt-validate-recvwindow"] = HeaderConfig::$XT_VALIDATE_RECVWINDOW;
        $header["xt-validate-timestamp"] = getMillisecond();
        ksort($header);

        return $header;
    }

    function createPayload($payload)
    {
        $tmp = null;
        $decode = HeaderConfig::$XT_VALIDATE_CONTENTTYPE_JSON;

        $header = $this->createHeader();
        $X = http_build_query($header);
        $path = $payload->path;

        if ($payload->getIsUrlencode()) {
            $tmp = http_build_query($payload->data);
            $decode = HeaderConfig::$XT_VALIDATE_CONTENTTYPE_URLENCODE;
        }

        if ($payload->getIsData()) {
            $param = null;
            $Y = sprintf("#%s#%s", $payload->method, $path);
        } else {
            $param = json_encode($payload->data);
            $Y = sprintf("#%s#%s#%s", $payload->method, $path, $tmp !=null ? $tmp : $param);
            $param = $payload->data;
        }

        $signature = createSigned($X . $Y, $this->secretkey);
        $header["xt-validate-signature"] = $signature;
        $header["Content-Type"] = $decode;
        ksort($header);

        return new RequestParam($header, $param);
    }

}

function getAuthPayload($payload) {

    $accesskey = $payload->data["accesskey"];
    $secretkey = $payload->data["secretkey"];

    unset($payload->data["accesskey"]);
    unset($payload->data["secretkey"]);

    $auth = new Auth($accesskey, $secretkey);

    return $auth->createPayload($payload);
}


function request($method, $url, array $headers=[], $body=null){

    $client = new Client();
    $request = new Request($method, $url, $headers, json_encode($body));

    try {
        //code...
        $res = $client->sendAsync($request)->wait();
    } catch (Exception $e) {
        //throw $th;
        return $e->getMessage();
    }

    return $res->getBody();
}


function httpBuildQuery($path, $param)
{
    if (empty($param)) {
        return $path;
    }

    $uri = http_build_query($param);
    $path = $path . "?" . $uri;
    return $path;
}


?>
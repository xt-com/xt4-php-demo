<?php
 header( 'Content-Type:text/html;charset=utf-8 ');

 // +---------------------------------------------
 // xt api path config
 // +---------------------------------------------
class XTPlatConfig
{

    // Get currency information 
    public static $GET_COINS_INFO = '/v4/public/currencies';

    // Get timestamp from server
    public static $GET_SERVER = '/v4/public/time';

    // Get trade account type
    public static $GET_ACCOUNT = '/trade/api/v1/getAccounts';

    // Get trade config from market
    public static $GET_MARKET_CONFIG = '/v4/public/symbol';

    // Get Kline
    public static $GET_KLINE = '/v4/public/kline';

    // Get latest prices ticker 
    public static $GET_TICKER = '/v4/public/ticker/price';

    // Access to 24 hours of trading 
    public static $GET_FULL_TICKER = '/v4/public/ticker/full';

    // Obtain all trading quotations within 24 hours
    public static $GET_TICKERS = '/v4/public/ticker/24h';

    // Get the best pending order ticker
    public static $GET_BEST_TICKER = '/v4/public/ticker/book';

    // Get 24h statistics ticker 
    public static $GET_24H_TICKER = '/v4/public/ticker/24h';

    // Get the latest trading depth
    public static $GET_DEPTH = '/v4/public/depth';

    // Get the latest transaction data
    public static $GET_TRADES = '/v4/public/trade/recent';

    // Get balance of account
    public static $GET_BALANCE = '/v4/balances';

    // Gets the specified account assets
    public static $GET_FUNDS = '/v4/balances';

    // Place a order and Commissioned order
    public static $SEND_ORDER = '/v4/order';

    // Batch order
    public static $BATCH_ORDER = '/v4/batch-order';

    // Cancel order
    public static $CANCEL_ORDER = '/v4/order';

    // Batch cancel
    public static $BATCH_CANCEL = '/v4/batch-order';

    // OrderLine
    public static $GET_ORDER = '/v4/order';

    // Obtain outstanding orders
    public static $GET_OPEN_ORDERS = '/v4/open-order';

    // Cancell batch order
    public static $DELETE_OPEN_ORDERS = '/v4/open-order';
   
    // Cancell batch order
    public static $GET_ACCOUNT_HISTORY_ORDER = '/v4/history-order';

    // Get multiple order information
    public static $GET_BATCH_ORDERS = '/v4/batch-order';

    // Get myTrades
    public static $GET_ACCOUNT_TRADES = '/v4/trade';

    // Get ListenKey
    public static $GET_ACCOUNT_LISTENKEY = '/v4/ws-token';
}


 // +---------------------------------------------
 // request headers config
 // +---------------------------------------------
class HeaderConfig
{

    public static $XT_VALIDATE_ALGORITHMS = "HmacSHA256";
    public static $XT_VALIDATE_RECVWINDOW = "5000";
    public static $XT_VALIDATE_CONTENTTYPE_URLENCODE = "application/x-www-form-urlencoded";
    public static $XT_VALIDATE_CONTENTTYPE_JSON = "application/json;charset=UTF-8";

}


 // +---------------------------------------------
 // request method
 // +---------------------------------------------
class RequestMethod
{
    public static $OPTION_GET = "GET";
    public static $OPTION_POST = "POST";
    public static $OPTION_PUT = "PUT";
    public static $OPTION_DELETE = "DELETE";

}
?>
<?php
require 'vendor/autoload.php';

use GuzzleHttp\Client;

$euCr = 86.14;
$usCr = 72;

$out = array();

$priceApi = new Client([
    'base_uri' => 'https://api.fixer.io/',
    'timeout'  => 5.0,
]);

$priceApiR = $priceApi->request('GET','/latest?base=INR');
$priceList = json_decode($priceApiR->getBody());

$euCr = $priceList->rates->EUR;
$usCr = $priceList->rates->USD;
    
$euCr = 1/$euCr;
$out['EUR'] = $euCr;
$euCr = ((7.25*$euCr)/100)+$euCr;

$usCr = 1/$usCr;
$out['USD'] = $usCr;
$usCr = ((7.25*$usCr)/100)+$usCr;

$out['USD_TAXED'] = $usCr;
$out['EUR_TAXED'] = $euCr;

/*
$clientK = new Client([
    // Base URI is used with relative requests
    'base_uri' => 'https://koinex.in/',
    // You can set any number of default request options.
    'timeout'  => 5.0,
]);
$responseK = $clientK->request('GET', '/api/ticker');
$koinxJson = json_decode($responseK->getBody());
*/
//print_r($koinxJson);


$client = new Client([
    // Base URI is used with relative requests
    'base_uri' => 'https://cex.io/',
    // You can set any number of default request options.
    'timeout'  => 5.0,
]);

$response = $client->request('GET', '/api/tickers/USD/EUR');
$cexJson = json_decode($response->getBody());

foreach($cexJson->data as $p){
    $pair = $p->pair;
    $pairArray = explode(':', $pair);
    $askPrice = $p->ask;
    if($pairArray[1] == 'USD'){
        $askPrice = $askPrice * $usCr;
    } else if($pairArray[1] == 'EUR'){
        $askPrice = $askPrice * $euCr;
    }
    $out[$pairArray[0]][$pairArray[1]]=$askPrice;
    $out[$pairArray[0]][$pairArray[1].'_ORI']=$p->ask;
    
    $coin = $pairArray[0];
    //print_r($koinxJson->prices->$coin);
    //if(property_exists($koinxJson->prices,$coin))
    //    $out[$pairArray[0]]['INR']=$koinxJson->prices->$coin;    
    

}

$clientCd = new Client([
    'base_uri' => 'https://coindelta.com/',
    'timeout' => 5.0
]);
$response = $clientCd->request('GET', '/api/v1/public/getticker/');
$cdJson = json_decode($response->getBody());

foreach($cdJson as $cd) {
    
    $coinCd = $cd->MarketName;
    $coinCda = explode('-', $coinCd);
    $coinCd = strtoupper($coinCda[0]);
    if($coinCda[1] == 'inr') {
       // if(property_exists($out,$coinCd)) {
            $out[$coinCd]['CD'] = $cd->Last;
       // }
    }
        
}


$clientBbns = new Client([
    'base_uri' => 'https://bitbns.com/',
    'timeout' => 5.0
]);
$responseBbns = $clientBbns->request('GET', '/order/getTickerAll');
$bbnsJson = json_decode($responseBbns->getBody());
$out['BTC']['BBNS'] = $bbnsJson[0]->BTC->lastTradePrice;
$out['XRP']['BBNS'] = $bbnsJson[1]->XRP->lastTradePrice;
$out['ETH']['BBNS'] = $bbnsJson[4]->ETH->lastTradePrice;
$out['XLM']['BBNS'] = $bbnsJson[5]->XLM->lastTradePrice;

$clientZeb = new Client([
    'base_uri' => 'https://live.zebapi.com/',
    'timeout' => 5.0
]);
$responseZeb = $clientZeb->request('GET', '/api/v1/ticker?currencyCode=INR');
$zebJson = json_decode($responseZeb->getBody());
$out['BTC']['ZEBP'] = $zebJson->market;




echo json_encode($out);

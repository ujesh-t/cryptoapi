<?php
require 'vendor/autoload.php';

use GuzzleHttp\Client;

$euCr = 83;
$usCr = 67;

$out = array();

$clientK = new Client([
    // Base URI is used with relative requests
    'base_uri' => 'https://koinex.in/',
    // You can set any number of default request options.
    'timeout'  => 5.0,
]);
$responseK = $clientK->request('GET', '/api/ticker');
$koinxJson = json_decode($responseK->getBody());

print_r($koinxJson);

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
    //print_r($koinxJson->prices->$pairArray[0]);
    if(property_exists($koinxJson->prices,$pairArray[0]))
        $out[$pairArray[0]]['INR']=$koinxJson->prices->$pairArray[0];
}






echo json_encode($out);

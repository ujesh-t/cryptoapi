<?php
require 'vendor/autoload.php';

use GuzzleHttp\Client;


$clientBbns = new Client([
    'base_uri' => 'https://bitbns.com/',
    'timeout' => 5.0
]);

$clientCex = new Client([
    'base_uri' => 'https://cex.io/',
    'timeout' => 5.0    
]);

$coinsToWatch = array('XRP','XLM','ETH', 'DASH');
$investment = 10000;
$dnf = 0.002;
$tradeFeeBns = 0.25;


$response = $clientCex->request('GET', '/api/tickers/BTC/BTC');
$cexJson = json_decode($response->getBody());


$responseBbns = $clientBbns->request('GET', '/order/getTickerAll');
$bbnsJson = json_decode($responseBbns->getBody());

$output = array();

foreach($bbnsJson as $bit) {
    foreach($coinsToWatch as $coin) {
        
        $cexData = array();
        
        if(property_exists($bit,$coin)) {
            $amt = ($investment - ($investment * $tradeFeeBns)/100);
            $qty = ($amt/$bit->$coin->buyPrice);
            $cexPairs = findPairsCex($coin, $qty-$dnf, $cexJson);
            
            foreach($cexPairs as $key => $value) {
                foreach($bbnsJson as $b) {
                    if(property_exists($b, $key)) {
                        $sellPrice = $value * $b->$key->sellPrice;
                        $sellPrice = $sellPrice - (($sellPrice * $tradeFeeBns)/100);
                        $cexData[$key] = array('INVESTED'=> $investment, 'RETURN'=>$sellPrice, 'ROI_PER'=>(($sellPrice - $investment)/$investment)*100);        
                    }
                }
            }
            $output[$coin] = $cexData;
        }
    } 
}

echo json_encode($output);


function findPairsCex($coin, $qty, $cexJson) {
    
    $tradeFeeCex = 0.16;
    $pairs = array();
    $btcAmt = 0;
    $dnf = 0.002;
    
    foreach($cexJson->data as $data) {
        if($data->pair == "$coin:BTC") {
            $bidPrice = $data->bid;
            $soldAmount = $bidPrice * $qty;
            $btcAmt = $soldAmount - (($soldAmount * $tradeFeeCex)/100);
            break;
        }
    }
    
    foreach($cexJson->data as $data) {
        $c = explode(":",$data->pair)[0];
        $ask = $data->ask;
        $qtyBougth = ($btcAmt - (($btcAmt * $tradeFeeCex)/100))/$ask;
        $pairs[$c]=$qtyBougth - $dnf;
    }
    return $pairs;
}
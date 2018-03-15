<?php
error_reporting(0);
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

$clientBinance = new Client([
    'base_uri' => 'https://api.binance.com/',
    'timeout' => 5.0    
]);

$clientBittrex = new Client([
    'base_uri' => 'https://bittrex.com/',
    'timeout' => 5.0  
]);


$coinsToWatch = array('XRP','XLM','ETH', 'DASH','NEO','GAS','TRX','RPX','BCH');

$investment = 10000;
$dnf = 0.002;
$tradeFeeBns = 0.25;


$response = $clientCex->request('GET', '/api/tickers/BTC/BTC');
$cexJson = json_decode($response->getBody());


$responseBbns = $clientBbns->request('GET', '/order/getTickerAll');
$bbnsJson = json_decode($responseBbns->getBody());

$responseBinance = $clientBinance->request('GET', '/api/v3/ticker/bookTicker');
$binanceJson = json_decode($responseBinance->getBody());

$responseBittrex = $clientBittrex->request('GET','/api/v1.1/public/getmarketsummaries');
$bittrexJson = json_decode($responseBittrex->getBody());


$output = array();

foreach($bbnsJson as $bit) {
    foreach($coinsToWatch as $coin) {
        
        $cexData = array();
        $binanceData = array();
        
        if(property_exists($bit,$coin)) {
            $amt = ($investment - ($investment * $tradeFeeBns)/100);
            $qty = ($amt/$bit->$coin->buyPrice);
            
            // cex
            $cexPairs = findPairsCex($coin, $qty-$dnf, $cexJson);
            foreach($cexPairs as $key => $value) {
                foreach($bbnsJson as $b) {
                   // if($key == 'TRX') continue;
                    if(property_exists($b, $key)) {                      
                        $sellPrice = $value['QTY'] * $b->$key->buyPrice;
                        
                        $sellPrice = $sellPrice - (($sellPrice * $tradeFeeBns)/100);
                        $cexData[$key] = array('INVESTED'=> $investment , 'RETURN'=>$sellPrice,'BOUGHT_AT'=>$value['PRICE_BTC'],'SOLD_AT'=>$b->$key->buyPrice, 'ROI_PER'=>(($sellPrice - $investment)/$investment)*100);        
                    }
                }
            }
            
            // binance
            $binancePair = findPairsBinance($coin, $qty-$dnf, $binanceJson);
            foreach($binancePair as $key => $value) {
               // if($key == 'TRX') continue;
                foreach($bbnsJson as $b) {
                    if(property_exists($b, $key)) {
                        $sellPrice = $value['QTY'] * $b->$key->buyPrice;
                        $sellPrice = $sellPrice - (($sellPrice * $tradeFeeBns)/100);
                        $binanceData[$key] = array('INVESTED'=> $investment, 'RETURN'=>$sellPrice,'BOUGHT_AT'=>$value['PRICE_BTC'],'SOLD_AT'=>$b->$key->buyPrice, 'ROI_PER'=>(($sellPrice - $investment)/$investment)*100);        
                    }
                }
            }        
            
            // bittrex
            $bittrexPair = findPairsBittrex($coin, $qty-$dnf, $bittrexJson);
            foreach($bittrexPair as $key => $value) {
               // if($key == 'TRX') continue;
                foreach($bbnsJson as $b) {
                    if(property_exists($b, $key)) {
                        $sellPrice = $value['QTY'] * $b->$key->buyPrice;
                        $sellPrice = $sellPrice - (($sellPrice * $tradeFeeBns)/100);
                        $bittrexData[$key] = array('INVESTED'=> $investment, 'RETURN'=>$sellPrice,'BOUGHT_AT'=>$value['PRICE_BTC'],'SOLD_AT'=>$b->$key->buyPrice, 'ROI_PER'=>(($sellPrice - $investment)/$investment)*100);        
                    }
                }
            }   
            
            
            //$cexData = sortByRoi($cexData);
            //$binanceData = sortByRoi($binanceData);
            
            //$coinData = array();
            $output[$coin]['CEX'] = $cexData;
            $output[$coin]['BINANCE'] = $binanceData;
            $output[$coin]['BITTREX'] = $bittrexData;
            
            //array_push($output, $coinData);
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
        $pairs[$c]['QTY']=$qtyBougth - $dnf;
        $pairs[$c]['PRICE_BTC'] = $ask;
    }
    return $pairs;
}




function findPairsBinance($coin, $qty, $binanceJson){
    
    $tradeFeeBin = 0.16;
    $btcAmt = 0;
    $dnf = 0.002;
    global $bbnsJson;
    
    
    foreach($binanceJson as $bin){
        if($bin->symbol == "$coin"."BTC"){
            $bidPrice = $bin->bidPrice;
            $soldAmount = $bidPrice * $qty;
            $btcAmt = $soldAmount - (($soldAmount * $tradeFeeBin)/100);
            break;            
        }
    }
    
    foreach($bbnsJson as $bit) {
        $t = get_object_vars($bit);
        foreach($t as $k => $v) {
            //if($t == 'TRX') continue;
            foreach($binanceJson as $bin){
                if($bin->symbol == $k."BTC"){
                    $ask = $bin->askPrice;
                    $qtyBougth = ($btcAmt - (($btcAmt * $tradeFeeBin)/100))/$ask;
                    $pairs[$k]['QTY']=$qtyBougth - $dnf;
                    $pairs[$k]['PRICE_BTC']=$ask;
                    break;
                }
            }
        }
    } 
    
    return $pairs;
}

function findPairsBittrex($coin, $qty-$dnf, $bittrexJson) {
    $tradeFeeBittrex = 0.16;
    $btcAmt = 0;
    $dnf = 0.002;
    global $bbnsJson;
    
    foreach($bittrexJson->result as $bin){
        if($bin->MarketName == "BTC"."-".$coin){
            $bidPrice = $bin->Bid;
            $soldAmount = $bidPrice * $qty;
            $btcAmt = $soldAmount - (($soldAmount * $tradeFeeBin)/100);
            break;            
        }
    }
    
    foreach($bbnsJson as $bit) {
        $t = get_object_vars($bit);
        foreach($t as $k => $v) {
            //if($t == 'TRX') continue;
            foreach($bittrexJson->result as $bin){
                if($bin->symbol == "BTC"."-".$k){
                    $ask = $bin->Ask;
                    $qtyBougth = ($btcAmt - (($btcAmt * $tradeFeeBin)/100))/$ask;
                    $pairs[$k]['QTY']=$qtyBougth - $dnf;
                    $pairs[$k]['PRICE_BTC']=$ask;
                    break;
                }
            }
        }
    } 
        
     return $pairs;
}



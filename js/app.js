var app = angular.module('cryptoApp',[]);


app.controller('ArbitrageController', function($scope, $http){
    
        $scope.updatePrice = function() {
        $scope.btnDisabled = true;  
        $scope.coinList = [];    
            
        $http.get('arbi.php').then(function(res){
            
            $scope.dataList = res.data;
            $scope.btnDisabled = false;   
            $scope.coinList = []; 
            angular.forEach($scope.dataList, function(currency, sym){
                var coinDetails = {};
                var maxRoi = -999999;
                angular.forEach(currency, function(exchangeData, exchange){
                    angular.forEach(exchangeData, function(coinData, coin){
                        if(coinData.ROI_PER >= maxRoi) {
                            maxRoi = coinData.ROI_PER;
                            coinDetails.roi = maxRoi;
                            coinDetails.currency = sym;
                            coinDetails.exchange = exchange;
                            coinDetails.boughtAt = coinData.BOUGHT_AT;
                            coinDetails.soldAt = coinData.SOLD_AT;
                            coinDetails.coin = coin;
                        }
                    });
                });
                $scope.coinList.push(coinDetails);
            }, this);
            
        });
    }
    
    $scope.updatePrice();
    
});

app.controller('DashboardController', function($scope, $http){
        
        $scope.currentNode = {"CEX":{"ETH":{"INVESTED":10000,"RETURN":9654.55176702548,"BOUGHT_AT":0.079183,"SOLD_AT":49001,"ROI_PER":-3.454482329745206},"BCH":{"INVESTED":10000,"RETURN":9643.646573270984,"BOUGHT_AT":0.115139,"SOLD_AT":71500,"ROI_PER":-3.563534267290161},"DASH":{"INVESTED":10000,"RETURN":10014.603966055452,"BOUGHT_AT":0.054697,"SOLD_AT":35001,"ROI_PER":0.14603966055452475},"XRP":{"INVESTED":10000,"RETURN":9890.236567643777,"BOUGHT_AT":0.00008923,"SOLD_AT":56,"ROI_PER":-1.0976343235622334},"XLM":{"INVESTED":10000,"RETURN":9767.907211440566,"BOUGHT_AT":0.00003309,"SOLD_AT":20.51,"ROI_PER":-2.3209278855943376}},"BINANCE":{"XRP":{"INVESTED":10000,"RETURN":9914.68637352159,"BOUGHT_AT":"0.00008913","SOLD_AT":56,"ROI_PER":-0.853136264784098},"NEO":{"INVESTED":10000,"RETURN":9943.092890085696,"BOUGHT_AT":"0.00970900","SOLD_AT":6125.05,"ROI_PER":-0.5690710991430388},"GAS":{"INVESTED":10000,"RETURN":9929.192972089408,"BOUGHT_AT":"0.00284700","SOLD_AT":1792,"ROI_PER":-0.708070279105923},"ETH":{"INVESTED":10000,"RETURN":9688.467016638268,"BOUGHT_AT":"0.07901500","SOLD_AT":49001,"ROI_PER":-3.115329833617325},"XLM":{"INVESTED":10000,"RETURN":9825.62106434056,"BOUGHT_AT":"0.00003294","SOLD_AT":20.51,"ROI_PER":-1.743789356594407},"RPX":{"INVESTED":10000,"RETURN":9608.535199992411,"BOUGHT_AT":"0.00001125","SOLD_AT":6.85,"ROI_PER":-3.9146480000758856},"LTC":{"INVESTED":10000,"RETURN":9758.942452458316,"BOUGHT_AT":"0.02066000","SOLD_AT":12810,"ROI_PER":-2.4105754754168447},"XMR":{"INVESTED":10000,"RETURN":10200.05190251559,"BOUGHT_AT":"0.02928600","SOLD_AT":19000,"ROI_PER":2.0005190251558997},"DASH":{"INVESTED":10000,"RETURN":9997.466708716513,"BOUGHT_AT":"0.05486400","SOLD_AT":35001,"ROI_PER":-0.02533291283487415},"TRX":{"INVESTED":10000,"RETURN":10009.990394682869,"BOUGHT_AT":"0.00000402","SOLD_AT":2.55,"ROI_PER":0.0999039468286901}}};
    
        $scope.updatePrice = function() {
            $scope.btnDisabled = true;  
            $scope.coinList = [];  

            $http.get('arbi.php').then(function(res){

                $scope.dataList = res.data;
                $scope.btnDisabled = false;          
                //$scope.currentNode = $scope.dataList.XRP;
            });
        }
        
        $scope.updateCurrentNode = function(details){
            $scope.currentNode = details;
        }
        
        $scope.updatePrice();
});

app.controller('CryptoController', function($scope, $http){
    
     
     $scope.updatePrice = function(){
        
       $scope.btnDisabled = true;     
        
    console.log($scope.reverse);
       if($scope.reverse) {
           $http.get('api.php?reverse=true').then(function(res){
           $scope.price = res.data;
           $scope.btnDisabled = false;     
       })     
           
       } else   {
           $http.get('api.php').then(function(res){
               $scope.price = res.data;
               $scope.btnDisabled = false;     
           });
       }
        
     }   
    
   /* 
    setInterval(function(){
      $scope.updatePrice();
    }, 10000);
    */
 
    $scope.updatePrice();
});
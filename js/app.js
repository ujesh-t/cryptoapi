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
        
        $scope.currentNode = {};
    
        $scope.updatePrice = function() {
            $scope.btnDisabled = true;  
            $scope.coinList = [];    

            $http.get('arbi.php').then(function(res){

                $scope.dataList = res.data;
                $scope.btnDisabled = false;          

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
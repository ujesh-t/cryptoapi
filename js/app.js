var app = angular.module('cryptoApp',[]);

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
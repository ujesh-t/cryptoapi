var app = angular.module('cryptoApp',[]);

app.controller('CryptoController', function($scope, $http){
    
     
     $scope.updatePrice = function(){
       console.log('>>>');
       $http.get('api.php').then(function(res){
           $scope.price = res.data;
       });
        
     }   
    
    
    setInterval(function(){
      $scope.updatePrice();
    }, 10000);
    
 
    $scope.updatePrice();
});
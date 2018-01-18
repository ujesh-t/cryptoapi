var app = angular.module('cryptoApp',[]);

app.controller('CryptoController', function($scope, $http){
    
     
     $scope.updatePrice = function(){
        
       $scope.btnDisabled = true;     
         
       console.log('>>>');
       $http.get('api.php').then(function(res){
           $scope.price = res.data;
           $scope.btnDisabled = false;     
       });
        
     }   
    
   /* 
    setInterval(function(){
      $scope.updatePrice();
    }, 10000);
    */
 
    $scope.updatePrice();
});
<!DOCTYPE html>
<html>
    <head>
        
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
    <link rel="stylesheet" type="text/css" href="semantic/dist/components/menu.min.css">
    <link rel="stylesheet" type="text/css" href="semantic/dist/components/icon.min.css">
    <link rel="stylesheet" type="text/css" href="semantic/dist/components/table.min.css">
    <link rel="stylesheet" type="text/css" href="semantic/dist/components/label.min.css">
    <link rel="stylesheet" type="text/css" href="semantic/dist/components/grid.min.css">
    
    <script src="https://code.jquery.com/jquery-3.1.1.min.js" integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.6/angular.min.js"></script>
    <script src="semantic/dist/semantic.min.js"></script>  
    <script src="js/app.js"></script>
        
    </head>
<body ng-app="cryptoApp">
    
    <div class="ui top fixed menu teal">
      <div class="header item">Cryptoapi</div>

    </div>
    
    <div class="container grid" style="margin-top:90px;" ng-controller="CryptoController">
    <div class="row">
        <div class="sixteen wide column">
         <table class="ui celled table">
        <thead>
          <tr><th>Coin</th><th>USD</th><th>EURO</th><th>INR</th></tr>  
        </thead>
        
        <tbody>
            <tr>
                <td><div class="ui ribbon label red">BTC</div></td>
                <td>{{price.BTC.USD}}</td>
                <td>{{price.BTC.EUR}}</td>
                <td>{{price.BTC.INR}}</td>
            </tr>
            <tr>
                <td><div class="ui ribbon label orange">BCH</div></td>
                <td>{{price.BCH.USD}}</td>
                <td>{{price.BCH.EUR}}</td>
                <td>{{price.BCH.INR}}</td>
            </tr> 
            <tr>
                <td><div class="ui ribbon label blue">XRP</div></td>
                <td>{{price.XRP.USD}}</td>
                <td>{{price.XRP.EUR}}</td>
                <td>{{price.XRP.INR}}</td>
            </tr>
            <tr>
                <td><div class="ui ribbon label violet">ETH</div></td>
                <td>{{price.ETH.USD}}</td>
                <td>{{price.ETH.EUR}}</td>
                <td>{{price.ETH.INR}}</td>
            </tr>  
        </tbody>
      </table>      
        </div>
    </div>
     
    </div>
</body>
</html>
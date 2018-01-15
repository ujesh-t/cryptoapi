<!DOCTYPE html>
<html>
    <head>
        
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
    <link rel="stylesheet" type="text/css" href="semantic/dist/components/menu.min.css">
    <link rel="stylesheet" type="text/css" href="semantic/dist/components/icon.min.css">
    <link rel="stylesheet" type="text/css" href="semantic/dist/components/table.min.css">
    <link rel="stylesheet" type="text/css" href="semantic/dist/components/label.min.css">
    <link rel="stylesheet" type="text/css" href="semantic/dist/components/grid.min.css">
    
    <link rel="stylesheet" type="text/css" href="bower_components/cryptofont/css/cryptofont.min.css">
        
    
    <script src="https://code.jquery.com/jquery-3.1.1.min.js" integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.6/angular.min.js"></script>
    <script src="semantic/dist/semantic.min.js"></script>  
    <script src="js/app.js"></script>
        
    </head>
<body ng-app="cryptoApp">
    
    <div class="ui top fixed menu teal">
      <div class="header item">Cryptoapi</div>
      <div class="item"><i class="rupee icon"></i></div>
      <div class="item"><i class="euro icon"></i></div>
      <div class="item"><i class="dollar icon"></i></div>

    </div>
    
    <div class="container grid" style="margin-top:90px;" ng-controller="CryptoController">
    <div class="row">
        <div class="sixteen wide column">
         <table class="ui celled table">
        <thead style="display:none;">
          <tr><th>Coin</th><th>USD</th><th>EURO</th><th>INR</th></tr>  
        </thead>
        
        <tbody>
            <tr>
                <td><div class="ui ribbon label red">BTC <i class="cf cf-btc"></i></div></td>
                <td>&#8377; {{price.BTC.USD | number:2}} <span>({{price.BTC.USD_ORI | currency}})</span></td>
                <td>&#8377; {{price.BTC.EUR | number:2}} <span>({{price.BTC.EUR_ORI | number:2}} &euro;)</span></td>
                <td>&#8377; {{price.BTC.INR | number:2}} </td>
            </tr>
            <tr>
                <td><div class="ui ribbon label orange">BCH <i class="cf cf-btc-alt"></i></div></td>
                <td>&#8377; {{price.BCH.USD | number:2}} <span>({{price.BCH.USD_ORI | currency}})</span></td>
                <td>&#8377; {{price.BCH.EUR | number:2}} <span>({{price.BCH.EUR_ORI | number:2}} &euro;)</span></td>
                <td>&#8377; {{price.BCH.INR | number:2}}</td>
            </tr> 
            <tr>
                <td><div class="ui ribbon label blue">XRP <i class="cf cf-xrp"></i></div></td>
                <td>&#8377; {{price.XRP.USD | number:2}} <span>({{price.XRP.USD_ORI | currency}})</span></td>
                <td>&#8377; {{price.XRP.EUR | number:2}} <span>({{price.XRP.EUR_ORI | number:2}} &euro;)</span></td>
                <td>&#8377; {{price.XRP.INR | number:2}} <span>({{(((price.XRP.INR-price.XRP.EUR)/price.XRP.INR)*100) | number:2}}%)</span></td>
            </tr>
            <tr>
                <td><div class="ui ribbon label violet">ETH <i class="cf cf-eth"></i></div></td>
                <td>&#8377; {{price.ETH.USD | number:2}} <span>({{price.ETH.USD_ORI | currency}})</span></td>
                <td>&#8377; {{price.ETH.EUR | number:2}} <span>({{price.ETH.EUR_ORI | number:2}} &euro;)</span></td>
                <td>&#8377; {{price.ETH.INR | number:2}}</td>
            </tr>  
        </tbody>
      </table>      
        </div>
    </div>
     
    </div>
</body>
</html>
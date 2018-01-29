<!DOCTYPE html>
<html>
    <head>
        
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
    <link rel="stylesheet" type="text/css" href="semantic/dist/components/menu.min.css">
    <link rel="stylesheet" type="text/css" href="semantic/dist/components/icon.min.css">
    <link rel="stylesheet" type="text/css" href="semantic/dist/components/table.min.css">
    <link rel="stylesheet" type="text/css" href="semantic/dist/components/label.min.css">
    <link rel="stylesheet" type="text/css" href="semantic/dist/components/grid.min.css">
    <link rel="stylesheet" type="text/css" href="semantic/dist/components/button.min.css">
    <link rel="stylesheet" type="text/css" href="semantic/dist/components/message.min.css">
    
    
    <link rel="stylesheet" type="text/css" href="bower_components/cryptofont/css/cryptofont.min.css">
    <link rel="icon" href="favicon.ico" type="image/x-icon">  
    
    <script src="https://code.jquery.com/jquery-3.1.1.min.js" integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.6/angular.min.js"></script>
    <script src="semantic/dist/semantic.min.js"></script>  
    <script src="js/app.js"></script>
    <title>Cryptoapi</title>
        
    </head>
<body ng-app="cryptoApp">
    
    <div class="ui top fixed menu blue inverted">
      <div class="header item">Cryptoapi</div>
      <div class="item"><i class="rupee icon"></i></div>
      <div class="item"><i class="euro icon"></i></div>
      <div class="item"><i class="dollar icon"></i></div>

    </div>
    
    <div class="container grid" style="margin-top:90px;" ng-controller="CryptoController">
    <div class="row">
        <div class="sixteen wide column">
        
            <div>
                <span><a class="ui red tag label"><i class="dollar icon"></i>= &#8377; {{price.USD | number:2}} </a></span>
                <span><a class="ui teal tag label"><i class="euro icon"></i>= &#8377; {{price.EUR | number:2}} </a></span>
            </div>                   
            
         <table class="ui celled table">
        <thead style="display:none;">
          <tr><th>Coin</th><th>USD</th><th>EURO</th><th>INR</th></tr>  
        </thead>
        
        <tbody>
            <tr>
                <td><div class="ui ribbon label yellow">BTC <i class="cf cf-btc"></i></div></td>
                <td>&#8377; {{price.BTC.USD | number:2}} <span>({{price.BTC.USD_ORI | currency}})</span> <i class="ui mini label teal horizontal">CEX</i></td>
                <td>&#8377; {{price.BTC.EUR | number:2}} <span>({{price.BTC.EUR_ORI | number:2}} &euro;)</span> <i class="ui mini label teal horizontal">CEX</i></td>
                <td>&#8377; {{price.BTC.INR | number:2}} <span>({{price.BTC.EUR < price.BTC.USD ? (((price.BTC.INR-price.BTC.EUR)/price.BTC.INR)*100) : (((price.BTC.INR-price.BTC.USD)/price.BTC.INR)*100) | number:2}}%)</span> <i class="ui mini label blue horizontal">KOINEX</i></td>
                <td>&#8377; {{price.BTC.CD | number:2}} <span>({{price.BTC.EUR < price.BTC.USD ? (((price.BTC.CD-price.BTC.EUR)/price.BTC.CD)*100) : (((price.BTC.CD-price.BTC.USD)/price.BTC.CD)*100) | number:2}}%)</span> <i class="ui mini label green horizontal">COINDELTA</i></td>
                <td>&#8377; {{price.BTC.BBNS | number:2}} <span>({{price.BTC.EUR < price.BTC.USD ? (((price.BTC.BBNS-price.BTC.EUR)/price.BTC.BBNS)*100) : (((price.BTC.BBNS-price.BTC.USD)/price.BTC.BBNS)*100) | number:2}}%)</span> <i class="ui mini label yellow horizontal">BITBNS</i></td>
                <td>&#8377; {{price.BTC.ZEBP | number:2}} <span>({{price.BTC.EUR < price.BTC.USD ? (((price.BTC.ZEBP-price.BTC.EUR)/price.BTC.ZEBP)*100) : (((price.BTC.ZEBP-price.BTC.USD)/price.BTC.ZEBP)*100) | number:2}}%)</span> <i class="ui mini label blue horizontal">ZEBPAY</i></td>
            </tr>
            <tr>
                <td><div class="ui ribbon label orange">BCH <i class="cf cf-btc-alt"></i></div></td>
                <td>&#8377; {{price.BCH.USD | number:2}} <span>({{price.BCH.USD_ORI | currency}})</span> <i class="ui mini label teal horizontal">CEX</i></td>
                <td>&#8377; {{price.BCH.EUR | number:2}} <span>({{price.BCH.EUR_ORI | number:2}} &euro;)</span> <i class="ui mini label teal horizontal">CEX</i></td>
                <td>&#8377; {{price.BCH.INR | number:2}} <span>({{price.BCH.EUR < price.BCH.USD ? (((price.BCH.INR-price.BCH.EUR)/price.BCH.INR)*100) : (((price.BCH.INR-price.BCH.USD)/price.BCH.INR)*100) | number:2}}%)</span> <i class="ui mini label blue horizontal">KOINEX</i></td>
                <td>&#8377; {{price.BCH.CD | number:2}} <span>({{price.BCH.EUR < price.BCH.USD ? (((price.BCH.CD-price.BCH.EUR)/price.BCH.CD)*100) : (((price.BCH.CD-price.BCH.USD)/price.BCH.CD)*100) | number:2}}%)</span> <i class="ui mini label green horizontal">COINDELTA</i></td>
                <td></td>
                <td></td>
            </tr> 
            <tr>
                <td><div class="ui ribbon label blue">XRP <i class="cf cf-xrp"></i></div></td>
                <td>&#8377; {{price.XRP.USD | number:2}} <span>({{price.XRP.USD_ORI | currency}})</span> <i class="ui mini label teal horizontal">CEX</i></td>
                <td>&#8377; {{price.XRP.EUR | number:2}} <span>({{price.XRP.EUR_ORI | number:2}} &euro;)</span> <i class="ui mini label teal horizontal">CEX</i></td>
                <td>&#8377; {{price.XRP.INR | number:2}} <span>({{price.XRP.EUR < price.XRP.USD ? (((price.XRP.INR-price.XRP.EUR)/price.XRP.INR)*100) : (((price.XRP.INR-price.XRP.USD)/price.XRP.INR)*100) | number:2}}%)</span> <i class="ui mini label blue horizontal">KOINEX</i></td>
                <td>&#8377; {{price.XRP.CD | number:2}} <span>({{price.XRP.EUR < price.XRP.USD ? (((price.XRP.CD-price.XRP.EUR)/price.XRP.CD)*100) : (((price.XRP.CD-price.XRP.USD)/price.XRP.CD)*100) | number:2}}%)</span> <i class="ui mini label green horizontal">COINDELTA</i></td>
                <td>&#8377; {{price.XRP.BBNS | number:2}} <span>({{price.XRP.EUR < price.XRP.USD ? (((price.XRP.BBNS-price.XRP.EUR)/price.XRP.BBNS)*100) : (((price.XRP.BBNS-price.XRP.USD)/price.XRP.BBNS)*100) | number:2}}%)</span> <i class="ui mini label yellow horizontal">BITBNS</i></td>
                <td></td>
            </tr>
            <tr>
                <td><div class="ui ribbon label violet">ETH <i class="cf cf-eth"></i></div></td>
                <td>&#8377; {{price.ETH.USD | number:2}} <span>({{price.ETH.USD_ORI | currency}})</span> <i class="ui mini label teal horizontal">CEX</i></td>
                <td>&#8377; {{price.ETH.EUR | number:2}} <span>({{price.ETH.EUR_ORI | number:2}} &euro;)</span> <i class="ui mini label teal horizontal">CEX</i></td>
                <td>&#8377; {{price.ETH.INR | number:2}} <span>({{price.ETH.EUR < price.ETH.USD ? (((price.ETH.INR-price.ETH.EUR)/price.ETH.INR)*100) : (((price.ETH.INR-price.ETH.USD)/price.ETH.INR)*100) | number:2}}%)</span> <i class="ui mini label blue horizontal">KOINEX</i></td>
                <td>&#8377; {{price.ETH.CD | number:2}} <span>({{price.ETH.EUR < price.ETH.USD ? (((price.ETH.CD-price.ETH.EUR)/price.ETH.CD)*100) : (((price.ETH.CD-price.ETH.USD)/price.ETH.CD)*100) | number:2}}%)</span> <i class="ui mini label green horizontal">COINDELTA</i></td>
                <td>&#8377; {{price.ETH.BBNS | number:2}} <span>({{price.ETH.EUR < price.ETH.USD ? (((price.ETH.BBNS-price.ETH.EUR)/price.ETH.BBNS)*100) : (((price.ETH.BBNS-price.ETH.USD)/price.ETH.BBNS)*100) | number:2}}%)</span> <i class="ui mini label yellow horizontal">BITBNS</i></td>
                <td></td>
            </tr>
        </tbody>
      </table>    
            <button class="ui primary button tiny" ng-disabled="btnDisabled" ng-click="updatePrice()">Refresh  <i class="icon refresh"></i></button>
        </div>
    </div>
     
    </div>
</body>
</html>
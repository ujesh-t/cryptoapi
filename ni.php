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
    <link rel="stylesheet" type="text/css" href="semantic/dist/components/card.min.css">
    <link rel="stylesheet" type="text/css" href="semantic/dist/components/item.min.css">
    
    
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
    
    <div class="container grid ui" style="margin-top:90px;" ng-controller="DashboardController">
    <div class="three wide column">
            <div class="ui vertical fluid tabular menu">
                <div class="item" ng-click="updateCurrentNode(details)" ng-repeat="(coin, details) in dataList">{{coin}}</div>
            </div>       
    </div>     
    <div class="six wide stretched column">
            <div class="olive column" ng-repeat="(exchange, priceList) in currentNode">
                <h1 class="ui header">{{exchange}}</h1>
                <div class="ui divided items">
                    <div class="item" ng-repeat="(c, p) in priceList">{{c}} <i class="icon rupee"></i> {{p.ROI_PER}}</div>
                </div>
            </div>        
    </div>
    </div>
    </body>
</html>
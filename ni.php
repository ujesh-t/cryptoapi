<!DOCTYPE html>
<html>
    <head>
        
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
    <!--link rel="stylesheet" type="text/css" href="semantic/dist/components/menu.min.css">
    <link rel="stylesheet" type="text/css" href="semantic/dist/components/icon.min.css">
    <link rel="stylesheet" type="text/css" href="semantic/dist/components/table.min.css">
    <link rel="stylesheet" type="text/css" href="semantic/dist/components/label.min.css">
    <link rel="stylesheet" type="text/css" href="semantic/dist/components/grid.min.css">
    <link rel="stylesheet" type="text/css" href="semantic/dist/components/button.min.css">
    <link rel="stylesheet" type="text/css" href="semantic/dist/components/message.min.css">
    <link rel="stylesheet" type="text/css" href="semantic/dist/components/card.min.css">
    <link rel="stylesheet" type="text/css" href="semantic/dist/components/item.min.css"-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">


    
    <link rel="stylesheet" type="text/css" href="bower_components/cryptofont/css/cryptofont.min.css">
    <link rel="icon" href="favicon.ico" type="image/x-icon">  
    
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.6/angular.min.js"></script>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="js/app.js"></script>
    <title>Cryptoapi</title>
        
    </head>
<body ng-app="cryptoApp">
    
<nav class="navbar navbar-expand-lg navbar-light bg-info">
  <a class="navbar-brand" href="#">Crpytoapi</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse pull-right" id="navbarSupportedContent">
  </div>
</nav>
    
    <div class="contianer" style="margin-top:5px;" ng-controller="DashboardController">
            <div class="row">
                <div class="col-lg-2">
                    
                    <ul class="nav flex-column nav-pills" aria-orientation="vertical">
                      <li class="nav-item" ng-repeat="(coin, details) in dataList">
                        <a class="nav-link" ng-class="{active: c===coin}" ng-click="updateCurrentNode(coin, details)" href="#">{{coin}} <span ng-class="(maxList[coin]>=0)?'badge-success':'badge-warning'" class="float-right badge">{{maxList[coin]|number:2}}%</span></a>
                        
                      </li>
                    </ul>      
                </div>  
                <div ng-show="btnDisabled" class="col-lg-10">
                    <img class="rounded mx-auto d-block" src="images/spinner.gif"/>
                </div>
                <div ng-hide="btnDisabled" class="col-lg-10">
                    <div class="row">                        
                        <div class="col-lg-4" ng-repeat="(exchange, priceList) in currentNode">
                            
                            <div class="list-group">
                              <a href="#" class="list-group-item list-group-item-action active">{{exchange}}</a>
                              <a href="#" ng-repeat="p in priceList | orderBy:'-ROI_PER'" class="list-group-item list-group-item-action" ng-class="{'text-danger': p.ROI_PER < 0}"> {{p.ROI_PER | number:2}}% - {{p.COIN}}</a>
                            </div>
                        </div>  
                    </div>                
                </div>
        </div>                 
    </div>
    
    <script>
    $(document).on("click", ".nav-link", function() {
        $(".nav-link").removeClass("active");
        $(this).addClass("active"); 
    });
    
    </script>
           
    </body>
</html>
    var app=angular.module('todoApp', []);
  
    app.controller('fotos', function($scope, $http)
    {
       $http({
          method : "GET",
          url : "dir.json"
        }).then(function mySucces(response) {
            $scope.artis = response.data;
        }, function myError(response) {
            $scope.artis = response.statusText;
        });
    });


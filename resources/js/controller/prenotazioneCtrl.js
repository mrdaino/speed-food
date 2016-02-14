/**
 * Created by Lorenzo Daneo.
 * mail to lorenzo.daneo@coolsholp.it
 */

app.controller('prenotazioneCtrl',['$scope','$routeParams',function($scope,$routeParams){

    var userId = $routeParams.userId;

    var response = request("prodotti").post(userId);
    response.success(function(data){
        $scope.ristoranti = data;
        $scope.$apply();
    });
    response = request("ingredienti").post(userId);
    response.success(function(data){
        $scope.ristoranti = data;
        $scope.$apply();
    });

}]);
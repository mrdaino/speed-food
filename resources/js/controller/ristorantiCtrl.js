/**
 * Created by Lorenzo Daneo.
 * mail to lorenzo.daneo@coolsholp.it
 */

app.controller('ristorantiCtrl',['$scope',function($scope){

    $scope.ristoranti = [];

    var response = request("ristoranti").get();
    response.success(function(data){
        $scope.ristoranti = data;
        $scope.$apply();
    });

}]);
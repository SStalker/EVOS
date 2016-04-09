/**
 * Created by davidherzog on 09.04.16.
 */

var evos = angular.module('evosApp', ['ngRoute'], function($interpolateProvider) {
    $interpolateProvider.startSymbol('<%');
    $interpolateProvider.endSymbol('%>');
});

evos.controller('frontEndController', ['$scope', '$http', function($scope, $http) {
    $scope.sendQuizPin = function (quizPin) {

        $http.get('/quiz/'+quizPin).then(function(response) {
            alert(response.data);
        })
    }
}]);
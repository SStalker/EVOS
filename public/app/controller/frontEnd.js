/**
 * Created by davidherzog on 09.04.16.
 */

var evos = angular.module('evosApp', ['ngRoute'], function($interpolateProvider) {
    $interpolateProvider.startSymbol('<%');
    $interpolateProvider.endSymbol('%>');
});

evos.controller('frontEndController', ['$scope', '$http', '$window', function($scope, $http, $window) {

    $scope.sendQuizPin = function (quizPin) {

        $http.get('/quiz/'+quizPin).then(function(response) {

            if (response.data == 'quiz_exists') {
                $window.location.href = 'entername';

            } else {
                alert('Das Quiz mit der Pin '+quizPin+' existiert nicht!');
            }

        });
    }

    $scope.sendName = function (name) {

        

    }
}]);
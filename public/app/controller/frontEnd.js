/**
 * Created by davidherzog on 09.04.16.
 */

var evos = angular.module('evosApp', ['ngRoute', 'ngCookies'], function($interpolateProvider) {
    $interpolateProvider.startSymbol('<%');
    $interpolateProvider.endSymbol('%>');
});

evos.config(function($routeProvider) {
   $routeProvider
       .when('/start', {
           templateUrl: 'pages/frontendlanding.html',
           controller: 'frontEndController'
        })
       .when('/entername', {
           templateUrl: 'pages/entername.html',
           controller: 'frontEndController'
       });
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

    $scope.sendName = function (attandeeName) {

        $http.post('/attendee', {
            name: attandeeName
        }).then(function(response) {

            document.write(response.data);

        });

    }
}]);
/**
 * Created by davidherzog on 09.04.16.
 */

var evos = angular.module('evosApp', ['ngRoute', 'ngCookies'], function($interpolateProvider) {
    $interpolateProvider.startSymbol('<%');
    $interpolateProvider.endSymbol('%>');
});

evos.controller('frontEndController', ['$scope', '$http', '$window', function($scope, $http, $window, CSRF_TOKEN) {

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

        var myToken = document.getElementsByTagName('meta')['csrf-token'].getAttribute('content');
        alert(myToken);
        $http.post('/attendee', {
            name: attandeeName,
            _token: myToken
        }).then(function(response) {

            alert(response.data);

        });

    }
}]);
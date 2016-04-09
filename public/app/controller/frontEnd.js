/**
 * Created by davidherzog on 09.04.16.
 */

var evos = angular.module('evosApp', ['ngRoute'], function($interpolateProvider) {
    $interpolateProvider.startSymbol('<%');
    $interpolateProvider.endSymbol('%>');
});

evos.controller('frontEndController', function($scope) {
    $scope.sendQuizPin = function (quizPin) {
        alert(quizPin);
    }
});
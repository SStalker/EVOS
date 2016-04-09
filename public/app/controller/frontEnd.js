/**
 * Created by davidherzog on 09.04.16.
 */

var evos = angular.module('evosApp', [], function($interpolateProvider) {
    $interpolateProvider.startSymbol('<%');
    $interpolateProvider.endSymbol('%>');
});

evos.controller('frontEndController', function($scope) {
    $scope.test = "Nur ein test!";
});
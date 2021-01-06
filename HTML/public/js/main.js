angular.module("main", ['ngAnimate', 'ngRoute'])
.config(function($routeProvider, $locationProvider){
    $locationProvider.html5Mode(true);
    $routeProvider.when('/', {
        templateUrl: 'partials/principal.html',
        controller: 'MainController'
    });
    $routeProvider.otherwise({
        redirectTo: '/'
    });

});

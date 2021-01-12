angular.module("main", ['ngAnimate', 'ngRoute'])
.config(function($routeProvider, $locationProvider){
    $locationProvider.html5Mode(true);
    $routeProvider.when('/', {
        templateUrl: 'partials/principal.html',
        controller: 'IndexController'
    });
    $routeProvider.when('/cadastro', {
        templateUrl: 'partials/cadastro.html',
        controller: 'CadastroController'
    })
    $routeProvider.otherwise({
        redirectTo: '/'
    });

});

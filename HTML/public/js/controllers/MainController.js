angular.module('main').controller('MainController', function ($scope, $http) {
    $scope.titulo = "Lista de Contatos";
    $scope.lista = []

    $http.get('http://localhost:8080/api/contatos', {
        method: 'GET'
    }).then(resp =>{
        $scope.lista = resp.data;
    })
    console.log($scope.lista)
})
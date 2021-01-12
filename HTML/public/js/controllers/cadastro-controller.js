angular.module('main').controller('CadastroController', function ($scope, $http, $timeout, $location) {

    $scope.titulo = "Adição de contatos";
    $scope.message = "";

    $scope.nome = 'luiz';
    $scope.email = 'l.otavio9099@gmail.com';
    $scope.num = 147788775454;

    $scope.data = {
        'nome': $scope.nome,
        'email': $scope.email,
        'numero': $scope.num
    };
    $scope.cadastrar = function () {
        $http.post('http://localhost:8080/api/contatos/', $scope.data).success(res => {
            console.log(res);
            $scope.transition = true;
            $scope.message = 'CADASTRO EM CONSTRUÇÃO, FOI FEITO UM POST';
            $timeout(f => {
                $scope.transition = false;
                $scope.message = 'CADASTRO EM CONSTRUÇÃO, FOI FEITO UM POST';
            }, 5000)
        }).error(res => {
            console.log(res);
        })
    }
    $scope.inicio = function(){
        $location.path("/");
    }
    
})
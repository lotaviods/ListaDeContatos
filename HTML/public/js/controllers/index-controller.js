angular.module('main').controller('IndexController', function ($scope, $http, $timeout) {

    $scope.titulo = "Lista de Contatos";
    $scope.contatos = [];
    $scope.resp = {};
    $scope.message = "";

    $http.get('http://localhost:8080/api/contatos', {
        method: 'GET'
    }).success(resp =>{
        $scope.resp = resp;
        $scope.contatos = $scope.resp.conteudoResposta;
    }).error(resp =>{
        $scope.message = resp.conteudoResposta.mensagem;
    })
    $scope.excluir = function(id){
        //Criar service para refatorar.
        //Criar função para apagar.
        $scope.transition = true;
        $scope.message = `Ainda não adicionada a funcionalidade: id ${id}`;
        $timeout(f=>{
            $scope.transition = false;
            $scope.message = '';
        }, 5000)
    }
})
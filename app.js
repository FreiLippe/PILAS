/* Criando a aplicação com AngularJS*/
var app = angular.module("pilas", []);

/* Declarando um controller para nossa aplicação */
app.controller("pilasController", pilasController);

/* Criando a função que será executada pelo controller */
function pilasController($scope, $http) {

    /* Declarando variáveis e objetos do controller*/
    $scope.lancamentos = [];
    $scope.categorias = [];
    $scope.categoria = '';

    $scope.lancamento = {
        idlancamento: 0,
        idcategoria: 0,
        tipo: 0,
        descricao: '',
        valor: 0
    }

    $scope.lancamentoAlterado = {};

    /* Declarando funções do controller */
    $scope.listarLancamentos = function () {
        $http
            .get('http://localhost/pilas/backSymfony/public/lancamento-listar')
            .error(function () {
                alert('Falha de comunicacao com o back-end.');
            })
            .success(function (retorno) {
                $scope.lancamentos = retorno;
                console.log($scope.lancamentos);
            });
    }

    $scope.listarCategorias = function () {
        $http
            .get('http://localhost/pilas/backSymfony/public/categoria-listar')
            .error(function () {
                alert('Falha ao comunicar com o back-end.');
            })
            .success(function (retorno) {
                $scope.categorias = retorno;
                console.log($scope.categorias);
            });
    }

    $scope.inserirCategoria = function () {
        $http
            .post('http://localhost/pilas/backSymfony/public/categoria-inserir', { 'categoria': $scope.categoria})
            .error(function () {
                alert('Falha de comunicacao com o back-end ao inserir categoria.');
            })
            .success(function (retorno) {
                if (retorno == 0) {
                    alert('Nao foi possivel inserir a categoria');
                }
                else {
                    alert('Categoria inserida com sucesso.');
                    $scope.listarCategorias();
                }
            });
    }

    $scope.inserirLancamento = function () {

        let obj = {
            idcategoria: $scope.lancamento.idcategoria,
            tipo: $scope.lancamento.tipo,
            descricao: $scope.lancamento.descricao,
            valor: $scope.lancamento.valor
        }

        console.log($scope.url);

        console.log(obj);

        $http
            .post('http://localhost/pilas/backSymfony/public/lancamento-inserir', obj)
            .error(function () {
                alert('Falha de comunicao com o back-end ao inserir um lancamento.');
            })
            .success(function (retorno) {
                if (retorno == 0) {
                    alert('Nao foi possivel inserir o lancamento.');
                }
                else {
                    alert('Lancamento inserido com sucesso.');
                    $scope.listarLancamentos();
                }
            });
    }

    $scope.alterarLancamento = function () {

        let obj = {
            idcategoria: $scope.lancamentoAlterado.categoria.id,
            tipo: $scope.lancamentoAlterado.tipo,
            descricao: $scope.lancamentoAlterado.descricao,
            valor: $scope.lancamentoAlterado.valor
        }

        console.log($scope.url);

        console.log($scope.lancamentoAlterado);

        $http
            .put('http://localhost/pilas/backSymfony/public/lancamento-atualiza/' + $scope.lancamentoAlterado.id, obj)
            .error(function () {
                alert('Falha de comunicao com o back-end ao alterar um lancamento.');
            })
            .success(function (retorno) {
                console.log(retorno);
                if (retorno == 0) {
                    alert('Nao foi possivel alterar o lancamento.');
                }
                else {
                    alert('Lancamento alterado com sucesso.');
                    $scope.listarLancamentos();
                }
            });
    }

    $scope.carregarLancamento = function (objeto) {
        $scope.lancamentoAlterado = objeto;
    }

    $scope.excluirLancamento = function (objeto) {
        if (!confirm('Deseja excluir este lançamento agora?'))
            return;

        $http
            .delete('http://localhost/pilas/backSymfony/public/lancamento-deleta/' + objeto.id)
            .error(function () {
                alert('Falha de comunicacao com o back-end ao excluir um lancamento.');
            })
            .success(function (retorno) {
                alert('Lancamento excluido com sucesso.');
                $scope.listarLancamentos();
            });

    }

    /* Chamando funções do controller ao iniciar a aplicação */
    $scope.listarLancamentos();
    $scope.listarCategorias();

}
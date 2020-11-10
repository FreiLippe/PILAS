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
        idcategoria: 0,
        tipo: 0,
        descricao: '',
        valor: 0
    }

    $scope.lancamentoAlterado = {};

    /* Declarando funções do controller */
    $scope.listarLancamentos = function () {
        $http
            .get('back/lancamento_listar.php')
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
            .get('back/categoria_listar.php')
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
            .get('back/categoria_inserir.php?categoria=' + $scope.categoria)
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

        $scope.url = 'back/lancamento_inserir.php?idcategoria=:idcategoria&tipo=:tipo&descricao=:descricao&valor=:valor';
        $scope.url = $scope.url.replace(':idcategoria', $scope.lancamento.idcategoria);
        $scope.url = $scope.url.replace(':tipo', $scope.lancamento.tipo);
        $scope.url = $scope.url.replace(':descricao', $scope.lancamento.descricao);
        $scope.url = $scope.url.replace(':valor', $scope.lancamento.valor);

        console.log($scope.url);

        $http
            .get($scope.url)
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

        $scope.url = 'back/lancamento_alterar.php?idlancamento=:idlancamento&descricao=:descricao&valor=:valor';
        $scope.url = $scope.url.replace(':idlancamento', $scope.lancamentoAlterado.idlancamento);
        $scope.url = $scope.url.replace(':descricao', $scope.lancamentoAlterado.descricao);
        $scope.url = $scope.url.replace(':valor', $scope.lancamentoAlterado.valor);

        console.log($scope.url);

        $http
            .get($scope.url)
            .error(function () {
                alert('Falha de comunicao com o back-end ao alterar um lancamento.');
            })
            .success(function (retorno) {
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
            .get('back/lancamento_excluir.php?idlancamento=' + objeto.idlancamento)
            .error(function () {
                alert('Falha de comunicacao com o back-end ao excluir um lancamento.');
            })
            .success(function (retorno) {
                if (retorno == 0) {
                    alert('Nao foi possivel excluir o lancamento.');
                }
                else {
                    alert('Lancamento excluido com sucesso.');
                    $scope.listarLancamentos();
                }
            });

    }

    /* Chamando funções do controller ao iniciar a aplicação */
    $scope.listarLancamentos();
    $scope.listarCategorias();

}
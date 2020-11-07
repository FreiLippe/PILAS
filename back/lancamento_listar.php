<?php
    //Inclui o arquivo da conexão do banco de dados
    require "banco.php";    

    //Comando SQL
    $sql = "SELECT lancamento.*, categoria.categoria
            FROM lancamento
            JOIN categoria ON categoria.idcategoria = lancamento.idcategoria
            ORDER BY datahora DESC";

    //Prepara o comando SQL
    $qry = $con->prepare($sql);

    //Executa o comando SQL
    $qry->execute();    

    //Pega os dados de retorno do sql e transforma em objetos
    $dados = $qry->fetchAll(PDO::FETCH_OBJ);

    //Devolve os dados no formato json
    echo json_encode($dados);
?>
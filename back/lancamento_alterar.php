<?php
    //Inclui o arquivo da conexão do banco de dados
    require "banco.php";   

    //Captura os paramêtros que foram enviados pela aplicação cliente
    $idlancamento = $_GET{"idlancamento"};
    $descricao = $_GET{"descricao"};
    $valor = $_GET{"valor"};

    //Comando SQL
    $sql = "UPDATE lancamento SET descricao = :descricao, valor = :valor
            WHERE idlancamento = :idlancamento";

    //Prepara o comando SQL
    $qry = $con->prepare($sql);

    //Preencher os paramêtros do sql
    $qry->bindParam(":idlancamento", $idlancamento, PDO::PARAM_STR);
    $qry->bindParam(":descricao", $descricao, PDO::PARAM_STR);
    $qry->bindParam(":valor", $valor, PDO::PARAM_STR);

    //Executa o comando SQL
    $qry->execute();    

    //Devolve o número de registros afetados
    echo $qry->rowCount();
?>
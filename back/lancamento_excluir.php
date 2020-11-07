<?php
    //Inclui o arquivo da conexão do banco de dados
    require "banco.php";   

    //Captura os paramêtros que foram enviados pela aplicação cliente
    $idlancamento = $_GET{"idlancamento"};

    //Comando SQL
    $sql = "DELETE FROM lancamento
            WHERE idlancamento = :idlancamento";

    //Prepara o comando SQL
    $qry = $con->prepare($sql);

    //Preencher os paramêtros do sql
    $qry->bindParam(":idlancamento", $idlancamento, PDO::PARAM_STR);

    //Executa o comando SQL
    $qry->execute();    

    //Devolve o número de registros afetados
    echo $qry->rowCount();
?>
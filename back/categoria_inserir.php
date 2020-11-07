<?php
    //Inclui o arquivo da conexão do banco de dados
    require "banco.php";   

    //Captura os paramêtros que foram enviados pela aplicação cliente
    $categoria = $_GET{"categoria"};

    //Comando SQL
    $sql = "INSERT INTO categoria (categoria)
            VALUES (:categoria)";

    //Prepara o comando SQL
    $qry = $con->prepare($sql);

    //Preencher os paramêtros do sql
    $qry->bindParam(":categoria", $categoria, PDO::PARAM_STR);

    //Executa o comando SQL
    $qry->execute();    

    //Devolve o número de registros afetados
    echo $qry->rowCount();
?>
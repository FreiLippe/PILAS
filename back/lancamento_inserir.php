<?php
    //Inclui o arquivo da conexão do banco de dados
    require "banco.php";   

    //Captura os paramêtros que foram enviados pela aplicação cliente
    $idcategoria = $_GET{"idcategoria"};
    $tipo = $_GET{"tipo"};
    $descricao = $_GET{"descricao"};
    $valor = $_GET{"valor"};

    //Comando SQL
    $sql = "INSERT INTO lancamento (idcategoria, tipo, descricao, valor)
            VALUES (:idcategoria, :tipo, :descricao, :valor)";

    //Prepara o comando SQL
    $qry = $con->prepare($sql);

    //Preencher os paramêtros do sql
    $qry->bindParam(":idcategoria", $idcategoria, PDO::PARAM_STR);
    $qry->bindParam(":tipo", $tipo, PDO::PARAM_STR);
    $qry->bindParam(":descricao", $descricao, PDO::PARAM_STR);
    $qry->bindParam(":valor", $valor, PDO::PARAM_STR);

    //Executa o comando SQL
    $qry->execute();    

    //Devolve o número de registros afetados
    echo $qry->rowCount();
?>
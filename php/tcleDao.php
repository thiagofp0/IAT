<?php
    include_once("conexao.php");

    $nome = $_POST['nome'];
    $contato = $_POST['contato'];

    if($conexao){
        $sql = "INSERT INTO tcle (nome, contato) values ('$nome', '$contato');";
        $resultado = mysqli_query($conexao, $sql);

        if($resultado){
            header("location:explicito.php");
        }
    }
?>
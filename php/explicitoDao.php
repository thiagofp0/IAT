<?php
    include_once("conexao.php");

    $sexo = $_POST['sexo'];
    $curso = $_POST['curso'];
    $idade = $_POST['idade'];
    $cor = $_POST['cor'];
    $q6= $_POST['q6'];
    $q7 = $_POST['q7'];
    $q8 = $_POST['q8'];
    $q9 = $_POST['q9'];
    $q10a = $_POST['q10a'];
    $q10b = $_POST['q10b'];
    $q10c = $_POST['q10c'];
    $q10d = $_POST['q10d'];
    $q10e = $_POST['q10e'];
    $q10f = $_POST['q10f'];
    $q11a = $_POST['q11a'];
    $q11b = $_POST['q11b'];
    $q11c = $_POST['q11c'];
    $genero = $_POST['genero'];

    if($conexao){
        $sql = "INSERT INTO explicito(sexo, curso, idade, cor, q6, q7, q8, q9, q10a, q10b, q10c, q10d, q10e, q10f, q11a, q11b, q11c, genero) VALUES ($sexo, $curso, $idade, '$cor', '$q6', '$q7', '$q8', '$q9', '$q10a', '$q10b', '$q10c', '$q10d', '$q10e', '$q10f', '$q11a', '$q11b', '$q11c', '$genero');";
        $resultado = mysqli_query($conexao, $sql);
        $idExplicito = mysqli_insert_id($conexao);
        echo "<script>window.sessionStorage.setItem('idExplicito', " . $idExplicito . " );</script>";

        if($resultado){
            header("location:welcome.php");
        }
        else{
            echo "erro";
        }

        // usar procedure 
        $resultado2 = mysqli_query($conexao, $sql2);

    }
?>
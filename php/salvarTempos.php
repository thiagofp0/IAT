<?php
    include_once("conexao.php");

    $idExplicito = $_POST['id'];
    $tempos1 = $_POST['t1'];
    $tempos2 = $_POST['t2'];
    $tempos3 = $_POST['t3'];
    $tempos4 = $_POST['t4'];
    $tempos5 = $_POST['t5'];
    $tempos6 = $_POST['t6'];
    $tempos7 = $_POST['t7'];
    $erros1 = $_POST['e1'];
    $erros2 = $_POST['e2'];
    $erros3 = $_POST['e3'];
    $erros4 = $_POST['e4'];
    $erros5 = $_POST['e5'];
    $erros6 = $_POST['e6'];
    $erros7 = $_POST['e7'];
    $score = $_POST['score'];
    $severity = $_POST['severity'];
    $result = $_POST['resultado'];

    if($conexao){
        $sql = "INSERT INTO implicito VALUES ($idExplicito, $tempos1, $erros1, $tempos2, $erros2, $tempos3, $erros3, $tempos4, $erros4, $tempos5, $erros5, $tempos6, $erros6, $tempos7, $erros7, $score, $severity, $result);";
        $resultado = mysqli_query($conexao, $sql);

        if($resultado){
            $response = array("resultado" => 1);
	        echo json_encode($response);
        }
        else{
            $response = array("resultado" => 0);
	        echo json_encode($response);
        }
    }
?>
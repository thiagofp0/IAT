<?php
        session_start();

        if(!isset($_SESSION["log_nb_auto"])){
            unset($_SESSION["log_nb_auto"]);
            header("location:index.php");
            exit;
        }
        
        $login = $_SESSION["log_nb_auto"];
        $user = $login["username"];
        $nome = $login["nome"];
        $admin = $login["admin"];
        
        if(!$admin)
            header("location:deniedPermission.php");
        
        include "conexao.inc";
        
        $descricao = $_POST['desc'];
        $nome = $_POST['nome'];
        
        $result = $conn->query("INSERT INTO beneficios(descricao_beneficio, nome) VALUES ('$descricao','$nome')");

        $response = array("id" => $conn->insert_id);
	    echo json_encode($response);
	    
	    $conn->close();
?>
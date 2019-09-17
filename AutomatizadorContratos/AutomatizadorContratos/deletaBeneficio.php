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
        
        $id = $_POST['id'];
        
        $result = $conn->query("DELETE FROM beneficios WHERE id = $id");

        echo $id;
        
	    $conn->close();
?>
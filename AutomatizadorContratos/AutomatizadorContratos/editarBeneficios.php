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
        for($i = 0; $i < $_POST["qnt"]; $i++){
            if(isset($_POST[strval($i)])){
                $hidden = "h".strval($i);
                $result = $conn->query("UPDATE beneficios SET descricao_beneficio ='".$_POST[strval($i)]."' WHERE id = ".$_POST["h".$i]);
            }
        }
	    
	    $conn->close();
	    
	    echo "<script>this.close()</script>"
?>
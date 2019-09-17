<?php
	//Verifica se a sessão está aberta
	session_start();

	if(!isset($_SESSION["log_nb_auto"])){
		unset($_SESSION["log_nb_auto"]);
		header("location:index.php");
		exit;
	}
	
	$login = $_SESSION["log_nb_auto"];
	$user = $login["username"];
	$admin = $login["admin"];
    
    if(!$admin)
        header("location:deniedPermission.php");
	
	//Iniciando a conexão com o BD
	include "conexao.inc";
	
	$username = $_POST['username'];
	$select = $conn->query("SELECT * FROM Colaborador WHERE username = '$username'")->fetch_assoc();

	if(number_format($select['admin']) == 1){
	    if(number_format($admin) == 2){
	        $acesso = 0;
	    }
	    else{
	        header("location:deniedPermission.php?user=true");
	    }
	}
	
	if(number_format($select['admin']) == 0){
	    if(number_format($admin) >= 1){
	        $acesso = 1;
	    }
	    else{
	        header("location:deniedPermission.php?user=true");
	    }
	}
	
	if(number_format($select['admin']) == 2){
	    header("location:deniedPermission.php?user=true");
	}
    	          
	$result = $conn->query("UPDATE Colaborador SET admin= $acesso WHERE username = '$username'");
	
	if(!$result){
	    $conn->close();
	    header("location:dadosUsuarios.php?msg=Fail");
	}
	else{
	    $conn->close();
	    header("location:dadosUsuarios.php?msg=OK");
	}
	
?>
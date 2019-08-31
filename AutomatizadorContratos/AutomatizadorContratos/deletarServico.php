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
	
	$nome = addslashes($_POST['nome']);
	
	$result = $conn->query("DELETE FROM Item WHERE Item.nome = '$nome'");
	
	$conn->close();
	
	if($result)
		header("location:dadosServicos.php?msg='delOk'");
	//else
		//header("location:dadosServicos.php?msg='delFail'");
?>
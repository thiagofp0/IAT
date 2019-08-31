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
	
	$result = $conn->query("SELECT * FROM Empresa");
	$row = $result->fetch_assoc();
	
	$nome = addslashes($_POST['nome']);
	$username = addslashes($_POST['username']);
	$email = addslashes($_POST['email']);
	$senha = md5(addslashes($_POST['senha']));
	$empresa = $row["razao_social"];
	$admin = $_POST['admin'];
	
	$result = $conn->query("INSERT INTO Colaborador(Nome, username, email, senha, empresa, admin) VALUES ('$nome','$username','$email','$senha','$empresa',$admin)");
	
	$conn->close();
	
	if($result)
		header("location:dadosUsuarios.php?msg='saveOk'");
	else
		//header("location:dadosUsuarios.php?msg='saveFail'");
?>
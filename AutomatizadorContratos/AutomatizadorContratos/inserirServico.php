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
	$preco = addslashes($_POST['preco']);
	$prazoDiasUteis = addslashes($_POST['prazoDiasUteis']);
	$prazoSemanas = addslashes($_POST['prazoSemanas']);
	$descricao = addslashes($_POST['descricao']);
	$empresa = $row["razao_social"];
	$tempoInd = $_POST['tempo_indeterminado'];
	$descServ = $_POST["descricao_servico"];
	$descDiag = $_POST["descricao_diagnostico"];
	
	
	$result = $conn->query("INSERT INTO Item(nome, descricao, preco, empresa, prazoDiasUteis, prazoSemanas, tempo_indeterminado, descricao_servico, descricao_diagnostico) VALUES ('$nome',NULL,$preco,'$empresa',$prazoDiasUteis,$prazoSemanas, $tempoInd, '$descServ', '$descDiag')");
	
	$conn->close();
	
	if($result)
		header("location:dadosServicos.php?msg='saveOk'");
	else
		//header("location:dadosServicos.php?msg='saveFail'");
?>
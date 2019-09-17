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
	
	$nomeAntigo = addslashes($_POST['nomeAntigo']);
	$nome = addslashes($_POST['nome']);
	$preco = addslashes($_POST['preco']);
	$prazoDiasUteis = addslashes($_POST['prazoDiasUteis']);
	$prazoSemanas = addslashes($_POST['prazoSemanas']);
	$tempoInd = addslashes($_POST['tempo_indeterminado']);
	$descServico = addslashes($_POST['descricao_servico']);
	$descDiagnostico = addslashes($_POST['descricao_diagnostico']);
	
	$result = $conn->query("UPDATE Item SET nome = '$nome', descricao_servico = '$descServico', descricao_diagnostico = '$descDiagnostico', preco = $preco, prazoDiasUteis = $prazoDiasUteis, prazoSemanas = $prazoSemanas, tempo_indeterminado = $tempoInd WHERE Item.nome = '$nomeAntigo'");
	
	$conn->close();
	
	if($result)
		header("location:dadosServicos.php?msg='editOk'");
	else
		header("location:dadosServicos.php?msg='editFail'");
?>
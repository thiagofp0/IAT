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
	
	$razao_social = $_POST["razao_social"];
	$sede = $_POST["sede"];
	$cep = $_POST["CEP"];
	$cnpj = $_POST["CNPJ"];
	
	$result = $conn->query("UPDATE Empresa SET razao_social ='$razao_social',sede='$sede',CEP='$cep',CNPJ='$cnpj' WHERE 1");
	
	if(!$result){
	    $conn->close();
		header("location:dadosEmpresa.php?msg='editFailEmpresa'");
	}
	
	$nome_presidente = $_POST['nome_presidente'];
	$nacionalidade_presidente = $_POST['nacionalidade_presidente'];
	$estado_civil_presidente = $_POST['estado_civil_presidente'];
	$profissao_presidente = $_POST['profissao_presidente'];
	$CPF_presidente = $_POST['CPF_presidente'];
	$RG_presidente = $_POST['RG_presidente'];
	$orgao_emissor_presidente = $_POST['orgao_emissor_presidente'];
	$endereco_presidente = $_POST['endereco_presidente'];
	$CEP_presidente = $_POST['CEP_presidente'];
	$nome_presidente = $_POST['nome_presidente'];
	$genero_presidente = $_POST['genero_presidente'];
	
	$result = $conn->query("UPDATE Presidente SET nome='$nome_presidente',nacionalidade='$nacionalidade_presidente',estado_civil='$estado_civil_presidente',profissao='$profissao_presidente',CPF='$CPF_presidente',RG='$RG_presidente',orgaoEmissorRG='$orgao_emissor_presidente',endereco='$endereco_presidente',CEP='$CEP_presidente',genero='$genero_presidente' WHERE 1");
	
	if(!$result){
	    $conn->close();
		header("location:dadosEmpresa.php?msg='editFailPresidente'");
	}
	
	$nome_admfin = $_POST['nome_admfin'];
	$nacionalidade_admfin = $_POST['nacionalidade_admfin'];
	$estado_civil_admfin = $_POST['estado_civil_admfin'];
	$profissao_admfin = $_POST['profissao_admfin'];
	$CPF_admfin = $_POST['CPF_admfin'];
	$RG_admfin = $_POST['RG_admfin'];
	$orgao_emissor_admfin = $_POST['orgao_emissor_admfin'];
	$endereco_admfin = $_POST['endereco_admfin'];
	$CEP_admfin = $_POST['CEP_admfin'];
	$nome_admfin = $_POST['nome_admfin'];
	$genero_admfin = $_POST['genero_admfin'];
	
	$result = $conn->query("UPDATE AdmFin SET nome='$nome_admfin',nacionalidade='$nacionalidade_admfin',estado_civil='$estado_civil_admfin',profissao='$profissao_admfin',CPF='$CPF_admfin',RG='$RG_admfin',orgaoEmissorRG='$orgao_emissor_admfin',endereco='$endereco_admfin',CEP='$CEP_admfin',genero='$genero_admfin' WHERE 1");
	
	if(!$result){
	    $conn->close();
		header("location:dadosEmpresa.php?msg='editFailAdmFin'");
	}
	
	$conn->close();
	header("location:dadosEmpresa.php?msg='editOk'");
	
?>
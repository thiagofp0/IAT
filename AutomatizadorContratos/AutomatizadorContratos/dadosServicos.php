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
?>
<!DOCTYPE html>
<!-- DESENVOLVIDO POR NO BUGS - EMPRESA JÚNIOR DE INFORMÁTICA - 2019 -->
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset = "UTF-8">
    <title>Serviços Cadastrados</title>
    <link rel="icon" href="favicon.png" type="image/png" sizes="16x16">
</head>
<body>
	<?php require('header.php'); ?>
    <main style='margin: 20px 40px 10px 40px'>
		<?php require('logoutBox.php');?>
		<div><a href='adm.php'><input class="btn_class" type="button" value="Voltar para o menu"/></a></div>
		<br>
        <?php
			//***CONEXÃO COM BANCO DE DADOS ***//
			include "conexao.inc";
			
			$res = $conn->query("SELECT * FROM Item ORDER BY nome;");
			
			//CONSTRUÇÃO DA TABELA
			echo "<table class='table'>";
			echo "<thead>
			<th colspan = '4' style = 'text-align:center; font-size:22px'>Serviços Cadastrados</th>
			</thead>";
			echo "<thead>
			<th>Nome</th>
			<th>Editar</th>
			<th>Benefícios</th>
			<th>Excluir</th>
			</thead>";
			$cont = 0;
			while($row = $res->fetch_assoc()){//***IMPRESSÃO DO BANCO EM TABELA ***//
				echo "<tr><td>" . $row["nome"] . "</td>"; //nome
				echo"<td style = 'text-align:center'><form action='cadastrarServico.php' method='post'><input type='hidden' name='nome' value='".$row['nome']."'/>
				<input type='image' src='img/edit.svg' height='25' width='25'/></form></td>"; //editar
				echo"<td style = 'text-align:center'><form action='beneficiosServico.php' method='post'><input type='hidden' name='nome' value='".$row['nome']."'/>
				<input type='image' src='img/ben.png' height='25' width='25'/></form></td>"; //benefícios
				echo"<td style = 'text-align:center'><form action='deletarServico.php' method='post'><input type='hidden' name='nome' value='".$row['nome']."'/>
				<input type='image' src='img/delete.png' height='25' width='25'/></form></td>"; //excluir
				$cont++;
			}
			echo "</table>";
			$conn->close();//***FECHA CONEXÃO BD***//
		?>
		<p></p>
		<a class='btn btn_class' href="cadastrarServico.php" style= 'font-size:14px'/>Cadastrar um novo serviço</a>
	</main>
	<footer>
		Desenvolvido por <a target ="blank" href="http://www.nobugs.com.br">No Bugs</a> @2019
	</footer>
</body>
</html>
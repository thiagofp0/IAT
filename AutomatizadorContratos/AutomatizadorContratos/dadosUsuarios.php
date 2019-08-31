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
    <title>Usuários Cadastrados</title>
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
			
			$res = $conn->query("SELECT * FROM Colaborador ORDER BY nome;");
			
			//CONSTRUÇÃO DA TABELA
			echo "<table class='table'>";
			echo "<thead>
			<th colspan = '4' style = 'text-align:center; font-size:22px'>Usuários Cadastrados</th>
			</thead>";
			echo "<thead>
			<th>Nome</th>
			<th>Username</th>
			<th>Permissões</th>
			<th>Alterar permissões</th>
			</thead>";
			$cont = 0;
			while($row = $res->fetch_assoc()){//***IMPRESSÃO DO BANCO EM TABELA ***//
				echo "<tr><td>" . $row["Nome"] . "</td>"; //nome
				echo"<td>".$row["username"]."</td>";
				if($row["admin"] == 0){
				    echo"<td><font color='red'><b>Comum</b></font></td>";
				    echo"<td style = 'text-align:center'><form action='mudarAcesso.php' method='post'><input type='hidden' name='username' value='".$row['username']."'/>
				    <input type='image' src='img/down.png' height='25' width='25' value='descer'/></form></td>"; //permissoes
				}
				else if($row["admin"] == 1){
				    echo"<td><font color='green'><b>Administrador</b></font></td>";
				    if(login["admin"] == 2) echo "<td style = 'text-align:center'><form action='mudarAcesso.php' method='post'><input type='hidden' name='username' value='".$row['username']."'/>
				    <input type='image' src='img/up.png' height='25' width='25' value='subir'/></form></td>"; //permissoes
				    else
				    echo "<td></td>";
				
				}
				else if($row["admin"] == 2){
				    echo"<td><font color='blue'><b>Super Administrador</b></font></td>";
				    echo "<td></td>";
				}
				$cont++;
			}
			echo "</table>";
			$conn->close();//***FECHA CONEXÃO BD***//
		?>
		<p></p>
		<a class='btn btn_class' href="cadastrarUsuario.php" style= 'font-size:14px'/>Cadastrar um novo usuário</a>
	</main>
	<footer>
		Desenvolvido por <a target ="blank" href="http://www.nobugs.com.br">No Bugs</a> @2019
	</footer>
</body>
</html>
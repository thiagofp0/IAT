<?php
    session_start();
    
    if(!isset($_SESSION["log_nb_auto"])){
      unset($_SESSION["log_nb_auto"]);
      header("Location: index.php");
      exit;
    }
	
	$login = $_SESSION["log_nb_auto"];
    $user = $login["username"];
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
  <title><?php echo (isset($_POST["username"])?"Editar dados":"Cadastrar usuário")."";?></title>
  <link rel="icon" href="favicon.png" type="image/png" sizes="16x16">
  <script>
    function confereSenhas(){
        if(document.getElementById('senha').value === document.getElementById('senha2').value)
            return true;
        else{
            window.alert("As senhas não conferem!!!");
            return false;
        }
    }
  </script>
</head>
<body>
  <?php require('header.php') ?>
  <main>
    <?php require('logoutBox.php')?>
    <form method = "POST" action = "<?php echo "".(isset($_GET["username"])?"editar":"inserir")."Usuario.php";?>" onsubmit="return confereSenhas()">
        <br>
    <h5 align="center"><?php echo (isset($_GET["username"])?"Editar dados":"Cadastrar usuário")."";?></h5>
	<div class='container-fluid'>
		<?php
			//***CONEXÃO BD ***//
			include "conexao.inc";
			
			if(isset($_GET["username"])){
				$nomeAntigo = addslashes($_GET["username"]); 
				$result = $conn->query("SELECT * FROM Colaborador WHERE Colaborador.username = '$nomeAntigo'");
				if(!$result){
					echo "error";
					exit;
				}
				echo "<input type='hidden' name='nomeAntigo' value='$nomeAntigo'/>";
				$row = $result->fetch_assoc();
			}
		?>
		<!-- -------------------INFORMAÇÕES DO SERVIÇO-------------------- -->
		<div class='container-fluid'>
			<div class="row">
				<div class="col-lg-5" style="margin-left:auto">
					<label for="nome"> Nome</label>
					<input style="width: 100%" class="form-control" type="text" name="nome" id="nome" required value='<?php 
						if(isset($row)) echo $row["Nome"];
					?>'</p>
				</div>
				<div class="col-lg-5" style="margin-right:auto">
					<label for="username"> Login: </label>
					<input style="width: 100%" class="form-control" type="text" name="username" id="username" required value = '<?php 
						if(isset($row)) echo $row["username"];
					?>'</p>
				</div>
			</div><br>
			<div class = "row">
				<div class="col-lg-5" style="margin-left:auto">
					<label for="email">Email: </label>
					<input style="width: 100%" class="form-control" type="text" name="email" id="email" required value='<?php 
						if(isset($row)) echo $row["email"];
					?>'</p>
				</div>
				<div class="col-lg-5" style="margin-right:auto">
					<label for="admin"> Nível de Acesso: </label>
					<select class="form-control" name="admin" id="admin">
					    <option value = "1" <?php if(isset($row) and $row["admin"]) echo "selected";?>>Administrador</option>
					    <option value = "0" <?php if(isset($row) and !$row["admin"]) echo "selected";?>>Comum</option>
					</select>
				</div>
			</div><br>
			<div class="row">
				<div class="col-lg-5" style="margin-left:auto;margin-right:auto">
					<label for="senha">Senha:</label>
					<input style="width: 100%" class="form-control" type="password" name="senha" id="senha" required />
				</div>
			</div>
			<div class="row">
				<div class="col-lg-5" style="margin-left:auto;margin-right:auto">
					<label for="senha2"> Confirmar Senha: </label>
					<input style="width: 100%" class="form-control" type="password" name="senha2" id="senha2" required />
				</div>
			</div><br>
			<?php
				$conn->close();//***FECHA CONEXAO BD***//
			?>
			<br>
			<div class = "row" >
    				<div style="margin-left:auto;margin-right:auto">
    					<input class='btn_class' type = "submit" value = "Salvar" style='font-size:13px'>
    					<a href="dadosServicos.php"><input class='btn_class' type = "button" value = "Cancelar" style='font-size:13px'></a>
    				</div>
    		</div>
			<br><br>
			
		</div>
	</div>
    </form>
    </main>
	<footer>
        Desenvolvido por <a target ="blank" href="http://www.nobugs.com.br">No Bugs</a> @2019
    </footer>
</body>
</html>
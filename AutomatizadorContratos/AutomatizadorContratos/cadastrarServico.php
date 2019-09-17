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
  <title><?php echo (isset($_POST["nome"])?"Editar":"Cadastrar")." serviço";?></title>
  <link rel="icon" href="favicon.png" type="image/png" sizes="16x16">
</head>
<body>
  <?php require('header.php'); ?>
  <main>
    <?php require('logoutBox.php');?>
    <form method = "POST" action = <?php echo "'".(isset($_POST["nome"])?"editar":"inserir")."Servico.php'";?>>
        <br>
    <h5 align="center"><?php echo (isset($_POST["nome"])?"Editar":"Cadastrar")." serviço";?></h5>
	<div class='container-fluid'>
		<?php
			//***CONEXÃO BD ***//
			include "conexao.inc";
			
			if(isset($_POST["nome"])){
				$nomeAntigo = addslashes($_POST["nome"]); 
				$result = $conn->query("SELECT * FROM Item WHERE Item.nome = '$nomeAntigo'");
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
						if(isset($row)) echo $row["nome"];
					?>'</p>
				</div>
				<div class="col-lg-5" style="margin-right:auto">
					<label for="preco"> Preço: </label>
					<input style="width: 100%" class="form-control" type="number" min="0" step="0.01" name="preco" id="preco" required value = '<?php 
						if(isset($row)) echo $row["preco"];
					?>'</p>
				</div>
			</div><br>
			<div class = "row">
				<div class="col-lg-5" style="margin-left:auto">
					<label for="prazoDiasUteis">Prazo em Dias Úteis: </label>
					<input style="width: 100%" class="form-control" type="number" min="0" step="1" name="prazoDiasUteis" id="prazoDiasUteis" required value='<?php 
						if(isset($row)) echo $row["prazoDiasUteis"];
					?>'</p>
				</div>
				<div class="col-lg-5" style="margin-right:auto">
					<label for="prazoSemanas"> Prazo em Semanas: </label>
					<input style="width: 100%" class="form-control" type="number" min="0" step="1" name="prazoSemanas" id="prazoSemanas" required value = '<?php 
						if(isset($row)) echo $row["prazoSemanas"];
					?>'</p>
				</div>
			</div><br>
			<div class = "row">
				<div class="col-lg-2" style="margin-left:auto;margin-right:auto">
					<label for="tempo_indeterminado"> Tempo Indeterminado: </label>
					<select class="form-control" name="tempo_indeterminado" id="tempo_indeterminado">
					    <option value = "1" <?php if(isset($row) and $row["tempo_indeterminado"]) echo "selected";?>>Sim</option>
					    <option value = "0" <?php if(isset($row) and !$row["tempo_indeterminado"]) echo "selected";?>>Não</option>
					</select>
				</div>
			</div><br>
			<div class = "row">
				<div class="col-lg-7" style="margin-left:auto;margin-right:auto">
					<label for="descricao_servico"> Descrição do Serviço </label>
					<textarea style="width:100%" class="form-control" name="descricao_servico" id="descricao_servico" rows="7"><?php if(isset($row))echo $row["descricao_servico"];?></textarea>
				</div>
			</div><br>
			<div class = "row">
				<div class="col-lg-7" style="margin-left:auto;margin-right:auto">
					<label for="descricao_diagnostico"> Descrição do Diagnóstico </label>
					<textarea style="width:100%" class="form-control" name="descricao_diagnostico" id="descricao_diagnostico" rows="7"><?php if(isset($row))echo $row["descricao_diagnostico"];?></textarea>
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
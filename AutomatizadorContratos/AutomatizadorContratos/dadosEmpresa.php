<?php
        session_start();

        if(!isset($_SESSION["log_nb_auto"])){
            unset($_SESSION["log_nb_auto"]);
            header("location:index.php");
            exit;
        }
        
        $login = $_SESSION["log_nb_auto"];
        $user = $login["username"];
        $razao_social = $login["razao_social"];
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
    <title>Dados da Empresa</title>
    <link rel="icon" href="favicon.png" type="image/png" sizes="16x16">
</head>
<body>
	<?php require('header.php'); ?>

	<main style='margin: 20px 40px 10px 40px'>
		<?php
			//***CONEXÃO COM BANCO DE DADOS ***//
			include "conexao.inc";
			
			$dadosEmpresa = ($conn->query("SELECT * FROM Empresa;"))->fetch_array();
			$dadosPresidente = ($conn->query("SELECT * FROM Presidente;"))->fetch_array();
			$dadosAdmFin = ($conn->query("SELECT * FROM AdmFin;"))->fetch_array();
			
			$conn->close();//***FECHA CONEXÃO BD***//
		?>
		
		<?php require('logoutBox.php');?>
		
		<form method = "POST" action = "editarEmpresa.php" onsubmit = "return validar()">
        <br>
        <div>
            <div><a href='adm.php'><input class="btn_class" type="button" value="Voltar para o menu"/></a></div>
		    <h5 align="center">Editar dados da empresa</h5>
    	</div>
    	<div class='container-fluid'>
    		<!-- -------------------INFORMAÇÕES DA EMPRESA-------------------- -->
    		<div class='container-fluid'>
    			<div class="row">
					<div class="col-lg-10" style="margin-left:auto;margin-right:auto">
            			<label for="razao_social"> Razão Social:</label>
    					<input style="width: 100%" class="form-control" type="text" name="razao_social" id="razao_social" required value='<?php 
    						if(isset($dadosEmpresa)) echo $dadosEmpresa["razao_social"];
    					?>'</p>
    				</div>
    			</div><br>
    			<div class="row">
    			    <div class="col-lg-10" style="margin-left:auto;margin-right:auto">
            			<label for="sede"> Sede: </label>
    					<input style="width: 100%" class="form-control" type="text" name="sede" id="sede" required value = '<?php 
    						if(isset($dadosEmpresa)) echo $dadosEmpresa["sede"];
    					?>'</p>
    				</div>
    			</div><br>
    			<div class = "row">
    				<div class="col-lg-5" style="margin-left:auto">
    					<label for="CEP">CEP: </label>
    					<input style="width: 100%" class="form-control" type="text" min="0" step="1" name="CEP" id="CEP" required value='<?php 
    						if(isset($dadosEmpresa)) echo $dadosEmpresa["CEP"];
    					?>'</p>
    				</div>
    				<div class="col-lg-5" style="margin-right:auto">
    					<label for="CNPJ">CNPJ: </label>
    					<input style="width: 100%" class="form-control" type="text" min="0" step="1" name="CNPJ" id="CNPJ" required value = '<?php 
    						if(isset($dadosEmpresa)) echo $dadosEmpresa["CNPJ"];
    					?>'</p>
    				</div>
    			</div><br>
    			
    			<!--DADOS DO PRESIDENTE-->
    			
    			<h6 align="center">Presidente</h6>
    			<div class="row">
					<div class="col-lg-5" style="margin-left:auto">
            			<label for="nome_presidente"> Nome:</label>
    					<input style="width: 100%" class="form-control" type="text" name="nome_presidente" id="nome_presidente" required value='<?php 
    						if(isset($dadosPresidente)) echo $dadosPresidente["nome"];
    					?>'</p>
    				</div>
    				<div class="col-lg-5" style="margin-right:auto">
    				    <label for="genero_presidente"> Gênero:</label>
    					<select class="form-control" name="genero_presidente" id="genero_presidente" required>
    					    <option value="M" <?php if(isset($dadosPresidente) and $dadosPresidente["genero"] == 'M') echo "selected";?>> Masculino </option>
    					    <option value="F" <?php if(isset($dadosPresidente) and $dadosPresidente["genero"] == 'F') echo "selected";?> > Feminino </option>
    					</select>
    				</div>
    			</div><br>
    			<div class="row">
    			    <div class="col-lg-5" style="margin-left:auto">
        				<label for="nacionalidade_presidente"> Nacionalidade: </label>
    					<input style="width: 100%" class="form-control" type="text" name="nacionalidade_presidente" id="nacionalidade_presidente" required value = '<?php 
    						if(isset($dadosPresidente)) echo $dadosPresidente["nacionalidade"];
    					?>'</p>
					</div>
					<div class="col-lg-5" style="margin-right:auto">
        				<label for="estado_civil_presidente"> Estado Civil: </label>
    					<input style="width: 100%" class="form-control" type="text" name="estado_civil_presidente" id="estado_civil_presidente" required value = '<?php 
    						if(isset($dadosPresidente)) echo $dadosPresidente["estado_civil"];
    					?>'</p>
					</div>
    			</div><br>
    			<div class = "row">
    				<div class="col-lg-10" style="margin-left:auto;margin-right:auto">
        				<label for="endereco_presidente">Endereço: </label>
    					<input style="width: 100%" class="form-control" type="text" name="endereco_presidente" id="endereco_presidente" required value='<?php 
    						if(isset($dadosPresidente)) echo $dadosPresidente["endereco"];
    					?>'</p>
    				</div>
    			</div><br>
    			<div class = "row">
    				<div class="col-lg-5" style="margin-left:auto">
    					<label for="CEP_presidente">CEP: </label>
    					<input style="width: 100%" class="form-control" type="text" name="CEP_presidente" id="CEP_presidente" required value='<?php 
    						if(isset($dadosPresidente)) echo $dadosPresidente["CEP"];
    					?>'</p>
    				</div>
    				<div class="col-lg-5" style="margin-right:auto">
    					<label for="CPF_presidente">CPF: </label>
    					<input style="width: 100%" class="form-control" type="text" name="CPF_presidente" id="CPF_presidente" required value='<?php 
    						if(isset($dadosPresidente)) echo $dadosPresidente["CPF"];
    					?>'</p>
    				</div>
    			</div><br>
    			<div class = "row">
    			    <div class="col-lg-5" style="margin-left:auto">
    					<label for="RG_presidente">RG: </label>
    					<input style="width: 100%" class="form-control" type="text" name="RG_presidente" id="RG_presidente" required value='<?php 
    						if(isset($dadosPresidente)) echo $dadosPresidente["RG"];
    					?>'</p>
    				</div>
    				<div class="col-lg-5" style="margin-right:auto">
    					<label for="orgao_emissor_presidente">Órgão Emissor: </label>
    					<input style="width: 100%" class="form-control" type="text" name="orgao_emissor_presidente" id="orgao_emissor_presidente" required value='<?php 
    						if(isset($dadosPresidente)) echo $dadosPresidente["orgaoEmissorRG"];
    					?>'</p>
    				</div>
    			</div><br>
    			<!--DADOS DO PRESIDENTE-->
    			
    			<h6 align="center">Diretor Administrativo-Financeiro</h6>
    			<div class="row">
					<div class="col-lg-5" style="margin-left:auto">
            			<label for="nome_admfin"> Nome:</label>
    					<input style="width: 100%" class="form-control" type="text" name="nome_admfin" id="nome_admfin" required value='<?php 
    						if(isset($dadosAdmFin)) echo $dadosAdmFin["nome"];
    					?>'</p>
    				</div>
    				<div class="col-lg-5" style="margin-right:auto">
    				    <label for="genero_admfin"> Gênero:</label>
    					<select class="form-control" name="genero_admfin" id="genero_admfin" required>
    					    <option value="M" <?php if(isset($dadosAdmFin) and $dadosAdmFin["genero"] == 'M') echo "selected";?>> Masculino </option>
    					    <option value="F" <?php if(isset($dadosAdmFin) and $dadosAdmFin["genero"] == 'F') echo "selected";?> > Feminino </option>
    					</select>
    				</div>
    			</div><br>
    			<div class="row">
    			    <div class="col-lg-5" style="margin-left:auto">
        				<label for="nacionalidade_admfin"> Nacionalidade: </label>
    					<input style="width: 100%" class="form-control" type="text" name="nacionalidade_admfin" id="nacionalidade_admfin" required value = '<?php 
    						if(isset($dadosAdmFin)) echo $dadosAdmFin["nacionalidade"];
    					?>'</p>
					</div>
					<div class="col-lg-5" style="margin-right:auto">
        				<label for="estado_civil_admfin"> Estado Civil: </label>
    					<input style="width: 100%" class="form-control" type="text" name="estado_civil_admfin" id="estado_civil_admfin" required value = '<?php 
    						if(isset($dadosAdmFin)) echo $dadosAdmFin["estado_civil"];
    					?>'</p>
					</div>
    			</div><br>
    			<div class = "row">
    				<div class="col-lg-10" style="margin-left:auto;margin-right:auto">
        				<label for="endereco_admfin">Endereço: </label>
    					<input style="width: 100%" class="form-control" type="text" name="endereco_admfin" id="endereco_admfin" required value='<?php 
    						if(isset($dadosAdmFin)) echo $dadosAdmFin["endereco"];
    					?>'</p>
    				</div>
    			</div><br>
    			<div class = "row">
    				<div class="col-lg-5" style="margin-left:auto">
    					<label for="CEP_admfin">CEP: </label>
    					<input style="width: 100%" class="form-control" type="text" name="CEP_admfin" id="CEP_admfin" required value='<?php 
    						if(isset($dadosAdmFin)) echo $dadosAdmFin["CEP"];
    					?>'</p>
    				</div>
    				<div class="col-lg-5" style="margin-right:auto">
    					<label for="CPF_admfin">CPF: </label>
    					<input style="width: 100%" class="form-control" type="text" name="CPF_admfin" id="CPF_admfin" required value='<?php 
    						if(isset($dadosAdmFin)) echo $dadosAdmFin["CPF"];
    					?>'</p>
    				</div>
    			</div><br>
    			<div class = "row">
    			    <div class="col-lg-5" style="margin-left:auto">
    					<label for="RG_admfin">RG: </label>
    					<input style="width: 100%" class="form-control" type="text" name="RG_admfin" id="RG_admfin" required value='<?php 
    						if(isset($dadosAdmFin)) echo $dadosAdmFin["RG"];
    					?>'</p>
    				</div>
    				<div class="col-lg-5" style="margin-right:auto">
    					<label for="orgao_emissor_admfin">Órgão Emissor: </label>
    					<input style="width: 100%" class="form-control" type="text" name="orgao_emissor_admfin" id="orgao_emissor_admfin" required value='<?php 
    						if(isset($dadosAdmFin)) echo $dadosAdmFin["orgaoEmissorRG"];
    					?>'</p>
    				</div>
    			</div><br>
    			<?php
    				$conn->close();//***FECHA CONEXAO BD***//
    			?>
    			<div class = "row" >
    				<div style="margin-left:auto;margin-right:auto">
    					<input class='btn_class' type = "submit" value = "Salvar" style='font-size:13px'>
    				</div>
    			</div>
    		</div>
    	</div>
    </form>
	</main>
	<footer>
		Desenvolvido por <a target ="blank" href="http://www.nobugs.com.br">No Bugs</a> @2019
	</footer>
</body>
</html>
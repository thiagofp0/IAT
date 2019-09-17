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
    <title>Editar Benefícios</title>
    <link rel="icon" href="favicon.png" type="image/png" sizes="16x16">
    <script src="bibliotecas/jquery-3.3.1.min.js"></script>
    <script>
        function inserir(nome){
            var linha = document.getElementById('tabela').insertRow();
            var celula1 = linha.insertCell(0);
            var celula2 = linha.insertCell(1);
            
            celula1.innerHTML = "<input type='hidden' id = 'hnew' name = 'hnew'><input type='text' class='form-control' name='new' id = 'new'/>"
            celula2.innerHTML = "<center><img id='saveIcon' src='img/save.png' height='25' width='25' onclick=\"salvar('" + nome + "')\"/></center>"
            
            document.getElementById("insertBtn").disabled = "true";
        }
        
        function salvar(nome){
             document.getElementById("insertBtn").disabled = false;
             var x = document.getElementById("tabela").rows.length;
             var desc = document.getElementById("new").value;
             var xhttp = new XMLHttpRequest();
             xhttp.open("POST","insereBeneficio.php",true);
             xhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
             var json;
             xhttp.onload = function(){ 
                 json = JSON.parse('' + xhttp.responseText)
                 document.getElementById("new").setAttribute("name", x - 3 );
                 document.getElementById("hnew").value = json.id;
                 document.getElementById("hnew").setAttribute("name", "h" + (x-3));
                 document.getElementById("new").setAttribute("id", json.id)
                 document.getElementById("tabela").rows.item(x-1).cells.item(1).innerHTML = "<center><img src='img/delete.png' height='25' width='25' onclick='deletar(" + (x-1) + ", " + json.id + ")'/></center></form>"
             };
             xhttp.send("desc=" + desc + "&nome=" + nome);
             
            /*$.ajax({
                type: 'POST',
                dataType: 'json',
                url: 'insereBeneficio.php',
                async: true,
                data: {"desc" : desc, "nome": nome},
                success: function(response) {
                    location.reload();
                }
            });*/
        }
        
        function deletar(linha, id){
            var xhttp = new XMLHttpRequest();
            xhttp.open("POST","deletaBeneficio.php",true);
            xhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhttp.send("id=" + id)
            
            document.getElementById("tabela").rows.item(linha).style.display = "none";
            
            return false;
        }
    </script>
</head>
<body>
	<?php require('header.php'); ?>
    <main style='margin: 20px 40px 10px 40px'>
		<?php require('logoutBox.php');?>
		<div><a href="dadosServicos.php"><input class="btn_class" type="button" value="Voltar"/></a></div>
		<br>
		<form method='post' action='editarBeneficios.php' id="formulario"  target="_blank">
            <?php
    			//***CONEXÃO COM BANCO DE DADOS ***//
    			include "conexao.inc";
    			
    			$nome = $_POST["nome"];
    			$res = $conn->query("SELECT * FROM beneficios WHERE nome =  '$nome' ORDER BY descricao_beneficio;");
    			
    			
    			//CONSTRUÇÃO DA TABELA
    			echo "<table class='table' id='tabela'>";
    			echo "<thead>
    			<th colspan = '2' style = 'text-align:center; font-size:22px'>Benefícios</th>
    			</thead>";
    			echo "<thead>
    			<th>Descrição</th>
    			<th>Excluir</th>
    			</thead>";
    			$cont = 2;
    			
    			while($row = $res->fetch_assoc()){//***IMPRESSÃO DO BANCO EM TABELA ***//
    				echo "<tr><td><input type='hidden' name= 'h".($cont-2)."' value='".$row['id']."'><input type='text' class='form-control' value='".$row["descricao_beneficio"]."' name='".($cont - 2)."'></td>"; //nome
    				echo"<td style = 'text-align:center'><img src='img/delete.png' height='25' width='25' onclick='deletar(".$cont.", ".$row["id"].")'/></td>"; //excluir
    				$cont++;
    			}
    			echo "</table>";
    			echo "<input type='hidden' name='qnt' value='".($cont - 2)."'/>";
    			$conn->close();//***FECHA CONEXÃO BD***//
    		?>
		    <p></p>
		    <input type='submit' class='btn btn_class' href="cadastrarServico.php" style= 'font-size:14px' value='Alterar Descrições'>
		    <input type='button' onclick="inserir('<?php echo $nome?>')" class='btn btn_class' href="cadastrarServico.php" style= 'font-size:14px' value='Cadastrar um novo benefício' id="insertBtn">
	    </form>
	</main>
	<footer>
		Desenvolvido por <a target ="blank" href="http://www.nobugs.com.br">No Bugs</a> @2019
	</footer>
</body>
</html>
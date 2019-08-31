<?php
    session_start();
    
    if(!isset($_SESSION["log_nb_auto"])){
      unset($_SESSION["log_nb_auto"]);
      header("Location: index.php");
      exit;
    }
    else if(!strpos($_SERVER["HTTP_REFERER"], "propostas")){
      header("Location: propostas.php"); //Redireciona se a página anterior não for a correta
      exit;
    }
    
    $login = $_SESSION["log_nb_auto"];
    $user = $login["user"];
?>

<!DOCTYPE html>
<!-- DESENVOLVIDO POR NO BUGS - EMPRESA JÚNIOR DE INFORMÁTICA - 2019 -->
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
  <meta charset = "UTF-8">
  <title>Dados das propostas</title>
  <link rel="icon" href="favicon.png" type="image/png" sizes="16x16">
    
    
    <script type="text/javascript">

		    //FUNÇÃO QUE ENVIA O FORM DEPENDENDO DO BOTAO QUE FOI CLICADO
			function nextPage(page){
			    var form = document.getElementById("form");
			    form.action = page;
			    form.submit();
			}
			
			//FUNÇÃO QUE ESCONDE/EXIBE OS CAMPOS DE PROPOSTA DETALHADA
			function detalhadaOnOff(){
			    document.getElementById('infoDetalhada').style.display=document.getElementById('detalhada').checked ? 'block' : 'none';
			    document.getElementById('socio-detalhada').style.display=document.getElementById('detalhada').checked ? 'block' : 'none';
			    document.getElementById('servicosDetalhada-beneficios').style.display=document.getElementById('detalhada').checked ? 'block' : 'none';
			}
		</script>
</head>
<body>
  <?php require('header.php') ?>
  <main>
    <?php require('logoutBox.php'); ?>
    <?php
    //FUNÇÃO PHP PARA VERIFICAR QUAL BOTÃO FOI CLICADO
    function get_post_action($name){
            $params = func_get_args();
            foreach ($params as $name) {
                if (isset($_POST[$name]))
                    return $name;
            }
        }
    ?>
    <form method = "POST" id="form" action="" enctype="multipart/form-data">
    <br>
    <h5 align="center">Escolha quais propostas deseja gerar: </h5>
  <div class='container-fluid'>
    <br>
            <input class="form-control" type="checkbox" name="detalhada" value="detalhada" id="detalhada" checked="true" onChange="detalhadaOnOff()">Proposta Detalhada<br>      
            <input style="width: 100%" class="form-control" type="checkbox" name="resumida" value="resumida">Proposta Resumida<br>      
            <input style="width: 100%" class="form-control" type="checkbox" name="slides" value="slides">Apresentação de Slides<br>      
            <br>      
    <hr>
    
    <!-- INFORMAÇÕES REFERENTES AO CLIENTE -->
    <h5 align="center">Sobre o Cliente </h6>
    <div class="row">
            <div id='socio-detalhada' class="col-lg-5">
                <label for="socioCliente">Vocativo</label>
                <input style="width: 100%" class="form-control" type="text" name="socioCliente" id="socioCliente" value="Aos sócios do(a)" required</p>
            </div>
            <div class="col-lg-5">
                <label for="nomeCliente"> Nome:</label>
                <input style="width: 100%" class="form-control" type="text" name="nomeCliente" id="nomeCliente" required</p>
            </div>
            <!--
            <div class="col-lg-5">
                <label for="logo"> Logo:</label>
                <input style="width: 100%" class="form-control" type="file" name="logoCliente" id="logoCliente" required</p>
            </div>
            <br>
            //-->
            <div id ='infoDetalhada' style ='display:block'>
                <div class="col-lg-10">
                    Conforme solicitado, apresentamos aqui nossa proposta para realização dos serviços que, após diagnóstico, entendemos relevantes para 
                    <input style="width: 100%" class="form-control" type="text" name="tipoEmpresa" id="tipoEmpresa" value="a sua empresa." required</p>
                </div>
                <div class="col-lg-10">
                    A seguinte proposta tem como objetivo explicitar com maior detalhes os serviços quistos levando em conta os desafios atuais para
                    <textarea style="width: 100%" class="form-control" name="doresCliente" id="doresCliente" placeholder="as dores do atual cliente (ex.: regularização do Centro Acadêmico, proteção da marca da empresa, regularização da relação de trabalho, regularização da relação entre sócios)" required</p></textarea>
                </div>
                <div class="col-lg-10">
                    Para a 
                    <textarea style="width: 100%" class="form-control" name="necessidadeCliente" id="necessidadeCliente" placeholder="necessidade do cliente (ex.: estruturação jurídica da empresa X, proteção da marca da startup Y, regularização do Centro Acadêmico Z)" required</p></textarea>
                    propomos os seguintes serviços:
                </div>
            </div>
            
    </div>
    <hr>
    
    <!-- INFORMAÇÕES REFERENTES AOS SERVIÇOS -->
    <h5 align="center">Sobre os Serviços </h6>
<?php 
      date_default_timezone_set("America/Sao_Paulo");//AJUSTA TIMEZONE
    
      //Realiza a conexão com o banco
      include "conexao.inc";
      
      $result =$conn->query("SELECT * FROM Item ORDER BY nome");  
      $result2 = $conn->query("SELECT * FROM Item ORDER BY nome");   //duplica o resultado da consulta para ser usada na descrição do serviço 
      $result3 = $conn->query("SELECT * FROM Item ORDER BY nome");   //duplica o resultado da consulta para ser usada na descrição do serviço 
      $conn->close();//***FECHA CONEXAO BD***//
      if(!$result){
        echo "error";
        exit;
      }
      
      //***CRIA TABELA COM A QUANTIDADE DE FUNÇÕES ESCOLHIDAS NA PÁGINA ANTERIOR ***//
      echo "<table class='table'>
      <thead>
        <tr>
          <th>Nome:  </th>
          <th>Prazo (dias úteis)  </th>
          <th>Valor (R$) </th>
        </tr>
      </thead>
      ";
    $cont =0; $cont2=0;
    while($row = $result->fetch_assoc()) {//***PARA TODOS OS ITENS DO BD
        if(isset($_POST[$cont])) //opção foi marcada
            $index = 1;
        else
            $index = 0;

        if($index){//Se index = 1, o campo foi marcado e deve ser exibido
          echo "
            <tr>
              <td style='padding: 5px; width: 60%;'> <input class='form-control' id = 'name' type = 'text' name = 'nomes[]' value = '" . $row["nome"] . "'></td>" . 
              "<td style='padding: 5px'>  
                      <input class='form-control' id = 'value' type = 'text' name = 'valores[]' value = '" . $row["prazoDiasUteis"]."'></td>
                <td style='padding: 5px'>  
                      <input class='form-control' id = 'valor' type = 'text' name = 'valores2[]' value = '" . $row["preco"]."'>
                </td>
            </tr>";
                
            $cont2++;
        }
        $cont++;
    }
    $quantServicos = $cont2;
    echo "</table>";
    echo '
    <div class="row">
            <div class="col-lg-1" align="right">
                <p>Quantidade de parcelas:</p>
            </div>
            <div class="col-lg-1">
                <input class="form-control" type="number" name="nParcelas" id="nParcelas" value="1" min="1"/></p>
            </div>
    </div>';
    
    echo "<div><hr><h5 align='center'>Resultados</h5>";
    echo "<textarea rows='10' class='form-control' name = 'resultados'></textarea><hr></div>";
    
    $cont=0; $cont2 =0;
    $sql = "SELECT DISTINCT descricao_beneficio FROM beneficios WHERE nome='"; //CONSULTA SQL PARA BUSCAR OS BENEFICIOS
    echo "<div id='servicosDetalhada-beneficios>'"; //ESTARÁ APENAS NA PROPOSTA DETALHADA
    while($row = $result2->fetch_assoc()) {//***PARA TODOS OS ITENS DO BD
        if(isset($_POST[$cont])){ //opção foi marcada.
            if($cont2 == $quantServicos-1) //estamos no último serviço
                $sql .= $row["nome"]."';";
            else
                $sql .= $row["nome"]."' OR nome='";
            echo "<h5 align='center' id='nomeSer'".$cont.">".$row["nome"].".</h5>";
            echo "<hr>";
            echo "<h6>Descrição:</h6>";
            echo "<textarea rows='5' class='form-control' name = 'descricao[]'>" . $row["descricao_servico"] . "</textarea>";
            $cont2++;
        }
        $cont++;
    }
    
    echo "<hr><h5 align='center'>Benefícios</h5>";
    $benef = ""; //VARIAVEL QUE RECEBE TODOS OS BENEFÍCIOS
    //Realiza a conexão com o banco
    include "conexao.inc";
    $resultSQL = $conn->query($sql);  
    $conn->close();//***FECHA CONEXAO BD***//*
    if(!$resultSQL){
        echo "error";
        exit;
     }
     while($row = $resultSQL->fetch_assoc()) {//***PARA TODOS OS ITENS DO BD
        $benef .= $row['descricao_beneficio']."\n"; //acrescenta o benefício na String
     }
     echo "<textarea rows='10' class='form-control' name = 'beneficios'>".$benef."</textarea>";
     
    $cont=0; $cont2 =0;
    $sql = "SELECT DISTINCT descricao_beneficio FROM topico_beneficio WHERE nome='"; //CONSULTA SQL PARA BUSCAR OS BENEFICIOS
    echo "<div id='servicosSlides-beneficios>'"; //ESTARÁ APENAS NA PROPOSTA DETALHADA
    while($row = $result3->fetch_assoc()) {//***PARA TODOS OS ITENS DO BD
        if(isset($_POST[$cont])){ //opção foi marcada.
            if($cont2 == $quantServicos-1) //estamos no último serviço
                $sql .= $row["nome"]."';";
            else
                $sql .= $row["nome"]."' OR nome='";
            $cont2++;
        }
        $cont++;
    }
    echo "</div>";
     
     echo "<hr><h5 align='center'>Tópicos de Benefícios</h5>";
     $benefT = ""; //VARIAVEL QUE RECEBE TODOS OS TÓPICOS BENEFÍCIOS
     //Realiza a conexão com o banco
     include "conexao.inc";
     $resultSQL = $conn->query($sql);  
     $conn->close();//***FECHA CONEXAO BD***//*
     if(!$resultSQL){
        echo "error";
        exit;
     }
     while($row = $resultSQL->fetch_assoc()) {//***PARA TODOS OS ITENS DO BD
        $benefT .= $row['descricao_beneficio']."\n"; //acrescenta o benefício na String
     }
     echo "<textarea rows='10' class='form-control' name = 'topico_beneficios'>".$benefT."</textarea>";
     
     echo "<hr><h5 align='center'>Retorno além da Consultoria</h5>";
     echo "<textarea rows='10' class='form-control' name = 'retornos'></textarea>";
     
     echo "</div>" //FECHA A DIV COM INFORMAÇÕES APENAS DE PROPOSTA DETALHADA
?>
    <hr>
    <div class="row col-lg-12">
        <div class="col-lg-1">
        
        </div>
        <div class="col-lg-3">
            <input type="radio" name="tipoCliente" value="startup" checked="checked"> Startup<br>
            <input type="radio" name="tipoCliente" value="ej"> Empresa Júnior<br>
            <input type="radio" name="tipoCliente" value="associacao"> Associação<br>      
            <input type="radio" name="tipoCliente" value="associacaoEstudantil"> Associação Estudantil<br>
            <input type="radio" name="tipoCliente" value="empresa"> Empresa ou Empreendedor<br>
        </div>
        <div class="col-lg-3">
                <label for="validade">Validade da Proposta</label>
                <input type="date" style="width: 100%" class='form-control' name="validadeProposta" id="validadeProposta " value = '<?php echo date("Y-m-d", strtotime("+10 days"));?>'></input>
        </div>
        <div class="col-lg-1">
        
        </div>
        <div class="col-lg-4">
                <label for="logomarca">Logomarca do Cliente</label>
                <input type="file" class="form-control" name="logomarca" accept="image/*"></input>
        </div>
    </div>
    
    <hr>
    <button class='btn_class' type="button" style='font-size:13px' onclick="nextPage('resumida_arquivo.php')">Gerar Proposta Resumida</button>
    <button class='btn_class' type="button" style='font-size:13px' onclick="nextPage('detalhada_arquivo.php')">Gerar Proposta Detalhada</button>
    <button class='btn_class' type="button" style='font-size:13px' onclick="nextPage('slides_arquivo.php')">Gerar Proposta de Slides</button>
    <a href="propostas.php"><button class='btn_class' type="button" style='font-size:13px'>Voltar</button></a>
    </form>
    </main>
    
  <footer>
        Desenvolvido por <a target ="blank" href="http://www.nobugs.com.br">No Bugs</a> @2019
    </footer>
</body>
</html>
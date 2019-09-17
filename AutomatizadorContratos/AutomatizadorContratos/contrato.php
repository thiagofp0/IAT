<?php
        session_start();

        if(!isset($_SESSION["log_nb_auto"])){
            unset($_SESSION["log_nb_auto"]);
            header("location:index.php");
            exit;
        }
        
        $login = $_SESSION["log_nb_auto"];
        $user = $login["username"];
        $nome = $login["Nome"];
?>
<!DOCTYPE html>
<!-- DESENVOLVIDO POR NO BUGS - EMPRESA JÚNIOR DE INFORMÁTICA - 2019 -->
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset = "UTF-8">
    <title>Gerar Contrato</title>
    <link rel="icon" href="favicon.png" type="image/png" sizes="16x16">
    <script type="text/javascript">
        function validar(id){
            var i = 0;
            while(document.getElementById(i.toString()) != null){
                if(document.getElementById(i.toString()).checked)
                    return true;
                i++;
            }
            return false;
        }
    </script>
</head>
<body>
    <?php require('header.php'); ?>
    
    <main style='margin: 20px 40px 10px 40px'>
    <?php require('logoutBox.php');?>
    <p style= "margin-left:10px">Olá novamente, <?php echo $nome; ?> ! </p>
    <p style= "margin-left:10px">Bem vindo ao Automatizador de Contrados da NoBugs!</p>
    <p style= "margin-left:10px">Para iniciar, selecione o tipo de serviço prestado:</p>
    <form method="POST" action="contrato_tabela.php" onsubmit="return validar()">
    <?php
        //***CONEXÃO COM BANCO DE DADOS ***//
        include "conexao.inc";
        
        $res = $conn->query("SELECT * FROM Item ORDER BY nome;");
        
        //CONSTRUÇÃO DA TABELA
        echo "<table class='table'>";
        echo "<thead>
        <th>Incluir</th>
        <th>Nome</th>
        </thead>";
        $cont = 0;
        while($row = $res->fetch_assoc()){//***IMPRESSÃO DO BANCO EM TABELA ***//
            echo"<tr><td><input type='checkbox' id='".$cont."' name='".$cont."'></td>"; //incluir
            echo "<td>" . $row["nome"] . "</td></tr>"; //nome
            $cont++;
        }
        echo "</table>";
        $conn->close();//***FECHA CONEXÃO BD***//
    ?>
    <p></p>
    <input class='btn btn_class' type = 'submit' style= 'font-size:14px' value = 'Próximo'/>
    <a href="menu.php"><input class='btn btn_class' type = 'button' style= 'font-size:14px' value = 'Voltar'/></a>
  </form>
      </main>
    <footer>
        Desenvolvido por <a target ="blank" href="http://www.nobugs.com.br">No Bugs</a> @2019
    </footer>
</body>
</html>
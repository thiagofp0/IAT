<?php
    require('conexao.php');
	require_once('conexao.php');
	include_once("conexao.php");
		
	if($conexao){
      		
    	  $resultadoCategoria1 = mysqli_query($conexao, 'SELECT nome FROM palavras WHERE categoria = 1');
          //$palavrasCattegoria3 = array();
          $row = mysqli_num_rows($resultadoCategoria1);

          $resultadoCategoria2 = mysqli_query($conexao, "SELECT nome FROM palavras WHERE categoria = 2");
          //$palavrasCattegoria3 = array();
          $row2 = mysqli_num_rows($resultadoCategoria2);
          //Pega as palavras do BD
          $resultadoCategoria3 = mysqli_query($conexao, "SELECT nome FROM palavras WHERE categoria = 3");
          //$palavrasCattegoria3 = array();
          $row3 = mysqli_num_rows($resultadoCategoria3);

          $resultadoCategoria4 = mysqli_query($conexao, "SELECT nome FROM palavras WHERE categoria = 4");
          //$palavrasCattegoria4 = array();
          $row4 = mysqli_num_rows($resultadoCategoria4);
    }else{
      echo "Sem conexão!";
    }

    /* //Passa o resultado para o vetor
    while($row = $resultadoCategoria3->fetch_array()){
        $palavrasCategoria3[] = $row;
    } */

    //Embaralha as palavras e escolhe só as 10 primeiras para codificar com JSON
    //shuffle($palavras);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Início</title>
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../css/button.css">
    <link rel="stylesheet" href="../css/index_php.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/style_table.css">
    <link rel="stylesheet" href="../css/principal.css">
    <link rel="stylesheet" href=" ../css/implicito.css">
    <script>
        if(window.sessionStorage.getItem("page") != "12")
            window.location.replace("index.php");
        window.sessionStorage.setItem('page', '999');
    </script>
</head>
<body class="bg">
    <section class="cabecalho">
        <h1 id="titulo">TESTE DE ASSOCIAÇÃO IMPLÍCITA</h1>
    </section>
    <div class="container">
        <div class="alert alert-secondary">
            <h1 class="tituloEtapa">Etapa 6</h1> <br>
            <p>Neste teste você usará as teclas "E" e "I" para categorizar itens em grupos o mais rápido quanto conseguir <strong>sem cometer erros!</strong></p>
            <p>Abaixo estão os itens e os grupos aos quais eles pertencem:  </p>
            <table class="table">
                <thead class="thead-dark">
                    <tr>
                    <th scope="col" class="cabecaTabela">Grupos</th>
                    <th scope="col" class="cabecaTabela">Itens</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                    <th scope="row">Masculino</th>
                    <td><?php
                      		foreach($resultadoCategoria1 as $linha){
                           echo $linha['nome'] . "; ";
                        }
                      ?></td>
                    </tr>
                    <tr>
                    <th scope="row">Feminino</th>
                    <td><?php
                      		foreach($resultadoCategoria2 as $linha){
                           echo $linha['nome'] . "; ";
                        }
                      ?></td>
                    </tr>
                    <tr>
                    <th scope="row">Exatas/Naturais</th>
                    <td><?php
                      		foreach($resultadoCategoria3 as $linha){
                           echo $linha['nome'] . "; ";
                        }
                      ?></td>
                    </tr>
                    <tr>
                    <th scope="row">Humanas</th>
                    <td><?php
                      		foreach($resultadoCategoria4 as $linha){
                           echo $linha['nome'] . "; ";
                        }
                      ?></td>
                    </tr>
                </tbody>
            </table>
            <p><strong> Preste atenção!</strong></p>
            <button class="btn btn-success" id="botaoContinuar" onclick="window.sessionStorage.setItem('page','13'); window.location.href = 'impExaFemHumMasc2.php'">Começar</button>
        </div>
    </div>
    <script src="../js/bootstrap.js"></script>
</body>
</html>
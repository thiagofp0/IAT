<?php
    include_once("conexao.php");

    $resultadoCategoria1 = mysqli_query($conexao, "SELECT nome, categoria FROM palavras WHERE categoria = 1");
    //$palavrasCattegoria3 = array();
    $row = mysqli_num_rows($resultadoCategoria1);

    $resultadoCategoria2 = mysqli_query($conexao, "SELECT nome, categoria FROM palavras WHERE categoria = 2");
    //$palavrasCattegoria3 = array();
    $row = mysqli_num_rows($resultadoCategoria2);
    //Pega as palavras do BD
    $resultadoCategoria3 = mysqli_query($conexao, "SELECT nome, categoria FROM palavras WHERE categoria = 3");
    //$palavrasCattegoria3 = array();
    $row = mysqli_num_rows($resultadoCategoria3);

    $resultadoCategoria4 = mysqli_query($conexao, "SELECT nome, categoria FROM palavras WHERE categoria = 4");
    //$palavrasCattegoria4 = array();
    $row2 = mysqli_num_rows($resultadoCategoria4);

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
    <!-- <script>
        if(window.sessionStorage.getItem("page") != "2")
            window.location.replace("index.php");
        window.sessionStorage.setItem('page', '999');
    </script> -->
</head>
<body class="bg">
    <section class="cabecalho">
        <h1 id="titulo">TESTE DE ASSOCIAÇÃO IMPLÍCITA</h1>
    </section>
    <div class="container">
        <div class="alert alert-secondary">
            <h1 class="tituloEtapa">Etapa 1</h1> <br>
            <p>Neste teste você usará as teclas "seta para a esquerda" e "seta para a direita" para categorizar itens em grupos o mais rápido quanto conseguir.</p>
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
                    <td><? 
                        foreach($resultadoCategoria1 as $linha){
                            echo $linha['nome']. "; ";
                        }
                    ?></td>
                    </tr>
                    <tr>
                    <th scope="row">Feminino</th>
                    <td><? 
                        foreach($resultadoCategoria2 as $linha){
                            echo $linha['nome']. "; ";
                        }
                    ?></td>
                    </tr>
                    <tr>
                    <th scope="row">Exatas</th>
                    <td><? 
                        foreach($resultadoCategoria3 as $linha){
                            echo $linha['nome']. "; ";
                        }
                    ?></td>
                    </tr>
                    <tr>
                    <th scope="row">Humanas</th>
                    <td><? 
                        foreach($resultadoCategoria4 as $linha){
                            echo $linha['nome']. "; ";
                        }
                    ?></td>
                    </tr>
                </tbody>
            </table>
            <p><strong> Preste atenção!</strong></p>
            <button class="btn btn-success" id="botaoContinuar" onclick="window.location.href = 'impExaHum.php'">Continuar</button>
        </div>
    </div>
    <script src="../js/bootstrap.js"></script>
</body>
</html>
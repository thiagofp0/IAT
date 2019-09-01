<?php
    include_once("conexao.php");

    //Pega as palavras do BD
    $resultado = mysqli_query($conexao, "SELECT nome, categoria FROM palavras WHERE categoria = 1 or categoria = 2");
    $palavras = array();

    //Passa o resultado para o vetor
    while($row = $resultado->fetch_array()){
        $palavras[] = $row;
    }

    //Embaralha as palavras e escolhe só as 10 primeiras para codificar com JSON
    shuffle($palavras);
    $palavrasJSON = json_encode(array_slice($palavras, 0, 10));
?>

<head>
    <script type="text/javascript">
        var palavras = JSON.parse('<?=$palavrasJSON?>')
        console.log(palavras);
    </script>
</head>

<body>
    <!--Insira seu front-end aqui-->
</body>
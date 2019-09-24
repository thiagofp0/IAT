<?php
    include_once("conexao.php");

    //Pega as palavras do BD
    $resultado = mysqli_query($conexao, "SELECT nome, categoria FROM palavras WHERE categoria = 1 or categoria = 2");
    $palavras = array();

    //Passa o resultado para o vetor
    while($row = $resultado->fetch_array()){
        $palavras[] = $row;
    }


    /*Completa até dar 20*/
    while(sizeof($palavras) < 20){
        $palavras[] = $palavras[rand(0, sizeof($palavras) - 1)];
    }

    //Embaralha as palavras e escolhe só as 10 primeiras para codificar com JSON
    shuffle($palavras);

    //Tira casos de palavras iguasi adjacentes
    for($i = 0; $i < 19; $i++){
        if($palavras[$i] == $palavras[$i + 1]){
            if($i == 0){
                //Troca a palavra repetida por uma nova, não repetida
                $aux = $palavras[rand(0, sizeof($palavras) - 1)];
                while($aux == $palavras[$i + 1]){
                    $aux = $palavras[rand(0, sizeof($palavras) - 1)];
                }

                $palavras[$i] = $aux;
            }
            else{
                //Troca a palavra repetida por uma nova, não repetida
                $aux = $palavras[rand(0, sizeof($palavras) - 1)];
                while($aux == $palavras[$i + 1] or $aux == $palavras[$i - 1]){
                    $aux = $palavras[rand(0, sizeof($palavras) - 1)];
                }

                $palavras[$i] = $aux;
            }
        }
    }

    $palavrasJSON = json_encode(array_slice($palavras, 0, 20));
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Implícito</title>
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../css/button.css">
    <link rel="stylesheet" href="../css/index_php.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/style_table.css">
    <link rel="stylesheet" href="../css/principal.css">
    <link rel="stylesheet" href="../css/implicito.css">

    <!-- ------------------------------------------------------------------------------------>
    <script type="text/javascript">
        
        
        /*Controle de seção*/
        if(window.sessionStorage.getItem("page") != "5")
            window.location.replace("index.php");
        window.sessionStorage.setItem('page', '999');

        /*Controle das setas e de tempo*/
        
        var indice = -1;
        var palavras = JSON.parse('<?=$palavrasJSON?>');
        var quantpalavras = palavras.length;
        var tempos = [quantpalavras]; // Vetor que salva o tempo de cada resposta (sem calcular intervalo)
        var tempoInicio; // Váriável que armazena o tempo de início do teste
        var erros = 0;
        console.log(palavras);

        //Parte que muda as palavras da DIV
        function mudaPalavra(){
            if(indice >= palavras.length){
                document.getElementById("palavra").style.fontSize = '60px';
                window.sessionStorage.setItem('page', '6');
                window.sessionStorage.setItem('tempos2', JSON.stringify(tempos));
                window.sessionStorage.setItem('erros2', erros);
                window.location.replace("instrucaoRound3.php");
            }
            else{
                document.getElementById("palavra").style.fontSize = '60px';
                document.getElementById("palavra").innerHTML = palavras[indice].nome;
            }
            if(palavras[indice].categoria == 3 || palavras[indice].categoria == 4){
                document.getElementById("palavra").style.color = 'blue'; 
            }
            else if(palavras[indice].categoria == 1 || palavras[indice].categoria == 2){
                document.getElementById("palavra").style.color = 'green';
            }
        }

        //Tá errado o negócio da cor

        //Parte de captura das teclas
        document.onkeyup = function (event) {
            

            var key = event.which || event.keyCode;

            if(indice >= palavras.length){
                return;
            }
            else if(indice == -1){
                if(key == 32){
                    indice++;
                    mudaPalavra();
                    tempoInicio = Date.now(); // Tempo Início
                }
            }
            //Seta esquerda
            else if(key == 69){
                if(palavras[indice].categoria == 1){
                    indice++;
                    mudaPalavra();
                    let aux = Date.now();
                    tempos[indice - 1] = (aux - tempoInicio); //Tempo gasto na palavra
                }
                else{
                    document.getElementById("palavra").style.color = 'red';
                    erros++;
                }
            }
            //Seta direita
            else if(key == 73){
                if(palavras[indice].categoria == 2){
                    indice++;
                    mudaPalavra();
                    let aux = Date.now();
                    tempos[indice - 1] = (aux - tempoInicio); //Tempo gasto na palavra
                }
                else{
                    document.getElementById("palavra").style.color = 'red';
                    erros++;
                }
            }
        }
    </script>
    <!-- ------------------------------------------------------------------------------------>
</head>
<body class="bg">
    <section class="cabecalho" id="cabecalhoQuest">
        <h1 id="titulo">TESTE DE ASSOCIAÇÃO IMPLÍCITA</h1>
    </section>
    <div class="box container" id="boxQuest">
        <div class="grupos">
            <div class="grupo1">
                <h6>Aperte E</h6><br>
                <h1>Masculino</h1>
            </div>
            <div class="grupo2">
                <h6>Aperte I</h6><br>
                <h1>Feminino</h1>
            </div>
        </div>
        <div class="inboxText" id = "palavra" onkeydown="apertouTecla(event)">
        <p>Aperte a tecla <span class="tecla">E</span> para itens que pertencem ao grupo <strong>Masculino</strong>.</p>
        <p>Aperte a tecla <span class="tecla">I</span> para itens que pertencem ao grupo <strong>Feminino</strong>.</p>
        <p>Aparecerá apenas um item por vez!</p>
        <p>Caso você cometer um erro, o item passará a assumir a cor vermelha. Aperte a outra tecla para continuar</p>
        <p> <u> Vá o mais rápido possível </u><strong> sem cometer erros!</strong></p>
        Aperte <span class="tecla">ESPAÇO</span> quando estiver pronto para começar</div>
    </div>
</body>
</html>
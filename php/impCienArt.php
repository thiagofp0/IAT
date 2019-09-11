<?php
    include_once("conexao.php");

    //Pega as palavras do BD
    $resultado = mysqli_query($conexao, "SELECT nome, categoria FROM palavras WHERE categoria = 3 or categoria = 4");
    $palavras = array();

    //Passa o resultado para o vetor
    while($row = $resultado->fetch_array()){
        $palavras[] = $row;
    }

    //Embaralha as palavras e escolhe só as 10 primeiras para codificar com JSON
    shuffle($palavras);
    $palavrasJSON = json_encode(array_slice($palavras, 0, 10));
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
        
        var indice = -1;
        var palavras = JSON.parse('<?=$palavrasJSON?>');
        var quantpalavras = palavras.length;
        var tempos = [quantpalavras]; // Vetor que salva o tempo de cada resposta (sem calcular intervalo)
        var tempoInicio; // Váriável que armazena o tempo de início do teste
        console.log(palavras);

        //Parte que muda as palavras da DIV
        function mudaPalavra(){
            if(indice >= palavras.length){
                document.getElementById("palavra").style.color = 'black';
                document.getElementById("palavra").innerHTML = "fim";
            }
            else{
                document.getElementById("palavra").style.color = 'black';
                document.getElementById("palavra").innerHTML = palavras[indice].nome;
            }
        }

        //Parte de captura das teclas
        document.onkeyup = function (event) {
            

            var key = event.which || event.keyCode;

            if(indice >= palavras.length){
                return;
            }
            else if(indice == -1){
                if(key == 13){
                    indice++;
                    mudaPalavra();
                    tempoInicio = Date.now(); // Tempo Início
                }
            }
            //Seta esquerda
            else if(key == 37){
                if(palavras[indice].categoria == 3){
                    indice++;
                    mudaPalavra();
                    let aux = Date.now();
                    tempos[indice] = (aux - tempoInicio)/1000; //Tempo gasto na palavra
                }
                else{
                    document.getElementById("palavra").style.color = 'red';
                }
            }
            //Seta direita
            else if(key == 39){
                if(palavras[indice].categoria == 4){
                    indice++;
                    mudaPalavra();
                    let aux = Date.now();
                    tempos[indice] = (aux - tempoInicio)/1000; //Tempo gasto na palavra
                }
                else{
                    document.getElementById("palavra").style.color = 'red';
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
                <h6>Aperte seta para esquerda</h6><br>
                <h1>Ciência</h1>
            </div>
            <div class="grupo2">
                <h6>Aperte seta para direita</h6><br>
                <h1>Artes</h1>
            </div>
        </div>
        <div class="inboxText" id = "palavra" onkeydown="apertouTecla(event)">
        <p>Aperte a tecla <span class="tecla">Seta para a esquerda</span> para itens que pertencem ao grupo <strong>Ciência</strong>.</p>
        <p>Aperte a tecla <span class="tecla">Seta para a direita</span> para itens que pertencem ao grupo <strong>Artes</strong>.</p>
        <p>Aparecerá apenas um item por vez!</p>
        <p>Caso você cometer um erro, o item passará a assumir a cor vermelha. Aperte a outra tecla para continuar</p>
        <p> <u> Vá o mais rápido possível </u> enquanto é preciso</p>
        Aperte <span class="tecla">ENTER</span> quando estiver pronto para começar</div>
    </div>
</body>
</html>
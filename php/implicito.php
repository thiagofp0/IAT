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
        
        window.alert("aaa");

        var indice = -1;
        var palavras = JSON.parse('<?=$palavrasJSON?>')
        console.log(palavras);

        //Parte que muda as palavras da DIV
        function mudaPalavra(){
            if(indice >= palavras.length){
                document.getElementById("palavra").style.color = 'black';
                document.getElementById("palavra").innerHTML = "fim";
            }
            else{
                document.getElementById("palavra").style.color = 'black';
                document.getElementById("palavra").innerHTML = indice + " " + palavras[indice].nome;
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
                }
            }
            //Seta esquerda
            else if(key == 65){
                if(palavras[indice].categoria == 1){
                    indice++;
                    mudaPalavra();
                }
                else{
                    document.getElementById("palavra").style.color = 'red';
                }
            }
            //Seta direita
            else if(key == 69){
                if(palavras[indice].categoria == 2){
                    indice++;
                    mudaPalavra();
                }
                else{
                    document.getElementById("palavra").style.color = 'red';
                }
            }
        }
    </script>
</head>

<body>
    <div id = "palavra" onkeydown="apertouTecla(event)">Aperte enter para começar...</div>
</body>
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
    <script>
        if(window.sessionStorage.getItem("page") != "16")
            window.location.replace("index.php");
        window.sessionStorage.setItem("page", "999"); 

        /*Calculo do resultado*/
        tempos1 = JSON.parse(window.sessionStorage.getItem('tempos4'));
        tempos2 = JSON.parse(window.sessionStorage.getItem('tempos7'));

        var compatible = 0;
        for (i = 1; i < tempos1.length; i++){
		    score = tempos1[i];
		    if (score < 300) { score = 300; }
		    if (score > 3000) { score = 3000;}
		    compatible += Math.log(score);
	    }

        compatible /= (tempos1.length - 1);
	
        incompatible = 0;
        for (i = 1; i<tempos2.length; i++){
            score = tempos2[i];
            if (score < 300) { score = 300; }
            if (score > 3000) { score = 3000; }
            incompatible += Math.log(score);
        }
        incompatible /= (tempos2.length - 1);

        cvar = 0;
        for (i=1; i<tempos1.length; i++)
        {
            score = tempos1[i];
            if (score < 300) { score = 300; }
            if (score > 3000) { score = 3000; }
            cvar += Math.pow((Math.log(score) - compatible),2);
        }
        
        // calculate variance log(RT) for second key trial
        ivar = 0;
        for (i=1; i<tempos2.length; i++)
        {
            score = tempos2[i];
            if (score < 300) { score = 300; }
            if (score > 3000) { score = 3000; }
            ivar += Math.pow((Math.log(score) - incompatible),2);
        }
        
        // calculate t-value
        tvalue = (incompatible - compatible) / Math.sqrt(((cvar/39) + (ivar/39))/40);

        var severity = "";
        

        var resultado = 0;

        if (Math.abs(tvalue) > 2.89) { severity = " <b>muito mais</b> que ";}
	    else if (Math.abs(tvalue) > 2.64) { severity = " <b>mais</b> que "; resultado += 1;}	
	    else if (Math.abs(tvalue) > 1.99) { severity = " <b>um pouco mais</b> que "; resultado += 2;}
	    else if (Math.abs(tvalue) > 1.66) { severity = " <b>ligeiramente mais</b> que "; resultado += 3;}

        var resulttext = "";
        
        if (tvalue < 0 && severity != ""){ 
            resulttext = "Você associa feminino com exatas e masculino com humanas " + severity;
            resulttext += "feminino com humanas e masculino com exatas";
            resultado = 9 - resultado; 
        }
        else if (tvalue > 0 && severity != ""){ 
            resulttext = "Você associa masculino com exatas e feminino com humanas" + severity;
            resulttext += "masculino com humanas e feminino com exatas";
            resultado += 1;
        }
        else{ 
            resulttext = "Você não associa masculino com exatas mais do que associa feminino com exatas";
            resultado = 5;
        }

        //Somando os erros totais e exibindo
        var errosTotal = 0;
        for(var i = 1; i <= 7; i++){
            errosTotal += parseInt(window.sessionStorage.getItem("erros" + i), 10);
        }

        resulttext += "<br> Número de Erros: " + errosTotal;
		
        //Capturando os dados necessarios
        
        //ID
        id = window.sessionStorage.getItem('idExplicito');

        //Tempos
        t1 = JSON.parse(window.sessionStorage.getItem('tempos1')).reduce((a, b) => a + b, 0);
        t2 = JSON.parse(window.sessionStorage.getItem('tempos2')).reduce((a, b) => a + b, 0);
        t3 = JSON.parse(window.sessionStorage.getItem('tempos3')).reduce((a, b) => a + b, 0);
        t4 = JSON.parse(window.sessionStorage.getItem('tempos4')).reduce((a, b) => a + b, 0);
        t5 = JSON.parse(window.sessionStorage.getItem('tempos5')).reduce((a, b) => a + b, 0);
        t6 = JSON.parse(window.sessionStorage.getItem('tempos6')).reduce((a, b) => a + b, 0);
        t7 = JSON.parse(window.sessionStorage.getItem('tempos7')).reduce((a, b) => a + b, 0);

        //Erros
        e1 = window.sessionStorage.getItem('erros1');
        e2 = window.sessionStorage.getItem('erros2');
        e3 = window.sessionStorage.getItem('erros3');
        e4 = window.sessionStorage.getItem('erros4');
        e5 = window.sessionStorage.getItem('erros5');
        e6 = window.sessionStorage.getItem('erros6');
        e7 = window.sessionStorage.getItem('erros7');

        //AJAX
        var xhttp = new XMLHttpRequest();
        xhttp.open("POST", "salvarTempos.php", true);
        xhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        var json;
        xhttp.onload = function(){ 
            json = JSON.parse('' + xhttp.responseText)
            if(json.resultado == 0){
                resulttext += "<br><font color='red'> Ocorreu um erro no banco de dados! Repita o teste mais tarde! </font>"
            }
        };
        xhttp.send(
            "id=" + id +
            "&t1=" + t1 +
            "&t2=" + t2 +
            "&t3=" + t3 +
            "&t4=" + t4 +
            "&t5=" + t5 +
            "&t6=" + t6 +
            "&t7=" + t7 +
            "&e1=" + e1 +
            "&e2=" + e2 +
            "&e3=" + e3 +
            "&e4=" + e4 +
            "&e5=" + e5 +
            "&e6=" + e6 +
            "&e7=" + e7 +
            "&score=" + tvalue +
            "&severity=" + Math.abs(tvalue) +
            "&resultado=" + resultado
        );
        
    </script>
</head>
<style>
    .img{
        padding-top: 1%;
    }
    .rodape{
        background-color: black;
        position: absolute;
        height: 100px;
        margin-top: -70px;
        bottom: 0;
        width: 100.12%;
        text-align: center;
    }
    .bg{
       position: relative;
    }
    .container{
        height: 50%;
        margin-bottom: 0px;
        position: relative;
    }
    .alert alert-secondar{
        margin-bottom: 0px;
    }
    #resultado{
        text-align: center;
        margin-bottom: 3%;
    }
</style>
<body class="bg" onload="document.getElementById('resultado').innerHTML = resulttext;">
    <section class="cabecalho">
        <h1 id="titulo">TESTE DE ASSOCIAÇÃO IMPLÍCITA</h1>
    </section>
    <div class="container">
        <div class="alert alert-secondary">
            <p id="resultado"></p>
            <div id="centralizado">
            <button class="btn btn-success" id="voltar" onclick="window.location.href = 'index.php'">Voltar ao início</button>
            </div>
            <div id="centralizado" style="margin-top: 2%;"> 
				<h5>Para saber mais sobre o seu resultado e tirar outras dúvidas sobre o TAI, visite o site do Project Implicit (em português) clicando no botão abaixo</h5>
                <a href="https://implicit.harvard.edu/implicit/brazil/background/faqs.html"><button type="button" class="btn btn-light" id="saibaMais" >Saber mais sobre o teste</button></a>
            </div>
        </div>
    </div>
    <div class="rodape">
        <a href="https://nobugs.com.br/?utm_source=referral&utm_medium=dpnb&utm_campaign=iat"><img src="../img/nb.png" alt="Desenvolvido por No Bugs" class="img"></a>
</div>
    <script src="../js/bootstrap.js"></script>
</body>
</html>
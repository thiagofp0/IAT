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
        if(window.sessionStorage.getItem("page") != "1")
            window.location.replace("index.php");
        window.sessionStorage.setItem("page", "999");
    </script>
</head>
<body class="bg">
    <section class="cabecalho">
        <h1 id="titulo">TESTE DE ASSOCIAÇÃO IMPLÍCITA</h1>
    </section>
    <div class="container">
        <div class="alert alert-secondary">
            <p>Neste estudo, você completará um Teste de Associação Implícita (IAT), no qual você será solicitado a classificar as palavras em grupos o mais rápido possível. Este estudo deve levar cerca de 10 minutos para ser concluído. No final, você receberá o resultado do IAT juntamente com informações sobre o que isso significa.</p>
            <p>Agradecemos por estar aqui!</p>
            <button class="btn btn-success" id="botaoContinuar" onclick="window.sessionStorage.setItem('page', '2'); window.location.href = 'instrucaoRound.php'">Continuar</button>
        </div>
    </div>
    <script src="../js/bootstrap.js"></script>
</body>
</html>
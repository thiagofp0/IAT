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

</head>
<style>
    .alertPreto{
    margin-left: 15%;
    background-color: rgb(31, 31, 31);
    border-radius: 8px;
    width: 70%;
    height: 80%;
    padding: 2%;
    margin-top: 7%;
}
.textoCentro{
    text-align: center;
    margin-top: 5%;
    color: white;
}
.img{
    position:relative;
    left:45%;
    margin-top: 6%;
    margin-left:-50px;
}
</style>
<body class="bg" onload="document.getElementById('resultado').innerHTML = resulttext;">
    <section class="cabecalho">
        <h1 id="titulo">TESTE DE ASSOCIAÇÃO IMPLÍCITA</h1>
    </section>
    <div class="container">
        <div class="alertPreto">
            <p id="resultado"></p>
            <img src="../img/nb.png" alt="Desenvolvido por No Bugs" class="img">
        </div>
    </div>
    <script src="../js/bootstrap.js"></script>
</body>
</html>
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
<body class="bg">
    <section class="cabecalho">
        <h1 id="titulo">TESTE DE ASSOCIAÇÃO IMPLÍCITA</h1>
    </section>
    <div class="container">
        <div class="alert alert-secondary">
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
                    <td>Homem, Filho, Menino, Tio, Marido, Ele, Dele</td>
                    </tr>
                    <tr>
                    <th scope="row">Feminino</th>
                    <td>Mulher, Filha, Menina, Tia, Esposa, Ela, Dela</td>
                    </tr>
                    <tr>
                    <th scope="row">Exatas</th>
                    <td>Matemática, Engenharia, Física, Astronomia, Química, Geologia, Estatística</td>
                    </tr>
                    <tr>
                    <th scope="row">Humanas</th>
                    <td>Português, Literatura, Filosofia, História, Sociologia, Pedagogia, Jornalismo</td>
                    </tr>
                </tbody>
            </table>
            <p>São sete partes. As instruções mudam para cada parte. <strong> Preste atenção!</strong></p>
            <button class="btn btn-success" id="botaoContinuar" onclick="window.location.href = 'impCienArt.php'">Continuar</button>
        </div>
    </div>
    <script src="../js/bootstrap.js"></script>
</body>
</html>
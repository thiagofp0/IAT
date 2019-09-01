<?php
    include_once("conexao.php");
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
</head>
<body class="bg">
    <section class="cabecalho">
        <h1 id="titulo">TERMO DE CONSENTIMENTO LIVRE E ESCLARECIDO</h1>
    </section>
    <div class="container">
        <div class="alert alert-secondary">
            <h3 class="text-center">Questionário</h3>
            <div class="textTCLE">
                Este questionário faz parte da pesquisa “Estereótipos de gênero e escolha ocupacional na
                Universidade Federal de Viçosa”. Sua resposta às questões que se seguem são sigilosas e você
                não será identificado(a). Os riscos e benefícios provenientes da resposta a esse questionário
                estão de acordo com o explicitado no Termo de Consentimento Livre e Esclarecido (TCLE).
            </div>
            <div class="textTCLE">
                Por favor preencha as perguntas sobre você:
            </div>
            <form action="explicitoDao.php" method="POST">
                <div class="textQuestion">
                    1. Sexo:
                    <div class="textQuestionAns">
                        <select name = "sexo" class="form-control">
                            <option value="0"> Feminino </option>
                            <option value="1"> Masculino </option>
                        </select>
                    </div>
                </div>

                <div class="textQuestion">
                    2. Qual o seu curso? 
                    <div class="textQuestionAns">
                        <select name = "curso" class="form-control">
                            <?php
                                
                                $sql = "SELECT * FROM curso ORDER BY nome;";
                                $resultado = mysqli_query($conexao,$sql);
                                
                                if($resultado){
                                    while($obj = $resultado->fetch_object()){
                                        echo "<option value = '$obj->id'> $obj->nome </option>";
                                    }
                                }
                                echo "<option value = 'NULL'> Não sou estudante da universidade </option>"
                            ?>
                        </select>
                    </div>
                </div>

                <div class="textQuestion">
                    3. Em qual período você está? 
                    <div class="textQuestionAns">
                        <input class="form-control" type="number" name="periodo" min="1" step="1" style="max-width:7%; text-align:right; font-family:arial !important;" required>
                    </div>
                </div>

                <div class="textQuestion">
                    4. Idade: 
                    <div class="textQuestionAns">
                        <input class="form-control" type="number" name="idade" min="1" style="max-width:7%; font-family:arial !important;" required/>
                    </div>
                </div>

                <div class="textQuestion">
                    5. Cor: 
                    <div class="textQuestionAns">
                        <select name = "cor" class="form-control">
                            <option value="Preta"> Preta </option>
                            <option value="Branca"> Branca </option>
                            <option value="Parda"> Parda </option>
                            <option value="Amarela">Amarela </option>
                            <option value="Indígena"> Indígena </option>
                            <option value="Outra"> Outra </option>
                        </select>
                    </div>
                </div>
                <div class="textTCLE">
                    Agora responda às seguintes perguntas:
                </div>

                <div class="textQuestion">
                    6. Por favor, avalie quanto você associa as <b>Ciências Exatas e Naturais</b> com homens e mulheres: 
                    <div class="textQuestionAns">
                        <select name = "q6" class="form-control">
                            <option value="Fortemente masculino"> Fortemente masculino </option>
                            <option value="Moderadamente masculino"> Moderadamente masculino </option>
                            <option value="Ligeiramente masculino"> Ligeiramente masculino </option>
                            <option value="Nem masculino nem feminino">Nem masculino nem feminino </option>
                            <option value="Ligeiramente feminino"> Ligeiramente feminino </option>
                            <option value="Moderadamente feminino"> Moderadamente feminino </option>
                            <option value="Fortemente feminino"> Fortemente feminino </option>
                        </select>
                    </div>
                </div>

                <div class="textQuestion">
                    7. Por favor, avalie quanto você associa as <b>Ciências Humanas</b> com homens e mulheres: 
                    <div class="textQuestionAns">
                        <select name = "q7" class="form-control">
                            <option value="Fortemente masculino"> Fortemente masculino </option>
                            <option value="Moderadamente masculino"> Moderadamente masculino </option>
                            <option value="Ligeiramente masculino"> Ligeiramente masculino </option>
                            <option value="Nem masculino nem feminino">Nem masculino nem feminino </option>
                            <option value="Ligeiramente feminino"> Ligeiramente feminino </option>
                            <option value="Moderadamente feminino"> Moderadamente feminino </option>
                            <option value="Fortemente feminino"> Fortemente feminino </option>
                        </select>
                    </div>
                </div>

                <div class="textQuestion">
                    8. Por favor, avalie sua atitude com relação às <b>Ciências Exatas e Naturais</b> com homens e mulheres: 
                    <div class="textQuestionAns">
                        <select name = "q8" class="form-control">
                            <option value="Gosto Muito"> Gosto Muito </option>
                            <option value="Gosto"> Gosto </option>
                            <option value="Não gosto nem desgosto"> Não gosto nem desgosto </option>
                            <option value="Desgosto">Desgosto </option>
                            <option value="Desgosto muito"> Desgosto muito </option>
                        </select>
                    </div>
                </div>

                <div class="textQuestion">
                    9. Por favor, avalie sua atitude com relação às <b>Ciências Humanas</b> com homens e mulheres: 
                    <div class="textQuestionAns">
                        <select name = "q9" class="form-control">
                            <option value="Gosto Muito"> Gosto Muito </option>
                            <option value="Gosto"> Gosto </option>
                            <option value="Não gosto nem desgosto"> Não gosto nem desgosto </option>
                            <option value="Desgosto">Desgosto </option>
                            <option value="Desgosto muito"> Desgosto muito </option>
                        </select>
                    </div>
                </div>

                <div class="textQuestion">
                    10. As mulheres ocorrem em menor número que os homens como docentes nos cursos de
    graduação de Ciências Exatas e Naturais em Universidades prestigiadas. Os seguintes
    fatores são algumas vezes citados como razões para essa diferença. Por favor, avalie o
    quão importante você considera cada fator na explicação dessa diferença. <br><br>

                    <div class="textQuestionAns">
                        a) Em média, homens e mulheres diferem na sua disposição em devotar o tempo
    exigido por essas carreiras de prestígio.
                        <div class="textQuestionAns">
                            <select name = "q10a" class="form-control">
                                <option value="Extremamente importante"> Extremamente importante </option>
                                <option value="Muito Importante"> Muito Importante </option>
                                <option value="Um pouco importante"> Um pouco importante </option>
                                <option value="Ligeiramente importante">Ligeiramente importante </option>
                                <option value="Sem importância"> Sem importância </option>
                            </select>
                        </div>
                    </div>
                    <br>
                    <div class="textQuestionAns">
                        b) Em média, homens e mulheres diferem na sua disposição em passar tempo longe
    de suas famílias.
                        <div class="textQuestionAns">
                            <select name = "q10b" class="form-control">
                                <option value="Extremamente importante"> Extremamente importante </option>
                                <option value="Muito Importante"> Muito Importante </option>
                                <option value="Um pouco importante"> Um pouco importante </option>
                                <option value="Ligeiramente importante">Ligeiramente importante </option>
                                <option value="Sem importância"> Sem importância </option>
                            </select>
                        </div>
                    </div>
                    <br>
                    <div class="textQuestionAns">
                        c) São encontradas diferentes proporções de homens e mulheres entre as pessoas
com maiores níveis de habilidade matemática.
                        <div class="textQuestionAns">
                            <select name = "q10c" class="form-control">
                                <option value="Extremamente importante"> Extremamente importante </option>
                                <option value="Muito Importante"> Muito Importante </option>
                                <option value="Um pouco importante"> Um pouco importante </option>
                                <option value="Ligeiramente importante">Ligeiramente importante </option>
                                <option value="Sem importância"> Sem importância </option>
                            </select>
                        </div>
                    </div>
                    <br>
                    <div class="textQuestionAns">
                        d) Em média, homens e mulheres diferem naturalmente nos seus interesses
científicos.
                        <div class="textQuestionAns">
                            <select name = "q10d" class="form-control">
                                <option value="Extremamente importante"> Extremamente importante </option>
                                <option value="Muito Importante"> Muito Importante </option>
                                <option value="Um pouco importante"> Um pouco importante </option>
                                <option value="Ligeiramente importante">Ligeiramente importante </option>
                                <option value="Sem importância"> Sem importância </option>
                            </select>
                        </div>
                    </div>
                    <br>
                    <div class="textQuestionAns">
                        e) Direta ou indiretamente, meninos e meninas tendem a receber níveis diferentes de
encorajamento para desenvolver seus interesses científicos.
                        <div class="textQuestionAns">
                            <select name = "q10e" class="form-control">
                                <option value="Extremamente importante"> Extremamente importante </option>
                                <option value="Muito Importante"> Muito Importante </option>
                                <option value="Um pouco importante"> Um pouco importante </option>
                                <option value="Ligeiramente importante">Ligeiramente importante </option>
                                <option value="Sem importância"> Sem importância </option>
                            </select>
                        </div>
                    </div>
                    <br>
                    <div class="textQuestionAns">
                        f) Em média, consciente ou inconscientemente, os homens são favorecidos em
contratações e promoções.
                        <div class="textQuestionAns">
                            <select name = "q10f" class="form-control">
                                <option value="Extremamente importante"> Extremamente importante </option>
                                <option value="Muito Importante"> Muito Importante </option>
                                <option value="Um pouco importante"> Um pouco importante </option>
                                <option value="Ligeiramente importante">Ligeiramente importante </option>
                                <option value="Sem importância"> Sem importância </option>
                            </select>
                        </div>
                    </div>
                </div>
                
                <div class="textQuestion">
                11. Classifique as seguintes afirmativas sobre objetivos pessoais com relação à sua
importância: <br><br>

                    <div class="textQuestionAns">
                        a) Ser competente em ciência.
                        <div class="textQuestionAns">
                            <select name = "q11a" class="form-control">
                                <option value="Extremamente importante"> Extremamente importante </option>
                                <option value="Muito Importante"> Muito Importante </option>
                                <option value="Um pouco importante"> Um pouco importante </option>
                                <option value="Ligeiramente importante">Ligeiramente importante </option>
                                <option value="Sem importância"> Sem importância </option>
                            </select>
                        </div>
                    </div>
                    <br>
                    <div class="textQuestionAns">
                        b) Ser competente em matemática.
                        <div class="textQuestionAns">
                            <select name = "q11b" class="form-control">
                                <option value="Extremamente importante"> Extremamente importante </option>
                                <option value="Muito Importante"> Muito Importante </option>
                                <option value="Um pouco importante"> Um pouco importante </option>
                                <option value="Ligeiramente importante">Ligeiramente importante </option>
                                <option value="Sem importância"> Sem importância </option>
                            </select>
                        </div>
                    </div>
                    <br>
                    <div class="textQuestionAns">
                        c) Ser competente nas humanidades.
                        <div class="textQuestionAns">
                            <select name = "q11c" class="form-control">
                                <option value="Extremamente importante"> Extremamente importante </option>
                                <option value="Muito Importante"> Muito Importante </option>
                                <option value="Um pouco importante"> Um pouco importante </option>
                                <option value="Ligeiramente importante">Ligeiramente importante </option>
                                <option value="Sem importância"> Sem importância </option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="textQuestion">
                    12. Como você classifica a sua identidade de gênero:
                    <div class="textQuestionAns">
                        <select name = "genero" class="form-control">
                            <option value="Se identifica fortemente com o masculino"> Se identifica fortemente com o masculino </option>
                            <option value="Se identifica moderadamente com o masculino"> Se identifica moderadamente com o masculino </option>
                            <option value="Se identifica levemente com o masculino"> Se identifica levemente com o masculino </option>
                            <option value="Sem diferenças na identificação com o masculino e o feminino"> Sem diferenças na identificação com o masculino e o feminino </option>
                            <option value="Se identifica levemente com o feminino">Se identifica levemente com o feminino </option>
                            <option value="Se identifica moderadamente com o feminino">Se identifica moderadamente com o feminino </option>
                            <option value="Se identifica fortemente com o feminino">Se identifica fortemente com o feminino </option>
                        </select>
                    </div>
                </div>
                
                <div>
                    <button type="submit" class="btn btn-success" name="action">Enviar</button>
                </div>
            </form>
        </div>
    </div>
    <script src="../js/bootstrap.js"></script>
</body>
</html>
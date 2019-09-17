<?php
//DESENVOLVIDO POR NO BUGS - EMPRESA JÚNIOR DE INFORMÁTICA - 2019
session_start();

if (!isset($_SESSION["log_nb_auto"])) {
  unset($_SESSION["log_nb_auto"]);
  header("location:index.php");
  exit;
}


$_SESSION["anterior_e_contrato"] = false;

require_once ("dompdf/dompdf_config.inc.php");//DOMPDF
require_once ("bibliotecas/extenso.php");//BIBLIOTECA NÚMEROS EXTENSOS
require_once ("bibliotecas/docto.php");//BIBLIOTECA DE FUNÇÕES UTILIZADAS
date_default_timezone_set("America/Sao_Paulo");//AJUSTA TIMEZONE PARA LOCAL

//***DADOS RECEBIDOS DE PROPOSTA_TABELA.PHP CONVERTIDOS PARA VARIÁVEIS SEPARADAS***//
$nomeCliente = $_POST["nomeCliente"];
$nomes = $_POST["nomes"]; //nome do serviço
$valores = $_POST["valores"]; //prazo em dias úteis
$precos = $_POST["valores2"]; //preços
$descricoes = $_POST["descricao"]; //descrições dos serviços

//Cria o nome do arquivo, sem espaços
$arquivo = nome_docto("PropostaDetalhada_", $nomeCliente);

//GERA VETOR DE FUNCAO PARA ARMAZENAR FUNCOES E PRAZOS RECEBIDOS
$j = 0;
$vetor = array();
foreach ($nomes as $index => $key) {
  $item = new funcao();
  $item->setNome($nomes[$index]);
  $item->setPrazo($valores[$index]);
  $item->setPreco($precos[$index]);
  $item->setDescricao($descricoes[$index]);
  $vetor[$j] = $item;
  $j++;
}

$dompdf = new DOMPDF();//*** NOVO PDF ***//
$html = '<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<link href="https://fonts.googleapis.com/css?family=PT+Serif" rel="stylesheet">
<link rel="stylesheet" href="css/pdf.css" media="all" type="text/css" />
<header>
    <img class="background" src="img/topo-capa.jpg">
</header>

<style>
	p{
		text-align: justify;
	}
	p.recuo{
		text-align: justify;
		margin-left: 20px;
	}
	html{
            margin: 140px 75px;
            font-family: "PT Serif", serif;
    }
    .titulo{
        color: #fcc148;
    }
    
</style>
</head>

<body>
<main class="ui center aligned container">';

//PRIMEIRA PÁGINA - TEXTO DE APRESENTAÇÃO
$html .= '
<div class="capa">
    <header>
        <img class="background" src="img/topo-capa.jpg">
    </header>
    <div class="content">
        <div class="title">Proposta de Consultoria Jurídica</div>
        <div class="subtitle">'.$_POST['socioCliente']." ".$_POST['nomeCliente'].' </div>
        <p> Conforme solicitado, apresentamos aqui nossa proposta para realização dos serviços que, após diagnóstico, entendemos relevantes para '.$_POST['tipoEmpresa'].'.</p>
        <p>A seguinte proposta tem como objetivo explicitar com maior detalhes os serviços quistos levando em conta os desafios atuais para '.$_POST['doresCliente'].'</p>
        <p>Ademais, gostaríamos de agradecer a oportunidade e confiança oferecidos à Locus Iuris para apresentação desta proposta comercial e, confiantemente, sua realização.</p>
    </div>
    <footer>
    <div class="footer-content">
        <img class="background" src="img/inferior-capa.jpg">
    </div>
    </footer>
</div>';

//---------------------- SOBRE NÓS ------------------------------
//HISTÓRIA
$html .=
'<div class="page">
    <header>
        <img class="background" src="img/topo-sobre-nos.jpg">
    </header>
    <div class="content">
';
    
        include "conexao.inc";//conecta ao Banco de Dados
        $result =$conn->query("SELECT * FROM `Empresa`");
        while($row = $result->fetch_assoc())
            $html .= $row["sobre-detalhado"]; //Exibe o "Sobre a empresa detalhado"
        $conn->close(); //FECHA A CONEXÃO SQL

$html .='
    </div>
    <footer>
        <div class="footer-content">
            <div class="footer-logo">
                <img height="50" src="img/logo_completa.png">
            </div>
        </div>
    </footer>

</div>';


//DIFERENCIAIS
$html .=
'<div class="capa">
    <header>
        <img class="background" src="img/topo-sobre-nos.jpg">
    </header>
     <div class="content">
        <div class="subtitle" font-size:24px>Nossos diferenciais são: </div>
        <ul style="text-align:left; font-size:22px">
            <li class="paragraph">Oferecemos uma <b>consultoria personalizada</b>;</li>
            <li class="paragraph">Contamos com <b>Mestres Professores</b> para orientar nossos projetos;</li>
            <li class="paragraph">Formação de <b>equipe exclusiva</b> para cada cliente</li>
            <li class="paragraph">Temos mais de <b>5 anos de experiência</b> no mercado de startups e MPEs;</li>
        </ul>
    </div>
';
$html .='
    </div>
    <footer>
        <div class="footer-content">
            <div class="footer-logo">
                <img height="50" src="img/logo_completa.png">
            </div>
        </div>
    </footer>

</div>';

//DIAGNÓSTICO
$beneficios = explode(PHP_EOL, $_POST['resultados']);

$cont = 0;
$vazio = true;
foreach($beneficios as $beneficio){    
    if($cont == 0){
        $html .= '
        <div class="capa" style="page-break-before: always">
            <header>
                <img class="background" src="img/topo-beneficios.jpg">
            </header>
            <div class="content">
                <ul style="text-align:left; font-size:18px">';
    }
    
    if(strlen($beneficio) != 0 and !ctype_space($beneficio)){
        $html .= "<li>$beneficio</li>";
        $cont++;
        $vazio = false;
    }
    
    if($cont == 10){ //a cada 10, quebra uma página
        $html .= '</ul></div>
        <footer>
            <div class="footer-content">
                <div class="footer-logo">
                    <img height="50" src="img/logo_completa.png">
                </div>
            </div>
        </footer>
        </div>';
        $cont = 0;
    }
}

if($cont != 0 or $vazio){
        $html .= '</ul></div>
        <footer>
            <div class="footer-content">
                <div class="footer-logo">
                    <img height="50" src="img/logo_completa.png">
                </div>
            </div>
        </footer>
        </div></div>';
        $cont = 0;
}

$html .= "</div>";
    
$html .=
'<footer>
    <div class="footer-content">
        <div class="footer-logo">
            <img height="50" src="img/logo_completa.png">
        </div>
    </div>
    
</footer>
</div>';

//---------------------CRONOGRAMA--------------------------------
$html .=
'<div class="capa" style="page-break-before: always">
    <header>
        <img class="background" src="img/cronograma-locus.jpg">
    </header>
    <div class="content">
        <table>
        <thead>
            <tr>
            <th style="font-size: 24px" width="450px">Serviços:*  </th>
            <th style="font-size: 24px" width="150px">Prazo</th>
        </tr>
        </thead>';

        //tabela com os prazos
        $number = 1;
        foreach($vetor as $indice){
            $html .= "
            <tr>
                <th align='left' width='400px'>".$number.". ".$indice->getNome()."</th>
                <th align='center' width='200px'>".$indice->getPrazo()." dias úteis</th>
                </tr>";
            $number++;
        }

        $html .= "</table>";
        $html .='
    </div>
    <footer>
        <div class="footer-content">
            <div class="footer-logo">
                <img height="50" src="img/logo_completa.png">
            </div>
        </div>
    </footer>

</div>';


//---------------------INVESTIMENTO--------------------------------
$html .=
'<div class="capa" style="page-break-before: always">
    <header>
        <img class="background" src="img/topo-investimentos.jpg">
    </header>
    <div class="content">';

        //tabela com os precos
        $number = 1;
        $somaPrecos = 0;
        $html .= "<table>";
        foreach($vetor as $indice){
            $somaPrecos += $indice->getPreco();
            $html .= "
            <tr class='bordered'>
                <th align='left' width='500px'>".$number.". ".$indice->getNome()."</th>
                <th align='center' width='100px'>R$".number_format($indice->getPreco(), 2, ",", ".")."</th>
            </tr>";
        $number++;
        }
        $html .= "</table>";

        $nParcelas = $_POST["nParcelas"];
        $valorParcela = parcela($somaPrecos, $nParcelas);
        $html .= "<hr class='investimento'>";
        if($nParcelas > 1) //mais de uma parcela
            $html .= "
                <h2 align= 'center' class='subtitle' width='170px'> Total: ".number_format($somaPrecos, 2, ",", ".")."</h2>
                <h2 align= 'center' class='subtitle' width='170px'>ou ".$nParcelas." x ".number_format($valorParcela, 2, ",", ".")."</h2>";
        else
            $html .= "
                <h2 align= 'center' class='subtitle' width='170px'> Total: ".number_format($somaPrecos, 2, ",", ".")."</h2>";
        $html .='
    </div>
    <footer>
        <div class="footer-content">
            <div class="footer-logo">
                <img height="50" src="img/logo_completa.png">
            </div>
        </div>
    </footer>

</div>';


//---------------------BENEFICIOS--------------------------------
$beneficios = explode(PHP_EOL, $_POST['beneficios']);

$cont = 0;
$vazio = true;
foreach($beneficios as $beneficio){    
    if($cont == 0){
        $html .= '
        <div class="capa" style="page-break-before: always">
            <header>
                <img class="background" src="img/topo-beneficios.jpg">
            </header>
            <div class="content">
                <ul style="text-align:left; font-size:18px">';
    }
    
    if(strlen($beneficio) != 0 and !ctype_space($beneficio)){
        $html .= "<li>$beneficio</li>";
        $cont++;
        $vazio = false;
    }
    
    if($cont == 10){ //a cada 10, quebra uma página
        $html .= '</ul></div>
        <footer>
            <div class="footer-content">
                <div class="footer-logo">
                    <img height="50" src="img/logo_completa.png">
                </div>
            </div>
        </footer>
        </div>';
        $cont = 0;
    }
}

if($cont != 0 or $vazio){
        $html .= '</ul></div>
        <footer>
            <div class="footer-content">
                <div class="footer-logo">
                    <img height="50" src="img/logo_completa.png">
                </div>
            </div>
        </footer>
        </div></div>';
        $cont = 0;
}

$html .= "</div>";
    
$html .=
'<footer>
    <div class="footer-content">
        <div class="footer-logo">
            <img height="50" src="img/logo_completa.png">
        </div>
    </div>
    
</footer>
</div>';

//---------------------AGRADECIMENTO--------------------------------
$html .=
'<div class="capa" style="page-break-before: always">
    <header>
        <img class="background" src="img/topo-obrigado.jpg">
    </header>';

$tipoCliente = $_POST['tipoCliente'];
$html .= "<div class='content'><br>";

if($tipoCliente == "startup"){
    $html .= '<p style="padding: 0; text-align: justify">A Locus Iuris sabe que a trajetória de uma startup  é muito desafiadora e exige muita disposição e planejamento. Por isso, agradecemos o tempo e a confiança oferecidos.</p>';
    $html .= '<p style="padding: 0; text-align: justify">Acreditamos que o ramo de inovação e empreendedorismo deve ser sempre estimulado e, assim, destacamos que estamos abertos a negociações de preços, prazos e proposta.</p>';
    $html .= '<p style="padding: 0; text-align: justify">Por fim, esperamos muito poder ajudá-los a dar mais um passo em busca de seus objetivos!</p>';
}

if($tipoCliente == "ej"){
    $html .= '<p style="padding: 0; text-align: justify">A Locus Iuris busca sempre contribuir com outras Empresas Juniores, expandindo a atuação e o impacto  do MEJ  como um todo.</p>';
    $html .= '<p style="padding: 0; text-align: justify">Agradecemos o tempo e a confiança oferecidos, além de destacar que estamos abertos a negociações de preços, prazos e proposta.</p>';
    $html .= '<p style="padding: 0; text-align: justify">Por fim, esperamos muito poder ajudá-los a dar mais um passo em busca de seus objetivos!</p>';
}

if($tipoCliente == "associacao"){
    $html .= '<p style="padding: 0; text-align: justify">A Locus Iuris entende a importância de valorizar e contribuir com o funcionamento de associações. Sabemos do contexto desafiador, que exige muita disposição e planejamento. Por isso, agradecemos o tempo e a confiança oferecidos.</p>';
    $html .= '<p style="padding: 0; text-align: justify">Destacamos que estamos abertos a negociações de preços, prazos e proposta. </p>';
    $html .= '<p style="padding: 0; text-align: justify">Por fim, esperamos muito poder ajudá-los a dar mais um passo em busca de seus objetivos!</p>';
}

if($tipoCliente == "associacaoEstudantil"){
    $html .= '<p style="padding: 0; text-align: justify">A Locus Iuris entende a importância de valorizar e melhorar a experiência estudantil, pois foi também com esse intuito que a Locus Iuris foi fundada. Por isso, agradecemos o tempo e a confiança oferecidos.</p>';
    $html .= '<p style="padding: 0; text-align: justify">Destacamos que estamos abertos a negociações de preços, prazos e proposta. </p>';
    $html .= '<p style="padding: 0; text-align: justify">Por fim, esperamos muito poder ajudá-los a dar mais um passo em busca de seus objetivos!</p>';
}

if($tipoCliente == "empresa"){
    $html .= '<p style="padding: 0; text-align: justify">A Locus Iuris sabe que o meio empreendedor é muito desafiador e exige muita disposição e planejamento, por isso agradecemos o tempo e a confiança oferecidos.</p>';
    $html .= '<p style="padding: 0; text-align: justify">Acreditamos que o ramo de inovação e empreendedorismo deve ser sempre estimulado, por isso, destacamos que estamos abertos a negociações de preços, prazos e proposta.</p>';
    $html .= '<p style="padding: 0; text-align: justify">Por fim, esperamos muito poder ajudá-los a dar mais um passo em busca de seus objetivos!</p>';
}

$html .= "</div>";
    
$html .=
'<footer>
    <div class="footer-content">
        <div class="footer-logo">
            <img height="50" src="img/logo_completa.png">
        </div>
    </div>
    
</footer>
</div>';

//---------------- CONTATO ----------------------
$html .='
<div style="page-break-before: always">
    <header>
        <img class="background" src="img/contato-topo.png">
    </header>
    
    <div class="contato">
    
    <footer>
        <div class="footer-content">
            <div class="footer-logo">
                <img height="50" src="img/logo_completa.png">
            </div>
        </div>
    
    </footer>
</div>';
    
$html .= "</main></body>";

$dompdf->load_html(($html));

$dompdf->set_paper("a4", "portrail");

$dompdf->render();

$dompdf->stream($arquivo,array("Attachment" => true));

?>
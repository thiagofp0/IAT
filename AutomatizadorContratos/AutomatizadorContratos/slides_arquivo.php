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

$debug = false;

$dompdf = new DOMPDF();//*** NOVO PDF ***//
$html = '<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<link href="https://fonts.googleapis.com/css?family=PT+Serif" rel="stylesheet">
<link rel="stylesheet" href="css/pdfslides.css" media="all" type="text/css" />

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
<div class="page slide1">
    <div class="content">
        <div class="title">PROPOSTA DE SOLUÇÃO <br> JURÍDICA</div>
    </div>
</div>';

//SEGUNDA PÁGINA - FRASE MOTIVACIONAL
$html .= '
<div class="page slide2">
    <div class="content">
        <div class="quote">"Facilitar sonhos desenvolvendo<br> pessoas e ideias que fazem a <br> diferença"</div>
    </div>
</div>';

//---------------------- SOBRE NÓS ------------------------------


$debug = false;

//Informações
$html .= '
    <div class="page slide3">
        <div class="list">
            <h1>Sobre a Locus Iuris</h1>
            <ul>
                <li>Única empresa júnior de direito de Santa Catarina</li>
                <li>+ de 100 projetos executados ao longo do último ano</li>
                <li>+ 65 mil reais investidos nos membros</li>
            </ul>
        </div>
    </div>';

//RESULTADOS
$resultados = explode(PHP_EOL, $_POST['resultados']);
//var_dump($resultados);
$cont = 0;
$vazio = true;
foreach($resultados as $resultado){    
    if($cont == 0){
        $html .= '
        <div class="page slide3">
            <div class="list">
                <h1>Resultados do Diagnóstico</h1>
                <ul>';
    }
    
    if(strlen($resultado) != 0 and !ctype_space($resultado)){
        $html .= "<li>$resultado</li>";
        $cont++;
        $vazio = false;
    }
    
    if($cont == 5){
        $html .= '    </ul></div>
        </div>';
        $cont = 0;
    }
}

if($cont != 0 or $vazio){
        $html .= '    </ul></div>
        </div>';
        $cont = 0;
}

//SOLUÇÕES
$solucoes = $_POST['nomes'];
//var_dump($resultados);
$cont = 0;
$vazio = true;
foreach($solucoes as $servico){    
    if($cont == 0){
        $html .= '
        <div class="page slide3">
            <div class="list">
                <h1>Soluções</h1>
                <ul>';
    }
    
    if(strlen($servico) != 0 and !ctype_space($servico)){
        $html .= "<li>$servico</li>";
        $cont++;
        $vazio = false;
    }
    
    if($cont == 5){
        $html .= '    </ul></div>
        </div>';
        $cont = 0;
    }
}

if($cont != 0 or $vazio){
        $html .= '    </ul></div>
        </div>';
        $cont = 0;
}

//INVESTIMENTO
$investimentos = $_POST['valores2'];
//var_dump($resultados);
$cont = 0;
$total = 0;
$i = 0;
$vazio = true;
foreach($investimentos as $investimento){    
    if($cont == 0){
        $html .= '
        <div class="page slide3">
            <div class="list">
                <h1>Investimento</h1>
                <table class="tabela" border="1">
                <tr><th>Projeto</th><th>Investimento</th></tr>';
    }
    
    if(strlen($solucoes[$i]) != 0 and !ctype_space($solucoes[$i])){
        $html .= "<tr><td>".$solucoes[$i]."</td><td>R$ ".number_format($investimento, 2)."</td></tr>";
        $cont++;
        $vazio = false;
        $total += $investimento;
    }
    
    $i++;
    
    if($cont == 5 and $i != sizeof($solucoes)){
        $html .= '    </table></div>
        </div>
        ';
        $cont = 0;
    }
}

if($cont != 0 or $vazio){
        $html .= "<tr><td>Total</td><td> R$ ".number_format($total,2)."</td></table>
        <div class='footnote'>* Formas de pagamento negociáveis</div></div></div>";
        $cont = 0;
}

//BENEFÍCIOS
$beneficios = explode(PHP_EOL, $_POST['topico_beneficios']);
//var_dump($resultados);
$cont = 0;
$vazio = true;
foreach($beneficios as $beneficio){    
    if($cont == 0){
        $html .= '
        <div class="page slide3">
            <div class="list">
                <h1>Benefícios</h1>
                <ul>';
    }
    
    if(strlen($beneficio) != 0 and !ctype_space($beneficio)){
        $html .= "<li>$beneficio</li>";
        $cont++;
        $vazio = false;
    }
    
    if($cont == 5){
        $html .= '    </ul></div>
        </div>';
        $cont = 0;
    }
}

if($cont != 0 or $vazio){
        $html .= '    </ul></div>
        </div>';
        $cont = 0;
}

//RETORNOS
$retornos = explode(PHP_EOL, $_POST['retornos']);
$cont = 0;
$vazio = true;
foreach($retornos as $retorno){    
    if($cont == 0){
        $html .= '
        <div class="page slide3">
            <div class="list">
                <h1>Retorno além da Consultoria</h1>
                <ul>';
    }
    
    if(strlen($retorno) != 0 and !ctype_space($retorno)){
        $html .= "<li>$retorno</li>";
        $cont++;
        $vazio = false;
    }
    
    if($cont == 5){
        $html .= '    </ul></div>
        </div>';
        $cont = 0;
    }
}

if($cont != 0 or $vazio){
        $html .= '    </ul></div>
        </div>';
        $cont = 0;
}

//LOGO DO CLIENTE
if(isset($_FILES['logomarca'])){
  $uploadFile = "tmp/" . basename($_FILES['logomarca']['name']);
  if (move_uploaded_file($_FILES['logomarca']['tmp_name'], $uploadFile)) {
    $html .= "
        <div class='page slide4'>
            <div class='imgDiv'>
                <img src='$uploadFile' height='300' width='300'>
            </div>
        </div>";
  }
}

//ÚLTIMA PÁGINA - CONTATO
$html .= '
<div class="page slide5">
    <div class="content">
    </div>
</div>';

$html .= "</main></body>";

if($debug){
echo $html;
}
else{
$dompdf->load_html(($html));

$dompdf->set_paper(array(0,0,657.75,930), "landscape");

$dompdf->render();

$dompdf->stream($arquivo,array("Attachment" => true));

unlink($uploadFile) or die();
}

?>
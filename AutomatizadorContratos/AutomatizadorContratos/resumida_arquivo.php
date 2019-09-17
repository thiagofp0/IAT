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


//Cria o nome do arquivo, sem espaços
$arquivo = nome_docto("PropostaResumida_", $nomeCliente);

//GERA VETOR DE FUNCAO PARA ARMAZENAR FUNCOES E PRAZOS RECEBIDOS
$j = 0;
$vetor = array();
foreach ($nomes as $index => $key) {
  $item = new funcao();
  $item->setNome($nomes[$index]);
  $item->setPrazo($valores[$index]);
  $item->setPreco($precos[$index]);
  $vetor[$j] = $item;
  $j++;
}

$dompdf = new DOMPDF();//*** NOVO PDF ***//
$html = '<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<link href="https://fonts.googleapis.com/css?family=PT+Serif" rel="stylesheet">
<style>
	p{
		text-align: justify;
	}
	p.recuo{
		text-align: justify;
		margin-left: 20px;
	}
	html{
            margin: 180px 75px;
            font-family: "PT Serif", serif;
    }
    .titulo{
        color: #fcc148;
    }
    
</style>
</head>

<body>
<script type = "text/php">
          if(isset($pdf)){
            //HEADER
            $page = $pdf->open_object();
            $pdf->image("img/detalhada-cabecalho.png", "png", 0, -5, 131, -5000);
            $pdf->image("img/detalhada-rodape.png", "png", 850, 0, 0, 0);
            $pdf->close_object();
            $pdf->add_object($page, "all");
		  }
		  
</script>

';

//INFORMAÇÕES DO CLIENTE
$html .= "<h1>À ".$nomeCliente."</h1>";

//INFORMAÇÕES DA EMPRESA
$html .= "<h1 class='titulo'>Sobre nós</h1>";
include "conexao.inc";//conecta ao Banco de Dados
$result =$conn->query("SELECT * FROM `Empresa`");
while($row = $result->fetch_assoc())
    $html .= "<p class='recuo'>".$row["sobre"]."</p>"; //Exibe o "Sobre a empresa"
$conn->close(); //FECHA A CONEXÃO SQL

//INFORMAÇÕES DOS SERVIÇOS
$html .= "<h1 class='titulo'>Serviços</h1><ul style='list-style-type:disc'>";
$cont = 0; //contador para saber a quantidade de serviços
foreach($vetor as $indice){
        $html .= "<li>";
        $html .= $indice->getNome();
        $html.= "</li>";
        $cont++;
}
$html .= "</ul>"; //fecha a lista

//PRAZO
$html .= "<h1 class='titulo'>Prazo</h1>";
$html .= "<p class='recuo'>Solicita-se o prazo de "; //Exibe o "Sobre a empresa";
$cont2 = 0; //contador que armazena o numero de serviços já exibidos
foreach($vetor as $indice){
    $prazo = new numero($indice->getPrazo(), false, false); //número que não é moeda, tratado no masculino
    $html .= $prazo->get_valor() . " (".strtolower($prazo->get_extenso()).") dias úteis para o serviço de ".$indice->getNome();
    if($cont==1){ //tem apenas um serviço
        $html .= ".";
        break;
    } else{ //mais de um serviço
        if($cont2+1 == ($cont-1))
            $html .= " e ";
        else{
            if($cont2+1 == $cont)
                $html .= ".";
            else
                $html .= ", ";
        }
    }

    $cont2++;
}
$html .= "</p>";

//INVESTIMENTO
$html .= "<h1 class='titulo'>Investimento</h1>";
$html .= "<table>";
$valorTotal = 0;
foreach($vetor as $indice){
    $html .= "
        <tr>
          <th align='left' width='450px'>".$indice->getNome()."</th>
          <th align='right' width='150px'>".number_format($indice->getPreco(), 2, ",", ".")."</th>
        </tr>";
        $valorTotal += $indice->getPreco();
}
$html .= "</table>";

$html .= "<h3> Valor total do investimento: ".number_format($valorTotal, 2, ",", ".")."</h3>";

$html .= "<br><h5 style='text-align:center'>Proposta válida até ".date('d/m/Y', strtotime($_POST["validadeProposta"]))."</h5>";
      



$html .= "</body>";

$dompdf->load_html(($html));

$dompdf->set_paper("a4", "portrail");

$dompdf->render();

$dompdf->stream($arquivo,array("Attachment" => true));

?>
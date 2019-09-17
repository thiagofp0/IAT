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
  //***DADOS RECEBIDOS DE CONTRATO_TABELA.PHP CONVERTIDOS PARA VARIÁVEIS SEPARADAS***//

//INFORMAÇÕES DA CONTRATADA
$razao_social = $_POST["razao_social"];
$cnpj = $_POST["cnpj"];
$sede = $_POST["sede"];//localização da sede
$cep = $_POST["cep"];

//INFORMAÇÕES DO PRESIDENTE
$nomePres = $_POST["nomePres"];
$cpfPres = $_POST["cpfPres"];
$rgPres = $_POST["rgPres"];
$nacionalidadePres = $_POST["nacionalidadePres"];
$civilPres = $_POST["civilPres"];
$generoPres = $_POST["generoPres"];
$profissaoPres = $_POST["profissaoPres"];
$enderecoPres = $_POST["enderecoPres"];
$cepPres = $_POST["cepPres"];

//INFORMAÇÕES DO DIRETOR ADM-FIN


//INFORMAÇÕES DO CONTRATANTE
$pessoa_juridica = false;
//INFORMAÇÕES DA EMPRESA
if(isset($_POST["juridica"])){
    $pessoa_juridica = true; //é pessoa jurídica, temos informações sobre a empresa
    $razao_socialC = $_POST["razaoSocialCliente"];
    $cnpjC = $_POST["cnpjCliente"];
    $sedeC = $_POST["sedeCliente"];
    $cepC = $_POST["cepCliente"];
}

//INFORMAÇÕES DO REPRESENTANTE DO CLIENTE
$nomeRepresentante = $_POST["nomeRepresentante"];
$cpfRepresentante = $_POST["cpfRepresentante"];
$rgRepresentante = $_POST["rgRepresentante"];
$nacionalidadeRepresentante = $_POST["nacionalidadeRepresentante"];
$civilRepresentante = $_POST["civilRepresentante"];
$generoRepresentante = $_POST["generoRepresentante"];
$profissaoRepresentante = $_POST["profissaoRepresentante"];
$enderecoRepresentante = $_POST["enderecoRepresentante"];
$cepRepresentante = $_POST["cepRepresentante"];

//INFORMAÇÕES DO PROJETO
$preco_projeto = new numero($_POST["precoProjeto"], true, false); //número que é moeda, tratado no masculino
$nParcelas = new numero($_POST["parcelas"], false, true); //número que não é moeda, tratado no feminino

for($i=1; $i<=$nParcelas->get_valor(); $i++){
    $strAux = "parcela".$i;
    $dataParcelas[] = $_POST[$strAux]; //data da parcela i
}
$tempo = strtotime($_POST["dataContrato"]); //data do contrato

$nomes = $_POST["nomes"]; //nome do serviço
$valores = $_POST["valores"]; //prazo em dias úteis


//Cria o nome do arquivo, sem espaços
if($pessoa_juridica)
    $arquivo = nome_docto("Contrato", $razao_socialC);
else
    $arquivo = nome_docto("Contrato", $nomeRepresentante);

//GERA VETOR DE FUNCAO PARA ARMAZENAR FUNCOES E PRAZOS RECEBIDOS
$j = 0;
$vetor = array();
$registro_marca = false;

foreach ($nomes as $index => $key) {
  $item = new funcao();
  if($nomes[$index] == "Registro de Marca")
	  $registro_marca = true;
  $item->setNome($nomes[$index]);
  $item->setPrazo($valores[$index]);
  $vetor[$j] = $item;
  $j++;
}

//$dompdf = new DOMPDF();//*** NOVO PDF ***//
$html = '<!DOCTYPE html>
<html>
<head>
<link href="https://fonts.googleapis.com/css?family=PT+Serif" rel="stylesheet">
<style>
	p{
		text-align: justify;
	}
	p.recuo{
		text-align: justify;
		margin-left: 30px;
	}
	html{
            margin: 140px 75px;
            font-family: "PT Serif", serif;
    }
    
</style>
</head>

<body>
<script type = "text/php">
          if(isset($pdf)){
            //HEADER
            $page = $pdf->open_object();
            $pdf->image("img/cabecalho-contrato.png", "png", 0, -1, 100, 1586);
            $pdf->close_object();
            $pdf->add_object($page, "all");
		  }
		  
</script>

';

//INFORMAÇÕES DO CONTRATANTE
$html .= "<h4 align = 'center'>CONTRATO DE PRESTAÇÃO DE SERVIÇOS</h4>
<p>Pelo presente instrumento particular, de um lado <b>";
if($pessoa_juridica){
	$html .= $razao_socialC."</b>, com sede à ".$sedeC.", inscrito no CNPJ sob o nº <b>".$cnpjC."</b>, neste ato representada por <b>";
}
if($generoRepresentante == "M")
	$html .= $nomeRepresentante."</b>, ".$nacionalidadeRepresentante.", ".$civilRepresentante. ", ".$profissaoRepresentante.", portador do RG nº <b>".$rgRepresentante." ".$_POST['orgaoEmissorRepresentante']."</b>, inscrito no CPF sob nº <b>".$cpfRepresentante."</b>, residente e domiciliado à ".$enderecoRepresentante.", CEP ".$cepRepresentante.", doravante denominado <b> CONTRATANTE </b>.";
else
	$html .= $nomeRepresentante."</b>, ".$nacionalidadeRepresentante.", ".$civilRepresentante. ", ".$profissaoRepresentante.", portadora do RG nº <b>".$rgRepresentante." ".$_POST['orgaoEmissorRepresentante']."</b>, inscrita no CPF sob nº <b>".$cpfRepresentante."</b>, residente e domiciliada à ".$enderecoRepresentante.", CEP ".$cepRepresentante.", doravante denominada <b> CONTRATANTE </b>.";	
$html .= "</p>";

//INFORMAÇÕES DA CONTRATADA
$html .= "<p>e, do outro,</p>";
$html .= "<p><b>".$razao_social."</b>, associação civil sem fins lucrativos, com sede à ".$sede.", CEP ". $cep.", inscrita no CNPJ sob nº <b>".$cnpj."</b>, neste ato representada, nos termos do artigo 26 de seu Estatuto Social, por ";
if($generoPres == "M")
	$html .= "seu Presidente, <b>".$nomePres."</b>, ".$nacionalidadePres.", ".$civilPres. ", ".$profissaoPres.", portador do RG nº <b>".$rgPres." ".$_POST['orgaoEmissorPresidente']."</b>, inscrito no CPF sob nº <b>".$cpfPres."</b>, residente e domiciliado à ".$enderecoPres.", CEP ".$cepPres;
else
	$html .= "sua Presidente, <b>".$nomePres."</b>, ".$nacionalidadePres.", ".$civilPres. ", ".$profissaoPres.", portadora do RG nº <b>".$rgPres." ".$_POST['orgaoEmissorPresidente']."</b>, inscrita no CPF sob nº <b>".$cpfPres."</b>, residente e domiciliada à ".$enderecoPres.", CEP ".$cepPres;
$html .= ", doravante denominada <b>CONTRATADA</b>,";

//PARTE FIXA
$html .= "</p><p>têm entre si justo e acertado o presente CONTRATO DE PRESTAÇÃO DE SERVIÇOS, mediante as cláusulas e condições seguintes, que mutuamente aceitam, a saber:</p>";
$html .= "<h4>CONSIDERANDO:</h4>";
$html .= "<p>1)	Que tem-se por Empresa Júnior a entidade organizada nos termos da Lei nº 13.267 de 06 de abril de 2016, sob a forma de associação civil sem fins econômicos, gerida, obrigatória e exclusivamente, por estudantes regularmente matriculados em curso de graduação em instituição de ensino superior;</p>";
$html .= "<p>2)	Que uma Empresa Júnior tem como objetivo estimular o espírito empreendedor e promover o desenvolvimento técnico, acadêmico, pessoal e profissional de seus membros por meio de contato direto com a realidade do mercado de trabalho, desenvolvendo atividades de consultoria e de assessoria a empresários e empreendedores, além de promover o desenvolvimento econômico e social da comunidade em geral; </p>";
$html .= "<p>3)	Que a <b>CONTRATADA</b> é uma Empresa Júnior que abrange a área do direito, conforme indica seu Estatuto Social, devidamente regulamentada e de acordo com a legislação vigente;</p>";
$html .= "<p>4)	Que a <b>CONTRATADA</b> desenvolve suas atividades nos termos do Estatuto, Regimento Interno e das Resoluções da Universidade Federal de Santa Catarina, possuindo, entretanto, gestão autônoma em relação à direção da faculdade de Direito e de qualquer outra entidade acadêmica;</p>";
$html .= "<p>5)	Que os integrantes da <b>CONTRATADA</b> exercem trabalho voluntário, nos termos da Lei nº 9.608, de 18 de fevereiro de 1998;</p>";
$html .= "<p>6)	Que as atividades desenvolvidas pela <b>CONTRATADA</b> são orientadas e supervisionadas por professores orientadores especializados; </p>";
$html .= "<p>7)	Que a renda obtida pela <b>CONTRATADA</b> com os projetos e serviços prestados é revertida exclusivamente para o incremento das atividades-fim da empresa;</p>";

//ITENS ÚTEIS
/*
	if($nomes[0]=="Site")
	if($nomes[0]=="Automatizador de Propostas")
	if($nomes[0]=="Manutenção")
	if($nomes[0]=="Sistema")
	if($nomes[0]=="Aplicativo")
*/


//CAPÍTULO I- OBJETO

$html .= "<h4 align = 'center'>CAPÍTULO I- OBJETO</h4>";
$html .= "<p>1.1 O objeto do presente contrato consiste no <b>Desenvolvimento de ".$nomes[0]."</b> para a CONTRATANTE seguindo as especificações descritas na proposta anexa (doc.1).</p>";
$html .= "<p>1.2 O desenvolvimento de ".$nomes[0]." para a <b>CONTRATANTE</b> engloba as funcionalidades que seguem: </p>";
if($nomes[0]=="Aplicativo")
	$html .= "<p>1.3 O aplicativo desenvolvido será personalizado com layout, logomarca e informações do evento “_______________________” a ser realizado no dia XX/XX/XX.</p>";



//CAPÍTULO II- OBRIGAÇÕES DA CONTRATADA

$html .= "<h4 align = 'center'>CAPÍTULO II- OBRIGAÇÕES DA CONTRATADA</h4>";
$html .= "<p> Consistem em obrigações da <b>CONTRATADA:</b></p>";
$html .= "<p>2.1 O Desenvolvimento de <b>".$nomes[0]."</b> seguindo as especificações descritas na proposta anexa (doc.1), bem como as demais disposições do presente instrumento contratual.</p>";
if($nomes[0]!="Aplicativo")
	$html .= "<p>2.2 Realizar reparos e adequações ao <b>".$nomes[0]."</b> relacionados apenas às funcionalidades contratadas por meio do presente instrumento contratual, sem qualquer acréscimo no valor, quando solicitados em até 30 (trinta) dias após a entrega do mesmo.</p>";
if($nomes[0]=="Site")
	$html .= "<p>2.3 A responsabilidade pelo devido funcionamento do site e respectivas funcionalidades durante o tempo de vigência do presente contrato.";
if($nomes[0]=="Sistema")
	$html .= "<p>2.3 Fornecer à CONTRATANTE o sistema desenvolvido, o qual passará a ser propriedade desta após a finalização do serviço prestado.</p>";


//CAPÍTULO III- OBRIGAÇÕES DA CONTRATANTE

$html .= "<h4 align = 'center'>CAPÍTULO III- OBRIGAÇÕES DA CONTRATANTE</h4>";
$html .= "<p>Consistem em obrigações da <b>CONTRATANTE:</b><p>";
$html .= "<p>3.1 Realizar o pagamento à <b>CONTRATADA</b> no valor e forma estabelecidos neste contrato;</p>";
$html .= "<p>3.2 Colocar à disposição da <b>CONTRATADA</b> todas as informações e documentos necessários para a execução dos serviços, sob pena de suspensão da consultoria. Compromete-se, ainda, a entregá-los à <b>CONTRATADA</b>, em tempo hábil;</p>";
$html .= "<p>3.3 Auxiliar a <b>CONTRATADA</b> com informações que esta lhe solicitar, prezando pela celeridade, eficácia e bom andamento na prestação dos serviços contratados;</p>";
$html .= "<p>3.4 Não ceder ou transferir a outrem os direitos sobre a consultoria aqui ajustada;</p>";
$html .= "<p>3.5 Se necessário, firmar declaração, em favor da <b>CONTRATADA</b>, de que o contrato está findo, quando for o caso;</p>";
$html .= "<p>3.6 Arcar com as despesas decorrentes da implantação de novas funcionalidades no(s) projeto(s) contratado(s), solicitadas pela <b>CONTRATANTE</b>, não previstas na proposta apresentada, bem como no presente contrato;</p>";
$html .= "<p>3.7 Anuir com a alteração do prazo estabelecido na <b>Cláusula Sexta</b>, conforme necessário para o integral cumprimento das funcionalidades acrescidas, mediante prévio acordo.</p>";


//CAPÍTULO IV- USO DA IMAGEM

$html .= "<h4 align = 'center'>CAPÍTULO IV- USO DA IMAGEM</h4>";
$html .= "<p>4.1 A <b>CONTRATADA</b> tem a prerrogativa de integrar ao seu Portfólio de Serviços o produto final desenvolvido neste SERVIÇO.<p>";
if($nomes[0]=="Site")
	$html .= "<p>4.2 A <b>CONTRATANTE</b> se obriga a manter a logomarca da CONTRATADA no rodapé das páginas do site pelo tempo mínimo de um ano, a contar a partir da entrega da manutenção. A logomarca possuirá as dimensões <b>200px (duzentos pixels)</b> de largura e <b>60px (sessenta pixels)</b> de altura.</p>";
if($nomes[0]=="Aplicativo")
	$html .= "<p>4.2 A <b>CONTRATANTE</b> se obriga a manter a logomarca da <b>CONTRATADA</b> no <b>rodapé</b> do aplicativo desenvolvido durante toda a duração do evento.</p>";


//CAPÍTULO V - SITE 

if($nomes[0]=="Site"){
	$html .= "<h4 align = 'center'>CAPÍTULO V- HOSPEDAGEM E DOMÍNIO</h4>";
	$html .= "<p>5.1 A hospedagem será feita por meio de um Provedor de Hospedagem escolhido direta e exclusivamente pela <b>CONTRATANTE</b>, sem nenhuma intermediação por parte da <b>CONTRATADA</b>.<p>";
	$html .= "<p>5.2 O registro do domínio junto ao provedor de escolha da <b>CONTRATANTE</b> será feito única e exclusivamente pelo provedor contratado.</p>";
	$html .= "<p>5.3 É de responsabilidade da <b>CONTRATADA</b> fornecer todos os dados sobre o sistema, que a <b>CONTRATANTE</b> ou o provedor contratado requisitarem.</p>";
	$html .= "<p>5.4 A <b>CONTRATADA</b> realizará a “Transferência de Hospedagem” para o Provedor de escolha da <b>CONTRATANTE</b>.</p>";
}


//#CAPÍTULO V - SISTEMA E AUTOMATIZADOR

if($nomes[0]=="Automatizador de Propostas" || $nomes[0]=="Sistema" ){
	$html .= "<h4 align = 'center'>CAPÍTULO V- SOFTWARE E CÓDIGO FONTE</h4>";
	$html .= "<p>5.1 A <b>CONTRATANTE</b> poderá permanecer realizando a utilização do software fornecido pela <b>CONTRATADA</b> por tempo indeterminado. <p>";
	$html .= "<p>5.2 Os direitos autorais relativos ao código fonte permanecerão sendo propriedade da <b>CONTRATADA</b>.</p>";
}


//#CAPÍTULO V - APLICATIVO

if($nomes[0]=="Aplicativo"){
	$html .= "<h4 align = 'center'>CAPÍTULO V- APLICATIVO E CÓDIGO FONTE</h4>";
	$html .= "<p>5.1 Os direitos autorais relativos ao código fonte permanecerão sendo propriedade intelectual da <b>CONTRATADA</b>.<p>";
	$html .= "<p>5.2 Durante a realização do evento “_____________________”, a ser realizado no dia XX/XX/XX, o aplicativo desenvolvido estará disponível nas lojas de aplicativo, tendo seu uso limitado à duração do evento.</p>";
}


//CAPÍTULO VI- PRAZO

$html .= "<h4 align = 'center'>CAPÍTULO VI- PRAZO</h4>";
$html .= "<p>6.1 A <b>CONTRATADA</b> e a <b>CONTRATANTE</b> têm entre si ajustado este contrato de Prestação de Serviço a ser realizado no prazo máximo de <b>até ".$valores[0]." (trinta e cinco) dias úteis</b>, mediante as cláusulas e condições a seguir especificadas e cujo cumprimento se obrigam mutuamente. <p>";
$html .= "<p>6.2 Caso o Objeto disposto no presente contrato não se concretize no prazo previamente estipulado, este contrato renovar-se-á automaticamente por mais um período de 30 (trinta) dias, desde que nenhuma das partes se manifeste contrariamente a sua renovação, por escrito e em prazo não superior a 15 (quinze) dias, contados do término do prazo inicial.</p>";
$html .= "<p>6.3 Após a entrega do serviço, o presente contrato vigorará até o prazo de 30 dias, para que a <b>CONTRATANTE</b> informe se houve qualquer descumprimento do serviço pactuado, observadas as exigências estabelecidas na <b>Cláusula Segunda</b>.
</p>";
$html .= "<p>6.4 Em caso de atraso no pagamento, o desenvolvimento do serviço será interrompido e os dias de atraso serão acrescidos ao prazo final de desenvolvimento do projeto.
</p>";
$html .= "<p>6.5 O período de vacância entre o pedido de subsídios para implantação do sistema e a entrega dos mesmos será acrescido no prazo final de entrega do projeto.
</p>";
$html .= "<p>6.6 Caso seja necessária alguma alteração, a <b>CONTRATANTE</b> poderá, após a conclusão de cada fase, no prazo de 2 (dois) dias, enviar o “Termo de Requisição de Mudanças” devidamente preenchido por e-mail.
</p>";


//CAPÍTULO VII- PAGAMENTO

$html .= "<h4 align = 'center'>CLÁUSULA VII- PAGAMENTO</h4>";
$html .= "<p>7.1 A <b>CONTRATANTE</b> realizará pagamento ";
if($nParcelas->get_valor() == 1)
	$html .= "à vista";
else{
	$valorParcela = new numero(parcela($preco_projeto->get_valor(),$nParcelas->get_valor()), true, false);
	$html .= "parcelado em ".$nParcelas->get_valor()." (".$nParcelas->get_extenso().") "."vezes de R$".number_format($valorParcela->get_valor(), 2, ",", ".")." (".$valorParcela->get_extenso().")";
}
$html .= ", totalizando um montante de <b>R$".number_format($preco_projeto->get_valor(), 2, ",", ".")." (".($preco_projeto->get_extenso()).")</b>, à título de pró-labore, pelos serviços estabelecidos n".incisos($cont)." da Cláusula Primeira, em favor da <b>CONTRATADA</b>.</p> ";

$contadorC4 = 2;

$numeroClausulaPagamento = $contadorC4;
$html .= "<p>7.".$contadorC4++." O pagamento indicado no item 4.1 será realizado por meio de boleto bancário emitido pela <b>CONTRATADA</b> e enviado à <b>CONTRATANTE</b> em até 5 (cinco) dias antes da data de vencimento da respectiva parcela.</p>";

for($s = 1; $s <= $nParcelas->get_valor(); $s++){
	$auxiliar = $_POST["parcela".$s];
	$html .= "<p class='recuo'>".nParaLetra($s).") A ".ordinal($s)." parcela deverá ser paga até o dia ".date('d/m/Y', strtotime($auxiliar)).";</p>";
}

$html .= "<p>7.3 Os pagamentos deverão ser feitos exclusivamente via boleto bancário.</p>";
$html .= "<p>A <b>CONTRATANTE</b> se compromete a enviar os comprovantes de pagamento para o e-mail admfin@nobugs.com.br, após cada pagamento efetuado. Somente será reconhecido o pagamento após o envio do comprovante.</p>";


//CAPÍTULO VIII- DESCUMPRIMENTO

$html .= "<h4 align = 'center'>CAPÍTULO VIII- DESCUMPRIMENTO</h4>";
$html .= "<p>Quanto ao descumprimento das obrigações descritas neste contrato pelas Partes:<p>";
$html .= "<p>8.1 O descumprimento reiterado de quaisquer das cláusulas elencadas neste contrato por parte da <b>CONTRATANTE</b> ensejará à <b>CONTRATADA</b> o direito de suspensão ou resolução imediata da consultoria mediante notificação por escrito;
</p>";
$html .= "8.2 O não exercício por qualquer das Partes de quaisquer direitos ou faculdades que lhes sejam conferidos por este contrato ou pela Lei, bem como a eventual tolerância contra infrações contratuais cometidas pela outra Parte, não importará na renúncia pela Parte a qualquer dos seus direitos contratuais ou legais, novação ou alteração de cláusulas deste contrato, podendo a Parte, a seu exclusivo critério, exercê-los a qualquer momento.
</p>";


//CAPÍTULO IX- RESCISÂO

$html .= "<h4 align = 'center'>CAPÍTULO IX- RESCISÂO</h4>";
$html .= "<p>9.1 O presente contrato poderá ser rescindido pela <b>CONTRATANTE</b>, durante a execução da consultoria, devendo esta pagar à <b>CONTRATADA</b> por inteiro o valor dos serviços já finalizados, e por metade o valor dos demais serviços incompletos e/ou não iniciados que lhe tocaria de então ao termo legal do contrato, conforme dispõe o artigo 603 do Código Civil Brasileiro.<p>";


//CAPÍTULO X- EXTINÇÃO

$html .= "<h4 align = 'center'>CAPÍTULO X- EXTINÇÃO</h4>";
if($pessoa_juridica)
	$html .= "<p>10.1 O presente contrato encerra-se com a extinção da personalidade jurídica de qualquer uma das Partes; pela conclusão do serviço; por inadimplemento de qualquer uma das Partes; ou pela impossibilidade da continuação das obrigações, motivada por força maior.
	<b>CONTRATANTE</b> <p>";
else
	$html .= "<p>10.1 O presente contrato encerra-se com a extinção da personalidade jurídica da CONTRATADA; pela conclusão do serviço; por inadimplemento de qualquer uma das Partes; ou pela impossibilidade da continuação das obrigações, motivada por força maior.
	<b>CONTRATANTE</b> <p>";

$html .= "<p>10.2 A substituição dos administradores da CONTRATANTE e/ou a substituição dos representantes da CONTRATADA não implica na extinção do presente contrato.
<b>CONTRATANTE</b> <p>";



//CAPÍTULO XI- MULTAS

$html .= "<h4 align = 'center'>CAPÍTULO XI- MULTAS</h4>";
$html .= "<p>11.1 Após o vencimento do boleto, que se dará 15 (quinze) dias após a sua emissão e envio por e-mail, serão cobrados encargos de mora de 0,033% (trinta e três milésimos) ao dia, não capitalizável, além de multa de 2% (dois por cento), conforme previsto em lei.
<p>";
$html .= "<p>11.2 Em caso de inadimplência, a <b>CONTRATANTE</b> estará sujeita à cobrança Extrajudicial e Judicial.
</p>";
$html .= "<p>11.3 Em caso de atraso na entrega do serviço objeto do presente contrato, caberá a <b>CONTRATADA</b> notificar a <b>CONTRATANTE</b>, no mínimo 3 (três) dias antes do prazo previamente estipulado, justificativa plausível, juntamente da nova data de entrega, a qual não poderá exceder 15 (quinze) dias em relação ao prazo anterior pactuado.
</p>";
$html .= "<p><b>Parágrafo Único.</b> Falhando a <b>CONTRATADA</b> em realizar tal notificação ou caso a <b>CONTRATANTE</b> não entenda a justificativa do atraso como plausível, a <b>CONTRATADA</b> arcará com multa de 2% (dois por cento) em relação ao valor total do contrato por cada dia útil de atraso.
</p>";


//CAPÍTULO XII- DISPOSIÇÕES GERAIS

$html .= "<h4 align = 'center'>CAPÍTULO XII- DISPOSIÇÕES GERAIS</h4>";
$html .= "<p>12.1 Nas partes omissas deste contrato, serão observadas as normas próprias do Código Civil Brasileiro;<p>";
$html .= "<p>12.2 Ambas as partes entendem e concordam que o presente contrato constitui título executivo extrajudicial, na forma disposta no artigo 784 do Código de Processo Civil.<p>";
$html .= "<p>12.3 Se, em decorrência de qualquer decisão judicial irrecorrível, qualquer disposição ou termo deste contrato for sentenciada nula ou anulável, tal nulidade ou anulabilidade não afetará as demais cláusulas deste contrato, o qual permanecerá em pleno vigor, obrigando ambas as Partes;<p>";
$html .= "<p>12.4 As solicitações e notificações entre as Partes deverão ser enviadas por escrito, com aviso de recebimento (AR), para os endereços mencionados no preâmbulo deste instrumento.<p>";
$html .= "<p>12.5 Para dirimir quaisquer dúvidas e/ou solucionar pendências fundadas neste contrato, as Partes elegem o foro da Comarca de Viçosa (Viçosa/MG), com renúncia expressa de qualquer outro, ainda que privilegiado.<p>";
$html .= "<p>12.6 Elegem, ainda, a Conciliação como meio prévio e obrigatório de solução para as controvérsias que venham a surgir entre elas, relacionadas à presente relação contratual, inclusive as relativas à interpretação, validade, eficácia, execução e a qualquer forma de extinção do presente contrato.<p>";

//ASSINATURAS
$html .= "<p>E por estarem assim, justos e avençados, assinam o presente contrato em 2 (duas) vias de mesma forma e teor, para que produza seus efeitos jurídicos e legais. </p><br>";

if(isset($_POST["dataContrato"])) //O usuário selecionou a data
    $html .= "<div style='page-break-inside:avoid; height: 500px; margin-bottom:0px;'><p align = 'center'> Viçosa/MG, " . date('d', $tempo) . " de " . strtolower(mes(date('m', $tempo))) . " de " . date('Y', $tempo) . "</p>";
else //usuário não selecionou a data
    $html .= "<div style='page-break-inside:avoid; height: 500px; margin-bottom:0px;'><p align='center'>Florianópolis, _________ de ______________ de 20______</p><br>";

$html .= "<br>
		<div style='height: 100px; margin-top: 50px'><table style='text-align:center; margin-left:auto;margin-right:auto'>
			<tr>
				<td>_____________________________</td>
				<td align = 'center' style='width:50px'> </td>
			</tr>
			<tr>
				<td>CONTRATADA - Presidente</td>
				<td></td>
			</tr>
			<tr>
				<td>".$nomePres."</td>
				<td></td>

			</tr>
		</table></div>"
        ."<p align = 'center' style='margin-top:50px'> _____________________________</p>
		 <p align = 'center'>CONTRATANTE</p>
				<p align = 'center'>".$nomeRepresentante."</p>";

//INSERIR TESTEMUNHAS
$html .= "
	<br><br>
	<div style='height: 200px;'>
    	<table style='text-align:center; margin-left:auto;margin-right:auto; '>
    			<tr>
    				<td>_____________________________</td>
    				<td style='width:50px'> </td>
    				<td>_____________________________</td>
    			</tr>
    			<tr>
    				<td>Testemunha 1</td>
    				<td style='width:50px'> </td>
    				<td>Testemunha 2</td>
    			</tr>
    			<tr>
    				<td align='left'>Nome: ".$_POST['nomeTestemunha1']."</td>
    				<td style='width:50px'> </td>
    				<td align='left'>Nome: ".$_POST['nomeTestemunha2']."</td>
    			</tr>
    			<tr>
    				<td align='left'>CPF: ".$_POST['cpfTestemunha1']."</td>
    				<td style='width:50px'> </td>
    				<td align='left'>CPF: ".$_POST['cpfTestemunha2']."</td>
    			</tr>
    			<tr>
    				<td align='left'>RG: ".$_POST['rgTestemunha1']." ".$_POST['orgaoEmissorTestemunha1']."</td>
    				<td style='width:50px'> </td>
    				<td align='left'>RG: ".$_POST['rgTestemunha2']." ".$_POST['orgaoEmissorTestemunha2']."</td>
    			</tr>
    	</table>
	</div></div>"
;


$html .= "</body>";

echo $html;

$dompdf->load_html(utf8_decode($html));

$dompdf->set_paper("a4", "portrail");

$dompdf->render();

$dompdf->stream($arquivo,array("Attachment" => true));

?>
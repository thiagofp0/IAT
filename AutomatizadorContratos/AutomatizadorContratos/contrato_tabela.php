<?php
    session_start();
    
    if(!isset($_SESSION["log_nb_auto"])){
      unset($_SESSION["log_nb_auto"]);
      header("Location: index.php");
      exit;
    }
    else if(!strpos($_SERVER["HTTP_REFERER"], "contrato")){
      header("Location: contrato.php"); //Redireciona se a página anterior não for a correta
      exit;
    }
    
    $login = $_SESSION["log_nb_auto"];
    //$user = $login["user"];
?>

<!DOCTYPE html>
<!-- DESENVOLVIDO POR NO BUGS - EMPRESA JÚNIOR DE INFORMÁTICA - 2019 -->
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
  <meta charset = "UTF-8">
  <title>Dados do contrato</title>
  <link rel="icon" href="favicon.png" type="image/png" sizes="16x16">
    
    
    <!--  Máscaras dos campos -->
    <script type="text/javascript">
            var clicouDatas = false;
    
			function fMasc(objeto,mascara) {
				obj=objeto
				masc=mascara
				setTimeout("fMascEx()",1)
			}
			function fMascEx() {
				obj.value=masc(obj.value)
			}

			function mCNPJ(cnpj){
				cnpj=cnpj.replace(/\D/g,"")
				cnpj=cnpj.replace(/^(\d{2})(\d)/,"$1.$2")
				cnpj=cnpj.replace(/^(\d{2})\.(\d{3})(\d)/,"$1.$2.$3")
				cnpj=cnpj.replace(/\.(\d{3})(\d)/,".$1/$2")
				cnpj=cnpj.replace(/(\d{4})(\d)/,"$1-$2")
				return cnpj
			}
			function mCPF(cpf){
				cpf=cpf.replace(/\D/g,"")
				cpf=cpf.replace(/(\d{3})(\d)/,"$1.$2")
				cpf=cpf.replace(/(\d{3})(\d)/,"$1.$2")
				cpf=cpf.replace(/(\d{3})(\d{1,2})$/,"$1-$2")
				return cpf
			}
			function mCEP(cep){
				cep=cep.replace(/\D/g,"")
				cep=cep.replace(/^(\d{2})(\d)/,"$1.$2")
				cep=cep.replace(/\.(\d{3})(\d)/,".$1-$2")
				return cep
			}
			function mNum(num){
				num=num.replace(/\D/g,"")
				return num
			}
			
			function dataParcelas(){ //Função para selecionar as datas das parcelas no contrato
			    clicouDatas = true;
			    var x = document.getElementById("divParcelas");
			    var nParcelas = document.getElementById("parcelas").value;
			    var html = "";
			    var parcelaunica = false;
			    if(nParcelas == 1)
			        parcelaunica = true;
			    for(i = 1; i<= nParcelas; i++){
			        html = html.concat("<div class='col-lg-2'> <label for='parcela1'> Data da parcela ").concat(i)
			        .concat(": </label><input style-'width:100%' class='form-control' name='parcela").concat(i)
                    .concat("' id='parcela").concat(i).concat("' type='date'></div>");
                    if(!parcelaunica && i == nParcelas){
                        html = html.concat('<br><div class="col-lg-2"><br><input style-"width:100%" class="btn_class" name="replicar_datas" type = "button" value = "Replicar datas" style="font-size:13px" onclick="replicaData(');
                        html = html.concat(nParcelas);
                        html = html.concat(')"/></div>');
                    }
			    }
			    x.innerHTML = html;
			}
			
			function replicaData(nParcelas){
			    var data = document.getElementById("parcela1").value;
			    for(i = 2; i<=parseInt(nParcelas); i++){
			        var x = document.getElementById("parcela".concat(i));
			        var dataFinal = parseDate(data);
			        dataFinal.setMonth(dataFinal.getMonth()+i);
			        dataFinal = dataInconsistente(dataFinal);
			        x.value = dateInput(dataFinal);
			    }
			}
			
			function parseDate(s){ //recebe uma data no formato YYYY-MM-DD e retorna um objeto do tipo data
			    var b = s.split(/\D/);
			    return new Date(b[0], (--b[1]) -1, b[2]);
			}
			
			function dateInput(s){ //recebe um objeto do tipo data e retorna uma string no formato YYYY-MM-DD
			    var dia = s.getDate();
			    var mes = s.getMonth();
			    var ano = s.getFullYear();
			    return "".concat(ano,"-", ("00" + (mes+1)).slice(-2), "-", ("00" + dia).slice(-2));
			}
			
			function dataInconsistente(s){ //recebe um objeto do tipo data e caso esteja em uma data inconsistente, retorna a data mais próxima
			    if(s.getMonth() == 1){ //fevereiro
			        var n = 28;
			        if((s.getFullYear()%4 == 0 && s.getFullYear()%(100) != 0) || (s.getFullYear()%(400) == 0))
			            n = 29;
			        if(s.getDate() > n){
			            s.setDate(01);
			            s.setMonth(03);
			        }
			    }
			    if(s.getMonth() == 3 || s.getMonth() == 5 || s.getMonth() == 8 || s.getMonth() == 10){ //meses de 30 dias
			        if(s.getDate() == 31){
			            s.setDate(01);
			            s.setMonth(s.getMonth()+1);
			        }
			    }
			    return s;
			}
			
			function juridicaOnOff(){
			    document.getElementById('pessoa_juridica').style.display=document.getElementById('juridica').checked ? 'block' : 'none';
			    document.getElementById('razaoSocialCliente').required = !document.getElementById('razaoSocialCliente').required;
			    document.getElementById('cnpjCliente').required = !document.getElementById('cnpjCliente').required; 
			    document.getElementById('cepCliente').required = !document.getElementById('cepCliente').required;
			    document.getElementById('sedeCliente').required = !document.getElementById('sedeCliente').required;
			}
			
			function validar(){
			    if(!clicouDatas)
			        window.alert("Escolha a data das parcelas.");
			    return clicouDatas;
			}
			
		</script>
</head>
<body>
  <?php require('header.php') ?>
  <main>
    <?php require('logoutBox.php'); ?>
    <form method = "POST" action = "contrato_arquivo.php" onsubmit = "return validar()">
        <br>
    <h5 align="center">Serviços: </h5>
  <div class='container-fluid'>
    <br>
    <?php 
      date_default_timezone_set("America/Sao_Paulo");//AJUSTA TIMEZONE
    
      //Realiza a conexão com o banco
      include "conexao.inc";
      
      $result =$conn->query("SELECT * FROM Item ORDER BY nome");  
      if(!$result){
        echo "error";
        exit;
      }
      
      //***CRIA TABELA COM A QUANTIDADE DE FUNÇÕES ESCOLHIDAS NA PÁGINA ANTERIOR ***//
      echo "<table class='table'>
      <thead>
        <tr>
          <th>Nome:  </th>
          <th width='200px'>Prazo (dias úteis)  </th>
          <th width='150px'>Prazo Indeterminado  </th>
        </tr>
      </thead>
      ";
    $cont =0; $cont2=0;
	$registroMarca = false;
    while($row = $result->fetch_assoc()) {//***PARA TODOS OS ITENS DO BD
        if(isset($_POST[$cont])){ //opção foi marcada
            $index = 1;
			if($row["nome"] == "Registro de Marca"){
				$registroMarca = true;
			}
        } else{
            $index = 0;
        }

        if($index){//Se index = 1, o campo foi marcado e deve ser exibido
          echo "
            <tr>
              
              <td style='padding: 5px; width: 75%;'> <input class='form-control' id = 'name' type = 'text' name = 'nomes[]' value = '" . $row["nome"] . "'></td>" . 
              "<td style='padding: 5px'>  
                  <div class='input-group' style='flex-wrap: nowrap !important'>
                      <input class='form-control' id = 'value' type = 'text' name = 'valores[]' value = '" . $row["prazoDiasUteis"]."'>
                  </div></td>
                <td>";
                if($row["tempo_indeterminado"]){
                    echo "<select style='width: 100%' class='form-control' name='indeterminados".$cont2."'>
                            <option value='sim' selected='selected'>SIM</option>
                            <option value='nao'>NÃO</option>
                        </select>
                        </td></tr>";
                } else{
                    echo "<select style='width: 100%' class='form-control' name='indeterminados".$cont2."'>
                            <option value='sim'>SIM</option>
                            <option value='nao' selected='selected'>NÃO</option>
                        </select>
                        </td></tr>";
                }
            $cont2++;
        }
        $cont++;
      }
      echo "</table><div>";
      $conn->close();//***FECHA CONEXAO BD***//
    ?>
    <hr>
    <!--    ---------------------------------------INFORMAÇÕES DA CONTRATADA------------------------ -->
    <?php
        //***CONEXÃO BD ***//
        include "conexao.inc";
        
        $result =$conn->query("SELECT razao_social, Empresa.CEP AS CEPEmp, CNPJ, sede,
         Presidente.CEP AS CEPPres, Presidente.CPF AS CPFPres, Presidente.endereco AS enderecoPres, Presidente.estado_civil AS civilPres, Presidente.genero AS generoPres, Presidente.nacionalidade AS nacionalidadePres, Presidente.nome AS nomePres, Presidente.profissao AS profissaoPres, Presidente.RG AS RGPres, Presidente.orgaoEmissorRG AS emissorPres,
         AdmFin.CEP AS CEPAdm, AdmFin.CPF AS CPFAdm, AdmFin.endereco AS enderecoAdm, AdmFin.estado_civil AS civilAdm, AdmFin.genero AS generoAdm, AdmFin.nacionalidade AS nacionalidadeAdm, AdmFin.nome AS nomeAdm, AdmFin.profissao AS profissaoAdm, AdmFin.RG AS RGAdm, AdmFin.orgaoEmissorRG AS emissorAdm FROM (Empresa INNER JOIN Presidente ON razao_social = empresa)INNER JOIN AdmFin ON razao_social = AdmFin.empresa");  
        if(!$result){
            echo "error";
            exit;
        }
        while($row = $result->fetch_assoc()) {
    ?>
    <h5 align="center">Informações da Contratada </h5>
    <!-- -------------------INFORMAÇÕES DA EMPRESA-------------------- -->
    <hr>
    <h6 align="center">Empresa: </h6>
    <div class='container-fluid'>
        <div class="row">
            <div class="col-lg-7">
                <label for="razaoSocial"> Razão Social</label>
                <input style="width: 100%" class="form-control" type="text" name="razao_social" id="razao_social" required value=<?php 
                    echo "'".$row["razao_social"]."'";
                ?></p>
            </div>
            <div class="col-lg-5">
                <label for="cnpj"> CNPJ: </label>
                <input style="width: 100%" class="form-control" type="text" name="cnpj" id="cnpj" required onkeydown="javascript: fMasc( this, mCNPJ );" maxlength="18" value = <?php 
                    echo "'".$row["CNPJ"]."'";
                ?></p>
            </div>
        </div><br>
        <div class = "row">
            <div class="col-lg-7">
                <label for="sede">Localização da sede:</label>
                <textarea style="width: 100%" class="form-control" name="sede" id="sede" required><?php 
                    echo $row["sede"];
                ?></textarea>
            </div>
            <div class="col-lg-5">
                <label for="cnpj"> CEP: </label>
                <input style="width: 100%" class="form-control" type="text" name="cep" id="cep" required onkeydown="javascript: fMasc( this, mCEP );" maxlength="10" value = <?php 
                    echo "'".$row["CEPEmp"]."'";
                ?></p>
            </div>
        </div><br>
        
        <!-- -------------------------------------INFORMAÇÕES DO PRESIDENTE-------------- -->
        <hr>
        <h6 align="center">Presidente: </h6>
        <div class="row">
            <div class="col-lg-3">
                <label for="razaoSocial"> Nome</label>
                <input style="width: 100%" class="form-control" type="text" name="nomePres" id="nomePres" required value=<?php 
                    echo "'".$row["nomePres"]."'";
                ?></p>
            </div>
            <div class="col-lg-2">
                <label for="cnpj"> CPF: </label>
                <input style="width: 100%" class="form-control" type="text" name="cpfPres" id="cpfPres" onkeydown="javascript: fMasc( this, mCPF );" maxlength="14" value = <?php 
                    echo "'".$row["CPFPres"]."'";
                ?></p>
            </div>
            <div class="col-lg-2">
                <label for="cnpj"> RG: </label>
                <input style="width: 100%" class="form-control" type="text" name="rgPres" id="rgPres" value = <?php 
                    echo "'".$row["RGPres"]."'";
                ?></p>
            </div>
            <div class="col-lg-2">
                <label for="orgaoEmissorPresidente">Órgão Emissor: </label>
                <input style="width: 100%" class="form-control" type="text" name="orgaoEmissorPresidente" id="orgaoEmissorPresidente" value = <?php 
                    echo "'".$row["emissorPres"]."'";
                ?></p>
            </div>
            <div class="col-lg-2">
                <label for="nacionalidade"> Nacionalidade</label>
                <input style="width: 100%" class="form-control" type="text" name="nacionalidadePres" id="nacionalidadePres" required value=<?php 
                    echo "'".$row["nacionalidadePres"]."'";
                ?></p>
            </div>
            <div class="col-lg-1">
                <label for="genero"> Gênero: </label>
                <select name = "generoPres" style="width: 100%" class="form-control">
                    <?php 
                        if($row["generoPres"] == "M"){ //genero masculino
                            echo "<option selected='selected' value='M'>M</option>";
                            echo "<option value='F'>F</option>";
                        }
                        else{ //genero feminino
                            echo "<option value='M'>M</option>";
                            echo "<option selected='selected'  value='F'>F</option>";
                        }
                    ?>
                </select>
            </div>
        </div><br>
        <div class="row">
            <div class="col-lg-2">
                <label for="civil"> Estado Civil: </label>
                <input style="width: 100%" class="form-control" type="text" name="civilPres" id="civilPres" value = <?php 
                    echo "'".$row["civilPres"]."'";
                ?></p>
            </div>
            <div class="col-lg-2">
                <label for="cnpj"> Profissão: </label>
                <input style="width: 100%" class="form-control" type="text" name="profissaoPres" id="profissaoPres" value = <?php 
                    echo "'".$row["profissaoPres"]."'";
                ?></p>
            </div>
            <div class="col-lg-5">
                <label for="sede">Endereço Pessoal:</label>
                <textarea style="width: 100%" class="form-control" name="enderecoPres" id="enderecoPres" required><?php 
                    echo $row["enderecoPres"];
                ?></textarea>
            </div>
            <div class="col-lg-3">
                <label for="cnpj"> CEP: </label>
                <input style="width: 100%" class="form-control" type="text" name="cepPres" id="cepPres" required onkeydown="javascript: fMasc( this, mCEP );" maxlength="10" value = <?php 
                    echo "'".$row["CEPPres"]."'";
                ?></p>
            </div>
        </div><br>
        
        <!-- -------------------------------------INFORMAÇÕES DO DIRETOR ADM-FIN-------------- -->

        <div class="row">
            <div class="col-lg-2">
                <label for="cnpj"> Estado Civil: </label>
                <input style="width: 100%" class="form-control" type="text" name="civilAdm" id="civilAdm" value = <?php 
                    echo "'".$row["civilAdm"]."'";
                ?></p>
            </div>
            <div class="col-lg-2">
                <label for="cnpj"> Profissão: </label>
                <input style="width: 100%" class="form-control" type="text" name="profissaoAdm" id="profissaoAdm" value = <?php 
                    echo "'".$row["profissaoAdm"]."'";
                ?></p>
            </div>
            <div class="col-lg-5">
                <label for="sede">Endereço Pessoal:</label>
                <textarea style="width: 100%" class="form-control" name="enderecoAdm" id="enderecoAdm" required><?php 
                    echo $row["enderecoAdm"];
                ?></textarea>
            </div>
            <div class="col-lg-3">
                <label for="cnpj"> CEP: </label>
                <input style="width: 100%" class="form-control" type="text" name="cepAdm" id="cepAdm" required onkeydown="javascript: fMasc( this, mCEP );" maxlength="10" value = <?php 
                    echo "'".$row["CEPAdm"]."'";
                ?></p>
            </div>
        </div><br>
        <?php
            } //fecha while
            $conn->close();//***FECHA CONEXAO BD***//
        ?>
         <!-- -------------------------------------INFORMAÇÕES DO CLIENTE-------------- -->
        <hr>
        <h5 align="center">Informações do Contratante </h6><hr>
        
        <!-- SABER SE É PESSOA FÍSICA OU JURÍDICA -->
        <div class = "row">
            <div class="col-lg-2">
                <a>Pessoa jurídica: <input name='juridica' id='juridica' type='checkbox'
                onChange="juridicaOnOff()"
                checked='true' name='chk_fisica'</a>
            </div>
        </div>
        
        <!-- INFORMAÇÕES REFERENTES A PESSOAS JURÍDICAS -->
        <div id ='pessoa_juridica' style ='display:block'>
            <h6 align="center">Empresa: </h6>
            <div class="row">
                <div class="col-lg-7">
                    <label for="rsCliente"> Razão Social</label>
                    <input style="width: 100%" class="form-control" type="text" name="razaoSocialCliente" id="razaoSocialCliente" required/>
                </div>
                <div class="col-lg-5">
                    <label for="cnpjCliente"> CNPJ: </label>
                    <input style="width: 100%" class="form-control" type="text" name="cnpjCliente" id="cnpjCliente" required onkeydown="javascript: fMasc( this, mCNPJ );" maxlength="18"/>
                </div>
            </div><br>
            <div class = "row">
                <div class="col-lg-7">
                    <label for="sedeCliente">Localização da sede:</label>
                    <textarea style="width: 100%" class="form-control" name="sedeCliente" id="sedeCliente" required></textarea>
                </div>
                <div class="col-lg-5">
                    <label for="cepCliente"> CEP: </label>
                    <input style="width: 100%" class="form-control" type="text" name="cepCliente" id="cepCliente" required onkeydown="javascript: fMasc( this, mCEP );" maxlength="10"/>
                </div>
            </div><br>
        </div>
        
        <!-- INFORMAÇÕES REFERENTES A PESSOAS FÍSICAS OU REPRESENTANTE DA EMPRESA -->
        <hr>
        <h6 align="center">Informações do Representante: </h6>
        <div class="row">
            <div class="col-lg-3">
                <label for="nomeRepresentante"> Nome</label>
                <input style="width: 100%" class="form-control" type="text" name="nomeRepresentante" id="nomeRepresentante" required</p>
            </div>
            <div class="col-lg-2">
                <label for="cpfRepresentante"> CPF: </label>
                <input style="width: 100%" class="form-control" type="text" name="cpfRepresentante" id="cpfRepresentante" onkeydown="javascript: fMasc( this, mCPF );" maxlength="14"/>
            </div>
            <div class="col-lg-2">
                <label for="rgRepresentante"> RG: </label>
                <input style="width: 100%" class="form-control" type="text" name="rgRepresentante" id="rgRepresentante"/>
            </div>
            <div class="col-lg-2">
                <label for="orgaoEmissorPresidente">Órgão Emissor: </label>
                <input style="width: 100%" class="form-control" type="text" name="orgaoEmissorRepresentante" id="orgaoEmissorRepresentante"/>
            </div>
            <div class="col-lg-2">
                <label for="nacionalidadeRepresentante"> Nacionalidade</label>
                <input style="width: 100%" class="form-control" type="text" name="nacionalidadeRepresentante" id="nacionalidadeRepresentante" required value='brasileiro'/>
            </div>
            <div class="col-lg-1">
                <label for="generoRepresentante"> Gênero: </label>
                <select name = "generoRepresentante" style="width: 100%" class="form-control">
                            echo "<option value='M'>M</option>";
                            echo "<option value='F'>F</option>";
                </select>
            </div>
        </div><br>
        <div class="row">
            <div class="col-lg-2">
                <label for="civilRepresentante"> Estado Civil: </label>
                <input style="width: 100%" class="form-control" type="text" name="civilRepresentante" id="civilRepresentante"/>
            </div>
            <div class="col-lg-2">
                <label for="profissaoRepresentante"> Profissão: </label>
                <input style="width: 100%" class="form-control" type="text" name="profissaoRepresentante" id="profissaoRepresentante"/>
            </div>
            <div class="col-lg-5">
                <label for="enderecoRepresentante">Endereço Pessoal:</label>
                <textarea style="width: 100%" class="form-control" name="enderecoRepresentante" id="enderecoRepresentante" required></textarea>
            </div>
            <div class="col-lg-3">
                <label for="cepRepresentante"> CEP: </label>
                <input style="width: 100%" class="form-control" type="text" name="cepRepresentante" id="cepRepresentante" required onkeydown="javascript: fMasc( this, mCEP );" maxlength="10"/>
            </div>
        </div><br>
        
        <!-- INFORMAÇÕES REFERENTES AO PROJETO -->
        <hr>
        <h5 align="center">Dados do Projeto: </h5>
        <hr>
        <div class="row">
            <div class="col-lg-2">
                <label for="precoProjeto"> Preço Total: </label>
                <input style-"width:100%" class="form-control" name="precoProjeto" type="number" required min="0.00" value="0.00" step=".01"/>
            </div>
            <div class="col-lg-2">
                <label for="parcelas"> Número de Parcelas </label>
                <input style-"width:100%" class="form-control" name = "parcelas" id = "parcelas" type="number" required min="1" value=1 onchange = "clicouDatas = false"/>
            </div>
            <div class="col-lg-2">
                <br>
                <input style-"width:100%" class='btn_class' name="btn-parc" type = "button" value = "Escolher datas das parcelas" style='font-size:13px' onclick="dataParcelas()"/>
            </div>
        </div><br>
        
        <div class="row" name="divParcelas" id="divParcelas">
            <!-- O conteúdo da div é preenchido pelo js-->
        </div>
        <br>
        
        <?php 
			if($registroMarca){
				echo "<div class='row' name='regMarca' id='regMarca'>
						<div class='col-lg-2'>
							<label for='gru'> Taxa de Marca: </label>
							<input style-'width:100%' class='form-control' name='precoTaxaDeMarca' type='number' required min='0.00' value='0.00' step='.01'/>
						</div>
			</div><br>";
			}
			
		?>
		
        
        <!-- DADOS DAS TESTEMUNHAS -->
        <hr>
        <h5 align="center">Dados das Testemunhas: </h5>
        <hr>
        <h6 align="center">Testemunha 1</h6>
        <div class="row">
            <div class="col-lg-5">
                <label for="nome_testemunha1"> Nome: </label>
                <input style-"width:100%" class="form-control" name="nomeTestemunha1" type="text"/>
            </div>
            <div class="col-lg-2">
                <label for="cpf_testemunha1"> CPF: </label>
                <input style="width: 100%" class="form-control" type="text" name="cpfTestemunha1" id="cpfTestemunha1" onkeydown="javascript: fMasc( this, mCPF );" maxlength="14"/>
            </div>
            <div class="col-lg-2">
                <label for="rg_testemunha"> RG: </label>
                <input style="width: 100%" class="form-control" type="text" name="rgTestemunha1" id="rgTestemunha1"/>
            </div>
            <div class="col-lg-2">
                <label for="orgaoEmissorTest1"> Órgão Emissor: </label>
                <input style="width: 100%" class="form-control" type="text" name="orgaoEmissorTestemunha1" id="orgaoEmissorTestemunha1"/>
            </div>
        </div><br>
        
        <h6 align="center">Testemunha 2</h6>
        <div class="row">
            <div class="col-lg-5">
                <label for="nome_testemunha2"> Nome: </label>
                <input style-"width:100%" class="form-control" name="nomeTestemunha2" type="text"/>
            </div>
            <div class="col-lg-2">
                <label for="cpf_testemunha2"> CPF: </label>
                <input style="width: 100%" class="form-control" type="text" name="cpfTestemunha2" id="cpfTestemunha2" onkeydown="javascript: fMasc( this, mCPF );" maxlength="14"/>
            </div>
            <div class="col-lg-2">
                <label for="rg_testemunha2"> RG: </label>
                <input style="width: 100%" class="form-control" type="text" name="rgTestemunha2" id="rgTestemunha2"/>
            </div>
            <div class="col-lg-2">
                <label for="orgaoEmissorTest2"> Órgão Emissor: </label>
                <input style="width: 100%" class="form-control" type="text" name="orgaoEmissorTestemunha2" id="orgaoEmissorTestemunha2"/>
            </div>
        </div>
        <hr>
        <div class="row">
        <div class='col-lg-2'>
            <label for='dataContrato'> Data do Contrato:</label>
            <input style-'width:100%' class='form-control' name='dataContrato' type='date' value = '<?php echo date("Y-m-d"); ?>'>
        </div></div><br>
        
        <input class='btn_class' type = "submit" value = "Gerar Contrato" style='font-size:13px'>
        <a href="contrato.php"><input class='btn_class' type = "button" value = "Voltar" style='font-size:13px'></a>
        <br><br>
        
        </div>
    </form>
    </main>
  <footer>
        Desenvolvido por <a target ="blank" href="http://www.nobugs.com.br">No Bugs</a> @2019
    </footer>
</body>
</html>
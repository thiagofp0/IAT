<?php
//DESENVOLVIDO POR: GUSTAVO CANAL ULIANA - 2015
  class numero{//Armazena informações sobre um número X tal que abs(X)<999999.99
    private $num;//ARMAZENA NÚMERO COMPLETO
    private $decimal;//ARMAZENA VALOR DECIMAL
    private $unidade;//ARMAZENA VALOR DAS UNIDADES, DEZENAS E CENTENAS
    private $milhares;//ARMAZENA VALOR DOS MILHARES
    private $monetario;//TRUE SE EH MOEDA, FALSE SE NÃO
    private $feminino;//TRUE SE EH FEMININO, FALSE SE NÃO
    private $extenso;//ARMAZENA EXTENSO DO NÚMERO
    private $negativo;//TRUE SE É NEGATIVO, FALSE SE NÃO
    
    private function extenso_base($valor, $fem){//CALCULA O EXTENSO DE UM NÚMERO DE 3 DÍGITOS
      //$fem define se os números devem estar no feminino (true) ou nao (false)
      $uni = $valor%10;
      $dez = $valor%100 - $uni;
      $cen = $valor%1000 - $dez - $uni;
      $dez /= 10;
      $cen /= 100;
      $ext = "";//$ext irá armazenar o número montado
      if($cen == 1 and $dez == 0 and $uni == 0){
        return "Cem";
      }
      if($dez == 1){//Trata as unidades de 10
        switch($uni){
          case 1:
            $ext .= "Onze";
            break;
          case 2:
            $ext .= "Doze";
            break;
          case 3:
            $ext .= "Treze";
            break;
          case 4:
            $ext .= "Quatorze";
            break;
          case 5:
            $ext .= "Quinze";
            break;
          case 6:
            $ext .= "Dezesseis";
            break;
          case 7:
            $ext .= "Dezessete";
            break;
          case 8:
            $ext .= "Dezoito";
            break;
          case 9:
            $ext .= "Dezenove";
            break;
          case 0:
            $ext .= "Dez";
            break;
        }
      } else {//Trata as outras dezenas
        switch($dez){
          case 0:
            break;
          case 2:
            $ext .= "Vinte";
            break;
          case 3:
            $ext .= "Trinta";
            break;
          case 4:
            $ext .= "Quarenta";
            break;
          case 5:
            $ext .= "Cinquenta";
            break;
          case 6:
            $ext .= "Sessenta";
            break;
          case 7:
            $ext .= "Setenta";
            break;
          case 8:
            $ext .= "Oitenta";
            break;
          case 9:
            $ext .= "Noventa";
            break;
          
        }
      }
      if($dez != 1 and $uni != 0){//Trata unidades de outras dezenas
        if($dez != 0){
          $ext .= " e ";//Espaço
        }
        switch ($uni){
          case 1:
            if($fem){
              $ext .= "Uma";
              break;
            }
            $ext .= "Um";
            break;
          case 2:
            if($fem){
              $ext .= "Duas";
              break;
            }
            $ext .= "Dois";
            break;
          case 3:
            $ext .= "Três";
            break;
          case 4:
            $ext .= "Quatro";
            break;
          case 5:
            $ext .= "Cinco";
            break;
          case 6:
            $ext .= "Seis";
            break;
          case 7:
            $ext .= "Sete";
            break;
          case 8:
            $ext .= "Oito";
            break;
          case 9:
            $ext .= "Nove";
            break;
        }
      }
      if($cen != 0 and ($dez != 0 or $uni != 0)){
        $ext = " e " . $ext;//Espaço
      }
      switch($cen){//Trata centenas
        case 0:
          break;
        case 1:
          $ext = "Cento" . $ext;
          break;
        case 2:
          if($fem){
            $ext = "Duzentas" . $ext;
            break;
          }
          $ext = "Duzentos" . $ext;
          break;
        case 3:
          if($fem){
            $ext = "Trezentas" . $ext;
            break;
          }
          $ext = "Trezentos" . $ext;
          break;
        case 4:
          if($fem){
            $ext = "Quatrocentas" . $ext;
            break;
          }
          $ext = "Quatrocentos" . $ext;
          break;
        case 5:
          if($fem){
            $ext = "Quinhentas" . $ext;
            break;
          }
          $ext = "Quinhentos" . $ext;
          break;
        case 6:
          if($fem){
            $ext = "Seiscentas" . $ext;
            break;
          }
          $ext = "Seiscentos" . $ext;
          break;
        case 7:
          if($fem){
            $ext = "Setecentas" . $ext;
            break;
          }
          $ext = "Setecentos" . $ext;
          break;
        case 8:
          if($fem){
            $ext = "Oitocentas" . $ext;
            break;
          }
          $ext = "Oitocentos" . $ext;
          break;
        case 9:
          if($fem){
            $ext = "Novecentas" . $ext;
            break;
          }
          $ext = "Novecentos" . $ext;
          break;
      }
      
      return $ext;
      
    }
    
    private function set_num($valor){
      $this->num = $valor;
    }
    
    private function set_decimal($valor){
      $this->decimal = $valor;
    }
    
    private function set_unidade($valor){
      $this->unidade = $valor;
    }
    
    private function set_milhares($valor){
      $this->milhares = $valor;
    }
    
    private function set_monetario($mon){
      $this->monetario = $mon;
    }
    
    private function set_feminino($fem){
      $this->feminino = $fem;
    }
    
    private function set_extenso(){//CHAMA EXTENSO_BASE PARA O NÚMERO TRUNCADO E GERA SEU VALOR EM EXTENSO
      $neg = $this->negativo;
      $dec = $this->get_decimal();
      $uni = $this->get_unidade();
      $mil = $this->get_milhares();
      $fem = $this->get_feminino();
      $mon = $this->get_monetario();
      $e_dec = $e_uni = $e_mil = $ext = "";
      if($dec != 0)  $e_dec = $this->extenso_base($dec, $fem);
      if($uni != 0)  $e_uni = $this->extenso_base($uni, $fem);
      if($mil != 0)  $e_mil = $this->extenso_base($mil, $fem);
      
      if($mil != 0){
        $ext = $e_mil;
        $ext .= " Mil ";
        if($uni != 0){
          if($uni > 100){
            $ext .= ", ";
          } else {
            $ext .= "e ";
          }
        }
      }
      if($uni != 0){
        $ext .= $e_uni;
        if($dec != 0 and $mon){
          $ext .= " ";
        }
      }
      if(($uni !=0 or $mil != 0) and $mon){
        if($uni == 1 and $mil == 0){
          $ext .= " Real";
        } else {
          $ext .= " Reais";
        }
      }
      if($dec != 0 and $mon){
        $ext .= " e " . $e_dec . " Centavo(s)"; 
      }
      if($neg){
        $ext = "Negativo " . $ext;
      }
      $this->extenso = $ext;
      if($this->get_valor() == 0){
        $this->extenso = "Zero";
        if($mon){
         $this->extenso .= " Real"; 
        }
      }
    }
    
    private function get_decimal(){
      return $this->decimal;
    }
    
    private function get_unidade(){
      return $this->unidade;
    }
    
    private function get_milhares(){
      return $this->milhares;
    }
    
    private function get_feminino(){
      return $this->feminino;
    }
    
    private function get_monetario(){
      return $this->monetario;
    }
    
    public function get_extenso(){
      return $this->extenso;
    }
    
    public function get_valor(){
      return $this->num;
    }
    
    public function numero($valor, $mon, $fem){//RECEBE UM NÚMERO, SE EH MOEDA E SE EH FEMININO. CRIA OBJETO numero COMPLETO USANDO ESSAS INFORMAÇÕES
      //*** $mon deve ser TRUE se o valor está em moeda, e FALSE se não ***//
      //*** $fem deve ser TRUE se o valor se refere a algo feminino (Uma, duas, ...) e FALSE se não (Um, dois, ...) ***//
      $this->negativo = false;
      if($valor < 0){
        $valor*= (-1);
        $this->negativo = true;
      }
      $dec = $valor * 100;
      $aux = explode(".", $dec);
      $dec = $aux[0]%100;//Parte decimal de duas casas, sem arredondamento;
      $uni = ($aux[0]%100000 - $dec)/100;
      $mil = ($aux[0] - $uni*100 - $dec)/100000;
      $this->set_num($valor);
      $this->set_decimal($dec);
      $this->set_unidade($uni);
      $this->set_milhares($mil);
      $this->set_monetario($mon);
      $this->set_feminino($fem);
      $this->set_extenso();
    }
  }
?>
<?php
//DESENVOLVIDO POR: GUSTAVO CANAL ULIANA - 2015
	function mes($m){//RETORNA O VALOR EXTENSO DE UMA MÊS
		switch($m){
			case 1:
				return "Janeiro";
				break;
			case 2:
				return "Fevereiro";
				break;
			case 3:
				return "Março";
				break;
			case 4:
				return "Abril";
				break;
			case 5:
				return "Maio";
				break;
			case 6:
				return "Junho";
				break;
			case 7:
				return "Julho";
				break;
			case 8:
				return "Agosto";
				break;
			case 9:
				return "Setembro";
				break;
			case 10:
				return "Outubro";
				break;
			case 11:
				return "Novembro";
				break;
			case 12:
				return "Dezembro";
				break;
		}
	}

	class funcao {//Armazena informações sobre as funções pedidas pelo cliente
		private $nome;
		private $prazo;
		private $preco;
		private $descricao;
		
		public function setNome($nome){
			$this->nome = $nome;
		}
		
		public function setPrazo($prazo){
			$this->prazo = $prazo;
		}
		
		public function setPreco($preco){
		    $this->preco = $preco;
		}
		
		public function setDescricao($descricao){
		    $this->descricao = $descricao;
		    
		}
		public function getNome(){
			return $this->nome;
		}
		
		public function getPrazo(){
			return $this->prazo;
		}
		
		public function getPreco(){
		    return $this->preco;
		}
		
		public function getDescricao(){
		    return $this->descricao;
		}
	}
	
	function calcula_valor($i, $vetor){//Soma o valor de todas as funções parar retornar o valor final do projeto
		$soma = 0;
		$index = 0;
		while($index < $i){
			$item = $vetor[$index];
			$soma = $soma + $item->getValor();
			$index++;
		}
			return $soma;
	}
	
	function desconto ($valor, $desconto){//Dado um certo desconto, retorna valor restante
		$desc = (100 - $desconto)/100;
		$valor = $valor * $desc * 100;
		$aux = explode(".", $valor);
		return $aux[0]/100;
	}
	
	function parcela ($valor, $parcelas){//Dado um valor e quantidade de parcelas, retorna valor da parcela com duas casas não arredondado
		$valor = ($valor/$parcelas) * 100;
		$aux = explode(".", $valor);
		return $aux[0]/100;
	}
	
	function nome_docto($tipo, $cliente){
		$arquivo = "";
		$aux_nome = explode(" ", $cliente);
		foreach($aux_nome as $palavra){
			$arquivo = $arquivo . '_' . mb_strtoupper($palavra, "UTF-8");
		}
		$arquivo = $tipo . $arquivo . ".pdf";
		return $arquivo;
	}
	
	function incisos($cont){
		$html = "";
		if($cont == 2) //só tem um serviço
			$html .= "o inciso I no item 1.1";
		else{
			$html .= "os incisos ";
			for($z = 1; $z<$cont; $z++){
				if($z == $cont-1) //é o último
					$html .= "e ".numberIntegerToRoman($z);
				else{
					if($z == $cont-2) //é o penúltimo
						$html .= numberIntegerToRoman($z)." ";
					else
						$html .= numberIntegerToRoman($z).", ";
				}
			}
			$html .= " no item 1.1";
		}
		return $html;
	}
	
	function nParaLetra($letra){ //converte número para letra correspondente no alfabeto
	    $final = "";
	    switch($letra){
	        case 1:
	            $final = "a";
	            break;
	       case 2:
	            $final = "b";
	            break;
	        case 3:
	            $final = "c";
	            break;
	       case 4:
	            $final = "d";
	            break;
	       case 5:
	            $final = "e";
	            break;
	       case 6:
	            $final = "f";
	            break;
	       case 7:
	            $final = "g";
	            break;
	       case 8:
	            $final = "h";
	            break;
	       case 9:
	            $final = "i";
	            break;
	       case 10:
	            $final = "j";
	            break;
	       case 11:
	            $final = "k";
	            break;
	       case 12:
	            $final = "l";
	            break;
	       case 13:
	            $final = "m";
	            break;
	       case 14:
	            $final = "n";
	            break;
	       case 15:
	            $final = "o";
	            break;
	       case 16:
	            $final = "p";
	            break;
	       case 17:
	            $final = "q";
	            break;
	       case 18:
	            $final = "r";
	            break;
	       case 19:
	            $final = "s";
	            break;
	       case 20:
	            $final = "t";
	            break;
	       case 21:
	            $final = "u";
	            break;
	       case 22:
	            $final = "v";
	            break;
	       case 23:
	            $final = "w";
	            break;
	       case 24:
	            $final = "x";
	            break;
	       case 25:
	            $final = "y";
	            break;
	       case 26:
	            $final = "z";
	            break;
	    }
	    return $final;
	}
	
	function numberIntegerToRoman($num, $debug = false){ 
        $n = intval($num); 
        $nRoman = ''; 
 
        $default = array(
            'M'     => 1000,
            'CM'     => 900,
            'D'     => 500,
            'CD'     => 400,
            'C'     => 100,
            'XC'     => 90,
            'L'     => 50,
            'XL'     => 40,
            'X'     => 10,
            'IX'     => 9,
            'V'     => 5,
            'IV'     => 4,
            'I'     => 1,
        );
 
        foreach ($default as $roman => $number){ 
            $matches = intval($n / $number); 
            $nRoman .= str_repeat($roman, $matches); 
            $n = $n % $number; 
        } 
 
        if($debug){
            return sprintf('%s = %s', $num, $nRoman);
        }
 
        return $nRoman; 
    }

    //Retorna número por extenso na forma ordinal (primeira, segunda...) -- limite: 1 a 99
    function ordinal($num){
        
        if($num < 1 or $num > 99)
            return $num."ª";
        
        
        $dezena = floor($num/10);
        $unidade = $num% 10;
        
        $ordinal = "";
        
        switch($dezena){
            case 1:
                $ordinal .= "décima ";
                break;
            case 2:
                $ordinal .= "vigésima ";
                break;
            case 3:
                $ordinal .= "trigésima ";
                break;
            case 4:
                $ordinal .= "quadragésima ";
                break;
            case 5:
                $ordinal .= "quinquagésima ";
                break;
            case 6:
                $ordinal .= "sexagésima ";
                break;
            case 7:
                $ordinal .= "septuagésima ";
                break;
            case 8:
                $ordinal .= "octogésima ";
                break;
            case 9:
                $ordinal .= "nonagésima ";
                break;
        }
        
        switch($unidade){
            case 1:
                $ordinal .= "primeira";
                break;
            case 2:
                $ordinal .= "segunda";
                break;
            case 3:
                $ordinal .= "terceira";
                break;
            case 4:
                $ordinal .= "quarta";
                break;
            case 5:
                $ordinal .= "quinta";
                break;
            case 6:
                $ordinal .= "sexta";
                break;
            case 7:
                $ordinal .= "sétima";
                break;
            case 8:
                $ordinal .= "oitava";
                break;
            case 9:
                $ordinal .= "nona";
                break;
        }
        
        return $ordinal;
    }
?>
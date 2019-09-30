<?php
	include_once("conexao.php");

	// echo "Entrou aqui!";

	// $file = 'myfile1.txt';
	// $data = json_encode($_POST);
	
	// $fp = fopen($file, "w") or die("Couldn't open $file for writing!");

	// fwrite($fp, $data) or die("Couldn't write values to file!"); 

	// fclose($fp); 

	// echo "Saved to $file successfully!";


	//$variavel =	$_POST['NOMEDAVARIAVEL'];

	$id = $_POST['id'];
	
	$tempos1 = $_POST['tempos1'];
	$tempos2 = $_POST['tempos2'];
	$tempos3 = $_POST['tempos3'];
	$tempos4 = $_POST['tempos4'];
	$tempos5 = $_POST['tempos5'];
	$tempos6 = $_POST['tempos6'];
	$tempos7 = $_POST['tempos7'];

	$erros1 = $_POST['erros1'];
	$erros2 = $_POST['erros2'];
	$erros3 = $_POST['erros3'];
	$erros4 = $_POST['erros4'];
	$erros5 = $_POST['erros5'];
	$erros6 = $_POST['erros6'];
	$erros7 = $_POST['erros7'];

	$score = $_POST['score'];
	$severity = $_POST['severity'];


	 $sql = "INSERT INTO implicito values ('$id', '$tempos1', '$erros1', '$tempos2', '$erros2', '$tempos3', '$erros3', '$tempos4', '$erros4', '$tempos5', '$erros5', '$tempos6', '$erros6', '$tempos7', '$erros7', '$score', '$severity');"; 
		
		$resultado = mysqli_query($conexao, $sql);
		if ($resultado) {
			echo "<script>alert('Deu!');</script>";
		}else{
			echo "<script>alert('Deu não!');</script>";
		}
		mysqli_close($conexao);
?>
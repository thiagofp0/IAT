<?php 
    $conn = mysqli_connect("localhost", "root", "nobugs321","contratosNoBugs");
      
    if ($conn->connect_errno) {
        echo "Erro de conexão" . $conn->connect_error;
        exit;
    }
    $conn->set_charset('utf8');
?>
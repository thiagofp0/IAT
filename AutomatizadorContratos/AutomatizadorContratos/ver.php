<?php

  //CONEXÂO COM O BANCO DE DADOS
  include "conexao.inc";

  //DESENVOLVIDO POR NO BUGS - EMPRESA JÚNIOR DE INFORMÁTICA - 2019
  $login = $_POST["login"];
  $password = $_POST["password"];

  if(!ctype_alnum($login)){
    header("location: index.php");
  }
  
  $password = md5($_POST["password"]);
  
  session_start();
  
  $_SESSION["anterior_e_contrato"] = false;
  
    ini_set('display_startup_errors', 1);
    ini_set('display_errors', 1);
    error_reporting(-1);
  
  $result = $conn->query("SELECT * FROM Colaborador WHERE `username` = '$login' AND `senha` = '$password'");
  
  if($result->num_rows > 0){
    $_SESSION["log_nb_auto"] = mysqli_fetch_array($result);
    $conn->close();
    header("location:menu.php");
  } else {
    //unset($_SESSION["log_nb_auto"]);
    session_destroy();
    $conn->close();
    header("location:index.php");
    exit;
  }
?>
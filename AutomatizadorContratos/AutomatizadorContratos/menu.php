<?php
    session_start();

    $login = $_SESSION["log_nb_auto"];
    $user = $login["username"];
    $nome = $login["Nome"];
    if(!isset($_SESSION["log_nb_auto"])){
      unset($_SESSION["log_nb_auto"]);
      header("Location: index.php");
      exit;
    }
    else if($user == "bugs"){
      header("Location: pesw.php");
      exit;
    }
    $admin = $login["admin"];
?>
<!DOCTYPE html>
<!--DESENVOLVIDO POR GUSTAVO CANAL ULIANA - 2015-->
<html>
  <head>
     <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset = "UTF-8">
    <link rel="icon" href="favicon.png" type="image/png" sizes="16x16">
    <title><?php echo "Bem vindo, $nome"; ?></title>
    <link rel="stylesheet" href="./css/style.css">
    <style type = "text/css">
      @font-face{
        font-family: fonteNB;
        font-weight: normal;
        src: url("font/Desig.woff");
      }
      @font-face{
        font-family: fonteNB;
        font-weight: bold;
        src: url("font/DesigBold.woff");
      }
      p{
        font-family: fonteNB;
        font-size: 15pt;
      }
      label {
         font-family: fonteNB;
      }
      input{
        font-family: fonteNB;
        font-size: 15pt;
      }
    </style>
  </head>
  <body>
    <?php require('header.php'); ?>
    <div class="container-fluid">
        <?php require('logoutBox.php'); ?>
        <div class="row">
            <div class="col-lg-6">
                <p>Bem vindo, <?php echo $nome; ?>! Escolha o que deseja acessar: </p>
            </div>
        </div>
        <?php
            //Automatizador de contratos
            echo' <div class="row">
            <div class="col-lg-6">
            <form action = "contrato.php">
                <input font-family="fonteNB" class="btn_class" type = "submit" value = "Gerar Contrato">
            </form>
            </div>
            </div>';
        ?>
    </div>
  </body>
</html>
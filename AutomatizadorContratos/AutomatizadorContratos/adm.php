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
    
    if(!$admin)
        header("location:deniedPermission.php");
?>
<!DOCTYPE html>
<!--DESENVOLVIDO POR GUSTAVO CANAL ULIANA - 2015-->
<html>
  <head>
    <meta charset = "UTF-8">
    <link rel="icon" href="favicon.png" type="image/png" sizes="16x16">
    <title>Área Administrativa</title>
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
        <p>Escolha o que deseja acessar: </p>
        <?php
            //Editar dados da empresa e do presidente
            echo'<form action = "dadosEmpresa.php">
            <input font-family="fonteNB" class="btn_class"type = "submit" value = "Editar dados da empresa">
            </form>';
            
          echo "<br>";
          echo '
            <form action = "dadosServicos.php">
              <input font-family="fonteNB" class="btn_class" type = "submit" value = "Editar serviços">
            </form>';
          echo "<br>";
          echo '
            <form action = "dadosUsuarios.php">
              <input font-family="fonteNB" class="btn_class" type = "submit" value = "Editar usuários">
            </form>';
        ?>
        <br>
        <a href="menu.php"><input class="btn_class" type="button" value="Voltar ao início"/></a>
	</div>
	<br><br>
	
    </div>
  </body>
</html>
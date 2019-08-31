<!DOCTYPE html>
<!--DESENVOLVIDO POR NO BUGS - EMPRESA JÚNIOR DE INFORMÁTICA - 2019-->
<html>
  <?php header('Cache-Control: no cache');
        session_cache_limiter('private_no_expire'); ?>
  <head>
    <link rel="icon" href="favicon.png" type="image/png">
    <meta charset = "UTF-8">
    <title>Automateasy - Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
  </head>
  <body>
    <?php require('header.php'); ?>
    <main><br>
    <div align='center'> <img src='./img/nbLogo.png' width='200px'></div><br>
    <div  align='center'>
      <div class='box' align = 'center'>
      <form method = "POST" action = "ver.php">
      <p><input  type = "text" name = "login" placeholder = "Usuário"></p>
      <p><input font-family='fonteNB'type = "password" name = "password" placeholder = "Senha"></p>
      <input font-family='fonteNB' class="btn_class" type = "submit" value = "Login">    
    </form>
    </div>  
    </div>  

    </main>
    <footer>
    </footer>
    <p>
      <?php
        include "conexao.inc";
        @mysqli_close($conn);
      ?>
      </p>
    </div>
  </body>
</html>
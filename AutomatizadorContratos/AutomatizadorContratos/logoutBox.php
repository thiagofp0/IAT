<?php
    //DIV com o botão de logout e de acesso aos dados do usuário logado (deve ser colocada após a sessão ter sido iniciada e seus dados salvos na variável $login)
    echo "<div style='position:absolute; right:1px; background-color:#000;' class='btn'>
            <a href='user.php?username=".$login['username']."' class='btn' style='text-decoration:none; color:#f3cc4f !important'> ".$login['Nome']." </a>
            <a href='deslogar.php' class='btn' style='text-decoration:none; color:#f3cc4f !important'>Sair</a>
        </div><br>";
?>
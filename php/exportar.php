<?php
    include "conexao.php";

    $resultado = mysqli_query($conexao, "SELECT * FROM explicito INNER JOIN implicito ON explicito.id = implicito.idExplicito");

    $rows = array();

    while($row = $resultado->fetch_assoc()){
        array_push($rows, $row);
    }

    $json = json_encode($rows);

    header('Content-disposition: attachment; filename=dados.json');
    header('Content-type: application/json');

    echo($json);

    mysqli_close($conexao);
?>
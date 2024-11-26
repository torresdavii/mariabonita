<?php
$conectar = mysqli_connect("localhost", "root", "", "mariabonita");

// Pega os primeiros 10 registros
$sql_pesquisa = "SELECT idclientes, nome, usuario FROM clientes LIMIT 10";
$sql_resultado = mysqli_query($conectar, $sql_pesquisa);

// Exibe os primeiros 10 registros novamente
if (mysqli_num_rows($sql_resultado) > 0) {
    while ($registro = mysqli_fetch_row($sql_resultado)) {
        echo "<tr height='50px'>
                <td>{$registro[0]}</td>
                <td>{$registro[1]}</td>
                <td>{$registro[2]}</td>
              </tr>";
    }
}
?>

<?php
$conectar = mysqli_connect("localhost", "root", "", "mariabonita");

$offset = isset($_GET['offset']) ? intval($_GET['offset']) : 0;
$limit = 10; // Carrega 10 registros por vez

// Pega os próximos 10 registros a partir do offset
$sql_pesquisa = "SELECT idclientes, nome, usuario FROM clientes LIMIT $limit OFFSET $offset";
$sql_resultado = mysqli_query($conectar, $sql_pesquisa);

// Verifica se existem registros
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











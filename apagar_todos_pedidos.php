<?php
$conectar = mysqli_connect("localhost", "root", "", "mariabonita");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Apagar todos os registros da tabela de itens_pedidos primeiro
    $sql_apagar_itens = "DELETE FROM itens_pedidos";
    mysqli_query($conectar, $sql_apagar_itens);

    // Apagar todos os registros da tabela de pedidos
    $sql_apagar = "DELETE FROM pedidos";
    
    if (mysqli_query($conectar, $sql_apagar)) {
        echo 'success';
    } else {
        echo 'error';
    }
}
?>

<?php
$conectar = mysqli_connect("localhost", "root", "", "mariabonita");

// Número de registros a carregar
$limite = isset($_POST['limite']) ? intval($_POST['limite']) : 10;

// Consulta para buscar os pedidos
$sql_pesquisa = "SELECT idpedidos, clientes_usuario, endereco, pagamento, total FROM pedidos LIMIT $limite";
$sql_resultado = mysqli_query($conectar, $sql_pesquisa);

$pedidos = [];
while ($registro = mysqli_fetch_assoc($sql_resultado)) {
    $pedidos[] = $registro;
}

echo json_encode($pedidos);
?>

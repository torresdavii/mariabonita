<?php
$conectar = mysqli_connect("localhost", "root", "", "mariabonita");

// Obter o ID do pedido
$id_pedido = isset($_POST['id_pedido']) ? intval($_POST['id_pedido']) : 0;

if ($id_pedido > 0) {
    // Consulta para buscar os itens do pedido
    $sql_pesquisa2 = "SELECT pedidos_idpedidos, quantidade_bebida, quantidade_prato, nome_prato, nome_bebida 
                      FROM itens_pedidos 
                      WHERE pedidos_idpedidos = $id_pedido";
    $sql_resultado2 = mysqli_query($conectar, $sql_pesquisa2);

    $itens = [];
    while ($registro2 = mysqli_fetch_assoc($sql_resultado2)) {
        $itens[] = $registro2;
    }

    // Retorna os itens em formato JSON
    echo json_encode($itens);
} else {
    echo json_encode([]);
}
?>

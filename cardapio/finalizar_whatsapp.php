<?php
session_start();
require '../conexao.php';


$config = include '../config.php';
$telefone = $config['whatsapp_number'];

if (
    (!isset($_SESSION['carrinho']) || empty($_SESSION['carrinho'])) &&
    (!isset($_SESSION['carrinho_bebida']) || empty($_SESSION['carrinho_bebida']))
) {
    header('Location: carrinho.php');
    exit;
}

$ids = array_keys($_SESSION['carrinho']);
$pratos = [];

if (!empty($ids)) {
    $stmt = $pdo->query('SELECT * FROM pratos WHERE idpratos IN (' . implode(',', $ids) . ')');
    $pratos = $stmt->fetchAll(PDO::FETCH_ASSOC);
}

$ids_bebida = array_keys($_SESSION['carrinho_bebida']);
$bebidas = [];

if (!empty($ids_bebida)) {
    $stmt = $pdo->query('SELECT * FROM bebidas WHERE idbebidas IN (' . implode(',', array_map('intval', $ids_bebida)) . ')');
    $bebidas = $stmt->fetchAll(PDO::FETCH_ASSOC);
}

$endereco = $_POST['endereco'];
$pagamento = $_POST['pagamento'];
$cliente_usuario = $_SESSION['nome'];


$total = 0;
$nome_prato_str = '';
$quantidades_pratos_str = '';
$nome_bebida_str = '';
$quantidades_bebidas_str = '';

// Calcular o total do pedido e preparar strings de IDs e quantidades
foreach ($pratos as $prato) {
    $nome_prato = $prato['nome'];
    $idprato = $prato['idpratos'];
    $quantidade_prato = $_SESSION['carrinho'][$idprato]['quantidade'];
    $preco_prato = $prato['preco'];
    $subtotal_prato = $preco_prato * $quantidade_prato;
    $total += $subtotal_prato;

    $nome_prato_str .= $nome_prato . ',';
    $quantidades_pratos_str .= $quantidade_prato . ',';
}

foreach ($bebidas as $bebida) {
    $nome_bebida = $bebida['nome'];
    $idbebida = $bebida['idbebidas'];
    $quantidade_bebida = $_SESSION['carrinho_bebida'][$idbebida]['quantidade'];
    $preco_bebida = $bebida['preco'];
    $subtotal_bebida = $preco_bebida * $quantidade_bebida;
    $total += $subtotal_bebida;

    $nome_bebida_str .= $nome_bebida . ',';
    $quantidades_bebidas_str .= $quantidade_bebida . ',';
}

// Remover a última vírgula das strings
$nome_prato_str = rtrim($nome_prato_str, ',');
$quantidades_pratos_str = rtrim($quantidades_pratos_str, ',');
$nome_bebida_str = rtrim($nome_bebida_str, ',');
$quantidades_bebidas_str = rtrim($quantidades_bebidas_str, ',');

// Inserir pedido no banco de dados
try {
    $pdo->beginTransaction();

    $stmt = $pdo->prepare('INSERT INTO pedidos (clientes_usuario, endereco, pagamento, total) VALUES (?, ?, ?, ?)');
    $stmt->execute([$cliente_usuario, $endereco, $pagamento, $total]);
    $idpedido = $pdo->lastInsertId();

    $stmt = $pdo->prepare('INSERT INTO itens_pedidos (pedidos_idpedidos, quantidade_bebida, quantidade_prato, nome_prato, nome_bebida) VALUES (?, ?, ?, ?, ?)');
    $stmt->execute([$idpedido, $quantidades_bebidas_str, $quantidades_pratos_str, $nome_prato_str, $nome_bebida_str]);

    $pdo->commit();
} catch (Exception $e) {
    $pdo->rollBack();
    echo "Falha ao cadastrar pedido: " . $e->getMessage();
    exit;
}

/*Gerar mensagem para o WhatsApp*/
$mensagem .= "Bom dia, Aqui está o meu pedido!" . "\n\n";
$total = 0;

foreach ($pratos as $prato) {
    $id = $prato['idpratos'];
    $quantidade = $_SESSION['carrinho'][$id]['quantidade'];
    $acompanhamentos = $_SESSION['carrinho'][$id]['acompanhamentos'];
    $descricao = $_SESSION['carrinho'][$id]['descricao'];
    $preco = $prato['preco'];
    $subtotal = $preco * $quantidade;
    $total += $subtotal;

    $mensagem .= "Prato: 🍽️ " . "\n" . $prato['nome'] . "\n";
    $mensagem .= "Acompanhamentos: " . implode(', ', $acompanhamentos) . "\n";
    $mensagem .= "Carnes do prato: " . implode(', ', $descricao) . "\n";
    $mensagem .= "Quantidade: " . $quantidade . "\n\n";
}

foreach ($bebidas as $bebida) {
    $id_bebida = $bebida['idbebidas'];
    $quantidade_bebida = $_SESSION['carrinho_bebida'][$id_bebida]['quantidade'];
    $descricao_bebida = $bebida['descricao'];
    $subtotal_bebida = $bebida['preco'] * $quantidade_bebida;
    $total += $subtotal_bebida;

    $mensagem .= "Bebida: 🍹" . "\n" . $bebida['nome'] . "\n";
    $mensagem .= "Descrição: " . $descricao_bebida . "\n";
    $mensagem .= "Quantidade: " . $quantidade_bebida . "\n\n";
}
$mensagem .= "*Total: R$ " . number_format($total, 2, ',', '.') . "*\n\n";
$mensagem .= "Endereço: " . $endereco . "\n";
$mensagem .= "Método de Pagamento: " . $pagamento;

// Agora codifica a mensagem inteira com urlencode
$mensagem = urlencode($mensagem);


// Redireciona para o WhatsApp com a mensagem formatada
header("Location: https://api.whatsapp.com/send?phone=$telefone&text=$mensagem");
exit;

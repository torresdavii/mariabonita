<?php
session_start();
$id = $_GET['id'];

// Verifica se o carrinho já existe na sessão
if (!isset($_SESSION['carrinho'])) {
    $_SESSION['carrinho'] = [];
}

// Verifica se o item já está no carrinho e garante que ele é um array
if (isset($_SESSION['carrinho'][$id])) {
    // Verifica se $_SESSION['carrinho'][$id] é um array, caso contrário, inicializa corretamente
    if (is_array($_SESSION['carrinho'][$id])) {
        $_SESSION['carrinho'][$id]['quantidade']++;
    } else {
        // Caso não seja um array (por algum erro), inicializa o item novamente
        $_SESSION['carrinho'][$id] = [
            'quantidade' => 1,
            'acompanhamentos' => $_POST['acompanhamentos'] ?? [],
            'descricao' => $_POST['descricao'] ?? []
        ];
    }
} else {
    // Se o item não estiver no carrinho, adiciona o item com seus dados
    $_SESSION['carrinho'][$id] = [
        'quantidade' => 1,
        'acompanhamentos' => $_POST['acompanhamentos'] ?? [],
        'descricao' => $_POST['descricao'] ?? []
    ];
}


// Redireciona para a página do carrinho
header('Location: carrinho.php');
exit;
?>




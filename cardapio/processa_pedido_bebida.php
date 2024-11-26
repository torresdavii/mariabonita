<?php
session_start();
$id_bebida = $_GET['idbebida'];

// Verifica se o carrinho já existe na sessão
if (!isset($_SESSION['carrinho_bebida'])) {
    $_SESSION['carrinho_bebida'] = [];
}



// Verifica se o item já está no carrinho e garante que ele é um array
if (isset($_SESSION['carrinho_bebida'][$id_bebida])) {
    // Verifica se $_SESSION['carrinho_bebida'][$id] é um array, caso contrário, inicializa corretamente
    if (is_array($_SESSION['carrinho_bebida'][$id_bebida])) {
        $_SESSION['carrinho_bebida'][$id_bebida]['quantidade']++;
    } else {
        // Caso não seja um array (por algum erro), inicializa o item novamente
        $_SESSION['carrinho_bebida'][$id_bebida] = [
            'quantidade' => 1
        ];
    }
} else {
    // Se o item não estiver no carrinho, adiciona o item com seus dados
    $_SESSION['carrinho_bebida'][$id_bebida] = [
        'quantidade' => 1
    ];
}

// Redireciona para a página do carrinho
header('Location: carrinho.php');
exit;
?>
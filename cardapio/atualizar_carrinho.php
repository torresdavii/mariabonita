<?php
session_start();
$id = $_GET['id'];
$id_bebida = $_GET['idbebida'];
$acao = $_GET['acao'];
$acao_bebida = $_GET['acao_bebida'];

if (isset($_SESSION['carrinho'][$id]['quantidade'])) {
    if ($acao == 'aumentar') {
        $_SESSION['carrinho'][$id]['quantidade']++;
    } elseif ($acao == 'diminuir') {
        $_SESSION['carrinho'][$id]['quantidade']--;
        if ($_SESSION['carrinho'][$id]['quantidade'] <= 0) {
            unset($_SESSION['carrinho'][$id]);
        }
    }
}

if (isset($_SESSION['carrinho_bebida'][$id_bebida]['quantidade'])) {
    if ($acao_bebida == 'aumentar') {
        $_SESSION['carrinho_bebida'][$id_bebida]['quantidade']++;
    } elseif ($acao_bebida == 'diminuir') {
        $_SESSION['carrinho_bebida'][$id_bebida]['quantidade']--;
        if ($_SESSION['carrinho_bebida'][$id_bebida]['quantidade'] <= 0) {
            unset($_SESSION['carrinho_bebida'][$id_bebida]);
        }
    }
}

header('Location: carrinho.php');


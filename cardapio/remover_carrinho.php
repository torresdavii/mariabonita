<?php
session_start();
$id = $_GET['id'];
if (isset($_SESSION['carrinho'][$id])) {
    unset($_SESSION['carrinho'][$id]);
}

$id_bebida = $_GET['idbebida'];
if (isset($_SESSION['carrinho_bebida'][$id_bebida])) {
    unset($_SESSION['carrinho_bebida'][$id_bebida]);
}
header('Location: carrinho.php');


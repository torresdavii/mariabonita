<?php
session_start();
if (!isset($_SESSION['nome'])) {
    header("Location: /mariabonita/login.php");
    exit();
}
?>
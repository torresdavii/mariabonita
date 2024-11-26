<?php
session_start(); // Iniciar a sessão

// 1. Estabelecer uma conexão com o BD
$conectar = mysqli_connect("localhost", "root", "", "mariabonita");

// 2. Receber o nome, a função, login e senha
$nome = $_POST["nome"];
$usuario = $_POST["usuario"];
$senha = $_POST["senha"];

// 3. Pesquisar no banco de dados se já existe o login que foi recebido acima
$sql_consulta = "SELECT usuario FROM clientes WHERE usuario = '$usuario'";
$resultado_consulta = mysqli_query($conectar, $sql_consulta);
$linhas = mysqli_num_rows($resultado_consulta);

if ($linhas == 1) {
    $response = array('status' => 'error', 'message' => 'Nome de usuário já cadastrado. Tente outro!');
} else {
    // Para o usuário que não existe
    $sql_cadastrar = "INSERT INTO clientes (nome, usuario, senha) VALUES ('$nome', '$usuario', '$senha')";
    $resultado_cadastrar = mysqli_query($conectar, $sql_cadastrar);

    if ($resultado_cadastrar == true) {
        $sql_consulta2 = "SELECT usuario, senha, nome, idclientes FROM clientes WHERE usuario = '$usuario' AND senha = '$senha'";

        $resultado_consulta2 = mysqli_query($conectar, $sql_consulta2);
        $linhas2 = mysqli_num_rows($resultado_consulta2);

        if ($linhas2 == 1) {
            $registro = mysqli_fetch_assoc($resultado_consulta2);
            $_SESSION["nome"] = $registro["nome"];
            $_SESSION["codigo"] = $registro["idclientes"];

            // Resposta JSON de sucesso
            $response = array('status' => 'success', 'message' => 'Usuário cadastrado com sucesso!');
        } else {
            // Resposta JSON de erro
            $response = array('status' => 'error', 'message' => 'Erro ao iniciar sessão. Tente novamente.');
        }
    } else {
        $response = array('status' => 'error', 'message' => 'Ocorreu um erro no servidor. Tente de novo.');
    }
}

echo json_encode($response);
?>



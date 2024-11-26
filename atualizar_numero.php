<?php

// Função para remover a formatação e deixar o número apenas com dígitos
function remover_formatacao($numero)
{
    return preg_replace('/\D/', '', $numero); // Remove todos os caracteres não numéricos
}

// Função para formatar o número (para exibir de forma legível)
function formatar_numero($numero)
{
    $numero = remover_formatacao($numero); // Remove a formatação primeiro

    // Verifica se o número já inclui o DDI +55 e remove se necessário
    if (strpos($numero, '55') === 0) {
        $numero = substr($numero, 2); // Remove o '55' inicial
    }

    // Verifica se o número tem 11 dígitos e formata
    if (strlen($numero) === 11) {
        return '+55 (' . substr($numero, 0, 2) . ') ' . substr($numero, 2, 1) . ' ' . substr($numero, 3, 4) . '-' . substr($numero, 7, 4);
    } else {
        return $numero; // Retorna o número sem formatação se não tiver 11 dígitos
    }
}



$config = include 'config.php';

// atualizar_numero.php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $novo_numero = $_POST['whatsapp_number'];

    // Remover a formatação e salvar o número no formato bruto (para uso na API)
    $config['whatsapp_number'] = remover_formatacao($novo_numero);

    // Atualiza o arquivo de configuração com o número bruto
    $conteudo = "<?php\nreturn " . var_export($config, true) . ";\n?>";
    file_put_contents('config.php', $conteudo);

    echo "Número de WhatsApp atualizado com sucesso!";
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Atualizar Número de WhatsApp</title>
    <script>
        function formatarNumero() {
            let input = document.getElementById('whatsapp_number');
            let numero = input.value.replace(/\D/g, ''); // Remove todos os caracteres não numéricos

            // Começa a formatação pelo DDI +55
            let formatado = '';
            if (numero.length > 0) {
                formatado = '+' + numero.substring(0, 2); // Adiciona o +55
            }

            // Adiciona o DDD (61)
            if (numero.length > 2) {
                formatado += ' (' + numero.substring(2, 4) + ') ';
            }

            // Adiciona o dígito 9
            if (numero.length > 4) {
                formatado += numero.substring(4, 5) + ' ';
            }

            // Adiciona os primeiros quatro números após o 9
            if (numero.length > 5) {
                formatado += numero.substring(5, 9) + '-';
            }

            // Adiciona os últimos quatro números
            if (numero.length > 9) {
                formatado += numero.substring(9, 13); // Captura os últimos 4 dígitos corretamente
            }

            input.value = formatado; // Atualiza o valor no input com a formatação
        }
    </script>
</head>

<body>
    <h1>Atualizar Número de WhatsApp</h1>
    <form method="POST">
        Número atual: <?php echo formatar_numero($config['whatsapp_number']) ?>
        <br>
        <label for="whatsapp_number">Novo Número de WhatsApp:</label>
        <input type="text" id="whatsapp_number" name="whatsapp_number" oninput="formatarNumero()" maxlength="20" required>
        <button type="submit">Atualizar</button>
    </form>
</body>

</html>
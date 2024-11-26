<?php
$config_url = include 'config_url.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $url = $_POST['instagram_url'];

    $config_url['instagram_url'] = $url;

    // Atualiza o arquivo de configuração com o número bruto
    $conteudo2 = "<?php\nreturn " . var_export($config_url, true) . ";\n?>";
    file_put_contents('config_url.php', $conteudo2);

    echo "<script>
        window.location.href = 'admin.php';

    </script>";
}

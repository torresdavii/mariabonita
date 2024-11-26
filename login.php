<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="icon" href="img/icon.png" type="image/png">
    <title>Maria Bonita - Login</title>
</head>

<body style="
    background-image: url('img/fundo.png');">

    <div class="video-background">
        <video autoplay muted loop>
            <source src="img/202004-916894674.mp4" type="video/mp4">

        </video>
    </div>
    <div class="container" id="container">
        <div class="form-container sign-up">
            <form class="form" id="formCadastro" method="post" action="processa_cadastra_login.php">
                <h1>Criar conta</h1>
                <input type="text" name="nome" placeholder="Nome" autocomplete="off" required>
                <input type="text" name="usuario" placeholder="Usuario" autocomplete="off" required>
                <input type="password" name="senha" placeholder="Senha - Min 5 caracteres, 1 número" autocomplete="off" minlength="5" pattern=".*[0-9].*" required>
                <button class="btn btn-second">criar</button>
            </form>
        </div>
        <div class="form-container sign-in">
            <form class="form" id="formLogin" method="post" action="processa_login.php">
                <h1>Entrar</h1>

                <input type="text" name="usuario" placeholder="Usuario" autocomplete="off">

                <input type="password" name="senha" placeholder="Senha" autocomplete="off">


                <button class="btn btn-second">entrar</button>
            </form>
        </div>
        <div class="toggle-container">
            <div class="toggle">
                <div class="toggle-panel toggle-left">
                    <h1>Já possui cadastro?</h1>
                    <p>Faça login e acesse o nosso cardápio</p>
                    <button class="hidden" id="login">Entrar</button>
                </div>
                <div class="toggle-panel toggle-right">
                    <h1>Não possui cadastro?</h1>
                    <p>Registre-se com seus dados pessoais e peça o melhor prato da cidade</p>
                    <button class="hidden" id="register">Criar</button>
                </div>
            </div>
        </div>
    </div>
    <div class="backpai">
        <div class="back">
            <a href="index.php">Continuar sem conta</a>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="js/script.js"></script>
</body>

</html>
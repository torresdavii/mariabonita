<?php
session_start();

$conectar = mysqli_connect("localhost", "root", "", "mariabonita");

require '../conexao.php';

if (!isset($_SESSION['carrinho'])) {
    $_SESSION['carrinho'] = [];
}

$ids = array_keys($_SESSION['carrinho']);
if (empty($ids)) {
    $pratos = [];
} else {
    $stmt = $pdo->query('SELECT * FROM pratos WHERE idpratos IN (' . implode(',', array_map('intval', $ids)) . ')');
    $pratos = $stmt->fetchAll(PDO::FETCH_ASSOC);
}

if (!isset($_SESSION['carrinho_bebida'])) {
    $_SESSION['carrinho_bebida'] = [];
}
$ids_bebida = array_keys($_SESSION['carrinho_bebida']);
if (empty($ids_bebida)) {
    $bebidas = [];
} else {
    $stmt = $pdo->query('SELECT * FROM bebidas WHERE idbebidas IN (' . implode(',', array_map('intval', $ids_bebida)) . ')');
    $bebidas = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
$cont_cart = 0;
foreach ($pratos as $prato):

    $id = $prato['idpratos'];
    $quantidade = $_SESSION['carrinho'][$id]['quantidade'];
    $cont_cart += $quantidade;
endforeach;

foreach ($bebidas as $bebida):
    $id_bebida = $bebida['idbebidas'];
    $quantidade_bebida = $_SESSION['carrinho_bebida'][$id_bebida]['quantidade'];
    $cont_cart += $quantidade_bebida;
endforeach;

?>


<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Maria Bonita - Cardápio</title>

    <link rel="stylesheet" href="../css/cardapio.css">
    <link rel="shortcut icon" href="../images/favicon.ico" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">
    <link rel="icon" href="../img/icon.png" type="image/png">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/typed.js/2.0.11/typed.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/waypoints/4.0.1/jquery.waypoints.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Sharp:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
</head>

<body>
    <div class="video-background" style="display: none;">
        <video autoplay muted loop>
            <source src="../img/202004-916894674.mp4" type="video/mp4">

        </video>
    </div>
    <div class="scroll-up-btn">
        <i class="fas fa-angle-up"></i>
    </div>
    <div class="overlay" id="overlay" onclick="closeMenu()"></div>

    <nav class="navbar">
        <div class="max-width">

            <div class="menu-icon" onclick="toggleMenu()">
                <div class="bar"></div>
                <div class="bar"></div>
                <div class="bar"></div>
            </div>
            <div class="logo">
                <a href="../index.php">
                    <img src="../img/logo.png">
                </a>
            </div>
            <div class="menu">
                <?php
                // Verifica se a variável de sessão "nome" está definida
                if (!isset($_SESSION["nome"])) {
                ?>
                    <ul class="menu" id="menu">
                        <li><a href="../index.php#home" class="menu-btn">Home</a></li>
                        <li><a href="../index.php#about" class="menu-btn">Sobre</a></li>
                        <li><a href="../index.php#time" class="menu-btn">Horários</a></li>
                        <li><a href="../cardapio/cardapio.php" class="menu-btn">Cardápio</a></li>
                        <li><a href="../cardapio/carrinho.php" class="menu-btn"><i class="fas fa-shopping-cart"></i> Carrinho</a></li>
                        <li><a href="../login.php"><button class="menu-login">Login</button></a></li>
                    </ul>
                <?php
                } elseif ($_SESSION["codigo"] == "1") {
                ?>
                    <ul class="menu" id="menu">
                        <li><a href="../admin.php" class="menu-btn">Administração</a></li>
                        <li><a href="../index.php#home" class="menu-btn">Home</a></li>
                        <li><a href="../index.php#about" class="menu-btn">Sobre</a></li>
                        <li><a href="../index.php#time" class="menu-btn">Horários</a></li>
                        <li><a href="../cardapio/cardapio.php" class="menu-btn">Cardápio</a></li>
                        <li><a href="../cardapio/carrinho.php" class="menu-btn"><i class="fas fa-shopping-cart"></i> Carrinho</a></li>
                        <li><a href="../logout.php" class="menu-btn">Sair</a></li>
                    </ul>
                <?php
                } else {
                ?>
                    <ul class="menu" id="menu">
                        <li><a href="../index.php#home" class="menu-btn">Home</a></li>
                        <li><a href="../index.php#about" class="menu-btn">Sobre</a></li>
                        <li><a href="../index.php#time" class="menu-btn">Horários</a></li>
                        <li><a href="../cardapio/cardapio.php" class="menu-btn">Cardápio</a></li>
                        <li><a href="../cardapio/carrinho.php" class="menu-btn"><i class="fas fa-shopping-cart"></i> Carrinho</a></li>
                        <li><a href="../logout.php" class="menu-btn">Sair</a></li>
                    </ul>
                <?php
                }
                ?>
            </div>
            <script>
                function toggleMenu() {
                    const menu = document.getElementById('menu');
                    const overlay = document.getElementById('overlay');

                    // Verifica se o menu está aberto
                    if (menu.classList.contains('show-menu')) {
                        closeMenu(); // Se estiver aberto, fecha o menu
                    } else {
                        menu.classList.add('show-menu'); // Exibe o menu
                        overlay.classList.add('show-overlay'); // Exibe a sobreposição (overlay)
                    }
                }

                function closeMenu() {
                    const menu = document.getElementById('menu');
                    const overlay = document.getElementById('overlay');

                    menu.classList.remove('show-menu'); // Esconde o menu
                    overlay.classList.remove('show-overlay'); // Esconde a sobreposição (overlay)
                }
            </script>
            <div class="menu-cart">
                <a href="carrinho.php"><i class="fas fa-shopping-cart"></i><span><?php echo $cont_cart ?></span></a>
            </div>
        </div>
    </nav>
    <section class="home" id="home">
        <div class="max-width">
            <div class="home-content">
                <div class="text-2"><img src="../img/cacto.png">Cardápio</div>
                <br><br>
                <div class="text-3">Monte o seu prato ideal!</div>
            </div>
        </div>
        <div class="arrow">
            <a href="#about"><span class="material-symbols-sharp">south</span></a>
        </div>
    </section>

    <section class="about" id="about">
        <h1>Escolha o cardápio do dia</h1><br>
        <div class="container">

            <button class="calendario" onclick="showMenu('segunda', this)">Segunda</button>
            <button class="calendario" onclick="showMenu('terca', this)">Terça</button>
            <button class="calendario" onclick="showMenu('quarta', this)">Quarta</button>
            <button class="calendario" onclick="showMenu('quinta', this)">Quinta</button>
            <button class="calendario" onclick="showMenu('sexta', this)">Sexta</button>
            <button class="calendario" onclick="showMenu('sabado', this)">Sábado</button>

        </div>



        <div id="segunda" class="menu-dia" style="display:none;">

            <!-- Conteúdo do cardápio de segunda -->

            <?php
            $sql_consulta = "SELECT 
                        nome, 
                        acompanhamentos, 
                        idpratos,
                        foto,
                        preco,
                        tipoCarne,
                        condicao
                    FROM 
                        pratos
                    WHERE 
                        diaSemana = 'segunda';";
            $resultado_consulta = mysqli_query($conectar, $sql_consulta);
            ?>

            <div class="cardapio-container">
                <?php while ($registro = mysqli_fetch_row($resultado_consulta)) :
                    $disabledClass = $registro[6] === 'disabled' ? 'disabled' : '';
                    $userLoggedIn = isset($_SESSION['nome']) && $_SESSION['nome'];
                ?>
                    <button class="cardapio-item <?= $disabledClass ?>" style="border:none;" onclick="abrirModal(event, <?= $registro[2] ?>, '<?= $registro[6] ?>')">
                        <img src="<?= $registro[3] ?>" alt="<?= $registro[0] ?>">
                        <div class="cardapio-title"><?= $registro[0] ?></div>
                        <div class="cardapio-description"><?= $registro[1] ?></div>
                    </button>

                    <!-- Modal structure -->
                    <div id="modal_<?= $registro[2] ?>" class="modal">
                        <div class="modal-content">
                            <div class="left-content">
                                <img src="<?= $registro[3] ?>" alt="<?= $registro[0] ?>">
                            </div>
                            <div class="right-content">
                                <h2><?= $registro[0] ?></h2>

                                <form id="opcao" method="post" action="processa_pedido.php?id=<?= $registro[2] ?>">
                                    <div class="formulario">
                                        <div class="scrollable-content">
                                            <p>Acompanhamentos:</p><br>
                                            <?php
                                            $itens = explode(",", $registro[1]);
                                            $itens = array_map('trim', $itens);
                                            foreach ($itens as $item) : ?>
                                                <label>
                                                    <input type="checkbox" name="acompanhamentos[]" value="<?= $item ?>" checked>&nbsp;
                                                    <?= $item ?>
                                                </label><br>
                                            <?php endforeach; ?>

                                            <br><br>
                                            <p>Escolha a carne:</p><br>
                                            <?php
                                            $dados = explode(",", $registro[5]);
                                            $dados = array_map('trim', $dados);
                                            foreach ($dados as $dado) : ?>
                                                <label>
                                                    <input id="enviar" type="checkbox" name="descricao[]" value="<?= $dado ?>" checked>&nbsp;
                                                    <?= $dado ?>
                                                </label><br>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>

                                    <br>
                                    <hr>
                                    <div class="end">

                                        <h3>
                                            <p>Valor:</p>R$<?= number_format($registro[4], 2, ',', '.') ?>

                                        </h3>

                                        <button id="addToCartBtn" class="cta-button">
                                            <?= $userLoggedIn ? 'Adicionar ao Carrinho' : 'Faça login e peça agora!' ?>
                                        </button>
                                    </div>
                                </form>
                            </div>
                            <span class="close" onclick="fecharModal(<?= $registro[2] ?>)">&times;</span><br>
                        </div>
                    </div>
                <?php endwhile; ?>

                <div id="alerta" class="alerta">
                    <div class="icone_container">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                            <path fill="#3e733b" d="M256 32c14.2 0 27.3 7.5 34.5 19.8l216 368c7.3 12.4 7.3 27.7 .2 40.1S486.3 480 472 480L40 480c-14.3 0-27.6-7.7-34.7-20.1s-7-27.8 .2-40.1l216-368C228.7 39.5 241.8 32 256 32zm0 128c-13.3 0-24 10.7-24 24l0 112c0 13.3 10.7 24 24 24s24-10.7 24-24l0-112c0-13.3-10.7-24-24-24zm32 224a32 32 0 1 0 -64 0 32 32 0 1 0 64 0z" />
                        </svg>
                    </div>
                    <h2 class="titulo">Prato indisponível no momento!</h2>
                </div>
            </div>



        </div>
        <div id="terca" class="menu-dia" style="display:none;">

            <!-- Conteúdo do cardápio de segunda -->

            <?php
            $sql_consulta = "SELECT 
                        nome, 
                        acompanhamentos, 
                        idpratos,
                        foto,
                        preco,
                        tipoCarne,
                        condicao
                    FROM 
                        pratos
                    WHERE 
                        diaSemana = 'terca';";
            $resultado_consulta = mysqli_query($conectar, $sql_consulta);
            ?>

            <div class="cardapio-container">
                <?php while ($registro = mysqli_fetch_row($resultado_consulta)) :
                    $disabledClass = $registro[6] === 'disabled' ? 'disabled' : '';
                    $userLoggedIn = isset($_SESSION['nome']) && $_SESSION['nome'];
                ?>
                    <button class="cardapio-item <?= $disabledClass ?>" style="border:none;" onclick="abrirModal(event, <?= $registro[2] ?>, '<?= $registro[6] ?>')">
                        <img src="<?= $registro[3] ?>" alt="<?= $registro[0] ?>">
                        <div class="cardapio-title"><?= $registro[0] ?></div>
                        <div class="cardapio-description"><?= $registro[1] ?></div>
                    </button>

                    <!-- Modal structure -->
                    <div id="modal_<?= $registro[2] ?>" class="modal">
                        <div class="modal-content">
                            <div class="left-content">
                                <img src="<?= $registro[3] ?>" alt="<?= $registro[0] ?>">
                            </div>
                            <div class="right-content">
                                <h2><?= $registro[0] ?></h2>

                                <form id="opcao" method="post" action="processa_pedido.php?id=<?= $registro[2] ?>">
                                    <div class="formulario">
                                        <div class="scrollable-content">
                                            <p>Acompanhamentos:</p><br>
                                            <?php
                                            $itens = explode(",", $registro[1]);
                                            $itens = array_map('trim', $itens);
                                            foreach ($itens as $item) : ?>
                                                <label>
                                                    <input type="checkbox" name="acompanhamentos[]" value="<?= $item ?>" checked>&nbsp;
                                                    <?= $item ?>
                                                </label><br>
                                            <?php endforeach; ?>

                                            <br><br>
                                            <p>Escolha a carne:</p><br>
                                            <?php
                                            $dados = explode(",", $registro[5]);
                                            $dados = array_map('trim', $dados);
                                            foreach ($dados as $dado) : ?>
                                                <label>
                                                    <input id="enviar" type="checkbox" name="descricao[]" value="<?= $dado ?>" checked>&nbsp;
                                                    <?= $dado ?>
                                                </label><br>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>

                                    <br>
                                    <hr>
                                    <div class="end">

                                        <h3>
                                            <p>Valor:</p>R$<?= number_format($registro[4], 2, ',', '.') ?>

                                        </h3>

                                        <button id="addToCartBtn" class="cta-button">
                                            <?= $userLoggedIn ? 'Adicionar ao Carrinho' : 'Faça login e peça agora!' ?>
                                        </button>
                                    </div>
                                </form>
                            </div>
                            <span class="close" onclick="fecharModal(<?= $registro[2] ?>)">&times;</span><br>
                        </div>
                    </div>
                <?php endwhile; ?>

                <div id="alerta" class="alerta">
                    <div class="icone_container">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                            <path fill="#3e733b" d="M256 32c14.2 0 27.3 7.5 34.5 19.8l216 368c7.3 12.4 7.3 27.7 .2 40.1S486.3 480 472 480L40 480c-14.3 0-27.6-7.7-34.7-20.1s-7-27.8 .2-40.1l216-368C228.7 39.5 241.8 32 256 32zm0 128c-13.3 0-24 10.7-24 24l0 112c0 13.3 10.7 24 24 24s24-10.7 24-24l0-112c0-13.3-10.7-24-24-24zm32 224a32 32 0 1 0 -64 0 32 32 0 1 0 64 0z" />
                        </svg>
                    </div>
                    <h2 class="titulo">Prato indisponível no momento!</h2>
                </div>
            </div>



        </div>
        <div id="quarta" class="menu-dia" style="display:none;">

            <!-- Conteúdo do cardápio de segunda -->

            <?php
            $sql_consulta = "SELECT 
                        nome, 
                        acompanhamentos, 
                        idpratos,
                        foto,
                        preco,
                        tipoCarne,
                        condicao
                    FROM 
                        pratos
                    WHERE 
                        diaSemana = 'quarta';";
            $resultado_consulta = mysqli_query($conectar, $sql_consulta);
            ?>

            <div class="cardapio-container">
                <?php while ($registro = mysqli_fetch_row($resultado_consulta)) :
                    $disabledClass = $registro[6] === 'disabled' ? 'disabled' : '';
                    $userLoggedIn = isset($_SESSION['nome']) && $_SESSION['nome'];
                ?>
                    <button class="cardapio-item <?= $disabledClass ?>" style="border:none;" onclick="abrirModal(event, <?= $registro[2] ?>, '<?= $registro[6] ?>')">
                        <img src="<?= $registro[3] ?>" alt="<?= $registro[0] ?>">
                        <div class="cardapio-title"><?= $registro[0] ?></div>
                        <div class="cardapio-description"><?= $registro[1] ?></div>
                    </button>

                    <!-- Modal structure -->
                    <div id="modal_<?= $registro[2] ?>" class="modal">
                        <div class="modal-content">
                            <div class="left-content">
                                <img src="<?= $registro[3] ?>" alt="<?= $registro[0] ?>">
                            </div>
                            <div class="right-content">
                                <h2><?= $registro[0] ?></h2>

                                <form id="opcao" method="post" action="processa_pedido.php?id=<?= $registro[2] ?>">
                                    <div class="formulario">
                                        <div class="scrollable-content">
                                            <p>Acompanhamentos:</p><br>
                                            <?php
                                            $itens = explode(",", $registro[1]);
                                            $itens = array_map('trim', $itens);
                                            foreach ($itens as $item) : ?>
                                                <label>
                                                    <input type="checkbox" name="acompanhamentos[]" value="<?= $item ?>" checked>&nbsp;
                                                    <?= $item ?>
                                                </label><br>
                                            <?php endforeach; ?>

                                            <br><br>
                                            <p>Escolha a carne:</p><br>
                                            <?php
                                            $dados = explode(",", $registro[5]);
                                            $dados = array_map('trim', $dados);
                                            foreach ($dados as $dado) : ?>
                                                <label>
                                                    <input id="enviar" type="checkbox" name="descricao[]" value="<?= $dado ?>" checked>&nbsp;
                                                    <?= $dado ?>
                                                </label><br>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>

                                    <br>
                                    <hr>
                                    <div class="end">

                                        <h3>
                                            <p>Valor:</p>R$<?= number_format($registro[4], 2, ',', '.') ?>

                                        </h3>

                                        <button id="addToCartBtn" class="cta-button">
                                            <?= $userLoggedIn ? 'Adicionar ao Carrinho' : 'Faça login e peça agora!' ?>
                                        </button>
                                    </div>
                                </form>
                            </div>
                            <span class="close" onclick="fecharModal(<?= $registro[2] ?>)">&times;</span><br>
                        </div>
                    </div>
                <?php endwhile; ?>

                <div id="alerta" class="alerta">
                    <div class="icone_container">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                            <path fill="#3e733b" d="M256 32c14.2 0 27.3 7.5 34.5 19.8l216 368c7.3 12.4 7.3 27.7 .2 40.1S486.3 480 472 480L40 480c-14.3 0-27.6-7.7-34.7-20.1s-7-27.8 .2-40.1l216-368C228.7 39.5 241.8 32 256 32zm0 128c-13.3 0-24 10.7-24 24l0 112c0 13.3 10.7 24 24 24s24-10.7 24-24l0-112c0-13.3-10.7-24-24-24zm32 224a32 32 0 1 0 -64 0 32 32 0 1 0 64 0z" />
                        </svg>
                    </div>
                    <h2 class="titulo">Prato indisponível no momento!</h2>
                </div>
            </div>



        </div>
        <div id="quinta" class="menu-dia" style="display:none;">

            <!-- Conteúdo do cardápio de segunda -->

            <?php
            $sql_consulta = "SELECT 
                        nome, 
                        acompanhamentos, 
                        idpratos,
                        foto,
                        preco,
                        tipoCarne,
                        condicao
                    FROM 
                        pratos
                    WHERE 
                        diaSemana = 'quinta';";
            $resultado_consulta = mysqli_query($conectar, $sql_consulta);
            ?>

            <div class="cardapio-container">
                <?php while ($registro = mysqli_fetch_row($resultado_consulta)) :
                    $disabledClass = $registro[6] === 'disabled' ? 'disabled' : '';
                    $userLoggedIn = isset($_SESSION['nome']) && $_SESSION['nome'];
                ?>
                    <button class="cardapio-item <?= $disabledClass ?>" style="border:none;" onclick="abrirModal(event, <?= $registro[2] ?>, '<?= $registro[6] ?>')">
                        <img src="<?= $registro[3] ?>" alt="<?= $registro[0] ?>">
                        <div class="cardapio-title"><?= $registro[0] ?></div>
                        <div class="cardapio-description"><?= $registro[1] ?></div>
                    </button>

                    <!-- Modal structure -->
                    <div id="modal_<?= $registro[2] ?>" class="modal">
                        <div class="modal-content">
                            <div class="left-content">
                                <img src="<?= $registro[3] ?>" alt="<?= $registro[0] ?>">
                            </div>
                            <div class="right-content">
                                <h2><?= $registro[0] ?></h2>

                                <form id="opcao" method="post" action="processa_pedido.php?id=<?= $registro[2] ?>">
                                    <div class="formulario">
                                        <div class="scrollable-content">
                                            <p>Acompanhamentos:</p><br>
                                            <?php
                                            $itens = explode(",", $registro[1]);
                                            $itens = array_map('trim', $itens);
                                            foreach ($itens as $item) : ?>
                                                <label>
                                                    <input type="checkbox" name="acompanhamentos[]" value="<?= $item ?>" checked>&nbsp;
                                                    <?= $item ?>
                                                </label><br>
                                            <?php endforeach; ?>

                                            <br><br>
                                            <p>Escolha a carne:</p><br>
                                            <?php
                                            $dados = explode(",", $registro[5]);
                                            $dados = array_map('trim', $dados);
                                            foreach ($dados as $dado) : ?>
                                                <label>
                                                    <input id="enviar" type="checkbox" name="descricao[]" value="<?= $dado ?>" checked>&nbsp;
                                                    <?= $dado ?>
                                                </label><br>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>

                                    <br>
                                    <hr>
                                    <div class="end">

                                        <h3>
                                            <p>Valor:</p>R$<?= number_format($registro[4], 2, ',', '.') ?>

                                        </h3>

                                        <button id="addToCartBtn" class="cta-button">
                                            <?= $userLoggedIn ? 'Adicionar ao Carrinho' : 'Faça login e peça agora!' ?>
                                        </button>
                                    </div>
                                </form>
                            </div>
                            <span class="close" onclick="fecharModal(<?= $registro[2] ?>)">&times;</span><br>
                        </div>
                    </div>
                <?php endwhile; ?>

                <div id="alerta" class="alerta">
                    <div class="icone_container">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                            <path fill="#3e733b" d="M256 32c14.2 0 27.3 7.5 34.5 19.8l216 368c7.3 12.4 7.3 27.7 .2 40.1S486.3 480 472 480L40 480c-14.3 0-27.6-7.7-34.7-20.1s-7-27.8 .2-40.1l216-368C228.7 39.5 241.8 32 256 32zm0 128c-13.3 0-24 10.7-24 24l0 112c0 13.3 10.7 24 24 24s24-10.7 24-24l0-112c0-13.3-10.7-24-24-24zm32 224a32 32 0 1 0 -64 0 32 32 0 1 0 64 0z" />
                        </svg>
                    </div>
                    <h2 class="titulo">Prato indisponível no momento!</h2>
                </div>
            </div>



        </div>
        <div id="sexta" class="menu-dia" style="display:none;">

            <!-- Conteúdo do cardápio de segunda -->

            <?php
            $sql_consulta = "SELECT 
                        nome, 
                        acompanhamentos, 
                        idpratos,
                        foto,
                        preco,
                        tipoCarne,
                        condicao
                    FROM 
                        pratos
                    WHERE 
                        diaSemana = 'sexta';";
            $resultado_consulta = mysqli_query($conectar, $sql_consulta);
            ?>

            <div class="cardapio-container">
                <?php while ($registro = mysqli_fetch_row($resultado_consulta)) :
                    $disabledClass = $registro[6] === 'disabled' ? 'disabled' : '';
                    $userLoggedIn = isset($_SESSION['nome']) && $_SESSION['nome'];
                ?>
                    <button class="cardapio-item <?= $disabledClass ?>" style="border:none;" onclick="abrirModal(event, <?= $registro[2] ?>, '<?= $registro[6] ?>')">
                        <img src="<?= $registro[3] ?>" alt="<?= $registro[0] ?>">
                        <div class="cardapio-title"><?= $registro[0] ?></div>
                        <div class="cardapio-description"><?= $registro[1] ?></div>
                    </button>

                    <!-- Modal structure -->
                    <div id="modal_<?= $registro[2] ?>" class="modal">
                        <div class="modal-content">
                            <div class="left-content">
                                <img src="<?= $registro[3] ?>" alt="<?= $registro[0] ?>">
                            </div>
                            <div class="right-content">
                                <h2><?= $registro[0] ?></h2>

                                <form id="opcao" method="post" action="processa_pedido.php?id=<?= $registro[2] ?>">
                                    <div class="formulario">
                                        <div class="scrollable-content">
                                            <p>Acompanhamentos:</p><br>
                                            <?php
                                            $itens = explode(",", $registro[1]);
                                            $itens = array_map('trim', $itens);
                                            foreach ($itens as $item) : ?>
                                                <label>
                                                    <input type="checkbox" name="acompanhamentos[]" value="<?= $item ?>" checked>&nbsp;
                                                    <?= $item ?>
                                                </label><br>
                                            <?php endforeach; ?>

                                            <br><br>
                                            <p>Escolha a carne:</p><br>
                                            <?php
                                            $dados = explode(",", $registro[5]);
                                            $dados = array_map('trim', $dados);
                                            foreach ($dados as $dado) : ?>
                                                <label>
                                                    <input id="enviar" type="checkbox" name="descricao[]" value="<?= $dado ?>" checked>&nbsp;
                                                    <?= $dado ?>
                                                </label><br>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>

                                    <br>
                                    <hr>
                                    <div class="end">

                                        <h3>
                                            <p>Valor:</p>R$<?= number_format($registro[4], 2, ',', '.') ?>

                                        </h3>

                                        <button id="addToCartBtn" class="cta-button">
                                            <?= $userLoggedIn ? 'Adicionar ao Carrinho' : 'Faça login e peça agora!' ?>
                                        </button>
                                    </div>
                                </form>
                            </div>
                            <span class="close" onclick="fecharModal(<?= $registro[2] ?>)">&times;</span><br>
                        </div>
                    </div>
                <?php endwhile; ?>

                <div id="alerta" class="alerta">
                    <div class="icone_container">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                            <path fill="#3e733b" d="M256 32c14.2 0 27.3 7.5 34.5 19.8l216 368c7.3 12.4 7.3 27.7 .2 40.1S486.3 480 472 480L40 480c-14.3 0-27.6-7.7-34.7-20.1s-7-27.8 .2-40.1l216-368C228.7 39.5 241.8 32 256 32zm0 128c-13.3 0-24 10.7-24 24l0 112c0 13.3 10.7 24 24 24s24-10.7 24-24l0-112c0-13.3-10.7-24-24-24zm32 224a32 32 0 1 0 -64 0 32 32 0 1 0 64 0z" />
                        </svg>
                    </div>
                    <h2 class="titulo">Prato indisponível no momento!</h2>
                </div>
            </div>



        </div>
        <div id="sabado" class="menu-dia" style="display:none;">

            <!-- Conteúdo do cardápio de segunda -->

            <?php
            $sql_consulta = "SELECT 
                        nome, 
                        acompanhamentos, 
                        idpratos,
                        foto,
                        preco,
                        tipoCarne,
                        condicao
                    FROM 
                        pratos
                    WHERE 
                        diaSemana = 'sabado';";
            $resultado_consulta = mysqli_query($conectar, $sql_consulta);
            ?>

            <div class="cardapio-container">
                <?php while ($registro = mysqli_fetch_row($resultado_consulta)) :
                    $disabledClass = $registro[6] === 'disabled' ? 'disabled' : '';
                    $userLoggedIn = isset($_SESSION['nome']) && $_SESSION['nome'];
                ?>
                    <button class="cardapio-item <?= $disabledClass ?>" style="border:none;" onclick="abrirModal(event, <?= $registro[2] ?>, '<?= $registro[6] ?>')">
                        <img src="<?= $registro[3] ?>" alt="<?= $registro[0] ?>">
                        <div class="cardapio-title"><?= $registro[0] ?></div>
                        <div class="cardapio-description"><?= $registro[1] ?></div>
                    </button>

                    <!-- Modal structure -->
                    <div id="modal_<?= $registro[2] ?>" class="modal">
                        <div class="modal-content">
                            <div class="left-content">
                                <img src="<?= $registro[3] ?>" alt="<?= $registro[0] ?>">
                            </div>
                            <div class="right-content">
                                <h2><?= $registro[0] ?></h2>

                                <form id="opcao" method="post" action="processa_pedido.php?id=<?= $registro[2] ?>">
                                    <div class="formulario">
                                        <div class="scrollable-content">
                                            <p>Acompanhamentos:</p><br>
                                            <?php
                                            $itens = explode(",", $registro[1]);
                                            $itens = array_map('trim', $itens);
                                            foreach ($itens as $item) : ?>
                                                <label>
                                                    <input type="checkbox" name="acompanhamentos[]" value="<?= $item ?>" checked>&nbsp;
                                                    <?= $item ?>
                                                </label><br>
                                            <?php endforeach; ?>

                                            <br><br>
                                            <p>Escolha a carne:</p><br>
                                            <?php
                                            $dados = explode(",", $registro[5]);
                                            $dados = array_map('trim', $dados);
                                            foreach ($dados as $dado) : ?>
                                                <label>
                                                    <input id="enviar" type="checkbox" name="descricao[]" value="<?= $dado ?>" checked>&nbsp;
                                                    <?= $dado ?>
                                                </label><br>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>

                                    <br>
                                    <hr>
                                    <div class="end">

                                        <h3>
                                            <p>Valor:</p>R$<?= number_format($registro[4], 2, ',', '.') ?>

                                        </h3>

                                        <button id="addToCartBtn" class="cta-button">
                                            <?= $userLoggedIn ? 'Adicionar ao Carrinho' : 'Faça login e peça agora!' ?>
                                        </button>
                                    </div>
                                </form>
                            </div>
                            <span class="close" onclick="fecharModal(<?= $registro[2] ?>)">&times;</span><br>
                        </div>
                    </div>
                <?php endwhile; ?>

                <div id="alerta" class="alerta">
                    <div class="icone_container">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                            <path fill="#3e733b" d="M256 32c14.2 0 27.3 7.5 34.5 19.8l216 368c7.3 12.4 7.3 27.7 .2 40.1S486.3 480 472 480L40 480c-14.3 0-27.6-7.7-34.7-20.1s-7-27.8 .2-40.1l216-368C228.7 39.5 241.8 32 256 32zm0 128c-13.3 0-24 10.7-24 24l0 112c0 13.3 10.7 24 24 24s24-10.7 24-24l0-112c0-13.3-10.7-24-24-24zm32 224a32 32 0 1 0 -64 0 32 32 0 1 0 64 0z" />
                        </svg>
                    </div>
                    <h2 class="titulo">Prato indisponível no momento!</h2>
                </div>
            </div>



        </div>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Seleciona todos os botões de "Adicionar ao Carrinho"
            const addToCartButtons = document.querySelectorAll('.cta-button');
            const userLoggedIn = <?php echo json_encode($userLoggedIn); ?>;

            addToCartButtons.forEach(button => {
                button.addEventListener('click', (event) => {
                    if (!userLoggedIn) {
                        event.preventDefault(); // Impede o envio do formulário
                        window.location.href = '../login.php'; // Redireciona para a página de login
                    } else {
                        const form = button.closest('form'); // Encontra o formulário mais próximo do botão
                        form.submit(); // Envia o formulário para processar o pedido
                    }
                });
            });
        });
    </script>

    <section class="about bebidas" id="about bebidas" style="background-color:black;">
        <h1>Bebidas</h1><br>
        <div class="container">
            <button id="button1" class="button" onclick="showContent('content1', 'button1')">Refrigerantes</button>
            <button id="button2" class="button" onclick="showContent('content2', 'button2')">Sucos</button>
            <button id="button3" class="button" onclick="showContent('content3', 'button3')">Água</button>
        </div>

        <div id="content1" class="content active">
            <!-- Conteúdo  -->

            <?php
            $sql_consulta = "SELECT 
                        nome, 
                        descricao, 
                        idbebidas,
                        foto,
                        preco,
                        condicao

                    FROM 
                        bebidas
                    WHERE 
                        tipo = 'refrigerante';";
            $resultado_consulta = mysqli_query($conectar, $sql_consulta);
            ?>

            <div class="cardapio-container">
                <?php while ($registro = mysqli_fetch_row($resultado_consulta)) :
                    $disabledClass = $registro[5] === 'disabled' ? 'disabled' : '';
                    $userLoggedIn = isset($_SESSION['nome']) && $_SESSION['nome'];
                ?>
                    <button class="cardapio-item bebida <?= $disabledClass ?>" style="border:none;" onclick="abrirModelo(event, <?= $registro[2] ?>, '<?= $registro[5] ?>')">
                        <img src="<?= $registro[3] ?>" alt="<?= $registro[0] ?>">
                        <div class="cardapio-title bebida"><?= $registro[0] ?></div>
                        <div class="cardapio-description bebida"><?= $registro[1] ?></div>
                    </button>

                    <!-- Modal structure -->
                    <div id="modelo_<?= $registro[2] ?>" class="modal">
                        <div class="modal-content" style="background-color: #111;">
                            <div class="left-content">
                                <img src="<?= $registro[3] ?>" alt="<?= $registro[0] ?>">
                            </div>
                            <div class="right-content">
                                <h2><?= $registro[0] ?></h2>

                                <div class="bebidas-content">
                                    <h3> Descrição:</h3>
                                    <h4><?= $registro[1] ?></h4>

                                    <h3> Valor:</h3>
                                    <h4><mark style="background-color: #3e733b;">R$<?= number_format($registro[4], 2, ',', '.') ?></mark></h4>
                                </div>
                                <a href="processa_pedido_bebida.php?idbebida=<?= $registro[2] ?>" id="addToCartBtn" class="cta-button" style="margin: 0 auto; width: 75%;">
                                    <?= $userLoggedIn ? 'Adicionar ao Carrinho' : 'Faça login e peça agora!' ?>

                                </a>
                            </div>
                            <span class="close" onclick="fecharModelo(<?= $registro[2] ?>)">&times;</span><br>
                        </div>
                    </div>
                <?php endwhile; ?>

                <div id="alerta_bebida" class="alerta">
                    <div class="icone_container">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                            <path fill="#3e733b" d="M256 32c14.2 0 27.3 7.5 34.5 19.8l216 368c7.3 12.4 7.3 27.7 .2 40.1S486.3 480 472 480L40 480c-14.3 0-27.6-7.7-34.7-20.1s-7-27.8 .2-40.1l216-368C228.7 39.5 241.8 32 256 32zm0 128c-13.3 0-24 10.7-24 24l0 112c0 13.3 10.7 24 24 24s24-10.7 24-24l0-112c0-13.3-10.7-24-24-24zm32 224a32 32 0 1 0 -64 0 32 32 0 1 0 64 0z" />
                        </svg>
                    </div>
                    <h2 class="titulo">Bebida indisponível no momento!</h2>
                </div>
            </div>
        </div>
        <div id="content2" class="content active">
            <!-- Conteúdo  -->

            <?php
            $sql_consulta = "SELECT 
                        nome, 
                        descricao, 
                        idbebidas,
                        foto,
                        preco,
                        condicao

                    FROM 
                        bebidas
                    WHERE 
                        tipo = 'suco';";
            $resultado_consulta = mysqli_query($conectar, $sql_consulta);
            ?>

            <div class="cardapio-container">
                <?php while ($registro = mysqli_fetch_row($resultado_consulta)) :
                    $disabledClass = $registro[5] === 'disabled' ? 'disabled' : '';
                    $userLoggedIn = isset($_SESSION['nome']) && $_SESSION['nome'];
                ?>
                    <button class="cardapio-item bebida <?= $disabledClass ?>" style="border:none;" onclick="abrirModelo(event, <?= $registro[2] ?>, '<?= $registro[5] ?>')">
                        <img src="<?= $registro[3] ?>" alt="<?= $registro[0] ?>">
                        <div class="cardapio-title bebida"><?= $registro[0] ?></div>
                        <div class="cardapio-description bebida"><?= $registro[1] ?></div>
                    </button>

                    <!-- Modal structure -->
                    <div id="modelo_<?= $registro[2] ?>" class="modal">
                        <div class="modal-content" style="background-color: #111;">
                            <div class="left-content">
                                <img src="<?= $registro[3] ?>" alt="<?= $registro[0] ?>">
                            </div>
                            <div class="right-content">
                                <h2><?= $registro[0] ?></h2>

                                <div class="bebidas-content">
                                    <h3> Descrição:</h3>
                                    <h4><?= $registro[1] ?></h4>

                                    <h3> Valor:</h3>
                                    <h4><mark style="background-color: #3e733b;">R$<?= number_format($registro[4], 2, ',', '.') ?></mark></h4>
                                </div>
                                <a href="processa_pedido_bebida.php?idbebida=<?= $registro[2] ?>" id="addToCartBtn" class="cta-button" style="margin: 0 auto; width: 75%;">
                                    <?= $userLoggedIn ? 'Adicionar ao Carrinho' : 'Faça login e peça agora!' ?>

                                </a>
                            </div>
                            <span class="close" onclick="fecharModelo(<?= $registro[2] ?>)">&times;</span><br>
                        </div>
                    </div>
                <?php endwhile; ?>

                <div id="alerta_bebida" class="alerta">
                    <div class="icone_container">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                            <path fill="#3e733b" d="M256 32c14.2 0 27.3 7.5 34.5 19.8l216 368c7.3 12.4 7.3 27.7 .2 40.1S486.3 480 472 480L40 480c-14.3 0-27.6-7.7-34.7-20.1s-7-27.8 .2-40.1l216-368C228.7 39.5 241.8 32 256 32zm0 128c-13.3 0-24 10.7-24 24l0 112c0 13.3 10.7 24 24 24s24-10.7 24-24l0-112c0-13.3-10.7-24-24-24zm32 224a32 32 0 1 0 -64 0 32 32 0 1 0 64 0z" />
                        </svg>
                    </div>
                    <h2 class="titulo">Bebida indisponível no momento!</h2>
                </div>
            </div>
        </div>
        <div id="content3" class="content active">
            <!-- Conteúdo  -->

            <?php
            $sql_consulta = "SELECT 
                        nome, 
                        descricao, 
                        idbebidas,
                        foto,
                        preco,
                        condicao

                    FROM 
                        bebidas
                    WHERE 
                        tipo = 'agua';";
            $resultado_consulta = mysqli_query($conectar, $sql_consulta);
            ?>

            <div class="cardapio-container">
                <?php while ($registro = mysqli_fetch_row($resultado_consulta)) :
                    $disabledClass = $registro[5] === 'disabled' ? 'disabled' : '';
                    $userLoggedIn = isset($_SESSION['nome']) && $_SESSION['nome'];
                ?>
                    <button class="cardapio-item bebida <?= $disabledClass ?>" style="border:none;" onclick="abrirModelo(event, <?= $registro[2] ?>, '<?= $registro[5] ?>')">
                        <img src="<?= $registro[3] ?>" alt="<?= $registro[0] ?>">
                        <div class="cardapio-title bebida"><?= $registro[0] ?></div>
                        <div class="cardapio-description bebida"><?= $registro[1] ?></div>
                    </button>

                    <!-- Modal structure -->
                    <div id="modelo_<?= $registro[2] ?>" class="modal">
                        <div class="modal-content" style="background-color: #111;">
                            <div class="left-content">
                                <img src="<?= $registro[3] ?>" alt="<?= $registro[0] ?>">
                            </div>
                            <div class="right-content">
                                <h2><?= $registro[0] ?></h2>

                                <div class="bebidas-content">
                                    <h3> Descrição:</h3>
                                    <h4><?= $registro[1] ?></h4>

                                    <h3> Valor:</h3>
                                    <h4><mark style="background-color: #3e733b;">R$<?= number_format($registro[4], 2, ',', '.') ?></mark></h4>
                                </div>
                                <a href="processa_pedido_bebida.php?idbebida=<?= $registro[2] ?>" id="addToCartBtn" class="cta-button" style="margin: 0 auto; width: 75%;">
                                    <?= $userLoggedIn ? 'Adicionar ao Carrinho' : 'Faça login e peça agora!' ?>

                                </a>
                            </div>
                            <span class="close" onclick="fecharModelo(<?= $registro[2] ?>)">&times;</span><br>
                        </div>
                    </div>
                <?php endwhile; ?>

                <div id="alerta_bebida" class="alerta">
                    <div class="icone_container">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                            <path fill="#3e733b" d="M256 32c14.2 0 27.3 7.5 34.5 19.8l216 368c7.3 12.4 7.3 27.7 .2 40.1S486.3 480 472 480L40 480c-14.3 0-27.6-7.7-34.7-20.1s-7-27.8 .2-40.1l216-368C228.7 39.5 241.8 32 256 32zm0 128c-13.3 0-24 10.7-24 24l0 112c0 13.3 10.7 24 24 24s24-10.7 24-24l0-112c0-13.3-10.7-24-24-24zm32 224a32 32 0 1 0 -64 0 32 32 0 1 0 64 0z" />
                        </svg>
                    </div>
                    <h2 class="titulo">Bebida indisponível no momento!</h2>
                </div>
            </div>
        </div>
    </section>

    <!-- footer section start -->
    <footer>
        <div class="rodape">
            <div class="rodape-img">
                <img src="../img/logo2.png" alt="">
            </div>
            <div class="rodape-about">
                <h2>Sobre</h2>
                <hr>
                <p>"Maria Bonita: tradição,<br> sabor e qualidade em cada prato,<br> sempre pensando em você!"
                </p>
            </div>
            <div class="rodape-redes">
                <h2>Redes Sociais</h2>
                <hr>
                <a href="#"> <i class="fab fa-whatsapp fa-3x" style="color: #3e733b;"></i></a>
                <a href="#"> <i class="fab fa-instagram fa-3x" style="color: #3e733b;"></i></a>
                </a>

            </div>
            <div class="rodape-menu">
                <h2>Menu</h2>
                <hr>
                <a href="#home">
                    <h3> <i class="fas fa-home" style="color: #3e733b;"></i> &nbsp;início </h3>
                </a>
                <a href="cardapio/cardapio.php">
                    <h3> <i class="fas fa-utensils" style="color: #3e733b;"></i> &nbsp;Cardápio </h3>
                </a>
                <a href="cardapio/carrinho.php">
                    <h3> <i class="fas fa-shopping-cart" style="color: #3e733b;"></i> &nbsp;Carrinho </h3>
                </a>
            </div>
        </div>
        <hr>
        <div class="copyright">
            Projeto final do curso de informatica ETB | &nbsp;
            <span class="far fa-copyright"></span> 2024 Todos os direitos reservados.</span>
        </div>

    </footer>


    <script>
        function showContent(contentId, buttonId) {
            var contents = document.querySelectorAll('.content');
            var buttons = document.querySelectorAll('.button');

            contents.forEach(function(content) {
                content.classList.remove('active');
            });

            buttons.forEach(function(button) {
                button.classList.remove('active');
            });

            document.getElementById(contentId).classList.add('active');
            document.getElementById(buttonId).classList.add('active');
        }

        // Seleciona o primeiro botão por padrão
        document.getElementById('button1').click();
    </script>

    <script>
        function abrirModelo(event, id, status) {
            if (status === 'disabled') {
                event.preventDefault();
                mostrarAlert();
            } else {
                var modal = document.getElementById('modelo_' + id);
                modal.style.display = "block";
            }
        }

        function mostrarAlert() {
            var alerta = document.getElementById('alerta_bebida');

            // Exibe o alerta com a animação de fade-in
            alerta.style.display = "block";
            setTimeout(function() {
                alerta.classList.add("mostrar");
            }, 100);

            // Remove a exibição após 3 segundos, com fade-out
            setTimeout(function() {
                alerta.classList.remove("mostrar");
                setTimeout(function() {
                    alerta.style.display = "none";
                }, 500); // Espera o fade-out
            }, 3000);
        }



        function fecharModelo(id) {
            var modelo = document.getElementById('modelo_' + id);
            modelo.style.display = "none";
        }

        // Fecha o modal se clicar fora dele
        window.onclick = function(event) {
            var modals = document.getElementsByClassName('modal');
            for (var i = 0; i < modals.length; i++) {
                if (event.target == modals[i]) {
                    modals[i].style.display = "none";
                }
            }
        }
    </script>

    <script>
        function abrirModal(event, id, status) {
            if (status === 'disabled') {
                event.preventDefault();
                mostrarAlerta();
            } else {
                var modal = document.getElementById('modal_' + id);
                modal.style.display = "block";
            }
        }

        function mostrarAlerta() {
            var alerta = document.getElementById('alerta');

            // Exibe o alerta com a animação de fade-in
            alerta.style.display = "block";
            setTimeout(function() {
                alerta.classList.add("mostrar");
            }, 100);

            // Remove a exibição após 3 segundos, com fade-out
            setTimeout(function() {
                alerta.classList.remove("mostrar");
                setTimeout(function() {
                    alerta.style.display = "none";
                }, 500); // Espera o fade-out
            }, 3000);
        }



        function fecharModal(id) {
            var modal = document.getElementById('modal_' + id);
            modal.style.display = "none";
        }

        // Fecha o modal se clicar fora dele
        window.onclick = function(event) {
            var modals = document.getElementsByClassName('modal');
            for (var i = 0; i < modals.length; i++) {
                if (event.target == modals[i]) {
                    modals[i].style.display = "none";
                }
            }
        }
    </script>

    <script>
        function showMenu(dia, elemento) {
            // Esconde todas as seções de menu
            var menus = document.getElementsByClassName('menu-dia');
            for (var i = 0; i < menus.length; i++) {
                menus[i].style.display = 'none';
            }

            // Exibe a seção correspondente ao dia selecionado
            document.getElementById(dia).style.display = 'block';

            // Remove a classe 'selected' de todos os botões
            var botoes = document.getElementsByClassName('calendario');
            for (var i = 0; i < botoes.length; i++) {
                botoes[i].classList.remove('selected');
            }

            // Adiciona a classe 'selected' ao botão clicado
            elemento.classList.add('selected');
        }

        // Detecta o dia da semana atual e exibe o menu correspondente
        window.onload = function() {
            var diasDaSemana = ['segunda', 'terca', 'quarta', 'quinta', 'sexta', 'sabado'];
            var hoje = new Date().getDay(); // Retorna um número entre 0 (domingo) e 6 (sábado)

            // Ajusta o dia da semana corretamente, exibe 'segunda' se for domingo
            var diaAtual = (hoje === 0) ? 'segunda' : diasDaSemana[hoje - 1];

            // Encontra o botão correspondente ao dia atual pelo atributo `onclick`
            var botoes = document.getElementsByClassName('calendario');
            for (var i = 0; i < botoes.length; i++) {
                // Extrai o nome do dia do atributo `onclick`
                var diaDoBotao = botoes[i].getAttribute('onclick').match(/showMenu\('(\w+)'/)[1];
                if (diaDoBotao === diaAtual) {
                    showMenu(diaAtual, botoes[i]);
                    break;
                }
            }
        }
    </script>

    <script src="../js/home.js"></script>
</body>

</html>
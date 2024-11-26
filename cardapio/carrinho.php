<?php
session_start();
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

$logado = isset($_SESSION['nome']); // Verifica se o usuário está logado
$carrinho_vazio = empty($pratos) && empty($bebidas); // Verifica se o carrinho está vazio

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
$cont_cart = 0;
foreach ($pratos as $dishes):

    $id = $dishes['idpratos'];
    $quantidade = $_SESSION['carrinho'][$id]['quantidade'];
    $cont_cart += $quantidade;
endforeach;

foreach ($bebidas as $drinks):
    $id_bebida = $drinks['idbebidas'];
    $quantidade_bebida = $_SESSION['carrinho_bebida'][$id_bebida]['quantidade'];
    $cont_cart += $quantidade_bebida;
endforeach;
?>




<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Maria Bonita - Carrinho</title>
    <link rel="stylesheet" href="../css/cardapio.css">
    <link rel="stylesheet" href="../css/carrinho.css">
    <link rel="shortcut icon" href="../images/favicon.ico" />
    <script src="https://kit.fontawesome.com/95dd5c4026.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">
    <link rel="icon" href="../img/icon.png" type="image/png">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/typed.js/2.0.11/typed.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/waypoints/4.0.1/jquery.waypoints.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Sharp:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
</head>

<body style="background-color: #fff;">

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
                } elseif ($_SESSION["nome"] == "Administrador") {
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

    <section class="services" id="about">

        <div class="carrinho">
            <?php
            if (!$logado) {
            ?>
                <!-- Se o usuário não estiver logado -->
                <div class="mensagem">
                    <div class="mensagem-content">
                        <img src="../img/cart.png">
                        <h5>Seu carrinho está vazio</h5>

                        <p>Faça login e acesse o cardápio do dia</p>
                        <a href=" ../login.php">Fazer Login</a>
                    </div>
                </div>
            <?php
            } elseif ($logado && $carrinho_vazio) {
            ?>
                <!-- Se o usuário estiver logado, mas o carrinho estiver vazio -->
                <div class="mensagem">
                    <div class="mensagem-content">

                        <img src="../img/cart.png">
                        <h5>Seu carrinho está vazio</h5>

                        <p>Acesse o cardápio do dia e monte o seu prato</p>
                        <a href=" cardapio.php">Ver cardápio</a>
                    </div>
                </div>
            <?php
            } else {
            ?>
                <div class="seu_pedido">


                    <h1>Seu pedido</h1>

                    <?php
                    $total = 0;
                    foreach ($pratos as $prato):
                        $id = $prato['idpratos'];
                        $quantidade = $_SESSION['carrinho'][$id]['quantidade'];
                        $acompanhamentos = $_SESSION['carrinho'][$id]['acompanhamentos'] ?? [];
                        $descricao = $_SESSION['carrinho'][$id]['descricao'] ?? [];
                        $subtotal = $prato['preco'] * $quantidade;
                        $total += $subtotal;
                    ?>
                        <div class="conteiner">
                            <div class="cima">
                                <div class="img_carrinho">
                                    <img src="<?= $prato['foto'] ?>" width="200px">
                                </div>
                                <div class="dados_pedido">
                                    <h2><?= $prato['nome'] ?></h2>
                                    <h3>
                                        <p style="font-weight:300; font-size:10pt;">Acompanhamentos:</p>
                                        <?php
                                        if (!empty($acompanhamentos)) {
                                            $lastElement = end($acompanhamentos); // Pega o último elemento do array
                                            foreach ($acompanhamentos as $produto) {
                                                if ($produto === $lastElement) {
                                                    echo htmlspecialchars($produto) . ". "; // Adiciona um ponto ao último elemento
                                                } else {
                                                    echo htmlspecialchars($produto) . ", "; // Adiciona uma vírgula aos demais elementos
                                                }
                                            }
                                        } else {
                                            echo "<p>Sem acompanhamentos</p>";
                                        }
                                        ?>

                                    </h3>
                                    <h3>
                                        <p style="font-weight:300; font-size:10pt;">Carnes do prato:</p>

                                        <?php
                                        if (!empty($descricao)) {
                                            $lastElement = end($descricao); // Pega o último elemento do array
                                            foreach ($descricao as $produto2) {
                                                if ($produto2 === $lastElement) {
                                                    echo htmlspecialchars($produto2) . ". "; // Adiciona um ponto ao último elemento
                                                } else {
                                                    echo htmlspecialchars($produto2) . ", "; // Adiciona uma vírgula aos demais elementos
                                                }
                                            }
                                        } else {
                                            echo "<p>Sem acompanhamentos</p>";
                                        }
                                        ?>
                                    </h3>
                                </div>
                                <div class="remover_pedido">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                        <a href="remover_carrinho.php?id=<?= $id ?>"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                            <path d="M135.2 17.7L128 32 32 32C14.3 32 0 46.3 0 64S14.3 96 32 96l384 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l-96 0-7.2-14.3C307.4 6.8 296.3 0 284.2 0L163.8 0c-12.1 0-23.2 6.8-28.6 17.7zM416 128L32 128 53.2 467c1.6 25.3 22.6 45 47.9 45l245.8 0c25.3 0 46.3-19.7 47.9-45L416 128z" />
                                    </svg>
                                </div>
                            </div>
                            <hr>
                            <div class="baixo">
                                <div class="quant">
                                    <h4>
                                        <div style="margin-top:2px;">Quantidade:</div> &nbsp;&nbsp;
                                        <div style="display:flex">
                                            <a href="atualizar_carrinho.php?id=<?= $id ?>&acao=diminuir">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                                    <path fill="#447e41" d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM184 232l144 0c13.3 0 24 10.7 24 24s-10.7 24-24 24l-144 0c-13.3 0-24-10.7-24-24s10.7-24 24-24z" />
                                                </svg>
                                            </a>
                                            <div class="nmr">
                                                <?= $quantidade ?>
                                            </div>
                                            <a href="atualizar_carrinho.php?id=<?= $id ?>&acao=aumentar">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                                    <path fill="#447e41" d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM232 344l0-64-64 0c-13.3 0-24-10.7-24-24s10.7-24 24-24l64 0 0-64c0-13.3 10.7-24 24-24s24 10.7 24 24l0 64 64 0c13.3 0 24 10.7 24 24s-10.7 24-24 24l-64 0 0 64c0 13.3-10.7 24-24 24s-24-10.7-24-24z" />
                                                </svg>
                                            </a>
                                        </div>
                                    </h4>
                                </div>
                                <div class="valor">
                                    R$ <?= number_format($subtotal, 2, ',', '.') ?>
                                </div>

                            </div>
                            <div class="backpai">
                                <div class="back">
                                    <a href="cardapio.php#about">Continuar Comprando</a>
                                </div>
                            </div>


                        </div>


                    <?php endforeach; ?>

                    <div class="sua_bebida">
                        <?php
                        foreach ($bebidas as $bebida):
                            $id_bebida = $bebida['idbebidas'];
                            $descricao = $bebida['descricao'];
                            $quantidade_bebida = $_SESSION['carrinho_bebida'][$id_bebida]['quantidade'];
                            $subtotal_bebida = $bebida['preco'] * $quantidade_bebida;
                            $total += $subtotal_bebida;
                        ?>
                            <div class="conteiner">
                                <div class="cima">
                                    <div class="img_carrinho">
                                        <img src="<?= $bebida['foto'] ?>" width="200px">
                                    </div>
                                    <div class="dados_pedido">
                                        <h2><?= $bebida['nome'] ?></h2>
                                        <h3>
                                            <p style="font-weight:300; font-size:10pt;">Descricao:</p>
                                            <h3><?= $bebida['descricao'] ?></h3>

                                        </h3>

                                    </div>
                                    <div class="remover_pedido">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                            <a href="remover_carrinho.php?idbebida=<?= $id_bebida ?>"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                                <path d="M135.2 17.7L128 32 32 32C14.3 32 0 46.3 0 64S14.3 96 32 96l384 0c17.7 0 32-14.3 32-32s-14.3-32-32-32l-96 0-7.2-14.3C307.4 6.8 296.3 0 284.2 0L163.8 0c-12.1 0-23.2 6.8-28.6 17.7zM416 128L32 128 53.2 467c1.6 25.3 22.6 45 47.9 45l245.8 0c25.3 0 46.3-19.7 47.9-45L416 128z" />
                                        </svg>
                                    </div>
                                </div>
                                <hr>
                                <div class="baixo">
                                    <div class="quant">
                                        <h4>
                                            <div style="margin-top:2px;">Quantidade:</div> &nbsp;&nbsp;
                                            <div style="display:flex">
                                                <a href="atualizar_carrinho.php?idbebida=<?= $id_bebida ?>&acao_bebida=diminuir">
                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                                        <path fill="#447e41" d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM184 232l144 0c13.3 0 24 10.7 24 24s-10.7 24-24 24l-144 0c-13.3 0-24-10.7-24-24s10.7-24 24-24z" />
                                                    </svg>
                                                </a>
                                                <div class="nmr">
                                                    <?= $quantidade_bebida ?>
                                                </div>
                                                <a href="atualizar_carrinho.php?idbebida=<?= $id_bebida ?>&acao_bebida=aumentar">
                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                                        <path fill="#447e41" d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM232 344l0-64-64 0c-13.3 0-24-10.7-24-24s10.7-24 24-24l64 0 0-64c0-13.3 10.7-24 24-24s24 10.7 24 24l0 64 64 0c13.3 0 24 10.7 24 24s-10.7 24-24 24l-64 0 0 64c0 13.3-10.7 24-24 24s-24-10.7-24-24z" />
                                                    </svg>
                                                </a>
                                            </div>
                                        </h4>
                                    </div>
                                    <div class="valor">
                                        R$ <?= number_format($subtotal_bebida, 2, ',', '.') ?>
                                    </div>

                                </div>
                                <div class="backpai">
                                    <div class="back">
                                        <a href="cardapio.php#about">Continuar Comprando</a>
                                    </div>
                                </div>


                            </div>


                        <?php endforeach; ?>

                    </div>



                    <br><br>

                </div>



                <div class="resumo_compra">
                    <h1>Resumo da compra</h1>


                    <div class="resumo_content">
                        <h3>
                            Subtotal: <mark style="background-color: #3e733b; color:#fff;">R$ <?= number_format($total, 2, ',', '.') ?></mark>
                        </h3>
                        <hr>

                        <form action="finalizar_whatsapp.php" method="post" class="dados">
                            <h2 style="font-size: 12pt; color:#111; margin-block-end: 10px;">Informações de Entrega</h2>

                            <label for="endereco">Endereço:</label><br>
                            <input type="text" id="endereco" name="endereco" required><br><br>

                            <label for="pagamento">Método de Pagamento:</label><br>
                            <select id="pagamento" name="pagamento" required>
                                <option value="pix">PIX</option>
                                <option value="debito">Cartão de Débito</option>
                                <option value="credito">Cartão de Crédito</option>
                                <option value="dinheiro">Dinheiro</option>
                            </select><br><br>

                            <button type="submit">
                                <h1>Fazer Pedido <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--!Font Awesome Free 6.6.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                        <path fill="#ffffff" d="M380.9 97.1C339 55.1 283.2 32 223.9 32c-122.4 0-222 99.6-222 222 0 39.1 10.2 77.3 29.6 111L0 480l117.7-30.9c32.4 17.7 68.9 27 106.1 27h.1c122.3 0 224.1-99.6 224.1-222 0-59.3-25.2-115-67.1-157zm-157 341.6c-33.2 0-65.7-8.9-94-25.7l-6.7-4-69.8 18.3L72 359.2l-4.4-7c-18.5-29.4-28.2-63.3-28.2-98.2 0-101.7 82.8-184.5 184.6-184.5 49.3 0 95.6 19.2 130.4 54.1 34.8 34.9 56.2 81.2 56.1 130.5 0 101.8-84.9 184.6-186.6 184.6zm101.2-138.2c-5.5-2.8-32.8-16.2-37.9-18-5.1-1.9-8.8-2.8-12.5 2.8-3.7 5.6-14.3 18-17.6 21.8-3.2 3.7-6.5 4.2-12 1.4-32.6-16.3-54-29.1-75.5-66-5.7-9.8 5.7-9.1 16.3-30.3 1.8-3.7 .9-6.9-.5-9.7-1.4-2.8-12.5-30.1-17.1-41.2-4.5-10.8-9.1-9.3-12.5-9.5-3.2-.2-6.9-.2-10.6-.2-3.7 0-9.7 1.4-14.8 6.9-5.1 5.6-19.4 19-19.4 46.3 0 27.3 19.9 53.7 22.6 57.4 2.8 3.7 39.1 59.7 94.8 83.8 35.2 15.2 49 16.5 66.6 13.9 10.7-1.6 32.8-13.4 37.4-26.4 4.6-13 4.6-24.1 3.2-26.4-1.3-2.5-5-3.9-10.5-6.6z" />
                                    </svg></h1>
                            </button>
                        </form>

                    </div>

                </div>
            <?php
            }
            ?>
        </div>


    </section>

    <!-- footer section start -->
    <footer>
        <div class="rodape">
            <div class="rodape-img">
                <img src="../img/logo2.png" alt="">
            </div>
            <div class="rodape-about">
                <h4>Sobre</h4>
                <hr>
                <p>"Maria Bonita: tradição,<br> sabor e qualidade em cada prato,<br> sempre pensando em você!"
                </p>
            </div>
            <div class="rodape-redes">
                <h4>Redes Sociais</h4>
                <hr>
                <a href="#"> <i class="fab fa-whatsapp fa-3x" style="color: #3e733b;"></i></a>
                <a href="#"> <i class="fab fa-instagram fa-3x" style="color: #3e733b;"></i></a>
                </a>

            </div>
            <div class="rodape-menu">
                <h4>Menu</h4>
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

</body>

</html>
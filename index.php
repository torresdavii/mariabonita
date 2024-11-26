<?php

session_start();

$config = include 'config.php';
$config_url = include 'config_url.php';

require 'conexao.php';

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
    <title>Maria Bonita</title>
    <link rel="stylesheet" href="css/home.css">
    <link rel="shortcut icon" href="../images/favicon.ico" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">
    <link rel="icon" href="img/icon.png" type="image/png">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
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
            <source src="img/202004-916894674.mp4" type="video/mp4">

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
                <a href="../mariabonita/index.php">
                    <img src="img/logo.png">
                </a>
            </div>
            <div class="menu">
                <?php
                // Verifica se a variável de sessão "nome" está definida
                if (!isset($_SESSION["nome"])) {
                ?>
                    <ul class="menu" id="menu">
                        <li><a href="../mariabonita/index.php#home" class="menu-btn">Home</a></li>
                        <li><a href="../mariabonita/index.php#about" class="menu-btn">Sobre</a></li>
                        <li><a href="../mariabonita/index.php#time" class="menu-btn">Horários</a></li>
                        <li><a href="../mariabonita/cardapio/cardapio.php" class="menu-btn">Cardápio</a></li>
                        <li><a href="../mariabonita/cardapio/carrinho.php" class="menu-btn"><i class="fas fa-shopping-cart"></i> Carrinho</a></li>
                        <li><a href="login.php"><button class="menu-login">Login</button></a></li>
                    </ul>
                <?php
                } elseif ($_SESSION["codigo"] == "1") {
                ?>
                    <ul class="menu" id="menu">
                        <li><a href="admin.php" class="menu-btn">Administração</a></li>
                        <li><a href="index.php#home" class="menu-btn">Home</a></li>
                        <li><a href="index.php#about" class="menu-btn">Sobre</a></li>
                        <li><a href="index.php#time" class="menu-btn">Horários</a></li>
                        <li><a href="cardapio/cardapio.php" class="menu-btn">Cardápio</a></li>
                        <li><a href="cardapio/carrinho.php" class="menu-btn"><i class="fas fa-shopping-cart"></i> Carrinho</a></li>
                        <li><a href="logout.php" class="menu-btn">Sair</a></li>
                    </ul>
                <?php
                } else {
                ?>
                    <ul class="menu" id="menu">
                        <li><a href="../mariabonita/index.php#home" class="menu-btn">Home</a></li>
                        <li><a href="../mariabonita/index.php#about" class="menu-btn">Sobre</a></li>
                        <li><a href="../mariabonita/index.php#time" class="menu-btn">Horários</a></li>
                        <li><a href="../mariabonita/cardapio/cardapio.php" class="menu-btn">Cardápio</a></li>
                        <li><a href="../mariabonita/cardapio/carrinho.php" class="menu-btn"><i class="fas fa-shopping-cart"></i> Carrinho</a></li>
                        <li><a href="../mariabonita/logout.php" class="menu-btn">Sair</a></li>
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
                <a href="cardapio/carrinho.php"><i class="fas fa-shopping-cart"></i><span><?php echo $cont_cart ?></span></a>
            </div>
        </div>
    </nav>

    <!-- home section start -->
    <section class="home" id="home">
        <div class="max-width">
            <div class="home-content">



                <div class="text-2"><img src="img/cacto.png">Maria Bonita</div>

                <br><br>

                <div class="text-3">
                    <?php
                    if (isset($_SESSION["nome"]) && !empty($_SESSION["nome"])) {
                        echo "Bem vindo, " . htmlspecialchars($_SESSION["nome"]) . "!";
                    } else {
                        echo "Seja bem vindo ao nosso restaurante!";
                    }
                    ?>
                </div>

                <a href="cardapio/cardapio.php">Ver Cardápio</a>
            </div>
        </div>
        <div class="arrow">
            <a href="#about"><span class="material-symbols-sharp">south</span></a>
        </div>
    </section>


    <!-- about section start -->
    <section class="about" id="about">
        <div class="max-width">
            <div class="about-content">
                <div class="column left">
                    <img src="../mariabonita/img/history.jpg" alt="">
                </div>
                <div class="column right">
                    <h2 class="title">Sobre nós</h2>

                    <div class="text">Olá nós somos a Maria Bonita</div>
                    <p>Aqui no Maria Bonita, em Arniqueiras-DF, oferecemos pratos preparados com carinho, mantendo a tradição e a excelência que nos acompanham desde o início. Nossa missão é proporcionar uma experiência única aos nossos clientes, com sabores autênticos e ingredientes frescos. Queremos que cada visita ao Maria Bonita seja uma ocasião especial, especialmente para um almoço caprichado. Sinta-se em casa, aproveite nosso ambiente aconchegante e relaxe. Agradecemos sua preferência e esperamos sempre surpreender você com o melhor da nossa cozinha, servindo exclusivamente o almoço!
                    </p>
                    <a href="https://maps.app.goo.gl/MPc1PPZ3hX3djBNN6">Confira nossa localização &nbsp;<i class="fa-solid fa-location-dot"></i></a>
                </div>
            </div>
        </div>
    </section>

    <!-- services section start -->
    <section class="services" id="services">
        <div class="max-width">
            <h2 class="title">Nossos Serviços</h2>
            <h4 class="subtitle">Pedir um delivery fica fácil com apenas 3 passos</h4>
            <div class="serv-content">
                <div class="card">
                    <div class="box">
                        <i class="fab fa-whatsapp"></i>
                        <div class="text">Faça seu pedido</div>
                        <p>É muito simples, vá até o cardápio, escolha seu pedido e nos envie a mensagem por whatsapp.</p>
                    </div>
                </div>
                <div class="card">
                    <div class="box">
                        <i class="fas fa-truck"></i>
                        <div class="text">Nós entregamos</div>
                        <p>Agora é só esperar a entrega chegar e pagar, garantimos uma entrega rápida de 30 minutos.</p>
                    </div>
                </div>
                <div class="card">
                    <div class="box">
                        <i class="fas fa-hamburger"></i>
                        <div class="text">Aproveite seu lanche</div>
                        <p>O ultimo e melhor passo é apreciar o seu lanche no conforto do lar.</p>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>

    <!-- skills section start -->
    <section class="skills" id="time">
        <div class="max-width">
            <div class="skills-content">
                <div class="column left">
                    <h2 class="title" style="margin-top: -100px; margin-block-end: 50px;">Horários</h2>

                    <div class="text">Horários de Atendimento.</div>
                    <p>No Maria Bonita, estamos prontos para receber você ao longo do dia, sendo a escolha ideal para um café da manhã reforçado, um almoço delicioso ou uma pausa para o lanche da tarde.<br>Visite nossa loja física ou aproveite nosso serviço de delivery com entregas rápidas, entre 30 e 40 minutos.<br>Nossos horários de funcionamento são de segunda a sábado, das 07:00 às 18:00.</p>
                    <a href="cardapio/cardapio.php">Ver Cardápio</a>
                </div>
                <div class="column-right">
                    <img src="img/time.png" alt="">
                </div>
            </div>
        </div>
    </section>


    <!-- footer section start -->
    <footer>
        <div class="rodape">
            <div class="rodape-img">
                <img src="img/logo2.png" alt="">
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
                <a href="https://wa.me/<?= $config['whatsapp_number'] ?>"> <i class="fab fa-whatsapp fa-3x" style="color: #3e733b;"></i></a>
                <a href="<?= $config_url['instagram_url'] ?>"> <i class="fab fa-instagram fa-3x" style="color: #3e733b;"></i></a>
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

    <script src="js/home.js"></script>
</body>

</html>
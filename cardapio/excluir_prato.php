<?php
include($_SERVER['DOCUMENT_ROOT'] . '/mariabonita/valida_login.php');

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Maria Bonita</title>
    <link rel="stylesheet" href="../css/admin.css">
    <link rel="stylesheet" href="../css/cardapio.css">
    <link rel="shortcut icon" href="../images/favicon.ico" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">
    <link rel="icon" href="../img/icon.png" type="image/png">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/typed.js/2.0.11/typed.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/waypoints/4.0.1/jquery.waypoints.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Sharp:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>

<body>

    <div class="scroll-up-btn">
        <i class="fas fa-angle-up"></i>
    </div>
    <div class="overlay" id="overlay" onclick="closeMenu()"></div>

    <nav class="adm">


        <div class="max-width-adm">
            <div class="menu-btn">
                <i class="fas fa-bars"></i>
            </div>

            <div class="menu-icon" onclick="toggleMenu2()">
                <div class="bar"></div>
                <div class="bar"></div>
                <div class="bar"></div>
            </div>
            <div class="menu adm">
                <ul id="menu" class="menu">
                    <li><a href="../admin.php" class="menu-btn">Administração</a></li>
                    <li><a href="../index.php#home" class="menu-btn">Home</a></li>
                    <li><a href="../index.php#about" class="menu-btn">Sobre</a></li>
                    <li><a href="../index.php#time" class="menu-btn">Horários</a></li>
                    <li><a href="../cardapio/cardapio.php" class="menu-btn">Cardápio</a></li>
                    <li><a href="../cardapio/carrinho.php" class="menu-btn"><i class="fas fa-shopping-cart"></i> Carrinho</a></li>
                    <li><a href="../logout.php" class="menu-btn">Sair</a></li>
                </ul>
            </div>

            <div class="back">

                <a href="../index.php#home">
                    <i class="fa-solid fa-left-long fa-2xl" style="color: #ffffff;"></i>
                </a>

            </div>

            <h1 onclick="toggleMenu()">Administração <i id="icon" class="fas fa-chevron-down icon"></i></h1>

            <script>
                function toggleMenu2() {
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


        </div>


    </nav>

    <div class="submenu-adm" id="menu-options">
        <ul>
            <li><a href="../admin.php#pratos" style="text-decoration: none; color:#fff">Pratos</a>
                <ul class="descricao-menu">
                    <li>Editar prato</li>
                </ul>
            </li>
            <li><a href="../admin.php#bebidas" style="text-decoration: none; color:#fff">Bebidas</a>
                <ul class="descricao-menu">
                    <li>Alterar bebida</li>
                </ul>
            </li>
            <li><a href="../admin.php#clientes" style="text-decoration: none; color:#fff">Clientes</a>
                <ul class="descricao-menu">
                    <li>Ver Clientes</li>
                </ul>
            </li>
            <li><a href="../admin.php#pedidos" style="text-decoration: none; color:#fff">Pedidos</a>
                <ul class="descricao-menu">
                    <li>Ver Pedidos</li>
                </ul>
            </li>
            <li><a href="../admin.php#contato" style="text-decoration: none; color:#fff">Contato</a>
                <ul class="descricao-menu">
                    <li>Mudar Número de Contato</li>
                </ul>
            </li>
        </ul>
    </div>

    <script>
        // Função para alternar o menu
        function toggleMenu() {
            var submenu = document.getElementById("menu-options");
            var icon = document.getElementById("icon");

            if (submenu.classList.contains("show")) {
                submenu.classList.remove("show");
                icon.classList.remove("rotate");
            } else {
                submenu.classList.add("show");
                icon.classList.add("rotate");
            }
        }

        // Fecha o submenu se clicar fora dele
        document.addEventListener("click", function(event) {
            var submenu = document.getElementById("menu-options");
            var icon = document.getElementById("icon");

            // Verifica se o clique foi fora da navbar e do submenu
            if (!event.target.closest('.adm') && !event.target.closest('.submenu-adm')) {
                submenu.classList.remove("show");
                icon.classList.remove("rotate");
            }
        });
    </script>

    <section class="services" id="services" style="background-color: #fcf9f4;">
        <div class="title" style="color:#3e733b">Escolha o cardápio do dia para excluir!</div>
        <div class="container">

            <button class="calendario" onclick="showMenu('segunda', this)">Segunda</button>
            <button class="calendario" onclick="showMenu('terca', this)">Terça</button>
            <button class="calendario" onclick="showMenu('quarta', this)">Quarta</button>
            <button class="calendario" onclick="showMenu('quinta', this)">Quinta</button>
            <button class="calendario" onclick="showMenu('sexta', this)">Sexta</button>
            <button class="calendario" onclick="showMenu('sabado', this)">Sábado</button>

        </div>

        <?php
        $conectar = mysqli_connect("localhost", "root", "", "mariabonita");
        ?>

        <div id="segunda" class="menu-dia" style="display:none;">

            <!-- Conteúdo do cardápio de segunda -->

            <?php
            $sql_consulta = "SELECT 
                    nome, 
                    acompanhamentos, 
                    idpratos, 
                    foto
                FROM 
                    pratos
                WHERE 
                    diaSemana = 'segunda';";
            $resultado_consulta = mysqli_query($conectar, $sql_consulta);
            ?>

            <div class="cardapio-container">
                <?php
                while ($registro = mysqli_fetch_row($resultado_consulta)) {
                    echo "<div class='cardapio-item'>";
                    echo "  <img src='$registro[3]' alt='$registro[0]'>";
                    echo "  <div class='cardapio-title' style='color:#111;'>$registro[0]</div>";
                    echo "  <div class='cardapio-description'>$registro[1]</div>";
                    echo "  <button class='cardapio-altera' onclick='confirmarExclusao($registro[2])'>
                    Excluir
                </button>";
                    echo "</div>";
                }
                ?>
            </div>


        </div>

        <div id="terca" class="menu-dia" style="display:none;">
            <!-- Conteúdo do cardápio de terça -->

            <?php
            $sql_consulta = "SELECT 
                    nome, 
                    acompanhamentos, 
                    idpratos, 
                    foto
                FROM 
                    pratos
                WHERE 
                    diaSemana = 'terca';";
            $resultado_consulta = mysqli_query($conectar, $sql_consulta);
            ?>

            <div class="cardapio-container">
                <?php
                while ($registro = mysqli_fetch_row($resultado_consulta)) {
                    echo "<div class='cardapio-item'>";
                    echo "  <img src='$registro[3]' alt='$registro[0]'>";
                    echo "  <div class='cardapio-title' style='color:#111;'>$registro[0]</div>";
                    echo "  <div class='cardapio-description'>$registro[1]</div>";
                    echo "  <button class='cardapio-altera' onclick='confirmarExclusao($registro[2])'>
                    Excluir
                </button>";
                    echo "</div>";
                }
                ?>
            </div>

        </div>
        <div id="quarta" class="menu-dia" style="display:none;">
            <!-- Conteúdo do cardápio de quarta -->

            <?php
            $sql_consulta = "SELECT 
                    nome, 
                    acompanhamentos, 
                    idpratos, 
                    foto
                FROM 
                    pratos
                WHERE 
                    diaSemana = 'quarta';";
            $resultado_consulta = mysqli_query($conectar, $sql_consulta);
            ?>

            <div class="cardapio-container">
                <?php
                while ($registro = mysqli_fetch_row($resultado_consulta)) {
                    echo "<div class='cardapio-item'>";
                    echo "  <img src='$registro[3]' alt='$registro[0]'>";
                    echo "  <div class='cardapio-title' style='color:#111;'>$registro[0]</div>";
                    echo "  <div class='cardapio-description'>$registro[1]</div>";
                    echo "  <button class='cardapio-altera' onclick='confirmarExclusao($registro[2])'>
                    Excluir
                </button>";
                    echo "</div>";
                }
                ?>
            </div>

        </div>
        <div id="quinta" class="menu-dia" style="display:none;">
            <!-- Conteúdo do cardápio de quinta -->

            <?php
            $sql_consulta = "SELECT 
                    nome, 
                    acompanhamentos, 
                    idpratos, 
                    foto
                FROM 
                    pratos
                WHERE 
                    diaSemana = 'quinta';";
            $resultado_consulta = mysqli_query($conectar, $sql_consulta);
            ?>

            <div class="cardapio-container">
                <?php
                while ($registro = mysqli_fetch_row($resultado_consulta)) {
                    echo "<div class='cardapio-item'>";
                    echo "  <img src='$registro[3]' alt='$registro[0]'>";
                    echo "  <div class='cardapio-title' style='color:#111;'>$registro[0]</div>";
                    echo "  <div class='cardapio-description'>$registro[1]</div>";
                    echo "  <button class='cardapio-altera' onclick='confirmarExclusao($registro[2])'>
                    Excluir
                </button>";
                    echo "</div>";
                }
                ?>
            </div>

        </div>
        <div id="sexta" class="menu-dia" style="display:none;">
            <!-- Conteúdo do cardápio de sexta -->

            <?php
            $sql_consulta = "SELECT 
                    nome, 
                    acompanhamentos, 
                    idpratos, 
                    foto
                FROM 
                    pratos
                WHERE 
                    diaSemana = 'sexta';";
            $resultado_consulta = mysqli_query($conectar, $sql_consulta);
            ?>

            <div class="cardapio-container">
                <?php
                while ($registro = mysqli_fetch_row($resultado_consulta)) {
                    echo "<div class='cardapio-item'>";
                    echo "  <img src='$registro[3]' alt='$registro[0]'>";
                    echo "  <div class='cardapio-title' style='color:#111;'>$registro[0]</div>";
                    echo "  <div class='cardapio-description'>$registro[1]</div>";
                    echo "  <button class='cardapio-altera' onclick='confirmarExclusao($registro[2])'>
                    Excluir
                </button>";
                    echo "</div>";
                }
                ?>
            </div>

        </div>
        <div id="sabado" class="menu-dia" style="display:none;">
            <!-- Conteúdo do cardápio de sábado -->

            <?php
            $sql_consulta = "SELECT 
                    nome, 
                    acompanhamentos, 
                    idpratos, 
                    foto
                FROM 
                    pratos
                WHERE 
                    diaSemana = 'sabado';";
            $resultado_consulta = mysqli_query($conectar, $sql_consulta);
            ?>

            <div class="cardapio-container">
                <?php
                while ($registro = mysqli_fetch_row($resultado_consulta)) {
                    echo "<div class='cardapio-item'>";
                    echo "  <img src='$registro[3]' alt='$registro[0]'>";
                    echo "  <div class='cardapio-title' style='color:#111;'>$registro[0]</div>";
                    echo "  <div class='cardapio-description'>$registro[1]</div>";
                    echo "  <button class='cardapio-altera' onclick='confirmarExclusao($registro[2])'>
                    Excluir
                </button>";
                    echo "</div>";
                }
                ?>
            </div>

        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    <script>
        function confirmarExclusao(id) {
            Swal.fire({
                title: 'Você tem certeza que deseja excluir este prato?',
                icon: 'warning',

                showCancelButton: true,
                confirmButtonColor: '#3e733b',
                cancelButtonColor: 'grey',
                confirmButtonText: 'Sim, excluir!',
                cancelButtonText: 'Cancelar',
                customClass: {
                    popup: 'custom-swal-popup',
                    title: 'custom-swal-title'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = 'processa_excluir.php?codigo=' + id;
                }
            })
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
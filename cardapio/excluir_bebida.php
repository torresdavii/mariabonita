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
</head>

<body style="background-color: black;">

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

    <section class="about bebidas" id="about bebidas" style="background-color:black;">
        <h1 style="margin-top: 40px;">Selecione a bebida e exclua</h1><br>
        <div class="container">
            <button id="button1" class="button" onclick="showContent('content1', 'button1')">Refrigerantes</button>
            <button id="button2" class="button" onclick="showContent('content2', 'button2')">Sucos</button>
            <button id="button3" class="button" onclick="showContent('content3', 'button3')">Água</button>

        </div>
        <?php
        $conectar = mysqli_connect("localhost", "root", "", "mariabonita");
        ?>

        <div id="content1" class="content active">
            <!-- Conteúdo  -->

            <?php
            $sql_consulta = "SELECT 
                        nome, 
                        descricao, 
                        idbebidas,
                        foto,
                        preco

                    FROM 
                        bebidas
                    WHERE 
                        tipo = 'refrigerante';";
            $resultado_consulta = mysqli_query($conectar, $sql_consulta);
            ?>

            <div class="cardapio-container">
                <?php
                while ($registro = mysqli_fetch_row($resultado_consulta)) {
                    echo "<div class='cardapio-item' style='border:none; background-color:#111;'>";
                    echo "  <img src='$registro[3]' alt='$registro[0]'>";
                    echo "  <div class='cardapio-title' style='color:#ccc;'>$registro[0]</div>";
                    echo "  <div class='cardapio-description'>$registro[1]</div>";
                    echo "  <button class='cardapio-altera' style='background-color:black;' onclick='confirmarExclusao($registro[2])'>
                    <p>Excluir</p>
                </button>";
                    echo "</div>";
                }
                ?>
            </div>
        </div>
        <div id="content2" class="content">
            <!-- Conteúdo  -->

            <?php
            $sql_consulta = "SELECT 
                        nome, 
                        descricao, 
                        idbebidas,
                        foto,
                        preco

                    FROM 
                        bebidas
                    WHERE 
                        tipo = 'suco';";
            $resultado_consulta = mysqli_query($conectar, $sql_consulta);
            ?>

            <div class="cardapio-container">
                <?php
                while ($registro = mysqli_fetch_row($resultado_consulta)) {
                    echo "<div class='cardapio-item' style='border:none; background-color:#111;'>";
                    echo "  <img src='$registro[3]' alt='$registro[0]'>";
                    echo "  <div class='cardapio-title' style='color:#ccc;'>$registro[0]</div>";
                    echo "  <div class='cardapio-description'>$registro[1]</div>";
                    echo "  <button class='cardapio-altera' style='background-color:black;' onclick='confirmarExclusao($registro[2])'>
                    <p>Excluir</p>
                </button>";
                    echo "</div>";
                }
                ?>
            </div>
        </div>
        <div id="content3" class="content">
            <!-- Conteúdo  -->

            <?php
            $sql_consulta = "SELECT 
                        nome, 
                        descricao, 
                        idbebidas,
                        foto,
                        preco

                    FROM 
                        bebidas
                    WHERE 
                        tipo = 'agua';";
            $resultado_consulta = mysqli_query($conectar, $sql_consulta);
            ?>

            <div class="cardapio-container">
                <?php
                while ($registro = mysqli_fetch_row($resultado_consulta)) {
                    echo "<div class='cardapio-item' style='border:none; background-color:#111;'>";
                    echo "  <img src='$registro[3]' alt='$registro[0]'>";
                    echo "  <div class='cardapio-title' style='color:#ccc;'>$registro[0]</div>";
                    echo "  <div class='cardapio-description'>$registro[1]</div>";
                    echo "  <button class='cardapio-altera' style='background-color:black;' onclick='confirmarExclusao($registro[2])'>
                    <p>Excluir</p>
                </button>";
                    echo "</div>";
                }
                ?>
            </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>



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
        function confirmarExclusao(id) {
            Swal.fire({
                title: 'Você tem certeza que deseja excluir essa bebida?',
                icon: 'warning',

                showCancelButton: true,
                confirmButtonColor: '#3e733b',
                cancelButtonColor: 'grey',
                confirmButtonText: 'Sim, excluir!',
                cancelButtonText: 'Cancelar',
                customClass: {
                    popup: 'custom-swal-popup-drink',
                    title: 'custom-swal-title-drink'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = 'processa_exclui_bebida.php?codigo=' + id;
                }
            })
        }
    </script>

    <script src="../js/home.js"></script>
</body>

</html>
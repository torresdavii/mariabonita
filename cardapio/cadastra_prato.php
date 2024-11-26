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
    <section class="services" id="services" style="background-color: #fcf9f4; color:#111">
        <h1 align="center" style="color:#3e733b;">Adicionar Prato</h1>
        <form method="post" action="processa_cadastra_prato.php" enctype="multipart/form-data" onsubmit="return validarEntrada();">
            <div class="topo">
                <div class="esquerda ext">
                    Status do prato: <br><select name="status">
                        <option value="enabled"> Disponível </option>
                        <option value="disabled"> Indisponível </option>

                    </select>
                </div>
                <div class="esquerda">
                    Dia da Semana: <br><select name="dia">
                        <option value="segunda"> Segunda </option>
                        <option value="terça"> Terça </option>
                        <option value="quarta"> Quarta </option>
                        <option value="quinta"> Quinta </option>
                        <option value="sexta"> Sexta </option>
                        <option value="sabado"> Sábado </option>
                    </select>
                </div>

                <div class="direita">
                    Escolha uma foto <br>
                    <label for="fileInput" class="custom-file-label">Selecionar Arquivo</label>
                    <input type="file" id="fileInput" name="foto" accept="image/*" required>
                </div>

            </div>

            <div class="cardapio-container">


                <div class='cardapio-item2'>
                    <div id="previewContainer">
                        <img id="preview" src="" alt="Pré-visualização da imagem">
                    </div>
                    <div class='cardapio-title' style='color:#111;'>
                        Nome:<input type="text" name="nome" placeholder="Ex: Churrasco" required>
                    </div>
                    <div class="input-container">

                        <div class='cardapio-title'>
                            Preço:<input type="number" name="preco" placeholder="Ex: 17.50" step="0.01" required>
                        </div>

                        <div class='cardapio-title'>
                            Acompanhamentos:<input type="text" name="acompanhamentos" id="descricao" placeholder="Ex: Arroz, Feijão, Salada, Macarrão, Farofa" required>
                        </div>
                        <div class='cardapio-title'>
                            Carnes do prato:<input type="text" name="descricao" id="descricao" placeholder="Ex: Picanha, Alcatra, Fraldinha, Asinhas de frango" required>
                        </div>



                        <button class='cardapio-altera'>
                            Criar
                        </button>
                    </div>

                </div>
        </form>


    </section>

    <script>
        function validarEntrada() {
            const input = document.getElementById("descricao").value;


            const regex = /^[a-zA-ZÀ-ÿ\s]+,$/;

            if (regex.test(input)) {
                alerta.style.display = "none";
                return true;
            } else {
                alertaMensagem.textContent = "Por favor, insira uma lista de palavras separadas por uma vírgula e um espaço.";
                alerta.style.display = "block";
                return false;
            }
        }
    </script>

    <script>
        document.getElementById('fileInput').addEventListener('change', function(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const preview = document.getElementById('preview');
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                };
                reader.readAsDataURL(file);
            }
        });
    </script>

</body>

</html>
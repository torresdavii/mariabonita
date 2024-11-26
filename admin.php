<?php
include($_SERVER['DOCUMENT_ROOT'] . '/mariabonita/valida_login.php');

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
$config_url = include 'config_url.php';


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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $url = $_POST['instagram_url'];

    $config_url['instagram_url'] = $url;

    // Atualiza o arquivo de configuração com o número bruto
    $conteudo2 = "<?php\nreturn " . var_export($config_url, true) . ";\n?>";
    file_put_contents('config_url.php', $conteudo2);

    echo "URL atualizado com sucesso!";
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Maria Bonita - Administração</title>
    <link rel="stylesheet" href="css/admin.css">

    <link rel="shortcut icon" href="../images/favicon.ico" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="icon" href="img/icon.png" type="image/png">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/typed.js/2.0.11/typed.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/waypoints/4.0.1/jquery.waypoints.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
            <div class="menu-icon" onclick="toggleMenu2()">
                <div class="bar"></div>
                <div class="bar"></div>
                <div class="bar"></div>
            </div>
            <div class="menu adm">
                <ul id="menu" class="menu">
                    <li><a href="admin.php" class="menu-btn">Administração</a></li>
                    <li><a href="index.php#home" class="menu-btn">Home</a></li>
                    <li><a href="index.php#about" class="menu-btn">Sobre</a></li>
                    <li><a href="index.php#time" class="menu-btn">Horários</a></li>
                    <li><a href="cardapio/cardapio.php" class="menu-btn">Cardápio</a></li>
                    <li><a href="cardapio/carrinho.php" class="menu-btn"><i class="fas fa-shopping-cart"></i> Carrinho</a></li>
                    <li><a href="logout.php" class="menu-btn">Sair</a></li>
                </ul>
            </div>

            <div class="back">

                <a href="index.php#home">
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

        </div>
    </nav>

    <div class="submenu-adm" id="menu-options">
        <ul>
            <li><a href="#pratos" style="text-decoration: none; color:#fff">Pratos</a>
                <ul class="descricao-menu">
                    <li>Editar prato</li>
                </ul>
            </li>
            <li><a href="#bebidas" style="text-decoration: none; color:#fff">Bebidas</a>
                <ul class="descricao-menu">
                    <li>Alterar bebida</li>
                </ul>
            </li>
            <li><a href="#clientes" style="text-decoration: none; color:#fff">Clientes</a>
                <ul class="descricao-menu">
                    <li>Ver Clientes</li>
                </ul>
            </li>
            <li><a href="#pedidos" style="text-decoration: none; color:#fff">Pedidos</a>
                <ul class="descricao-menu">
                    <li>Ver Pedidos</li>
                </ul>
            </li>
            <li><a href="#contato" style="text-decoration: none; color:#fff">Contato</a>
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

    <!-- home section start -->
    <section class="home" id="home">
        <div class="max-width">
            <div class="home-content">


                <div class="text-2">
                    Administração

                </div>

                <br><br>

                <div class="text-3">Bem vindo, <?php include "nome.php" ?></div>

                <a href="#clientes">Gerenciar &nbsp;<i class="fa-solid fa-sliders"></i></a>
            </div>
        </div>
        <div class="arrow">
            <a href="#clientes"><span class="material-symbols-sharp">south</span></a>
        </div>
    </section>


    <!-- clientes section start -->
    <section class="clientes" id="clientes">
        <div class="max-width">
            <h2 class="title">Clientes cadastrados</h2>
            <div class="clientes-content">
                <?php
                $conectar = mysqli_connect("localhost", "root", "", "mariabonita");

                // Carrega os primeiros 10 registros
                $sql_pesquisa = "SELECT idclientes, nome, usuario FROM clientes LIMIT 10";
                $sql_resultado = mysqli_query($conectar, $sql_pesquisa);
                ?>
                <div class="scroll">

                    <table width="100%" border=1 id="tabela-clientes">
                        <tr height="50px">
                            <td>ID DO CLIENTE</td>
                            <td>NOME</td>
                            <td>USUARIO</td>
                        </tr>
                        <?php
                        while ($registro = mysqli_fetch_row($sql_resultado)) {
                        ?>
                            <tr height="50px">
                                <td><?php echo $registro[0]; ?></td>
                                <td><?php echo $registro[1]; ?></td>
                                <td><?php echo $registro[2]; ?></td>
                            </tr>
                        <?php
                        }
                        ?>
                    </table>
                    <div class="button-table">

                        <button id="loadMore">Ver Mais</button>
                        <button id="loadLess" style="display:none;">Ver Menos</button>
                    </div>
                    <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            let offset = 10; // Começamos com 10 registros carregados
                            const loadMoreButton = document.getElementById('loadMore');
                            const loadLessButton = document.getElementById('loadLess');
                            const table = document.getElementById('tabela-clientes');

                            loadMoreButton.addEventListener('click', function() {
                                const xhr = new XMLHttpRequest();
                                xhr.open('GET', 'load_more.php?offset=' + offset, true); // Faz requisição para carregar mais dados
                                xhr.onload = function() {
                                    if (this.status === 200) {
                                        const newRows = this.responseText.trim();
                                        if (newRows) {
                                            table.insertAdjacentHTML('beforeend', newRows); // Insere as novas linhas na tabela
                                            offset += 10; // Atualiza o offset

                                            // Esconde o botão "Ver Mais" se o número de registros retornados for menor que 10
                                            if (newRows.split('<tr').length - 1 < 10) {
                                                loadMoreButton.style.display = 'none';
                                            }
                                            loadLessButton.style.display = 'inline'; // Mostra o botão "Ver Menos"
                                        }
                                    }
                                };
                                xhr.send();
                            });

                            loadLessButton.addEventListener('click', function() {
                                const xhr = new XMLHttpRequest();
                                xhr.open('GET', 'load_less.php', true); // Faz requisição para resetar a tabela
                                xhr.onload = function() {
                                    if (this.status === 200) {
                                        table.innerHTML = `
                        <tr height="50px">
                            <td>ID DO CLIENTE</td>
                            <td>NOME</td>
                            <td>USUARIO</td>
                        </tr>
                    ` + this.responseText.trim(); // Reseta a tabela com os primeiros 10 registros

                                        offset = 10; // Reseta o offset
                                        loadMoreButton.style.display = 'inline'; // Mostra o botão "Ver Mais"
                                        loadLessButton.style.display = 'none'; // Esconde o botão "Ver Menos"
                                    }
                                };
                                xhr.send();
                            });
                        });
                    </script>

                </div>
            </div>
        </div>
        </div>
    </section>

    <section class="pratos" id="pratos">

        <div class="max-width">
            <h2 class="title">Pratos</h2>
            <h4 class="subtitle">Edite o seu prato com apenas 3 passos</h4>
            <br>
            <div class="pratos-content">
                <a class="card" href="cardapio/cadastra_prato.php">
                    <div class="box">
                        <i class="fas fa-plus"></i>
                        <div class="text" style="color:#fff">Adicionar prato</div>
                        <p style="color:#fff; font-size:15pt;">Clique aqui e adicione um prato para o cardápio.</p>
                    </div>
                </a>

                <a class="card" href="cardapio/altera_cardapio.php">
                    <div class="box">
                        <i class="fas fa-pen"></i>
                        <div class="text" style="color:#fff">Alterar prato</div>
                        <p style="color:#fff; font-size:15pt;">Clique aqui e modifique o seu prato do jeito que prefirir.</p>
                    </div>
                </a>
                <a class="card" href="cardapio/excluir_prato.php">
                    <div class="box">
                        <i class="fas fa-trash"></i>
                        <div class="text" style="color:#fff">Remover prato</div>
                        <p style="color:#fff; font-size:15pt;">Clique aqui é exclua o prato que você prefirir.</p>
                    </div>
                </a>
            </div>
        </div>


    </section>

    <!-- pedidos section start -->
    <section class="clientes" id="pedidos">
        <div class="max-width">
            <h2 class="title">Pedidos realizados</h2>
            <div class="pedidos-content">
                <div class="scroll">
                    <table width="100%" border="1" id="tabela-pedidos">
                        <tr height="50px">
                            <td>ID DO PEDIDO</td>
                            <td>USUÁRIO</td>
                            <td>ENDEREÇO</td>
                            <td>PAGAMENTO</td>
                            <td>TOTAL</td>
                            <td>DETALHES</td>
                        </tr>
                        <!-- A tabela de pedidos será preenchida via Ajax -->
                    </table>

                    <!-- Exemplo de estrutura de subtabela -->
                    <tr id="subtabela-1" class="subtabela" style="display: none;">
                        <td colspan="6">
                            <!-- A tabela de itens será carregada dinamicamente aqui -->
                        </td>
                    </tr>


                </div>
                <div class="button-table">
                    <button id="VerMais">Ver Mais</button>
                    <button id="VerMenos" style="display:none;">Ver Menos</button>
                    <button id="ApagarTodos">Limpar registros</button>
                </div>
            </div>
        </div>
    </section>


    <script>
        document.getElementById('ApagarTodos').addEventListener('click', function() {
            // Confirmação antes de apagar todos os registros
            Swal.fire({
                title: 'Tem certeza?',
                text: "Você não poderá reverter esta ação!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sim, apagar!',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Faz a requisição Ajax para apagar todos os registros
                    fetch('apagar_todos_pedidos.php', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/x-www-form-urlencoded'
                            }
                        })
                        .then(response => response.text())
                        .then(result => {
                            if (result === 'success') {
                                Swal.fire({
                                    title: 'Apagado!',
                                    text: 'Todos os pedidos foram apagados com sucesso.',
                                    icon: 'success',
                                    confirmButtonText: 'OK'
                                }).then(() => {
                                    // Atualiza a página automaticamente após a exclusão
                                    location.reload(); // Recarrega a página
                                });
                            } else {
                                Swal.fire({
                                    title: 'Erro!',
                                    text: 'Ocorreu um erro ao tentar apagar os pedidos.',
                                    icon: 'error',
                                    confirmButtonText: 'OK'
                                });
                            }
                        });
                }
            });
        });
    </script>
    <script>
        let limite = 5; // Limite inicial de pedidos
        let todosPedidosCarregados = false;

        // Função para carregar pedidos via Ajax
        function carregarPedidos(limite) {
            const tabela = document.getElementById('tabela-pedidos');

            // Faz a requisição para carregar os pedidos
            fetch('carregar_pedidos.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded'
                    },
                    body: `limite=${limite}`
                })
                .then(response => response.json())
                .then(pedidos => {
                    tabela.innerHTML = `
                <tr height="50px">
                    <td>ID DO PEDIDO</td>
                    <td>USUÁRIO</td>
                    <td>ENDEREÇO</td>
                    <td>PAGAMENTO</td>
                    <td>TOTAL</td>
                    <td>DETALHES</td>
                </tr>
            `; // Reseta a tabela com os novos registros

                    // Itera sobre os pedidos e os adiciona à tabela
                    pedidos.forEach(pedido => {
                        tabela.innerHTML += `
                    <tr height="50px">
                        <td>${pedido.idpedidos}</td>
                        <td>${pedido.clientes_usuario}</td>
                        <td>${pedido.endereco}</td>
                        <td>${pedido.pagamento}</td>
                        <td>${pedido.total}</td>
                        <td>
                            <ul>
                                
                                <a href="javascript:void(0)" onclick="toggleSubtabela(${pedido.idpedidos}, this)">
                                    Detalhes
                                    <i id="icon-${pedido.idpedidos}" class="fas fa-chevron-down icon"></i>
                                </a>
                                
                            </ul>
                        </td>
                    </tr>
                    <tr id="subtabela-${pedido.idpedidos}" class="subtabela" style="display: none;">
                        <td colspan="6">
                            <!-- Subtabela de detalhes pode ser preenchida aqui -->
                        </td>
                    </tr>
                `;
                    });

                    // Se já houver menos de 10 registros, desativar "Ver Mais"
                    if (pedidos.length < limite) {
                        document.getElementById('VerMais').style.display = 'none';
                        todosPedidosCarregados = true;
                    }
                });
        }

        // Carrega os primeiros 10 pedidos ao carregar a página
        carregarPedidos(limite);

        // Listener para o botão "Ver Mais"
        document.getElementById('VerMais').addEventListener('click', function() {
            limite += 10; // Incrementa o limite
            carregarPedidos(limite); // Carrega mais pedidos
            this.style.display = 'none'; // Esconde o botão "Ver Mais"
            document.getElementById('VerMenos').style.display = 'block'; // Mostra o botão "Ver Menos"
        });

        // Listener para o botão "Ver Menos"
        document.getElementById('VerMenos').addEventListener('click', function() {
            limite = 5; // Reseta o limite
            carregarPedidos(limite); // Carrega apenas os 10 primeiros pedidos
            this.style.display = 'none'; // Esconde o botão "Ver Menos"
            document.getElementById('VerMais').style.display = 'block'; // Mostra o botão "Ver Mais"
        });

        function toggleSubtabela(id, element) {
            var subtabela = document.getElementById("subtabela-" + id);
            var icon = document.getElementById("icon-" + id);

            // Se a subtabela já está visível, ocultamos ela
            if (subtabela.classList.contains('subtabela-ativa')) {
                subtabela.classList.remove('subtabela-ativa');
                setTimeout(() => {
                    subtabela.style.display = "none";
                }, 500);
                icon.classList.remove('rotate');
            } else {
                // Carrega os itens do pedido via Ajax
                fetch('itens_pedidos.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded'
                        },
                        body: `id_pedido=${id}`
                    })
                    .then(response => response.json())
                    .then(itens => {
                        // Monta a subtabela com os itens do pedido
                        let subtabelaHTML = `
                <table width="100%" border="1">
                    <tr>
                        <th>ID DO ITEM</th>
                        <th>QUANTIDADE BEBIDA</th>
                        <th>QUANTIDADE PRATO</th>
                        <th>NOME PRATO</th>
                        <th>NOME BEBIDA</th>
                    </tr>
            `;

                        itens.forEach(item => {
                            subtabelaHTML += `
                    <tr>
                        <td>${item.pedidos_idpedidos}</td>
                        <td>${item.quantidade_bebida}</td>
                        <td>${item.quantidade_prato}</td>
                        <td>${item.nome_prato}</td>
                        <td>${item.nome_bebida}</td>
                    </tr>
                `;
                        });

                        subtabelaHTML += `</table>`;

                        // Insere a tabela de itens dentro da subtabela
                        subtabela.querySelector('td').innerHTML = subtabelaHTML;

                        // Exibe a subtabela com os itens
                        subtabela.style.display = "table-row";
                        requestAnimationFrame(() => {
                            subtabela.classList.add('subtabela-ativa');
                        });
                        icon.classList.add('rotate');
                    });
            }
        }
    </script>


    <section class="pratos" id="bebidas">
        <div class="max-width">
            <h2 class="title">Bebidas</h2>
            <h4 class="subtitle">Edite a sua bebida com apenas 3 passos</h4>
            <br>
            <div class="pratos-content">
                <a class="card" href="cardapio/cadastra_bebida.php">
                    <div class="box">
                        <i class="fas fa-plus"></i>
                        <div class="text" style="color:#fff">Adicionar bebida</div>
                        <p style="color:#fff; font-size:15pt;">Clique aqui e adicione uma bebida para o cardápio.</p>
                    </div>
                </a>

                <a class="card" href="cardapio/altera_bebida.php">
                    <div class="box">
                        <i class="fas fa-pen"></i>
                        <div class="text" style="color:#fff">Alterar bebida</div>
                        <p style="color:#fff; font-size:15pt;">Clique aqui e modifique o sua bebida do jeito que prefirir.</p>
                    </div>
                </a>
                <a class="card" href="cardapio/excluir_bebida.php">
                    <div class="box">
                        <i class="fas fa-trash"></i>
                        <div class="text" style="color:#fff">Remover bebida</div>
                        <p style="color:#fff; font-size:15pt;">Clique aqui é exclua a bebida que você prefirir.</p>
                    </div>
                </a>
            </div>
        </div>


    </section>

    <!-- skills section start -->

    <section class="clientes" id="contato">
        <div class="contato">
            <div class="coluna-esquerda">
                <h1>Mudar contato</h1>
                <div class="btn-contato">
                    <div class="btn-whats">
                        <button onclick="abrirModelo(event, 1)" class="btn-whatsapp">WhatsApp</button>

                        <div id="modal_1" class="modal-adm">
                            <div class="modal-content">
                                <span class="close" onclick="fecharModal(1)">&times;</span>
                                <form method="POST">
                                    <h2>Número atual: <br> <?php echo formatar_numero($config['whatsapp_number']) ?></h2>
                                    <br>
                                    <label for="whatsapp_number">Novo Número:</label>
                                    <input type="text" id="whatsapp_number" name="whatsapp_number" oninput="formatarNumero()" maxlength="20" required>
                                    <input type="submit" value="Atualizar"></input>
                                </form>
                                <img src="img/icon-whatsapp.png">
                            </div>
                        </div>

                    </div>

                    <div class="btn-insta">
                        <button onclick="abrirModelo(event, 2)" class="btn-instagram">Instagram</button>

                        <div id="modal_2" class="modal-adm">
                            <div class="modal-content insta">
                                <span class="close" onclick="fecharModal(2)">&times;</span><br>
                                <form method="POST" action="instagram_url.php">
                                    <h2>URL atual: <br>
                                        <div class="url"> <?php echo $config_url['instagram_url'] ?></div>
                                    </h2>
                                    <br>
                                    <label for="instagram_url">Nova URL:<br></label>
                                    <input type="text" name="instagram_url" required>
                                    <input type="submit" value="Atualizar"></input>
                                </form>
                                <img src="img/icon-insta.png">

                            </div>
                        </div>
                    </div>
                </div>


            </div>
            <div class="coluna-direita">
                <div class="esq">
                    <div class="cima">
                        <img class="whatsapp" src="img/whatsapp.png">

                    </div>
                    <div class="baixo">
                        <img class="insta" src="img/insta.jpg">

                    </div>
                </div>
                <div class="dir">
                    <img class="rede" src="img/socialmedia.png">
                </div>
            </div>
        </div>
    </section>

    <script>
        function abrirModelo(event, id) {
            var modal = document.getElementById('modal_' + id);
            modal.style.display = "block";
        }

        function fecharModal(id) {
            var modal = document.getElementById('modal_' + id);
            modal.style.display = "none";
        }


        // Fecha o modal se clicar fora dele
        window.onclick = function(event) {
            var modals = document.getElementsByClassName('modal-adm');
            for (var i = 0; i < modals.length; i++) {
                if (event.target == modals[i]) {
                    modals[i].style.display = "none";
                }
            }
        }

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



    <script src="js/home.js"></script>



</body>

</html>
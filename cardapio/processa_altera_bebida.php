<?php

$conectar = mysqli_connect("localhost", "root", "", "mariabonita");

$status = $_POST["status"];
$cod = $_POST["codigo"];
$nome = $_POST["nome"];
$descricao = $_POST["descricao"];
$preco = $_POST["preco"];
$bebida = $_POST["bebida"];
$foto = $_POST["foto"];

if ($foto <> "") {
    $foto_nome = "images/" . $foto;
    move_uploaded_file($foto, $foto_nome);
} else {
    $pesquisa_caminho_foto = "SELECT foto
								  FROM bebidas
								  WHERE idbebidas = '$cod'";
    $resultado_pesquisa = mysqli_query($conectar, $pesquisa_caminho_foto);
    $registro = mysqli_fetch_row($resultado_pesquisa);
    $foto_nome = $registro[0];
}

$sql_altera = "UPDATE bebidas 		
				   SET 		condicao='$status',
				   			nome='$nome', 
							descricao = '$descricao',
                            preco = '$preco',
							tipo ='$bebida', 
							foto = '$foto_nome'
							
				   WHERE 	idbebidas = '$cod'";
$sql_resultado_alteracao = mysqli_query($conectar, $sql_altera);

if ($sql_resultado_alteracao == true) {
    echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
    echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    title: 'Sucesso!',
                    text: 'Bebida alterada com sucesso.',
                    icon: 'success',
                    showConfirmButton: false,
                    timer: 1500,
                    customClass: {
                        popup: 'custom-swal-popup',
                        title: 'custom-swal-title',
                        text: 'custom-swal-text'
                    }
                    
                });
                setTimeout(function() {
                    window.location.href = 'altera_bebida.php';
                }, 1500); // Redireciona após 1.5 segundos
            });
          </script>";
    echo "<style>
            @import url('https://fonts.googleapis.com/css?family=Open+Sans:300,400,700&display=swap');

            .custom-swal-popup {
                font-family: 'Open Sans', sans-serif;
                background-color: #f7f7f7;
                border-radius: 15px;
                padding: 20px;
                box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
            }

            .custom-swal-title {
                font-size: 24px;
                color: #333;
                margin-bottom: 15px;
            }

            .custom-swal-text {
                font-size: 18px;
                color: #555;
            }
          </style>";
} else {
    echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
    echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    title: 'Erro!',
                    text: 'Erro ao alterar bebida: " . $conectar->error . "',
                    icon: 'error',
                    showConfirmButton: false,
                    timer: 1500,
                    customClass: {
                        popup: 'custom-swal-popup',
                        title: 'custom-swal-title',
                        text: 'custom-swal-text'
                    }
                
                });
                setTimeout(function() {
                    window.location.href = 'altera_dados_bebida.php';
                }, 1500); // Redireciona após 1.5 segundos
            });
          </script>";

    echo "<style>
          @import url('https://fonts.googleapis.com/css?family=Open+Sans:300,400,700&display=swap');

          .custom-swal-popup {
              font-family: 'Open Sans', sans-serif;
              background-color: #f7f7f7;
              border-radius: 15px;
              padding: 20px;
              box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
          }

          .custom-swal-title {
              font-size: 24px;
              color: #333;
              margin-bottom: 15px;
          }

          .custom-swal-text {
              font-size: 18px;
              color: #555;
          }
        </style>";
}

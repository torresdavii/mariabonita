<?php
// Conexão com o banco de dados
$conectar = mysqli_connect("localhost", "root", "", "mariabonita");

// Verifica se a conexão foi bem-sucedida
if ($conectar->connect_error) {
    die("Conexão falhou: " . $conectar->connect_error);
}

// Obtém o ID da bebida a ser excluído
if (isset($_GET['codigo'])) {
    $id = $_GET['codigo'];

    // Prepara a declaração SQL para excluir o prato
    $sql = "DELETE FROM bebidas WHERE idbebidas = ?";

    // Prepara a declaração
    $stmt = $conectar->prepare($sql);
    $stmt->bind_param("i", $id);

    // Executa a declaração
    if ($stmt->execute()) {
        echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
        echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    title: 'Sucesso!',
                    text: 'Bebida excluída com sucesso.',
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
                    window.location.href = 'excluir_bebida.php';
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
                    text: 'Erro ao excluir bebida: " . $conectar->error . "',
                    icon: 'error',
                    showConfirmButton: false,
                    timer: 1500,
                    customClass: {
                        popup: 'custom-swal-popup',
                        title: 'custom-swal-title',
                        text: 'custom-swal-text'
                    }
                
                });
                window.location.href = 'excluir_bebida.php';
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

    // Fecha a declaração
    $stmt->close();
} else {
    echo "ID da bebida não fornecido.";
}

// Fecha a conexão
$conectar->close();

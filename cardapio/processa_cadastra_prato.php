<?php
$conectar = mysqli_connect("localhost", "root", "", "mariabonita");

$status = $_POST["status"];
$nome = $_POST["nome"];
$preco = $_POST["preco"];
$acompanhamentos = $_POST["acompanhamentos"];
$descricao = $_POST["descricao"];
$dia = $_POST["dia"];
$foto = $_FILES["foto"];

$foto_nome = "images/" . $foto["name"];
move_uploaded_file($foto["tmp_name"], $foto_nome);

$sql_cadastrar = "INSERT INTO pratos ( 
											nome, 
                                            condicao,
                                            preco,
											acompanhamentos, 
                                            tipoCarne,
											diaSemana, 
											foto) 
					  VALUES 			   ('$nome',
                                            '$status',
                                            '$preco',
					  						'$acompanhamentos',
                                            '$descricao',
											'$dia', 
											'$foto_nome')";

$sql_resultado_cadastrar = mysqli_query($conectar, $sql_cadastrar);

if ($sql_resultado_cadastrar == true) {
	echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
	echo "<script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    title: 'Sucesso!',
                    text: 'Prato adicionado com sucesso.',
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
                    window.location.href = 'cadastra_prato.php';
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
                    text: 'Erro ao adicionar prato: " . $conectar->error . "',
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
                    window.location.href = 'cadastra_prato.php';
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

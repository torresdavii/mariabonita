
var btnSignin = document.querySelector("#signin");
var btnSignup = document.querySelector("#signup");

var body = document.querySelector("body");


btnSignin.addEventListener("click", function () {
    body.className = "sign-in-js";
});

btnSignup.addEventListener("click", function () {
    body.className = "sign-up-js";
})

document.querySelector('#formCadastro').addEventListener('submit', async function(e) {
    e.preventDefault();

    const form = e.target;
    const formData = new FormData(form);

    try {
        const response = await fetch('processa_cadastra_login.php', {
            method: 'POST',
            body: formData
        });

        const data = await response.json();

        if (data.status === 'success') {
            await Swal.fire({
                icon: 'success',
                title: 'Sucesso!',
                text: data.message,
                showConfirmButton: false,
                timer: 1500,
                customClass: {
                    popup: 'custom-swal-popup',
                    title: 'custom-swal-title',
                    content: 'custom-swal-text',
                    confirmButton: 'custom-swal-button'
                }
            });
            window.location.href = 'index.php';
        } else {
            await Swal.fire({
                icon: 'error',
                title: 'Erro!',
                text: data.message,
                showConfirmButton: true,
                customClass: {
                    popup: 'custom-swal-popup',
                    title: 'custom-swal-title',
                    content: 'custom-swal-text',
                    confirmButton: 'custom-swal-button'
                }
            });
        }
    } catch (error) {
        console.error('Erro:', error);
        Swal.fire({
            icon: 'error',
            title: 'Erro de conexão!',
            text: 'Houve um problema ao tentar processar o cadastro. Tente novamente mais tarde.',
            showConfirmButton: true,
            customClass: {
                popup: 'custom-swal-popup',
                title: 'custom-swal-title',
                content: 'custom-swal-text',
                confirmButton: 'custom-swal-button'
            }
        });
    }
});
document.querySelector('#formLogin').addEventListener('submit', async function(e) {
    e.preventDefault();

    const form = e.target;
    const formData = new FormData(form);

    try {
        const response = await fetch('processa_login.php', {
            method: 'POST',
            body: formData
        });

        const data = await response.json();

        if (data.status === 'success') {
            await Swal.fire({
                icon: 'success',
                title: 'Sucesso!',
                text: data.message,
                showConfirmButton: false,
                timer: 1500,
                customClass: {
                    popup: 'custom-swal-popup',
                    title: 'custom-swal-title',
                    content: 'custom-swal-text',
                    confirmButton: 'custom-swal-button'
                }
            });
            window.location.href = 'index.php';
        } else {
            await Swal.fire({
                icon: 'error',
                title: 'Erro!',
                text: data.message,
                showConfirmButton: true,
                customClass: {
                    popup: 'custom-swal-popup',
                    title: 'custom-swal-title',
                    content: 'custom-swal-text',
                    confirmButton: 'custom-swal-button'
                }
            });
        }
    } catch (error) {
        console.error('Erro:', error);
        Swal.fire({
            icon: 'error',
            title: 'Erro de conexão!',
            text: 'Houve um problema ao tentar processar o login. Tente novamente mais tarde.',
            showConfirmButton: true,
            customClass: {
                popup: 'custom-swal-popup',
                title: 'custom-swal-title',
                content: 'custom-swal-text',
                confirmButton: 'custom-swal-button'
            }
        });
    }
});






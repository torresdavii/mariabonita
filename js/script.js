const container = document.getElementById('container');
const registerBtn = document.getElementById('register');
const loginBtn = document.getElementById('login');

registerBtn.addEventListener('click', () => {
    container.classList.add("active");
});

loginBtn.addEventListener('click', () => {
    container.classList.remove("active");
});

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
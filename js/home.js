$(document).ready(function () {
    $(window).scroll(function () {
        // sticky navbar on scroll script
        if (this.scrollY > 20) {
            $('.navbar').addClass("sticky");
        } else {
            $('.navbar').removeClass("sticky");
        }

        if (this.scrollY > 20) {
            $('.submenu').addClass("sticky");
        } else {
            $('.submenu').removeClass("sticky");
        }

        // scroll-up button show/hide script
        if (this.scrollY > 500) {
            $('.scroll-up-btn').addClass("show");
        } else {
            $('.scroll-up-btn').removeClass("show");
        }
    });

    // slide-up script
    $('.scroll-up-btn').click(function () {
        $('html').animate({ scrollTop: 0 });
        // removing smooth scroll on slide-up button click
        $('html').css("scrollBehavior", "auto");
    });

    $('.navbar .menu li a .submenu').click(function () {
        // applying again smooth scroll on menu items click
        $('html').css("scrollBehavior", "smooth");
    });

    // toggle menu/navbar script
    $('.menu-btn').click(function () {
        $('.navbar .menu .submenu').toggleClass("active");
        $('.menu-btn .fas.fa-bars').toggleClass("active");
    });

    
});








document.addEventListener("DOMContentLoaded", function() {
    const adminBtn = document.getElementById("admin-btn");
    const adminOptions = document.getElementById("admin-options");

    // Função para mostrar/ocultar o submenu ao clicar no botão de administração
    adminBtn.addEventListener("click", function(event) {
        event.preventDefault(); // Previne comportamento padrão do link
        if (adminOptions.style.display === "block") {
            adminOptions.style.display = "none";
        } else {
            adminOptions.style.display = "block";
        }
    });

    // Função para esconder o submenu ao clicar fora dele
    document.addEventListener("click", function(event) {
        if (!adminOptions.contains(event.target) && event.target !== adminBtn) {
            adminOptions.style.display = "none";
        }
    });
});





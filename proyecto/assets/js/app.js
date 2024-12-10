/*sidebar*/
const menu = document.getElementById('menu');
const sidebar =document.getElementById('sidebar');
const main=document.getElementById('main');

menu.addEventListener('click', () => {
    sidebar.classList.toggle('menu-toggle');
    menu.classList.toggle('menu-toggle');
    main.classList.toggle('menu-toggle');
});

/**boton de swiper */
document.addEventListener("DOMContentLoaded", function () {
    const swiper = new Swiper('.mySwiper-1', {
        loop: true,
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
        autoplay: {
            delay: 5000,
        },
    });
});

/**ventana modal */

document.addEventListener('DOMContentLoaded', () => {
    const modal = document.getElementById('modal');
    const closeModalButton = document.getElementById('closeModalButton');
    
    modal.showModal();

    closeModalButton.addEventListener('click', () => {
        modal.close();
    });
});


/**login solo hasta pasarlo a php */
// document.getElementById('loginForm').addEventListener('submit', function(event) {
//     event.preventDefault(); 


//     const username = document.getElementById('username').value;
//     const password = document.getElementById('password').value;

//     const validUsername = "usuario123";  
//     const validPassword = "contraseña123"; 

    
//     if (username === validUsername && password === validPassword) {
//         window.location.href = 'dashboard.html'; 
//     } else {
        
//         document.getElementById('errorMessage').textContent = "Usuario o contraseña incorrectos.";
//     }
// });

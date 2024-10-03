import 'flowbite';

document.addEventListener('DOMContentLoaded', function() {
    // Función para el toggle del menú de usuario
    function toggleDropdown() {
        const dropdown = document.getElementById('user-menu');
        dropdown.classList.toggle('hidden');
    }

    // Asignar el evento al botón del menú
    const userMenuButton = document.getElementById('user-menu-button');
    if (userMenuButton) {
        userMenuButton.addEventListener('click', toggleDropdown);
    }

    //función para ocultar/mostrar el menú header en movil
    function toggleMenuMovil() {
        const menu = document.getElementById('mobile-menu');
        const openIcon = document.getElementById('menu-open-icon');
        const closeIcon = document.getElementById('menu-close-icon');
    
        // Si el menú está oculto (max-height: 0)
        if (menu.classList.contains('max-h-0')) {
            menu.classList.remove('max-h-0');
            menu.classList.add('max-h-screen'); // Máxima altura del menú
        } else {
            menu.classList.remove('max-h-screen');
            menu.classList.add('max-h-0');
        }
    
        // Toggle the icons
        openIcon.classList.toggle('hidden');
        closeIcon.classList.toggle('hidden');
    }
    
      
      // Asignar el evento al botón del menú móvil
    const mobileMenuButton = document.querySelector('button[onclick="toggleMenuMovil()"]');
    if (mobileMenuButton) {
        mobileMenuButton.addEventListener('click', toggleMenuMovil);
    }
});

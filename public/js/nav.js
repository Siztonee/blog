document.addEventListener('DOMContentLoaded', function() {
    const userMenu = document.getElementById('userMenu');
    const userMenuButton = document.getElementById('userMenuButton');
    const userMenuDropdown = document.getElementById('userMenuDropdown');
    let isOpen = false;

    function showMenu() {
        userMenuDropdown.classList.remove('hidden');
        isOpen = true;
    }

    function hideMenu() {
        userMenuDropdown.classList.add('hidden');
        isOpen = false;
    }

    userMenuButton.addEventListener('click', function(e) {
        e.stopPropagation();
        if (isOpen) {
            hideMenu();
        } else {
            showMenu();
        }
    });

    userMenuButton.addEventListener('mouseenter', showMenu);
    userMenuDropdown.addEventListener('mouseenter', showMenu);

    userMenuDropdown.addEventListener('mouseleave', function() {
        hideMenu();
    });

    document.addEventListener('click', function(e) {
        if (!userMenu.contains(e.target)) {
            hideMenu();
        }
    });
});
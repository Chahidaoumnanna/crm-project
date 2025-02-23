import './bootstrap';
import 'admin-lte/dist/js/adminlte.js';
import 'bootstrap/dist/js/bootstrap.bundle.js';



document.addEventListener('DOMContentLoaded', function() {
    const navItems = document.querySelectorAll('.nav-item');

    navItems.forEach(item => {
        if (item.querySelector('.nav-treeview')) {
            item.addEventListener('click', function(e) {
                e.preventDefault();
                item.classList.toggle('show');
            });
        }
    });
});



//dark mode
document.addEventListener("DOMContentLoaded", function () {
    const themeToggle = document.getElementById("theme-toggle");
    const htmlElement = document.documentElement;

    // Vérifier le thème stocké
    const currentTheme = localStorage.getItem("theme") || "light";
    htmlElement.setAttribute("data-bs-theme", currentTheme);
    themeToggle.innerHTML = currentTheme === "dark" ? '<i class="bi bi-sun"></i>' : '<i class="bi bi-moon"></i>';

    // Basculer le mode sombre/claire
    themeToggle.addEventListener("click", () => {
        const newTheme = htmlElement.getAttribute("data-bs-theme") === "dark" ? "light" : "dark";
        htmlElement.setAttribute("data-bs-theme", newTheme);
        localStorage.setItem("theme", newTheme);
        themeToggle.innerHTML = newTheme === "dark" ? '<i class="bi bi-sun"></i>' : '<i class="bi bi-moon"></i>';
    });
});

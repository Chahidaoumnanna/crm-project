<nav class="app-header navbar navbar-expand bg-light shadow-sm">
    <div class="container-fluid">
        <!-- Navbar gauche -->
        <ul class="nav nav-pills nav-fill flex-column flex-sm-row text-dark" id="tabs-text">
            <li class="nav-item me-2">
                <a class="nav-link mb-sm-3 mb-md-0 text-dark" data-lte-toggle="sidebar" href="#">
                    <i class="bi bi-list"></i>
                </a>
            </li>
        </ul>

        <!-- Navbar droite -->
        <ul class="navbar-nav ms-auto">
            <!-- Recherche -->
            <li class="nav-item navbar-search">
                <form class="d-flex">
                    <div class="input-group">
                        <span class="input-group-text bg-white border-0">
                            <i class="bi bi-search"></i>
                        </span>
                        <input type="text" class="form-control border-0" placeholder="Rechercher..." />
                    </div>
                </form>
            </li>

            <!-- Mode sombre -->
            <li class="nav-item">
                <button id="theme-toggle" class="btn btn-light border">
                    <i class="bi bi-moon" id="theme-icon"></i>
                </button>
            </li>

            <!-- Plein écran -->
            <li class="nav-item">
                <a class="nav-link" href="#" data-lte-toggle="fullscreen">
                    <i data-lte-icon="maximize" class="bi bi-arrows-fullscreen"></i>
                    <i data-lte-icon="minimize" class="bi bi-fullscreen-exit d-none"></i>
                </a>
            </li>

            <!-- Menu utilisateur -->
            <li class="nav-item dropdown user-menu">
                <a href="#" class="nav-link dropdown-toggle d-flex align-items-center bg-white border rounded-pill p-2" data-bs-toggle="dropdown">
                    <img src="{{ asset('images/Useravatar.jpg') }}" class="user-image rounded-circle shadow" alt="User Image" width="40" height="40"/>
                    <span class="d-none d-md-inline ms-2 text-dark">Admin</span>
                    <i class="bi bi-chevron-down ms-1"></i>
                </a>
                <ul class="dropdown-menu dropdown-menu-end shadow">
                    <li class="user-header  text-center py-3" style="background-color: #0B162C">
                        <img src="{{ asset('images/Useravatar.jpg') }}" class="rounded-circle shadow" width="70" height="70" />
                        <p class="mt-2 mb-0 text-dark">Alexander Pierce</p>
                        <small class="text-muted">Web Developer</small>
                    </li>
                    <li class="user-body p-3">
                        <div class="row text-center">
                            <div class="col-4">
                                <a href="#" class="text-decoration-none text-dark">
                                    <i class="bi bi-people fs-5"></i>
                                    <p class="mb-0 small">Followers</p>
                                </a>
                            </div>
                            <div class="col-4">
                                <a href="#" class="text-decoration-none text-dark">
                                    <i class="bi bi-graph-up fs-5"></i>
                                    <p class="mb-0 small">Sales</p>
                                </a>
                            </div>
                            <div class="col-4">
                                <a href="#" class="text-decoration-none text-dark">
                                    <i class="bi bi-person-plus fs-5"></i>
                                    <p class="mb-0 small">Ventes</p>
                                </a>
                            </div>
                        </div>
                    </li>
                    <li class="user-footer d-flex justify-content-between px-3 py-2">
                        <a href="#" class="btn btn-outline-primary btn-sm">
                            <i class="bi bi-person-circle me-1"></i> Profil
                        </a>
                        <a href="#" class="btn btn-outline-danger btn-sm">
                            <i class="bi bi-box-arrow-right me-1"></i> Déconnexion
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</nav>
<style>
    /* Couleur des icônes par défaut */
    .navbar-nav .nav-link i,
    .navbar-nav .nav-link span,
    .navbar-search .input-group-text i,
    #theme-toggle i,
    .nav-link[data-lte-toggle="fullscreen"] i,
    .user-menu .dropdown-menu i {
        color: #0B162C !important; /* Couleur des icônes */
        transition: color 0.3s ease; /* Transition fluide */
    }

    /* Effet de survol pour les icônes */
    .navbar-nav .nav-link:hover i,
    .navbar-nav .nav-link:hover span,
    .navbar-search .input-group-text:hover i,
    #theme-toggle:hover i,
    .nav-link[data-lte-toggle="fullscreen"]:hover i,
    .user-menu .dropdown-menu a:hover i {
        color: #007bff !important; /* Couleur au survol */
    }

    /* Fond clair du navbar */
    .app-header {
        background-color: #f8f9fa !important; /* Fond clair */
    }

    /* Style pour le menu utilisateur */
    .user-menu .dropdown-menu {
        background-color: #ffffff !important; /* Fond blanc */
    }
    .user-menu .dropdown-menu a {
        color: #343a40 !important; /* Texte gris foncé */
    }
    .user-menu .dropdown-menu a:hover {
        background-color: #f1f3f5 !important; /* Survol doux */
    }
</style>
<style>
    /* Couleur des icônes par défaut */
    #tabs-text .nav-link i {
        color: #0B162C !important; /* Couleur des icônes */
        transition: color 0.3s ease; /* Transition fluide */
    }

    /* Effet de survol pour les icônes */
    #tabs-text .nav-link:hover i {
        color: #007bff !important; /* Couleur au survol */
    }

    /* Fond clair du navbar */
    #tabs-text {
        background-color: #f8f9fa !important; /* Fond clair */
    }
</style>

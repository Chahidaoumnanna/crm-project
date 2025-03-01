<style>
    .custom-nav {
        background-color: #f8f9fa !important; /* Fond clair */
        color: #343a40 !important; /* Texte gris foncé */
    }
    .custom-nav .nav-link,
    .custom-nav .nav-link i {
        color: #495057 !important; /* Gris foncé pour icônes */
    }
    .custom-nav .nav-link:hover {
        color: #007bff !important; /* Bleu moderne au survol */
    }
    .dark-mode {
        background-color: #e9ecef !important; /* Fond gris clair */
        color: #495057 !important; /* Texte foncé */
    }
    .dropdown-menu {
        background-color: #ffffff !important; /* Fond blanc pour le menu utilisateur */
    }
    .dropdown-menu a {
        color: #343a40 !important; /* Texte gris foncé */
    }
    .dropdown-menu a:hover {
        background-color: #f1f3f5 !important; /* Survol plus doux */
    }
</style>

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
                            <i class="bi bi-search text-dark"></i>
                        </span>
                        <input type="text" class="form-control border-0" placeholder="Rechercher..." />
                    </div>
                </form>
            </li>

            <!-- Mode sombre -->
            <li class="nav-item">
                <button id="theme-toggle" class="btn btn-light border">
                    <i class="bi bi-moon text-dark" id="theme-icon"></i>
                </button>
            </li>

            <!-- Plein écran -->
            <li class="nav-item">
                <a class="nav-link text-dark" href="#" data-lte-toggle="fullscreen">
                    <i data-lte-icon="maximize" class="bi bi-arrows-fullscreen"></i>
                    <i data-lte-icon="minimize" class="bi bi-fullscreen-exit d-none"></i>
                </a>
            </li>

            <!-- Menu utilisateur -->
            <li class="nav-item dropdown user-menu">
                <a href="#" class="nav-link dropdown-toggle d-flex align-items-center bg-white border rounded-pill p-2" data-bs-toggle="dropdown">
                    <img src="{{ asset('images/Useravatar.jpg') }}" class="user-image rounded-circle shadow" alt="User Image" width="40" height="40"/>
                    <span class="d-none d-md-inline ms-2 text-dark">Admin</span>
                    <i class="bi bi-chevron-down ms-1 text-dark"></i>
                </a>
                <ul class="dropdown-menu dropdown-menu-end shadow">
                    <li class="user-header bg-light text-center py-3">
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

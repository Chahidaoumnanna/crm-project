<!--begin::Header-->
<nav class="app-header navbar navbar-expand bg-body">
    <!--begin::Container-->
    <div class="container-fluid">
        <!--begin::Start Navbar Links-->
        <ul class="nav nav-pills nav-fill flex-column flex-sm-row" id="tabs-text" role="tablist">
            <li class="nav-item me-2">
                <a class="nav-link mb-sm-3 mb-md-0" data-lte-toggle="sidebar" href="#" role="button">
                    <i class="bi bi-list"></i>
                </a>
            <li class="nav-item d-none d-md-block me-2">
                <a class="nav-link mb-sm-3 mb-md-0 active btn btn-primary rounded-pill" id="tabs-text-1-tab"
                    data-toggle="tab" href="#tabs-text-1" role="tab" aria-controls="tabs-text-1"
                    aria-selected="true">Home</a>
            </li>

        </ul>
        <!--end::Start Navbar Links-->
        <!--begin::End Navbar Links-->
        <ul class="navbar-nav ms-auto">
            <!--begin::Navbar Search-->
            <li class="nav-item navbar-search">
                <form class="d-flex">
                    <div class="input-group">
                        <span class="input-group-text search-icon">
                            <i class="bi bi-search"></i>
                        </span>
                        <input type="text" class="form-control" placeholder="Rechercher..." aria-label="Rechercher" />
                    </div>
                </form>
            </li>
           <!--begin::Navbar DarkMode-->
           <li  class="nav-item">
            <button id="theme-toggle" class="btn btn-secondary dark-mode">
               <i class="bi bi-moon" id="theme-icon"></i> <!-- Icône pour le dark mode -->
            </button>
            </li>
           <!--end::Navbar DarkMode-->
            <!--begin::Fullscreen Toggle-->
            <li class="nav-item">
                <a class="nav-link" href="#" data-lte-toggle="fullscreen">
                    <i data-lte-icon="maximize" class="bi bi-arrows-fullscreen"></i>
                    <i data-lte-icon="minimize" class="bi bi-fullscreen-exit" style="display: none"></i>
                </a>
            </li>
            <!--end::Fullscreen Toggle-->
            <!--begin::User Menu Dropdown-->
            <li class="nav-item dropdown user-menu">
                <a href="#" class="nav-link dropdown-toggle d-flex align-items-center" data-bs-toggle="dropdown">
                    <img src="{{ asset('images/Useravatar.jpg') }}" class="user-image rounded-circle shadow"
                        alt="User Image" />
                    <span class="d-none d-md-inline ms-2">Alexander Pierce</span>
                    <i class="bi bi-chevron-down ms-1"></i> <!-- Icône flèche -->
                </a>
                <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-end shadow-lg">
                    <!--begin::User Image-->
                    <li class="user-header bg-gradient-primary-to-secondary text-center text-white py-4">
                        <img src="{{ asset('images/Useravatar.jpg') }}" class="rounded-circle shadow" alt="User Image"
                            width="80" height="80" />
                        <p class="mt-2 mb-0">Alexander Pierce</p>
                        <small class="text-white-50">Web Developer</small>
                        <small class="d-block text-white-50">Member since Nov. 2023</small>
                    </li>
                    <!--end::User Image-->
                    <!--begin::Menu Body-->
                    <li class="user-body px-3 py-2">
                        <!--begin::Row-->
                        <div class="row text-center">
                            <div class="col-4">
                                <a href="#" class="text-decoration-none text-dark">
                                    <i class="bi bi-people fs-4"></i> <!-- Icône followers -->
                                    <p class="mb-0 small">Followers</p>
                                </a>
                            </div>
                            <div class="col-4">
                                <a href="#" class="text-decoration-none text-dark">
                                    <i class="bi bi-graph-up fs-4"></i> <!-- Icône sales -->
                                    <p class="mb-0 small">Sales</p>
                                </a>
                            </div>
                            <div class="col-4">
                                <a href="#" class="text-decoration-none text-dark">
                                    <i class="bi bi-person-plus fs-4"></i> <!-- Icône friends -->
                                    <p class="mb-0 small">Friends</p>
                                </a>
                            </div>
                        </div>
                        <!--end::Row-->
                    </li>
                    <!--end::Menu Body-->
                    <!--begin::Menu Footer-->
                    <li class="user-footer d-flex justify-content-between px-3 py-2">
                        <a href="#" class="btn btn-outline-primary btn-sm">
                            <i class="bi bi-person-circle me-1"></i> Profile
                        </a>
                        <a href="#" class="btn btn-outline-danger btn-sm">
                            <i class="bi bi-box-arrow-right me-1"></i> Sign out
                        </a>
                    </li>
                    <!--end::Menu Footer-->
                </ul>
            </li>
            <!--end::User Menu Dropdown-->
            <!--end::User Menu Dropdown-->
        </ul>
        <!--end::End Navbar Links-->
    </div>
    <!--end::Container-->
</nav>
<!--end::Header-->

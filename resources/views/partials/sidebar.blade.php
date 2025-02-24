<!--begin::Sidebar-->
<aside class="app-sidebar bg-light shadow-lg" data-bs-theme="light">
    <!--begin::Sidebar Brand-->
    <div class="sidebar-brand bg-gradient-primary-to-secondary p-3">
        <!--begin::Brand Link-->
        <a class='brand-link d-flex align-items-center text-decoration-none' href='{{ route('home') }}'>
            <!--begin::Brand Image-->
            <img
                src="{{ asset('images/logo.png') }}"
                alt="AdminLTE Logo"
                class="brand-image img-fluid opacity-90 shadow-sm"
            />
            <!--end::Brand Image-->
            <!--begin::Brand Text-->
            <span class="brand-text fw-light ms-2" style="color: #333;">CRM Project</span>
            <!--end::Brand Text-->
        </a>
        <!--end::Brand Link-->
    </div>
    <!--end::Sidebar Brand-->
    <!--begin::Sidebar Wrapper-->
    <div class="sidebar-wrapper p-3">
        <nav class="mt-2">
            <!--begin::Sidebar Menu-->
            <ul
                class="nav sidebar-menu flex-column"
                data-lte-toggle="treeview"
                role="menu"
                data-accordion="false"
            >
                <li class="nav-item mb-2">
                    <a class='nav-link d-flex align-items-center text-dark text-decoration-none p-2 rounded' href='{{ route('home') }}'>
                        <i class="nav-icon bi bi-house me-2"></i>
                        <p class="mb-0">Home</p>
                    </a>
                </li>
                <li class="nav-item mb-2">
                    <a class='nav-link d-flex align-items-center text-dark text-decoration-none p-2 rounded' href='{{ route('clients.index') }}'>
                        <i class="nav-icon bi bi-person me-2"></i>
                        <p class="mb-0">Client</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link d-flex align-items-center text-dark text-decoration-none p-2 rounded">
                        <i class="bi-box me-2"></i>
                        <p class="mb-0">
                            Stock
                            <i class="nav-arrow bi bi-chevron-right ms-auto"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a class='nav-link d-flex align-items-center text-dark text-decoration-none p-2 rounded' href='/dist/pages/'>
                                <i class="bi-cart me-2"></i>
                                <p class="mb-0">Produit</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class='nav-link d-flex align-items-center text-dark text-decoration-none p-2 rounded' href='/dist/pages/index2'>
                                <i class="bi-hash me-2"></i>
                                <p class="mb-0">Unité</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class='nav-link d-flex align-items-center text-dark text-decoration-none p-2 rounded' href='/dist/pages/index3'>
                                <i class="bi-box me-2"></i>
                                <p class="mb-0">Sortie de stock</p>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
            <!--end::Sidebar Menu-->
        </nav>
    </div>
    <!--end::Sidebar Wrapper-->
</aside>
<!--end::Sidebar-->

<!--begin::Sidebar-->
<aside class="app-sidebar shadow-lg" style="background-color: #0B162C;" data-bs-theme="light">
    <!--begin::Sidebar Brand-->
    <div class="sidebar-brand bg-gradient-primary-to-secondary p-3">
        <!--begin::Brand Link-->
        <a class='brand-link d-flex align-items-center text-decoration-none m-3' href='{{ route('home') }}'>
            <!--begin::Brand Image-->
            <img
                src="{{ asset('images/novicore-4a9d51aef45f2b931c676a92284b14e6.png') }}"
                alt="Novicore Logo"
                class="brand-image img-fluid opacity-100 shadow-lg"
            />
            <!--end::Brand Image-->
            <!--begin::Brand Text-->
            <span class="brand-text fw-light ms-2" style="color: #fff !important; font-size: 1.5rem; margin-bottom: 1rem;">Novicore</span>
            <!--end::Brand Text-->
        </a>
        <!--end::Brand Link-->
    </div>
    <!--end::Sidebar Brand-->

    <!--begin::Sidebar Wrapper-->
    <div class="sidebar-wrapper p-3 ">
        <nav class="mt-2">
            <!--begin::Sidebar Menu-->
            <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="menu" data-accordion="false">
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
                <li class="nav-item mb-2">
                    <a class='nav-link d-flex align-items-center text-dark text-decoration-none p-2 rounded' href='{{ route('bonlivraison.index') }}'>
                        <i class="nav-icon bi bi-receipt me-2"></i> <!-- Icône changée -->
                        <p class="mb-0">Bon de livraison</p>
                    </a>
                </li>
                <li class="nav-item mb-2">
                    <a class='nav-link d-flex align-items-center text-dark text-decoration-none p-2 rounded' href='{{ route('produits.index') }}'>
                        <i class="nav-icon bi bi-box-seam me-2"></i> <!-- Icône changée -->
                        <p class="mb-0">Produit</p>
                    </a>
                </li>
                <li class="nav-item mb-2">
                    <a class='nav-link d-flex align-items-center text-dark text-decoration-none p-2 rounded' href="{{ route('ticket.index') }}">
                        <i class="nav-icon bi bi-ticket-perforated me-2"></i>
                        <p class="mb-0">Tickets</p>
                    </a>
                </li>
            </ul>
            <!--end::Sidebar Menu-->
        </nav>
    </div>
    <!--end::Sidebar Wrapper-->
    <!--end::Sidebar-->

</aside>
<style>
    .text-dark {
        color: #fff !important; /* ou une autre couleur claire */
    }
</style>
Nsdfghjkhshjsjjs

<!--begin::Sidebar-->
<aside class="app-sidebar shadow-lg" style="background-color: #0a1730; color: #fff;" data-bs-theme="dark">
    <!--begin::Sidebar Brand  #0B162C-->
    <div class="sidebar-brand p-3 text-center">
        <img src="{{ asset('images/novicore-4a9d51aef45f2b931c676a92284b14e6.png') }}" alt="Novicore Logo" class="brand-image img-fluid opacity-100" />
        <span class="brand-text fw-bold" style="font-size: 1.5rem; font-family:'ui-sans-serif'">Novicore</span>
    </div>
    <!--end::Sidebar Brand-->

    <!--begin::Sidebar Wrapper-->
    <div class="sidebar-wrapper p-3">
        <nav>
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link text-light" href="{{ route('home') }}">
                        <i class="bi bi-house-door me-2"></i> ACCUEIL
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link text-light" data-bs-toggle="collapse" href="#crmMenu">
                        <i class="bi bi-people me-2"></i> CRM
                    </a>
                    <ul class="collapse list-unstyled ms-3" id="crmMenu">
                        <li><a class="nav-link text-light" href="{{ route('clients.index') }}">Client</a></li>
                        <li><a class="nav-link text-light" href=" #">Fournisseur</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-light" data-bs-toggle="collapse" href="#stockMenu">
                        <i class="bi bi-box-seam me-2"></i> STOCK
                    </a>
                    <ul class="collapse list-unstyled ms-3" id="stockMenu">
                        <li>
                            <a class="nav-link text-light" href="{{ route('produits.index') }}">Produit</a>


                        </li>
                        <li><a class="nav-link text-light" href="{{route('bonlivraison.index') }}">Sortie de stock</a></li>
                        <li><a class="nav-link text-light" href="#">Entrée de stock</a></li>
                        <li><a class="nav-link text-light" href="#">Avoir de client</a></li>
                        <li><a class="nav-link text-light" href="#">Avoir de fournisseur</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-light" data-bs-toggle="collapse" href="#documentMenu">
                        <i class="bi bi-file-earmark-text me-2"></i> DOCUMENT
                    </a>
                    <ul class="collapse list-unstyled ms-3" id="documentMenu">
                        <li><a class="nav-link text-light" href="#">Facture</a></li>
                        <li><a class="nav-link text-light" href="#">Devis</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
    </div>
    <!--end::Sidebar Wrapper-->
</aside>
<!--end::Sidebar-->

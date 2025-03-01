<!--begin::Footer-->
<footer class="app-footer">
    <!--begin::To the end-->
    <div class="float-end d-none d-sm-inline">
        <a href="#" class="text-decoration-none hover-effect">Anything you want</a>
    </div>
    <!--end::To the end-->
    <!--begin::Copyright-->
    <strong>
        Copyright &copy; 2014-2025&nbsp;
        <a href="https://adminlte.io" class="text-decoration-none hover-effect">AdminLTE.io</a>.
    </strong>
    All rights reserved.
    <!--end::Copyright-->
</footer>
<!--end::Footer-->

<!-- Styles pour un footer moderne et simple -->
<style>
    .app-footer {
        background-color: #ffffff; /* Fond blanc */
        color: #333333; /* Texte sombre */
        padding: 20px;
        text-align: center;
        font-size: 14px;
        border-top: 1px solid #e0e0e0; /* Bordure légère en haut */
        box-shadow: 0 -2px 10px rgba(0, 0, 0, 0.05); /* Ombre subtile */
        position: relative;
        overflow: hidden;
        transition: box-shadow 0.3s ease;
    }

    .app-footer:hover {
        box-shadow: 0 -4px 15px rgba(0, 0, 0, 0.1); /* Ombre plus prononcée au survol */
    }

    .app-footer a {
        color: #3498db; /* Couleur des liens */
        transition: color 0.3s ease, transform 0.3s ease;
    }

    .app-footer a.hover-effect:hover {
        color: #1abc9c; /* Changement de couleur au survol */
        transform: translateY(-2px); /* Effet de déplacement vers le haut */
    }

    .app-footer strong {
        font-weight: 600;
    }

    .app-footer::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 2px;
        background: linear-gradient(90deg, transparent, #3498db, transparent);
        animation: slide 3s linear infinite;
    }

    @keyframes slide {
        0% {
            left: -100%;
        }
        100% {
            left: 100%;
        }
    }

    .app-footer .float-end {
        font-style: italic;
        color: #777777; /* Texte secondaire */
    }
</style>

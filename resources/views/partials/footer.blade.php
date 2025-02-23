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

<!-- Styles pour un footer moderne et interactif -->
<style>
    .app-footer {
        background-color: #2c3e50; /* Fond sombre */
        color: #ecf0f1; /* Texte clair */
        padding: 20px;
        text-align: center;
        font-size: 14px;
        border-top: 3px solid #3498db; /* Bordure bleue en haut */
        box-shadow: 0 -2px 10px rgba(0, 0, 0, 0.1); /* Ombre portée */
        position: relative;
        overflow: hidden;
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
        height: 3px;
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
    }
</style>
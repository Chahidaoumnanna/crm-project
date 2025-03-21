@extends('base')

@section('title', 'Home')
@section('bodyTitle','Home')

@section('body')
    <!-- Small Box (Stat card) -->
    <!-- Small boxes (Stat box) -->
    <!-- /.row -->

    <style>
        body {
            background-color: #f8f9fa;
        }

        .stat-icon {
            font-size: 30px;
            padding: 10px;
            border-radius: 50%;
        }
        .text-muted {
            font-size: 14px;
        }
        .stat-box i {
            font-size: 24px;
        }
        .green-box {
            border-left: 5px solid #8fc79a;
        }
        .blue-box {
            border-left: 5px solid #68c2dc;
        }
        .dark-blue-box {
            border-left: 5px solid #4a90e2;
        }
        .yellow-box {
            border-left: 5px solid #f8c74e;
        }
             /* Styles de base pour les boîtes */
         .stat-box {
             display: flex;
             align-items: center;
             justify-content: space-between;
             padding: 15px;
             background: #ffffff;
             border-radius: 8px;
             box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
             min-width: 250px;
             transition: transform 0.3s ease, box-shadow 0.3s ease; /* Transition fluide */
         }

        /* Effet de survol */
        .stat-box:hover {
            transform: translateY(-5px); /* Légère élévation */
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2); /* Ombre plus prononcée */
        }

        /* Couleurs des bordures */
        .green-box {
            border-left: 5px solid #8fc79a;
        }
        .blue-box {
            border-left: 5px solid #68c2dc;
        }
        .dark-blue-box {
            border-left: 5px solid #4a90e2;
        }
        .yellow-box {
            border-left: 5px solid #f8c74e;
        }

        /* Styles pour les icônes */
        .stat-icon {
            font-size: 30px;
            padding: 10px;
            border-radius: 50%;
            background-color: #f8f9fa; /* Fond clair pour les icônes */
            transition: background-color 0.3s ease; /* Transition fluide */
        }

        /* Effet de survol pour les icônes */
        .stat-box:hover .stat-icon {
            background-color: #e9ecef; /* Changement de fond au survol */
        }

        /* Styles pour le texte */
        .stat-box h5 {
            font-weight: bold;
            color: #343a40; /* Couleur du texte */
        }
        .stat-box p {
            font-size: 14px;
            color: #6c757d; /* Couleur du texte secondaire */
        }
    </style>


    <div class="container mt-4">

        <div class="row g-3">
            <!-- Total des ventes -->
            <div class="col-md-3 mb-4">
                <div class="stat-box green-box d-flex align-items-center">
                    <i class="bi bi-cart stat-icon text-success bg-light"></i>
                    <div class="ms-3">
                        <p class="mb-1 text-muted">TOTAL DES VENTES (0)</p>
                        <h5 class="mb-0">0,00 DH</h5>
                    </div>
                </div>
            </div>

            <!-- Total des entrées de stock -->
            <div class="col-md-3">
                <div class="stat-box blue-box d-flex align-items-center">
                    <i class="bi bi-box-seam stat-icon text-primary bg-light"></i>
                    <div class="ms-3">
                        <p class="mb-1 text-muted">TOTAL DES ENTRÉES DE STOCK </p>
                        <h5 class="mb-0">0,00 DH</h5>
                    </div>
                </div>
            </div>

            <!-- Total du bénéfice -->
            <div class="col-md-3">
                <div class="stat-box dark-blue-box d-flex align-items-center">
                    <i class="bi bi-bar-chart stat-icon text-info bg-light"></i>
                    <div class="ms-3">
                        <p class="mb-1 text-muted">TOTAL DU BÉNÉFICE</p>
                        <h5 class="mb-0">0,00 DH</h5>
                    </div>
                </div>
            </div>

            <!-- Total des factures -->
            <div class="col-md-3">
                <div class="stat-box yellow-box d-flex align-items-center">
                    <i class="bi bi-file-earmark-text stat-icon text-warning bg-light"></i>
                    <div class="ms-3">
                        <p class="mb-1 text-muted">TOTAL DES FACTURES (0)</p>
                        <h5 class="mb-0">0,00 DH</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>




    <!-- /.row -->
    <!-- /.start Statistiques -->

    <div class="row "> <!-- Ligne contenant les graphiques -->

        <!-- Première colonne pour le graphique Chart.js -->
        <div class="col-md-6">
            <div class="card mb-3">
                <div class="card-body p-3">
                    <div class="chart">
                        <canvas id="mixed-chart" class="chart-canvas" height="300"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- Deuxième colonne pour le graphique ApexCharts -->
        <div class="col-md-6">
            <div class="card card-chart">
                <div class="card-header">
                    <div class="row align-items-center">
                        <div class="col-6">
                            <h5 class="card-title">Aperçu des ventes</h5>
                        </div>
                        <div class="col-6">
                            <ul class="chart-list list-unstyled p-0 m-0">
                                <li><span class="circle-blue"></span></li>
                                <li><span class="circle-green"></span></li>
                                <li><span class="circle-orange"></span></li>
                                <li class="star-menus">
                                    <a href="javascript:;"><i class="fas fa-ellipsis-v"></i></a>
                                </li>
                            </ul>

                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div id="apexcharts-area"></div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            var options = {
                chart: {
                    type: "area",
                    height: 300
                },
                series: [
                    {
                        name: "Stock",
                        data: [150, 180, 200, 170, 210, 230, 250]
                    },
                    {
                        name: "Clients",
                        data: [50, 80, 120, 140, 180, 200, 220]
                    },
                    {
                        name: "Ventes",
                        data: [5000, 7000, 10000, 12000, 15000, 17000, 20000]
                    }
                ],
                xaxis: {
                    categories: ["Jan", "Fév", "Mar", "Avr", "Mai", "Juin", "Juil"]
                },
                colors: ["#007bff", "#28a745", "#fd7e14"], // Bleu, Vert, Orange
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    curve: "smooth"
                },
                grid: {
                    borderColor: "#f1f1f1"
                }
            };

            var chart = new ApexCharts(document.querySelector("#apexcharts-area"), options);
            chart.render();
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const ctx = document.getElementById('mixed-chart').getContext('2d');
            const mixedChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['Janvier', 'Février', 'Mars', 'Avril', 'Mai'],
                    datasets: [{
                        label: 'Ventes',
                        data: [65, 59, 80, 81, 56],
                        backgroundColor: 'rgba(68,157,228,0.8)', // Bleu clair plus opaque
                        borderColor: 'rgb(1,34,60)', // Bleu clair
                        borderWidth: 1,
                        borderRadius: 8, // Bords arrondis plus prononcés
                        barThickness: 30, // Largeur des barres (taille moyenne)
                    }, {
                        label: 'Factures',
                        data: [28, 48, 40, 19, 86],
                        type: 'line', // Graphique en ligne
                        borderColor: 'rgb(236,179,9)', // Orange clair
                        borderWidth: 3, // Ligne plus épaisse
                        fill: false,
                        tension: 0.4, // Courbure de la ligne
                        pointRadius: 5, // Taille des points
                        pointBackgroundColor: 'rgba(255, 152, 0, 1)', // Couleur des points
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'top', // Légende en haut
                            labels: {
                                color: '#333', // Couleur du texte de la légende
                                font: {
                                    size: 14, // Taille de la police de la légende
                                    weight: 'bold', // Texte en gras
                                }
                            }
                        },
                        tooltip: {
                            backgroundColor: 'rgba(0, 0, 0, 0.9)', // Fond des tooltips plus sombre
                            titleColor: '#fff', // Couleur du titre des tooltips
                            bodyColor: '#fff', // Couleur du texte des tooltips
                            titleFont: {
                                size: 14, // Taille de la police du titre des tooltips
                            },
                            bodyFont: {
                                size: 12, // Taille de la police du texte des tooltips
                            },
                            padding: 10, // Espacement interne des tooltips
                            cornerRadius: 5, // Coins arrondis des tooltips
                        }
                    },
                    scales: {
                        x: {
                            grid: {
                                display: false, // Masquer la grille de l'axe X
                            },
                            ticks: {
                                color: '#666', // Couleur des ticks de l'axe X
                                font: {
                                    size: 12, // Taille de la police des ticks de l'axe X
                                }
                            }
                        },
                        y: {
                            beginAtZero: true,
                            grid: {
                                color: 'rgba(200, 200, 200, 0.2)', // Couleur de la grille de l'axe Y
                            },
                            ticks: {
                                color: '#666', // Couleur des ticks de l'axe Y
                                font: {
                                    size: 12, // Taille de la police des ticks de l'axe Y
                                },
                                stepSize: 20, // Intervalle des ticks de l'axe Y
                            }
                        }
                    },
                    animation: {
                        duration: 1000, // Durée de l'animation
                        easing: 'easeInOutQuart', // Effet d'animation fluide
                    }
                }
            });
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

    <style>
        .card-header {
            background: #f8f9fa;
            font-weight: bold;
        }
        .action-btn {
            border: none;
            background: none;
            color: white;
        }
    </style>

    <div class="">
        <div class="row">
            <!-- Premier tableau : Ajout de mt-4 pour une marge en haut -->
            <div class="col-md-6">
                <div class="card mb-4 mt-4"> <!-- Ajout de mt-4 -->
                    <div class="card-header d-flex justify-content-between align-items-center">
                        L'échéance du client
                        <div>
                            <label>Du :</label>
                            <input type="date" value="2025-02-28">
                            <label>Au :</label>
                            <input type="date" value="2025-03-07">
                            <button class="btn btn-primary btn-sm">
                                <i class="bi bi-funnel"></i> Filtre
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered text-center">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Client</th>
                                <th>Montant</th>
                                <th>Échéance</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr><td colspan="5">Aucun élément trouvé</td></tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Deuxième tableau : Ajout de mt-4 pour une marge en haut -->
            <div class="col-md-6">
                <div class="card mb-4 mt-4"> <!-- Ajout de mt-4 -->
                    <div class="card-header d-flex justify-content-between align-items-center">
                        Échéance Fournisseur
                        <div>
                            <label>Du :</label>
                            <input type="date" value="2025-02-28">
                            <label>Au :</label>
                            <input type="date" value="2025-03-07">
                            <button class="btn btn-primary btn-sm">
                                <i class="bi bi-funnel"></i> Filtre
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered text-center">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Fournisseur</th>
                                <th>Montant</th>
                                <th>Échéance</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr><td colspan="5">Aucun élément trouvé</td></tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Troisième tableau : Ajout de mb-4 pour une marge en bas -->
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4"> <!-- Ajout de mb-4 -->
                    <div class="card-header">Les clients en retard de paiement</div>
                    <div class="card-body">
                        <table class="table table-bordered text-center">
                            <thead>
                            <tr>
                                <th>Nom et prénom</th>
                                <th>Compte</th>
                                <th>Téléphone</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>Youness</td>
                                <td>-20,00</td>
                                <td></td>
                                <td>
                                    <button class="btn btn-primary btn-sm">
                                        <i class="bi bi-info-circle"></i>
                                    </button>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <style>
        .custom-margin-top {
            margin-top: 2rem; /* Marge en haut de 2rem */
        }
        .custom-margin-bottom {
            margin-bottom: 2rem; /* Marge en bas de 2rem */
        }
    </style>




@endsection

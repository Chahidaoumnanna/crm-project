@extends('base')

@section('title', 'Home')
@section('bodyTitle','Home')

@section('body')
    <!-- Small Box (Stat card) -->
    <!-- Small boxes (Stat box) -->
    <div class="row">
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="card card-stats mb-4 mb-lg-0">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col">
                            <h5 class="card-title text-uppercase text-muted mb-0">TOTAL DES VENTES</h5>
                            <span class="h2 font-weight-bold mb-0" style="white-space: nowrap;">77 877,10 DH</span>
                        </div>
                        <div class="col-auto">
                            <div class="icon icon-shape bg-info text-white rounded-circle shadow">
                                <i class="bi bi-cart-fill"></i> <!-- Icône de panier de Bootstrap Icons -->
                            </div>
                        </div>
                    </div>
                    <p class="mt-3 mb-0 text-muted text-sm">
                        <a href="#" class="text-primary text-decoration-none">
                            Plus d'informations <i class="bi bi-arrow-right"></i>
                        </a>
                    </p>
                </div>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="card card-stats mb-4 mb-lg-0">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col">
                            <h5 class="card-title text-uppercase text-muted mb-0">TOTAL DU BÉNÉFICE</h5>
                            <span class="h2 font-weight-bold mb-0" style="white-space: nowrap;">18 258,94 DH</span>
                        </div>
                        <div class="col-auto">
                            <div class="icon icon-shape bg-success text-white rounded-circle shadow">
                                <i class="bi bi-graph-up"></i> <!-- Icône de bénéfice de Bootstrap Icons -->
                            </div>
                        </div>
                    </div>
                    <p class="mt-3 mb-0 text-muted text-sm">
                        <a href="#" class="text-primary text-decoration-none">
                            Plus d'informations <i class="bi bi-arrow-right"></i>
                        </a>
                    </p>
                </div>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="card card-stats mb-4 mb-lg-0">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col">
                            <h5 class="card-title text-uppercase text-muted mb-0">TOTAL DU STOCK</h5>
                            <span class="h2 font-weight-bold mb-0" style="white-space: nowrap;">247 723,44 DH</span>
                        </div>
                        <div class="col-auto">
                            <div class="icon icon-shape bg-warning text-white rounded-circle shadow">
                                <i class="bi bi-box-seam"></i> <!-- Icône de stock de Bootstrap Icons -->
                            </div>
                        </div>
                    </div>
                    <p class="mt-3 mb-0 text-muted text-sm">
                        <a href="#" class="text-primary text-decoration-none">
                            Plus d'informations <i class="bi bi-arrow-right"></i>
                        </a>
                    </p>
                </div>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="card card-stats mb-4 mb-lg-0">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col">
                            <h5 class="card-title text-uppercase text-muted mb-0">TOTAL CRÉDIT CLIENTS</h5>
                            <span class="h2 font-weight-bold mb-0" style="white-space: nowrap;">-19 227,70 DH</span>
                        </div>
                        <div class="col-auto">
                            <div class="icon icon-shape bg-danger text-white rounded-circle shadow">
                                <i class="bi bi-credit-card"></i> <!-- Icône de crédit de Bootstrap Icons -->
                            </div>
                        </div>
                    </div>
                    <p class="mt-3 mb-0 text-muted text-sm">
                        <a href="#" class="text-primary text-decoration-none">
                            Plus d'informations <i class="bi bi-arrow-right"></i>
                        </a>
                    </p>
                </div>
            </div>
        </div>
        <!-- ./col -->
    </div>


    <!-- /.row -->
     <!-- /.start Statistiques -->
    <div class="row mt-5">

    <div class="card mb-3">
  <div class="card-body p-3">
    <div class="chart">
      <canvas id="mixed-chart" class="chart-canvas" height="300"></canvas>
    </div>
  </div>
</div>


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
                    backgroundColor: 'rgba(100, 181, 246, 0.8)', // Bleu clair plus opaque
                    borderColor: 'rgba(100, 181, 246, 1)', // Bleu clair
                    borderWidth: 1,
                    borderRadius: 8, // Bords arrondis plus prononcés
                    barThickness: 30, // Largeur des barres (taille moyenne)
                }, {
                    label: 'Factures',
                    data: [28, 48, 40, 19, 86],
                    type: 'line', // Graphique en ligne
                    borderColor: 'rgba(255, 152, 0, 1)', // Orange clair
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
                        cornerRadius: 5, // Coins arrondis des     tooltips
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

</div>
    <!-- Liste des 5 derniers clients -->
    <div class="row mt-5">
        <div class="col-12">
            <h2 class="mb-4">Les 5 derniers clients ajoutés</h2>
            <table class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>Code</th>
                    <th>Nom</th>
                    <th>Email</th>
                    <th>Téléphone</th>
                    <th>Adresse</th>
                    <th>Type</th>
                    <th>Date d'ajout</th>
                </tr>
                </thead>
                <tbody>
                @foreach($latestClients as $client)
                    <tr>
                        <td>{{ $client->code }}</td>
                        <td>{{ $client->name }}</td>
                        <td>{{ $client->email ?? 'N/A' }}</td>
                        <td>{{ $client->phone ?? 'N/A' }}</td>
                        <td>{{ $client->address ?? 'N/A' }}</td>
                        <td>{{ $client->type }}</td>
                        <td>{{ $client->created_at->format('d/m/Y H:i') }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>











@endsection


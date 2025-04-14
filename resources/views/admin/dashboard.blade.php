@extends('layout.sidebar')

@section('content')
<style>
    .with-sidebar {
        padding-left: 250px;
    }

    @media (max-width: 768px) {
        .with-sidebar {
            padding-left: 0;
        }
    }
</style>

<div class="with-sidebar py-4">
    <div class="container-fluid">
        <div class="row gy-4">
            <div class="col-12">
                <h4 class="fw-semibold">Selamat Datang, Admin!</h4>
            </div>

            <!-- Grafik Statistik Penjualan -->
            <div class="col-xl-8 col-lg-7 col-md-12">
                <div class="card shadow-sm rounded-4">
                    <div class="card-body">
                        <h5 class="card-title">Statistik Penjualan</h5>
                        <canvas id="salesChart" height="220"></canvas>
                    </div>
                </div>
            </div>

            <!-- Grafik Pie Persentase Produk Hari Ini -->
            <div class="col-xl-4 col-lg-5 col-md-12">
                <div class="card shadow-sm rounded-4">
                    <div class="card-body">
                        <h5 class="card-title">Persentase Penjualan Produk Hari Ini</h5>
                        <canvas id="productChart" height="220"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Grafik Batang: Statistik Penjualan per Tanggal
    const salesCtx = document.getElementById('salesChart').getContext('2d');
    const salesData = @json($salesData);

    new Chart(salesCtx, {
        type: 'bar',
        data: {
            labels: salesData.dates,
            datasets: [{
                label: 'Jumlah Produk Terjual',
                data: salesData.sales,
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            return value;
                        }
                    }
                }
            }
        }
    });

    // Grafik Pie: Persentase Penjualan Produk Hari Ini dengan Jumlah di Tooltip
    const productCtx = document.getElementById('productChart').getContext('2d');
    const produkLabels = @json(array_keys($produkPercentages));
    const produkData = @json(array_values($produkPercentages));
    const produkSales = @json($produkSales); // jumlah produk terjual hari ini

    new Chart(productCtx, {
        type: 'pie',
        data: {
            labels: produkLabels,
            datasets: [{
                data: produkData,
                backgroundColor: [
                    '#ff9999','#ffcc66','#9966ff','#ff6699','#6699ff',
                    '#66cccc','#ff9966','#66cc66','#ffcc99','#99cccc'
                ]
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'bottom'
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            const label = context.label || '';
                            const value = produkSales[label] || 0;
                            const percentage = context.parsed.toFixed(2);
                            return `${label}: ${value} terjual hari ini (${percentage}%)`;
                        }
                    }
                }
            }
        }
    });
</script>
@endsection

<!-- Content Row -->
<div class="row d-flex justify-content-center gap-3">

    <!-- Daftar Tamu -->
    <div class="col-10 col-sm-6 col-md-4 col-lg-3 mb-4">
        <a href="{{ route('tamu.index') }}" class="d-block text-decoration-none">
            <div class="card text-center border-left-primary shadow py-3">
                <i class="fas fa-users fa-2x text-gray-300 mb-2"></i>
                <h6 class="text-primary text-uppercase m-0">Daftar Tamu</h6>
            </div>
        </a>
    </div>

    <!-- Form Tamu -->
    <div class="col-10 col-sm-6 col-md-4 col-lg-3 mb-4">
        <a href="{{ route('tamu.form') }}" class="d-block text-decoration-none">
            <div class="card text-center border-left-primary shadow py-3">
                <i class="fas fa-address-book fa-2x text-gray-300 mb-2"></i>
                <h6 class="text-primary text-uppercase m-0">Form Tamu</h6>
            </div>
        </a>
    </div>

</div>

<!-- Area Chart -->
<div class="row">
    <div class="col-xl-12 col-lg-12">
        <div class="card shadow mb-4">

            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Statistik Kunjungan Tamu per Bulan</h6>
            </div>

            <div class="card-body">
                <div class="chart-area" style="height: 350px;">
                    <canvas id="myBarChart"></canvas>
                </div>
            </div>

        </div>
    </div>
</div>

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
document.addEventListener("DOMContentLoaded", function() {

    const ctx = document.getElementById("myBarChart");

    if (!ctx) {
        console.error("Canvas myBarChart tidak ditemukan");
        return;
    }

    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: @json($labels),
            datasets: [{
                label: "Jumlah Tamu",
                data: @json($jumlah),

                // WARNA-WARNI SETIAP BATANG
                backgroundColor: [
                    "#f6c23e", // Jan
                    "#1cc88a", // Feb
                    "#36b9cc", // Mar
                    "#f6c23e", // Apr
                    "#1cc88a", // Mei
                    "#36b9cc", // Jun
                    "#f6c23e", // Jul
                    "#1cc88a", // Agu
                    "#36b9cc", // Sep
                    "#f6c23e", // Okt
                    "#1cc88a", // Nov
                    "#36b9cc"  // Des
                ],

                // BORDER BAR
                borderColor: "#4e73df",
                borderWidth: 1
            }]
        },

        options: {
            responsive: true,
            maintainAspectRatio: false,

            scales: {
                y: {
                    beginAtZero: true,
                    ticks: { precision: 0 },
                    title: {
                        display: true,
                        text: 'Jumlah Tamu'
                    }
                }
            },

            plugins: {
                legend: {
                    display: false
                },

                // ANGKA DI ATAS BAR
                tooltip: {
                    enabled: true
                }
            }
        }
    });

});
</script>

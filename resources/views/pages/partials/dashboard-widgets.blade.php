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

<!-- Chart.js v2 -->
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4"></script>

<script>
document.addEventListener("DOMContentLoaded", function () {

    const canvas = document.getElementById("myBarChart");

    if (!canvas) {
        console.error("Canvas myBarChart tidak ditemukan.");
        return;
    }

    const ctx = canvas.getContext("2d");

    // === GRADIENT BIRU PASTEL ===
    const gradient = ctx.createLinearGradient(0, 0, 0, 400);
    gradient.addColorStop(0, "#BBDEFB"); // biru pastel muda
    gradient.addColorStop(1, "#64B5F6"); // biru pastel medium

    const labels = @json($labels);
    const dataJumlah = @json($jumlah);

    new Chart(ctx, {
        type: "bar",
        data: {
            labels: labels,
            datasets: [{
                label: "",
                data: dataJumlah,
                backgroundColor: gradient,
                borderColor: "transparent",
                borderWidth: 0,
                hoverBackgroundColor: gradient
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            legend: {
                display: false
            },
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true,
                        precision: 0
                    },
                    scaleLabel: {
                        display: false
                    },
                    gridLines: {
                        color: "rgba(0,0,0,0.1)"
                    }
                }],
                xAxes: [{
                    gridLines: {
                        display: false
                    }
                }]
            }
        }
    });

});
</script>

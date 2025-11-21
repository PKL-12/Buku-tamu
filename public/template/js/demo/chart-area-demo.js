var ctx = document.getElementById("myAreaChart");

new Chart(ctx, {
    type: 'line',
    data: {
        labels: [
            "Januari", "Februari", "Maret", "April", "Mei", "Juni",
            "Juli", "Agustus", "September", "Oktober", "November", "Desember"
        ],
        datasets: [{
            label: "Jumlah Tamu",
            tension: 0.3,
            backgroundColor: "rgba(78, 115, 223, 0.05)",
            borderColor: "rgba(78, 115, 223, 1)",
            pointRadius: 3,
            pointBackgroundColor: "rgba(78, 115, 223, 1)",
            pointBorderColor: "rgba(78, 115, 223, 1)",
            pointHoverRadius: 3,
            pointHoverBackgroundColor: "rgba(78, 115, 223, 1)",
            pointHoverBorderColor: "rgba(78, 115, 223, 1)",
            pointHitRadius: 10,
            pointBorderWidth: 2,
            fill: true,
            data: [12, 20, 18, 33, 25, 40, 35, 50, 45, 60, 55, 70],
        }]
    },
    options: {
        maintainAspectRatio: false,
        layout: {
            padding: { left: 10, right: 25, top: 25, bottom: 0 }
        },
        scales: {
            x: {
                grid: { display: false },
                ticks: { maxTicksLimit: 12 }
            },
            y: {
                beginAtZero: true,
                ticks: {
                    stepSize: 20,
                    callback: function(value) {
                        return value;
                    }
                },
                grid: {
                    color: "rgb(234, 236, 244)"
                }
            }
        },
        plugins: {
            legend: { display: false },
            tooltip: {
                backgroundColor: "white",
                titleColor: "#6e707e",
                bodyColor: "#858796",
                borderColor: "#dddfeb",
                borderWidth: 1,
                padding: 15,
                displayColors: false,
                callbacks: {
                    label: function(context) {
                        return "Jumlah: " + context.raw;
                    }
                }
            }
        }
    }
});

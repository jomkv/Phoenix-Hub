<?= $this->extend("layouts/adminDefault2") ?>

<?= $this->section("title") ?>Admin | Reports <?= $this->endSection() ?>

<?= $this->section("content") ?>

<style>
    canvas {
        border: 1px dotted red;
    }

    .chart-container {
        position: relative;
        margin: auto;
        height: 80vh;
        width: 80vw;
    }
</style>

<div class="row mt-4">
    <div class="col-12">
        <h1> Reports </h1>
    </div>
    <div class="col-12 d-flex order-md-1">
        <div class="card flex-fill border-0">
            <div class="card-body py-4">
                <h4 class="mb-2">Monthly Earnings</h4>
                <div class="chart-container" style="background-color: #1D1F20;">
                    <canvas id="chart"></canvas>
                </div>

            </div>
        </div>
    </div>
    <div class="col-12 d-flex order-md-2">
        <div class="card flex-fill border-0">
            <div class="card-body py-4">
                <h4 class="mb-2">Orders per Organization</h4>
                <div id="bar-graph-placeholder" style="background-color: #f0f0f0;">
                    <canvas id="pieGraph"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    const monthlyEarnings = <?= json_encode($monthlyEarnings) ?>;

    var data = {
        datasets: [{
            label: "Dataset #1",
            backgroundColor: "rgba(255,99,132,0.2)",
            borderColor: "rgba(255,99,132,1)",
            borderWidth: 2,
            hoverBackgroundColor: "rgba(255,99,132,0.4)",
            hoverBorderColor: "rgba(255,99,132,1)",
            data: monthlyEarnings,
        }]
    };

    var options = {
        maintainAspectRatio: false,
        scales: {
            y: {
                stacked: true,
                grid: {
                    display: true,
                    color: "rgba(255,99,132,0.2)"
                }
            },
            x: {
                grid: {
                    display: false
                }
            }
        }
    };

    new Chart('chart', {
        type: 'bar',
        options: options,
        data: data
    });


    const orgLabels = <?= json_encode($orgLabels) ?>;
    const orgData = <?= json_encode($orgData) ?>;

    var ordersData = {
        labels: orgLabels,
        datasets: [{
            label: 'Orders per Organization',
            data: orgData,
            backgroundColor: [
                'rgb(255, 99, 132)',
                'rgb(54, 162, 235)',
                'rgb(255, 205, 86)',
                'rgb(75, 192, 192)',
                'rgb(153, 102, 255)',
                'rgb(255, 159, 64)'
            ],
            hoverOffset: 4
        }]
    };

    new Chart('pieGraph', {
        type: 'doughnut',
        data: ordersData,
        options: {
            maintainAspectRatio: false
        }
    });
</script>


<?= $this->endSection() ?>
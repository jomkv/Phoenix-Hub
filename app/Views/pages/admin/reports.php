<?= $this->extend("layouts/adminDefault2") ?>

<?= $this->section("title") ?>Admin | Reports <?= $this->endSection() ?>

<?= $this->section("content") ?>

<h1> Reports </h1>
<div class="row">
                <div>
                    <button class="btn btn-primary">Filter</button>
                </div>
    <div class="col-12 col-md-6 d-flex order-md-1">
        <div class="card flex-fill border-0">
            <div class="card-body py-4">
                <h4 class="mb-2">Graph Title 1</h4>
                <p class="mb-2">Some description or content for the graph 1.</p>
                <!-- Placeholder for Line Graph -->
                <div id="line-graph-placeholder" style="width: 100%; height: 300px; background-color: #f0f0f0;">
                    <!-- Line Graph content goes here -->
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-md-6 d-flex order-md-2">
        <div class="card flex-fill border-0">
            <div class="card-body py-4">
                <h4 class="mb-2">Graph Title 2</h4>
                <p class="mb-2">Some description or content for the graph 2.</p>
                <!-- Placeholder for Bar Graph -->
                <div id="bar-graph-placeholder" style="width: 100%; height: 300px; background-color: #f0f0f0;">
                    <!-- Bar Graph content goes here -->
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card flex-fill border-0">
            <div class="card-body py-4 d-flex justify-content-between">
                <div>
                    <h4 class="mb-2">Table Title</h4>
                    <p class="mb-2">Some description or content for the table.</p>
                </div>
            </div>
            <!-- Placeholder for Table -->
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Header 1</th>
                            <th>Header 2</th>
                            <th>Header 3</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Data 1</td>
                            <td>Data 2</td>
                            <td>Data 3</td>
                        </tr>
                        <!-- Add more rows as needed -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


<?= $this->endSection() ?>
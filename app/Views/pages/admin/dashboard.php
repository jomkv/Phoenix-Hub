<?= $this->extend("layouts/adminDefault2") ?>

<?= $this->section("title") ?>Admin Dashboard <?= $this->endSection() ?>

<?= $this->section("content") ?>

<main class="content px-3 py-2">
    <div class="container-fluid">
        <div class="mb-3">
            <h4>Admin Dashboard</h4>
        </div>
        <div class="row">
            <div class="col-12 col-md-4 d-flex">
                <div class="card flex-fill border-0 illustration">
                    <div class="card-body p-0 d-flex flex-fill">
                        <div class="row g-0 w-100">
                            <div class="col-6">
                                <div class="p-3 m-1">
                                    <h4>Welcome Back, Admin</h4>
                                    <p class="mb-0">Admin Dashboard</p>
                                </div>
                            </div>
                            <div class="col-6 align-self-end text-end">
                                <img src="<?= base_url() . 'phoenix.png' ?>" class="img-fluid illustration-img" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-4 d-flex">
                <div class="card flex-fill border-0">
                    <div class="card-body py-4">
                        <div class="d-flex align-items-start">
                            <div class="flex-grow-1">
                                <h4 class="mb-2">
                                    $ 78.00
                                </h4>
                                <p class="mb-2">
                                    Total Earnings
                                </p>
                                <div class="mb-0">
                                    <span class="badge text-success me-2">
                                        +9.0%
                                    </span>
                                    <span class="text-muted">
                                        Since Last Month
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-4 d-flex">
                <div class="card flex-fill border-0">
                    <div class="card-body py-4">
                        <div class="d-flex align-items-start">
                            <div class="flex-grow-1">
                                <h4 class="mb-2">
                                    150
                                </h4>
                                <p class="mb-2">
                                    New Users
                                </p>
                                <div class="mb-0">
                                    <span class="badge text-primary me-2">
                                        +15%
                                    </span>
                                    <span class="text-muted">
                                        Since Last Week
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <!-- Graph on the Left -->
            <div class="col-12 col-md-6 d-flex order-md-1">
                <div class="card flex-fill border-0">
                    <div class="card-body py-4">
                        <h4 class="mb-2">Graph Title</h4>
                        <p class="mb-2">Some description or content for the graph.</p>
                        <!-- Placeholder for Graph -->
                        <div id="graph-placeholder" style="width: 100%; height: 300px; background-color: #f0f0f0;">
                            <!-- Graph content goes here -->
                        </div>
                    </div>
                </div>
            </div>

            <!-- Table on the Right -->
            <div class="col-12 col-md-6 d-flex order-md-2">
                <div class="card border-0 flex-fill">
                    <div class="card-header">
                        <h5 class="card-title">Basic Table</h5>
                        <h6 class="card-subtitle text-muted">
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptatum ducimus, necessitatibus reprehenderit itaque!
                        </h6>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">First</th>
                                    <th scope="col">Last</th>
                                    <th scope="col">Handle</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">1</th>
                                    <td>Mark</td>
                                    <td>Otto</td>
                                    <td>@mdo</td>
                                </tr>
                                <tr>
                                    <th scope="row">2</th>
                                    <td>Jacob</td>
                                    <td>Thornton</td>
                                    <td>@fat</td>
                                </tr>
                                <tr>
                                    <th scope="row">3</th>
                                    <td colspan="2">Larry the Bird</td>
                                    <td>@twitter</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
</main>
<footer class="footer">
    <div class="container-fluid">
        <div class="row text-muted">
            <div class="col-6 text-start">
                <p class="mb-0">
                    <a href="#" class="text-muted">
                        <strong>Phoenix Hub</strong>
                    </a>
                </p>
            </div>
        </div>
    </div>
</footer>


<?= $this->endSection() ?>
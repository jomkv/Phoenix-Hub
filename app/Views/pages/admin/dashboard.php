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
                                <img src="<?= base_url() . 'circular-logo-purple(4).png' ?>" class="img-fluid illustration-img" alt="">
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
                                    <?= $studentCount ?>
                                </h4>
                                <p class="mb-2">
                                    Total Users
                                </p>
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
                                    <?= $pendingPostCount ?>
                                </h4>
                                <p class="mb-2">
                                    Pending Posts
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-md-4 d-flex">
                <div class="card flex-fill border-0">
                    <div class="card-body py-4">
                        <div class="d-flex align-items-start">
                            <div class="flex-grow-1">
                                <h4 class="mb-2">
                                    <?= $pendingOrderCount ?>
                                </h4>
                                <p class="mb-2">
                                    Pending Orders
                                </p>
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
                                    <?= $deliverCount ?>
                                </h4>
                                <p class="mb-2">
                                    Orders to Deliver
                                </p>
                            </div>
                        </div>
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
<?php helper('form'); ?>

<?= $this->extend("layouts/adminDefault2") ?>

<?= $this->section("title") ?>Manage Barter <?= $this->endSection() ?>

<?= $this->section("content") ?>
<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center">
        <h1>Manage Barter</h1>
        <div class="dropdown">
            <button class="btn btn-secondary btn-sm btn-md btn-lg dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Filter
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <a class="dropdown-item" href="#">Action</a>
                <a class="dropdown-item" href="#">Another action</a>
                <a class="dropdown-item" href="#">Something else here</a>
            </div>
        </div>
    </div>

    <div class="table-responsive mt-5">
        <table class="table table-striped">
            <thead class="table-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Seller</th>
                    <th scope="col">Title</th>
                    <th scope="col">Date</th>
                    <th scope="col">View</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th scope="row">2</th>
                    <td>Mark</td>
                    <td>Otto</td>
                    <td>no</td>
                    <td><button class="btn btn-primary"><i class="bi bi-eye-fill"></i>View</button></td>
                    <td><button class="btn btn-primary">Approved</button></td>
                </tr>
                <tr>
                    <th scope="row">3</th>
                    <td>Jacob</td>
                    <td>Thornton</td>
                    <td>yes</td>
                    <td><button class="btn btn-primary"><i class="bi bi-eye-fill"></i>View</button></td>
                    <td><button class="btn btn-primary">Approved</button></td>
                </tr>
                <tr>
                    <th scope="row">1</th>
                    <td>Jacob</td>
                    <td>Larry the Bird</td>
                    <td>later</td>
                    <td><button class="btn btn-primary"><i class="bi bi-eye-fill"></i>View</button></td>
                    <td><button class="btn btn-primary">Approved</button></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
<?= $this->endSection() ?>
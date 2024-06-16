<?= $this->extend("layouts/adminDefault2") ?>

<?= $this->section("title") ?>Admin | Pending <?= $this->endSection() ?>

<?= $this->section("content") ?>

<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center">
        <h1>Pending Purchases</h1>
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
                    <th scope="col">Order ID</th>
                    <th scope="col">Organizations ID</th>
                    <th scope="col">Seller</th>
                    <th scope="col">Payment Mode</th>
                    <th scope="col">Payment Status</th>
                    <th scope="col">Order Status</th>
                    <th scope="col">Date</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th scope="row">1</th>
                    <td>Mark</td>
                    <td>Otto</td>
                    <td>@mdo</td>
                    <td>tite</td>
                    <td>Pending</td>
                    <td>2023-01-01</td>
                    <td><button class="btn btn-primary">Received</button></td>
                </tr>
                <tr>
                    <th scope="row">2</th>
                    <td>Jacob</td>
                    <td>Thornton</td>
                    <td>@fat</td>
                    <td>Pending</td>
                    <td>2023-01-02</td>
                    <td></td>
                    <td><button class="btn btn-primary">Received</button></td>
                </tr>
                <tr>
                    <th scope="row">3</th>
                    <td>Larry the Bird</td>
                    <td>@twitter</td>
                    <td>Pending</td>
                    <td>2023-01-03</td>
                    <td></td>
                    <td></td>
                    <td><button class="btn btn-primary">Received</button></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<?= $this->endSection() ?>

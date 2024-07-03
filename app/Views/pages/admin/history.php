<?= $this->extend("layouts/adminDefault2") ?>

<?= $this->section("title") ?>Admin | History <?= $this->endSection() ?>

<?= $this->section("content") ?>

<div class="row w-100 mt-4">
    <div class="col-12 col-md-6 d-flex order-md-1 w-100">
        <div class="card flex-fill border-0 w-100">
            <div class="card-body py-4">
                <!-- CARD HEADER -->
                <div class="row h-auto justify-content-between w-100">
                    <div class="col-12 align-items-center">
                        <h1>Payment History</h1>
                    </div>
                </div>

                <!-- CARD CONTENT (TABLE) -->
                <div class="table-responsive p-4 rounded mt-2">
                    <table class="table table-dark table-hover table-bordered table-striped text-center w-100 mt-2" id="payments-table">
                        <thead>
                            <tr>
                                <th style="text-align:center;">ID</th>
                                <th style="text-align:center;">Name</th>
                                <th style="text-align:center;">Email</th>
                                <th style="text-align:center;">Amount</th>
                                <th style="text-align:center;">Date</th>
                            </tr>
                        </thead>
                        <tbody class="table-light">
                            <?php foreach ($payments as $payment) : ?>
                                <tr>
                                    <td style="text-align:center;"><?= $payment->payment_id ?></td>
                                    <td style="text-align:center;"><?= esc($payment->full_name) ?></td>
                                    <td style="text-align:center;"><?= esc($payment->email) ?></td>
                                    <td style="text-align:center;">₱<?= $payment->amount ?></td>
                                    <td style="text-align:center;"><?= $payment->date ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.bootstrap5.css">
<script src="https://cdn.datatables.net/2.0.8/js/dataTables.js"></script>

<script>
    $(document).ready(function() {
        // Initialize DataTable with additional options
        $('#payments-table').DataTable({
            paging: false,
            info: false,
            responsive: true,
            language: {
                search: "Search payment:",
                lengthMenu: "Show _MENU_ entries",
                info: "Showing _START_ to _END_ of _TOTAL_ entries",
                infoEmpty: "No entries available",
                paginate: {
                    previous: "Previous",
                    next: "Next"
                }
            }
        });
    });
</script>

<?= $this->endSection() ?>
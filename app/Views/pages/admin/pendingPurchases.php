<?php helper('form'); ?>

<?= $this->extend("layouts/adminDefault2") ?>

<?= $this->section("title") ?>Admin | Orders <?= $this->endSection() ?>

<?= $this->section("content") ?>

<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center">
        <h1>Orders</h1>
        <?= form_open('/orders', ['class' => 'd-flex']) ?>
        <select name="filter" class="form-select">
            <option value="none" <?= $filter === "none" ? "selected" : "" ?>>None</option>
            <option value="pending" <?= $filter === "pending" ? "selected" : "" ?>>Pending</option>
            <option value="confirmed" <?= $filter === "confirmed" ? "selected" : "" ?>>Confirmed</option>
        </select>
        <button type="submit" class="btn btn-primary">Filter</button>
        <?= form_close() ?>
    </div>

    <div class="table-responsive mt-5">
        <table class="table table-striped">
            <thead class="table-dark">
                <tr>
                    <th scope="col">Order ID</th>
                    <th scope="col">Total</th>
                    <th scope="col">Payment Mode</th>
                    <th scope="col">Payment Status</th>
                    <th scope="col">Order Status</th>
                    <th scope="col">Pickup Date</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($orders as $order) : ?>
                    <tr>
                        <th scope="row"><?= $order->order_id ?></th>
                        <td>₱<?= $order->total ?></td>
                        <td><?= $order->payment_method ?></td>
                        <td><?= $order->is_paid ?></td>
                        <td><?= $order->status ?></td>
                        <td><?= $order->pickup_date ?></td>
                        <td>
                            <button class="btn btn-primary">Inspect</button>
                            <?php if ($order->status === "pending") : ?>
                                <button class="btn btn-primary">Confirm</button>
                                <button class="btn btn-danger">Cancel</button>
                            <?php elseif ($order->status === "confirmed") : ?>
                                <button class="btn btn-primary">Received</button>
                            <?php endif; ?>

                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<?= $this->endSection() ?>
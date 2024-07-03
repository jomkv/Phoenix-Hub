<?php helper('form'); ?>

<?= $this->extend("layouts/default2") ?>

<?= $this->section("title") ?>Cart <?= $this->endSection() ?>

<?= $this->section("content") ?>
<style>
    body {
        background-color: #f2f2f2;
        overflow: hidden;
    }

    #cart-container {
        padding-top: 120px;
    }

    .shopping-cart {
        font-size: 2rem;
        font-weight: bold;
    }

    .table-container {
        max-height: 500px;
        /* Adjust this value as needed */
        overflow-y: auto;
        margin-top: 1rem;
        background: #fff;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        border-radius: 10px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    thead th {
        position: sticky;
        top: 0;
        background-color: #343a40;
        color: white;
        z-index: 1;
        padding: 10px;
        text-align: center;
    }

    tbody tr {
        text-align: center;
        border-bottom: 1px solid #dee2e6;
    }

    tbody tr:nth-child(even) {
        background-color: #f8f9fa;
    }

    tbody tr:hover {
        background-color: #e9ecef;
    }

    tbody td {
        padding: 15px;
        vertical-align: middle;
    }

    .img-fluid {
        max-width: 100px;
        height: auto;
        border-radius: 10px;
    }

    .card-title {
        font-size: 1rem;
        margin-top: 0.5rem;
    }

    .quantity-container {
        display: flex;
        flex-direction: column;
        /* Arrange items vertically */
        align-items: center;
        /* Center horizontally */
    }

    .item-quantity {
        max-width: 100px;
        text-align: center;
        display: flex;
        justify-content: center;
        /* Center horizontally */
        align-items: center;
        /* Center vertically */
    }

    .available-stocks {
        font-size: 0.9rem;
        color: #6c757d;
        margin-top: 0.5rem;
        /* Adjust spacing */
        text-align: center;
        /* Center text */
    }

    .btn-danger {
        background-color: #dc3545;
        border: none;
        border-radius: 5px;
        color: white;
        padding: 8px 16px;
        /* Adjust padding for button size */
        transition: background-color 0.3s ease;
        /* Add smooth hover effect */
    }

    .btn-danger:hover {
        background-color: #c82333;
    }

    .btn-update {
        background-color: #007bff;
        border: none;
        border-radius: 5px;
        color: white;
        padding: 8px 16px;
        /* Adjust padding for button size */
        transition: background-color 0.3s ease;
        /* Add smooth hover effect */
    }

    .btn-update:hover {
        background-color: #0056b3;
    }

    .card-checkout {
        position: fixed;
        bottom: 0;
        left: 0;
        width: 100%;
        background-color: white;
        padding: 1rem;
        border-top: 1px solid #ccc;
        box-shadow: 0 -2px 10px rgba(0, 0, 0, 0.1);
        z-index: 1000;
    }

    .card-checkout .container {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .card-checkout p {
        margin: 0;
    }

    .btn-checkout {
        background-color: #007bff;
        border: none;
        border-radius: 20px;
        padding: 10px 20px;
    }

    .btn-checkout:hover {
        background-color: #0056b3;
    }

    @media (max-width: 767px) {
        #cart-container {
            padding-top: 70px;
        }

        .header {
            padding: 1rem 0;
            /* Reduce padding for smaller screens */
            margin-top: 3.5rem;
            /* Add margin to avoid overlap with navbar */
        }

        .shopping-cart {
            font-size: 1.5rem;
            /* Reduce font size for smaller screens */
        }

        .table-container {
            margin-top: 1rem;
            overflow-x: auto;
        }

        .card-checkout {
            flex-direction: column;
            text-align: center;
            padding: 0.5rem;
            /* Reduce padding for smaller screens */
        }

        .card-checkout .container {
            flex-direction: column;
            /* Stack items vertically */
        }

        .card-checkout p {
            margin-bottom: 10px;
            /* Add spacing below text */
        }

        .btn-checkout,
        .btn-danger,
        .btn-update {
            width: 100%;
            margin-top: 10px;
            font-size: 0.9rem;
            /* Adjust font size for smaller screens */
        }
    }
</style>

<div class="container" id="cart-container">
    <div class="header row">
        <div class="col-12 d-flex align-items-center">
            <img src="<?= base_url() . '/circular-logo-purple(4).png' ?>" class="img-fluid" style="width:50px; height: 50px; margin-right: 5px;">
            <h1 class="fw-semibold fs-1 m-0">Shopping Cart</h1>
        </div>
    </div>

    <div class="table-container">
        <table class="table">
            <thead class="table-dark">
                <tr>
                    <th class="fw-semibold">Product</th>
                    <th class="fw-semibold">Price</th>
                    <th class="fw-semibold">Quantity</th>
                    <th class="fw-semibold">Subtotal</th>
                    <th class="fw-semibold">Update</th>
                    <th class="fw-semibold">Remove</th>
                </tr>
            </thead>
            <tbody>
                <?php $total = 0; ?>
                <?php foreach ($cartItems as $item) : ?>
                    <?php
                    $cartItemPrice = 0;
                    $cartItemTotal = 0;

                    if ($item['cartItem']->is_variant) {
                        $cartItemPrice = $item["variant"]->price;
                        $cartItemTotal = $item["variant"]->price * $item['cartItem']->quantity;
                    } else {
                        $cartItemPrice = $item["product"]->price;
                        $cartItemTotal = $item['product']->price * $item['cartItem']->quantity;
                    }

                    $total += $cartItemTotal;
                    ?>
                    <tr>
                        <td>
                            <img src="<?= json_decode($item['product']->images)[0]->url ?>" class="img-fluid mb-2" alt="Product Image" style="height:100px; width:100px; object-fit:cover;">
                            <div class="card-title"><?= esc($item['product']->product_name) ?></div>
                            <?php if ($item['cartItem']->is_variant && $item['product']->has_variations) : ?>
                                <div class="card-title">[<?= esc($item["product"]->variation_name) . ": " . esc($item["variant"]->option_name) ?>]</div>
                            <?php endif; ?>
                        </td>
                        <td>₱<?= $cartItemPrice ?></td>
                        <?= form_open('/cart/edit/' . $item['cartItem']->cart_item_id) ?>
                        <td>
                            <div class="quantity-container">
                                <div class="item-quantity">
                                    <input type="number" class="form-control" name="quantity" value="<?= $item['cartItem']->quantity ?>" max="<?= $item['cartItem']->is_variant === "1" ? $item['variant']->stock : $item['product']->stock ?>">
                                </div>
                                <div class="available-stocks">Available Stocks: <?= $item["variant"]->stock ?? $item['product']->stock ?></div>
                            </div>
                        </td>
                        <td>₱<?= $cartItemTotal ?></td>
                        <td>
                            <button type="submit" class="btn btn-primary"><i class="bi bi-pencil-fill"></i></button>
                        </td>
                        <?= form_close() ?>
                        <td>
                            <?= form_open('/cart/remove/' . $item['cartItem']->cart_item_id) ?>
                            <button type="submit" class="btn btn-danger"><i class="bi bi-trash3-fill"></i></button>
                            <?= form_close() ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<div class="card-checkout">
    <div class="container">
        <div>
            <p>Total Price: ₱<span id="total-price"><?= $total ?></span></p>
            <p>Total Items: <span id="total-items"><?= count($cartItems) ?></span></p>
        </div>
        <a href="<?= url_to("CartController::viewCheckoutCart") ?>" type="button" class="btn btn-primary btn-lg fw-bold">Check Out</a>
    </div>
</div>

<?= $this->endSection() ?>
<?= $this->extend("layouts/default2") ?>

<?= $this->section("title") ?>Cart <?= $this->endSection() ?>

<?= $this->section("content") ?>
<style>
    body {
        background-color: #f2f2f2;
        overflow:hidden;
    }
    .container {
        margin-top: 2rem;
    }
    .header {
        padding-top: 5rem;
    }
    .shopping-cart {
        font-size: 2rem;
        font-weight: bold;
    }
    .search-bar {
        max-width: 300px;
        border-radius: 20px;
    }
    .table-container {
        max-height: 500px; /* Adjust this value as needed */
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
    flex-direction: column; /* Arrange items vertically */
    align-items: center; /* Center horizontally */
}

.item-quantity {
    max-width: 100px;
    text-align: center;
    display: flex;
    justify-content: center; /* Center horizontally */
    align-items: center; /* Center vertically */
}

.available-stocks {
    font-size: 0.9rem;
    color: #6c757d;
    margin-top: 0.5rem; /* Adjust spacing */
    text-align: center; /* Center text */
}


    .available-stocks {
        font-size: 0.9rem;
        color: #6c757d;
    }
    .btn-danger {
        background-color: #dc3545;
        border: none;
        border-radius: 5px;
    }
    .btn-danger:hover {
        background-color: #c82333;
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
    .btn-primary {
        background-color: #007bff;
        border: none;
        border-radius: 20px;
        padding: 10px 20px;
    }
    .btn-primary:hover {
        background-color: #0056b3;
    }
    @media (max-width: 767px) {
        .header {
            padding: 1rem 0; /* Reduce padding for smaller screens */
        }
        .search-bar {
            max-width: 200px; /* Adjust width for smaller screens */
        }
        .table-container {
            margin-top: 1rem;
            overflow-x: auto;
        }
        .card-checkout {
            flex-direction: column;
            text-align: center;
            padding: 0.5rem; /* Reduce padding for smaller screens */
        }
        .card-checkout .container {
            flex-direction: column; /* Stack items vertically */
        }
        .card-checkout p {
            margin-bottom: 10px; /* Add spacing below text */
        }
        .btn-primary, .btn-danger {
            width: 100%;
            margin-top: 10px;
            font-size: 0.9rem; /* Adjust font size for smaller screens */
        }
    }
</style>

<div class="container">
    <div class="header mb-3 d-flex justify-content-between align-items-center">
        <div class="shopping-cart">
            <i class="bi bi-cart-fill"></i> Shopping Cart
        </div>
        <input type="text" class="search-bar form-control" placeholder="Search...">
    </div>

    <div class="table-container">
        <table class="table">
            <thead class="table-dark">
                <tr>
                    <th><input type="checkbox" id="selectAll" class="me-2"></th>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
            <tr>
    <td><input type="checkbox" id="item1"></td>
    <td>
        <img src="<?= base_url() . 'CvSU Home page.jpg' ?>" class="img-fluid rounded-start mb-2" alt="Product Image">
        <div class="card-title">Product Name</div>
    </td>
    <td>$10.00</td>
    <td>
        <div class="quantity-container">
            <div class="item-quantity">
                <input type="number" class="form-control" value="1" min="1">
            </div>
            <div class="available-stocks">Available Stocks: 50</div>
        </div>
    </td>
    <td><button class="btn btn-danger btn-sm">Remove</button></td>
</tr>
<tbody>
            <tr>
    <td><input type="checkbox" id="item1"></td>
    <td>
        <img src="<?= base_url() . 'CvSU Home page.jpg' ?>" class="img-fluid rounded-start mb-2" alt="Product Image">
        <div class="card-title">Product Name</div>
    </td>
    <td>$10.00</td>
    <td>
        <div class="quantity-container">
            <div class="item-quantity">
                <input type="number" class="form-control" value="1" min="1">
            </div>
            <div class="available-stocks">Available Stocks: 50</div>
        </div>
    </td>
    <td><button class="btn btn-danger btn-sm">Remove</button></td>
</tr>
<tbody>
            <tr>
    <td><input type="checkbox" id="item1"></td>
    <td>
        <img src="<?= base_url() . 'CvSU Home page.jpg' ?>" class="img-fluid rounded-start mb-2" alt="Product Image">
        <div class="card-title">Product Name</div>
    </td>
    <td>$10.00</td>
    <td>
        <div class="quantity-container">
            <div class="item-quantity">
                <input type="number" class="form-control" value="1" min="1">
            </div>
            <div class="available-stocks">Available Stocks: 50</div>
        </div>
    </td>
    <td><button class="btn btn-danger btn-sm">Remove</button></td>
</tr>
<tbody>
            <tr>
    <td><input type="checkbox" id="item1"></td>
    <td>
        <img src="<?= base_url() . 'CvSU Home page.jpg' ?>" class="img-fluid rounded-start mb-2" alt="Product Image">
        <div class="card-title">Product Name</div>
    </td>
    <td>$10.00</td>
    <td>
        <div class="quantity-container">
            <div class="item-quantity">
                <input type="number" class="form-control" value="1" min="1">
            </div>
            <div class="available-stocks">Available Stocks: 50</div>
        </div>
    </td>
    <td><button class="btn btn-danger btn-sm">Remove</button></td>
</tr>

                <!-- Repeat tbody rows for each product as needed -->
            </tbody>
        </table>
    </div>
</div>

<div class="card-checkout">
    <div class="container">
        <div>
            <p>Total Price: $<span id="total-price">10.00</span></p>
            <p>Total Items: <span id="total-items">1</span></p>
        </div>
        <button type="button" class="btn btn-primary">Check Out</button>
    </div>
</div>

<?= $this->endSection() ?>

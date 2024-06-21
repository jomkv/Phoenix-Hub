<?= $this->extend("layouts/adminDefault2") ?>

<?= $this->section("title") ?>Admin | History <?= $this->endSection() ?>

<?= $this->section("content") ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin History</title>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8f9fa;
        }

        .content {
            padding: 20px;
        }

        .table-container {
            background: #fff;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            overflow: hidden;
            margin-bottom: 20px;
        }

        h1 {
            font-size: 24px;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 12px 15px;
            border-bottom: 1px solid #ddd;
            text-align: left;
        }

        th {
            background-color: #007bff;
            color: white;
            text-transform: uppercase;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .status-paid {
            color: green;
            font-weight: bold;
        }

        .status-not-paid {
            color: red;
            font-weight: bold;
        }

        .button {
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
            border-radius: 5px;
            text-align: center;
            display: inline-block;
            margin-top: 10px;
        }

        .button:hover {
            background-color: #0056b3;
        }

        @media (max-width: 768px) {
            table, th, td {
                display: block;
                width: 100%;
            }

            th {
                display: none;
            }

            td {
                display: flex;
                justify-content: space-between;
                align-items: center;
                padding: 10px;
                border-bottom: 1px solid #ddd;
            }

            td::before {
                content: attr(data-label);
                font-weight: bold;
                text-transform: uppercase;
            }
        }
    </style>
</head>
<body>
    <div class="content">
        <h1>Recent Orders</h1>
        <div class="table-container">
            <table class="table">
                <thead>
                    <tr>
                        <th>Order Code</th>
                        <th>Customer Name</th>
                        <th>Product</th>
                        <th>Unit Price</th>
                        <th>Quantity</th>
                        <th>Total Price</th>
                        <th>Status</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td data-label="Order Code">NEOG-1680</td>
                        <td data-label="Customer Name">Tammy R. Polley</td>
                        <td data-label="Product">Crab Cake</td>
                        <td data-label="Unit Price">$16</td>
                        <td data-label="Quantity">1</td>
                        <td data-label="Total Price">$16</td>
                        <td data-label="Status" class="status-not-paid">NOT PAID</td>
                        <td data-label="Date">04/Sep/2022 9:46</td>
                    </tr>
                    <tr>
                        <td data-label="Order Code">AEHM-0653</td>
                        <td data-label="Customer Name">Ana J. Browne</td>
                        <td data-label="Product">Turkish Coffee</td>
                        <td data-label="Unit Price">$8</td>
                        <td data-label="Quantity">1</td>
                        <td data-label="Total Price">$8</td>
                        <td data-label="Status" class="status-paid">PAID</td>
                        <td data-label="Date">03/Sep/2022 7:11</td>
                    </tr>
                    <tr>
                        <td data-label="Order Code">OTEV-8532</td>
                        <td data-label="Customer Name">Louise R. Holloman</td>
                        <td data-label="Product">Spaghetti Bolognese</td>
                        <td data-label="Unit Price">$15</td>
                        <td data-label="Quantity">1</td>
                        <td data-label="Total Price">$15</td>
                        <td data-label="Status" class="status-paid">PAID</td>
                        <td data-label="Date">03/Sep/2022 6:58</td>
                    </tr>
                    <tr>
                        <td data-label="Order Code">ZPXD-6951</td>
                        <td data-label="Customer Name">Julie R. Martin</td>
                        <td data-label="Product">Pulled Pork</td>
                        <td data-label="Unit Price">$8</td>
                        <td data-label="Quantity">2</td>
                        <td data-label="Total Price">$16</td>
                        <td data-label="Status" class="status-paid">PAID</td>
                        <td data-label="Date">03/Sep/2022 6:57</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <h1>Recent Payments</h1>
        <div class="table-container">
            <table class="table">
                <thead>
                    <tr>
                        <th>Payment Code</th>
                        <th>Amount</th>
                        <th>Order Code</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td data-label="Payment Code">WERGFCXZSR</td>
                        <td data-label="Amount">$8</td>
                        <td data-label="Order Code">AEHM-0653</td>
                    </tr>
                    <tr>
                        <td data-label="Payment Code">AZSUNOKEI7</td>
                        <td data-label="Amount">$15</td>
                        <td data-label="Order Code">OTEV-8532</td>
                    </tr>
                    <tr>
                        <td data-label="Payment Code">MF2TVJA1PY</td>
                        <td data-label="Amount">$16</td>
                        <td data-label="Order Code">ZPXD-6951</td>
                    </tr>
                    <tr>
                        <td data-label="Payment Code">5E31DQ2NCG</td>
                        <td data-label="Amount">$22</td>
                        <td data-label="Order Code">COXP-6018</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>

<?= $this->endSection() ?>

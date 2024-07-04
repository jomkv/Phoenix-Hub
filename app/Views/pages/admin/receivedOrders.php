<?php helper('form'); ?>

<?= $this->extend("layouts/adminDefault2") ?>

<?= $this->section("title") ?>Admin | Orders <?= $this->endSection() ?>

<?= $this->section("content") ?>

<div class="card flex-fill border-0 w-100">
  <div class="card-header" style="color: #6366f1">
    <ul class="nav nav-tabs card-header-tabs">
      <li class="nav-item">
        <a class="nav-link" aria-current="true" href="<?= url_to("AdminViewController::viewPendingOrders") ?>">Pending</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?= url_to("AdminViewController::viewConfirmedOrders") ?>">Confirmed</a>
      </li>
      <li class="nav-item">
        <a class="nav-link active" href="<?= url_to("AdminViewController::viewReceivedOrders") ?>">Received</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?= url_to("AdminViewController::viewCancelledOrders") ?>">Cancelled</a>
      </li>
    </ul>
  </div>
  <div class="card-body py-4">
    <!-- Placeholder for Line Graph -->
    <div id="line-graph-placeholder w-100 h-100">
      <div class="table-responsive">
        <table class="table table-striped w-100 mt-2" id="received-table">
          <thead class="table-dark">
            <tr>
              <th scope="col" style="text-align:center;">Order ID</th>
              <th scope="col" style="text-align:center;">Total</th>
              <th scope="col" style="text-align:center;">Payment Mode</th>
              <th scope="col" style="text-align:center;">Payment Status</th>
              <th scope="col" style="text-align:center;">Order Status</th>
              <th scope="col" style="text-align:center;">Pickup Date</th>
              <th scope="col" style="text-align:center;">Inspect</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($orders as $order) : ?>
              <tr>
                <th scope="row" style="text-align:center;"><?= $order->order_id ?></th>
                <td style="text-align:center;">₱<?= $order->total ?></td>
                <td style="text-align:center;"><?= $order->payment_method ?></td>
                <td style="text-align:center;"><?= $order->is_paid === "0" ? "Not Paid" : "Paid" ?></td>
                <td style="text-align:center;">
                  <p class="p-2 w-75 rounded-pill text-bg-success">
                    <?= ucfirst($order->status) ?>
                  </p>
                </td>
                <td style="text-align:center;"><?= $order->pickup_date ?></td>
                <td style="text-align:center;">
                  <button class="btn btn-primary view-product-btn" data-bs-toggle="modal" data-bs-target="#staticBackdrop" data-order-id="<?= $order->order_id ?>"><i class="bi bi-eye"></i></button>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<!-- Inspect Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="order-header-container">Order Details</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="table-responsive">
          <table class="table table-bordered table-hover rounded w-100">
            <thead class="table-dark">
              <tr>
                <th scope="col" class="text-center">Merchandise</th>
                <th scope="col" class="text-center">Unit Price</th>
                <th scope="col" class="text-center">Quantity</th>
                <th scope="col" class="text-center">Item Subtotal</th>
              </tr>
            </thead>
            <tbody style="background-color: white;" id="order-details-container">
              <tr>
                <td class="text-center">
                  <p>
                    Test
                  </p>
                  <p>
                    [ Test ]
                  </p>
                </td>
                <td class="text-center">₱123</td>
                <td class="text-center">
                  <div class="text-center">
                    12
                  </div>
                </td>
                <td class="text-center">₱123</td>
              </tr>
              <tr>
                <td colspan="2"></td>
                <td class="text-end">Total:</td>
                <td class="text-center fw-bold">₱123</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.bootstrap5.css">
<script src="https://cdn.datatables.net/2.0.8/js/dataTables.js"></script>

<script>
  $(document).ready(function() {
    $('#received-table').DataTable({
      paging: false,
      info: false,
      responsive: true,
      columnDefs: [{
          orderable: false,
          targets: [-1, -2]
        } // Disable ordering on the Actions column
      ],
      language: {
        search: "Search order:",
        lengthMenu: "Show _MENU_ entries",
        info: "Showing _START_ to _END_ of _TOTAL_ entries",
        infoEmpty: "No entries available",
        paginate: {
          previous: "Previous",
          next: "Next"
        }
      }
    });

    $('.view-product-btn').click(function() {
      let url = '<?= base_url() ?>' + `admin/order/details/${$(this).data('order-id')}`;

      $.ajax({
        url: url,
        type: 'POST',
        success: (data) => {
          showOrderDetails(data);
        },
        error: (err) => {
          console.log(err);
        }
      })
    })
  });

  function showOrderDetails(data) {
    // * Update modal header
    $('#order-header-container').text(`Order #${data.order.order_id}`);

    // * Empty modal table content
    var tableContainer = $('#order-details-container');
    tableContainer.empty();

    // * Fill modal table content
    data.orderItems.forEach(
      (orderItem) => {
        let escapedProductName = '';
        let escapedVariationName = '';
        let escapedOptionName = '';

        if (orderItem.product) {
          escapedProductName = $('<div/>').text(orderItem.product.product_name).html(); // Escape product name
        }

        if (orderItem.item.is_variant === "1" && orderItem.variant) {
          escapedVariationName = $('<div/>').text(orderItem.product.variation_name).html(); // Escape variation name
          escapedOptionName = $('<div/>').text(orderItem.variant.option_name).html(); // Escape option name
        }

        let itemPrice = orderItem.variant ? orderItem.variant.price : (orderItem.product ? orderItem.product.price : 0); // Get price (variant or product)

        let subTotal = Number(itemPrice) * Number(orderItem.item.quantity);

        let tableRow = $('<tr></tr>'); // Create table row element

        // Create separate cells for product name and variation (if applicable)
        let productNameCell = $('<td class="text-center"></td>');
        productNameCell.append($('<p>' + escapedProductName + '</p>'));

        if (escapedVariationName) {
          productNameCell.append($('<p>[ ' + escapedVariationName + ': ' + escapedOptionName + ' ]</p>'));
        }

        tableRow.append(productNameCell); // Append product name cell

        tableRow.append(
          $('<td class="text-center">₱' + itemPrice + '</td>'),
          $('<td class="text-center">' + orderItem.item.quantity + '</td>'),
          $('<td class="text-center">₱' + subTotal + '</td>')
        );

        tableContainer.append(tableRow); // Append the completed table row
      }
    );

    tableContainer.append(`
            <tr>
                <td colspan="2"></td>
                <td class="text-end">Total:</td>
                <td class="text-center fw-bold">₱${data.order.total}</td>
            </tr>
        `)
  }
</script>


<?= $this->endSection() ?>
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
        <a class="nav-link active" href="<?= url_to("AdminViewController::viewCancelledOrders") ?>">Cancelled</a>
      </li>
    </ul>
  </div>
  <div class="card-body py-4">
    <!-- Placeholder for Line Graph -->
    <div id="line-graph-placeholder w-100 h-100">
      <div class="table-responsive">
        <table class="table table-striped">
          <thead class="table-dark">
            <tr>
              <th scope="col">Order ID</th>
              <th scope="col">Total</th>
              <th scope="col">Payment Mode</th>
              <th scope="col">Payment Status</th>
              <th scope="col">Order Status</th>
              <th scope="col">Pickup Date</th>
              <th scope="col">Inspect</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($orders as $order) : ?>
              <tr>
                <th scope="row"><?= $order->order_id ?></th>
                <td>₱<?= $order->total ?></td>
                <td><?= $order->payment_method ?></td>
                <td><?= $order->is_paid === "0" ? "Not Paid" : "Paid" ?></td>
                <td>
                  <p class="p-2 w-75 rounded-pill text-bg-danger">
                    <?= ucfirst($order->status) ?>
                  </p>
                </td>
                <td><?= $order->pickup_date ?></td>
                <td>
                  <button class="btn btn-primary view-product-btn" data-order-id="<?= $order->order_id ?>" data-bs-toggle="modal" data-bs-target="#staticBackdrop"><i class="bi bi-eye"></i></button>
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

<script>
  $(document).ready(function() {
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
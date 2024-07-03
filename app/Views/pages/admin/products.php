<?php helper('form'); ?>

<?= $this->extend("layouts/adminDefault2") ?>

<?= $this->section("title") ?>Admin | Products<?= $this->endSection() ?>

<?= $this->section("content") ?>

<div class="row w-100 mt-4">
  <div class="col-12 col-md-6 d-flex order-md-1 w-100">
    <div class="card flex-fill border-0 w-100">
      <div class="card-body py-4">
        <!-- CARD HEADER -->
        <div class="row h-auto justify-content-between w-100">
          <div class="col-12 align-items-center">
            <h1>Products</h1>
          </div>
          <div class="col-12 d-flex justify-content-between align-items-end mb-4">
            <a href="<?= url_to("ProductController::viewCreateProduct") ?>" class="btn btn-primary align-self-center" style="width: 200px;">Create New Product</a>
            <div>
              <label class="form-label">Filter by Organization</label>
              <div class="d-flex" id="select-org">
                <select class="form-select" id="org-filter">
                  <option value="none">None</option>
                  <?php foreach ($organizations as $org) : ?>
                    <option value="<?= $org->organization_id ?>" <?= $filter === $org->organization_id ? "selected" : "" ?>><?= esc($org->name) ?></option>
                  <?php endforeach ?>
                </select>
                <button onclick="window.location='product?filter='+document.getElementById('org-filter').value;" class="btn btn-primary">Filter</button>
              </div>
            </div>
          </div>
        </div>

        <!-- CARD CONTENT (TABLE) -->
        <div class="table-responsive p-4 rounded" style="background-color: #f0f0f0;">
          <table class="table table-dark table-hover table-bordered table-striped text-center w-100 mt-2" id="products-table">
            <thead>
              <tr>
                <th scope="col" style="text-align:center;">ID</th>
                <th scope="col" style="text-align:center;">Image</th>
                <th scope="col" style="text-align:center;">Product Name</th>
                <th scope="col" style="text-align:center;">Price</th>
                <th scope="col" style="text-align:center;">Stock</th>
                <th scope="col" style="text-align:center;">Organization</th>
                <th scope="col" style="text-align:center;">Inspect Variants</th>
                <th scope="col" style="text-align:center;">Edit</th>
                <th scope="col" style="text-align:center;">Delete</th>
              </tr>
            </thead>
            <tbody id="products-container" class="table-light">
              <?php foreach ($products as $product) : ?>
                <?php $isVariant = $product->has_variations === "1"; ?>
                <tr data-product-id="<?= $product->product_id ?>">
                  <td class="tr-product-id"># <?= $product->product_id ?></td>
                  <td>
                    <div style="align-items:center; display: flex;justify-content: center;">
                      <img src="<?= json_decode($product->images)[0]->url ?>" class="rounded mx-auto d-block" style="width:50px; height:50px; object-fit:cover;" alt="Product Image">
                    </div>
                  </td>
                  <td class="tr-product-name"><?= esc($product->product_name) ?></td>
                  <td class="tr-product-price"><?= $isVariant ? "N/A" : "₱" . $product->price ?></td>
                  <td class="tr-product-stock text-center"><?= $isVariant ? "N/A" : $product->stock ?></td>
                  <td><?= esc($product->organization_name) ?></td>
                  <td class="text-center">
                    <button class="btn btn-primary view-product-btn" <?= $isVariant ? "" : "disabled" ?> data-bs-toggle="modal" data-bs-target="#staticBackdrop" data-product-id="<?= $product->product_id ?>"><i class="bi bi-eye"></i></button>
                  </td>
                  <td class="text-center">
                    <a href="<?= url_to("ProductController::viewEditProduct", $product->product_id) ?>" type="button" class="btn btn-primary edit-modal-btn"><i class="bi bi-pencil"></i></a>
                  </td>
                  <td class="text-center">
                    <a href="<?= url_to("ProductController::deleteProduct", $product->product_id) ?>" data-product-id="<?= $product->product_id ?>" type="button" data-bs-toggle="modal" data-bs-target="#deleteProductModal" class="btn btn-lg btn-danger delete-modal-btn"><i class="bi bi-trash3"></i></a>
                  </td>
                </tr>
              <?php endforeach ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Confirm Delete Modal -->
<div class="modal fade" id="deleteProductModal" tabindex="-1" aria-labelledby="deleteProductModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Confirm Delete</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="delete-modal-btn-close"></button>
      </div>
      <div class="modal-body">
        Are you sure you want to delete this product?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-danger" id="delete-product-btn">Delete</button>
      </div>
    </div>
  </div>
</div>


<!-- Inspect Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="product-header-container">Product Variants</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <h4 class="fw-normal" style="color: black;">Variation Name: <span class="fs-4 fw-semibold" id="modal-variation-name"></span></h4>
        <div class="table-responsive">
          <table class="table table-bordered table-hover rounded w-100">
            <thead class="table-dark">
              <tr>
                <th scope="col" class="text-center">Option Name</th>
                <th scope="col" class="text-center">Stock</th>
                <th scope="col" class="text-center">Price</th>
              </tr>
            </thead>
            <tbody style="background-color: white;" id="product-details-container">
              <tr>
                <td class="text-center">Medium</td>
                <td class="text-center">12</td>
                <td class="text-center">₱123</td>
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
  let deleteProductId;

  $(document).ready(function() {
    // Initialize DataTable with additional options
    $('#products-table').DataTable({
      paging: false,
      info: false,
      responsive: true,
      columnDefs: [{
          orderable: false,
          targets: [1, -1, -2, -3]
        } // Disable ordering on the Actions column
      ],
      language: {
        search: "Search product:",
        lengthMenu: "Show _MENU_ entries",
        info: "Showing _START_ to _END_ of _TOTAL_ entries",
        infoEmpty: "No entries available",
        paginate: {
          previous: "Previous",
          next: "Next"
        }
      }
    });

    $(document).ready(function() {
      $('.view-product-btn').click(function() {
        let url = '<?= base_url() ?>' + `admin/variants/${$(this).data('product-id')}`;

        $.ajax({
          url: url,
          type: 'POST',
          success: (data) => {
            showProductVariants(data, $(this).data('product-id'));
          },
          error: (err) => {
            console.log(err);
          }
        })
      })
    });

    // Handle delete button click to set the product ID for deletion
    $('.delete-modal-btn').click(function() {
      deleteProductId = $(this).data('product-id');
    });

    // Handle the delete confirmation
    $('#delete-product-btn').click(function() {
      let url = '<?= base_url() ?>' + `admin/product/${deleteProductId}`;
      $(this).attr("disabled", true); // disable button

      $.ajax({
        url: url,
        type: 'DELETE',
        success: () => {
          $(`tr[data-product-id="${deleteProductId}"]`).remove();
          $('#delete-modal-btn-close').click();
          generateSuccessToast('Product Deleted');
          $(this).attr("disabled", false); // enable button
        },
        error: (err) => {
          console.log(err);
          generateErrorToast('Error Deleting Product.');
          $('#delete-modal-btn-close').click();
          $(this).attr("disabled", false); // enable button
        }
      });
    });
  });

  function showProductVariants(data, productId) {
    console.log(data);
    // * Update modal header
    $('#product-header-container').text(`Product #${productId} Variants`);
    $('#modal-variation-name').text(data.product.variation_name);

    // * Empty modal table content
    var tableContainer = $('#product-details-container');
    tableContainer.empty();

    // * Fill modal table content
    data.variants.forEach(
      (variant) => {
        let escapedOptionName = '';

        if (variant.option_name) {
          escapedOptionName = $('<div/>').text(variant.option_name).html(); // Escape option name
        }

        let tableRow = $('<tr></tr>'); // Create table row element

        // Create separate cells for product name and variation (if applicable)
        let productNameCell = $('<td class="text-center"></td>');
        productNameCell.append($('<p>' + escapedOptionName + '</p>'));

        tableRow.append(productNameCell); // Append product name cell

        tableRow.append(
          $('<td class="text-center">' + variant.stock + '</td>'),
          $('<td class="text-center">₱' + variant.price + '</td>')
        );

        tableContainer.append(tableRow); // Append the completed table row
      }
    );
  }
</script>

<?= $this->endSection() ?>
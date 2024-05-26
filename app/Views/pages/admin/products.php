<?php helper('form'); ?>

<?= $this->extend("layouts/adminDefault") ?>

<?= $this->section("title") ?>Admin | Products<?= $this->endSection() ?>

<?= $this->section("content") ?>

<div class="row h-auto justify-content-between">
  <div class="col-12">
    <h1>Products</h1>
  </div>
  <div class="col-2">
    <a href="<?= url_to('ProductController::viewCreateProduct') ?>"><button class="btn btn-primary align-self-center">Create New Product</button></a>
  </div>
  <div class="col-2">

    <label for="select-org" class="form-label">Filter by Organization</label>
    <select id="select-org" class="form-select">
      <option>None</option>
      <?php foreach ($organizations as $org) : ?>
        <option value="<?= $org['organization_id'] ?>"><?= $org['organization_name'] ?></option>
      <?php endforeach ?>
    </select>
  </div>

</div>
<div class="row h-100">

  <div class="col-12">
    <div class="table-responsive">
      <table class="table table-dark table-hover table-bordered table-striped text-center">
        <thead>
          <tr>
            <th scope="col">ID</th>
            <th scope="col">Product Name</th>
            <th scope="col">Price</th>
            <th scope="col">Stock</th>
            <th scope="col">Actions</th>
          </tr>
        </thead>
        <tbody id="products-container">
          <?php foreach ($products as $product) : ?>
            <tr data-product-id="<?= $product['product_id'] ?>">
              <td class="tr-product-id"># <?= $product['product_id']; ?></td>
              <td class="tr-product-name"><?= $product['product_name']; ?></td>
              <td class="tr-product-price">₱<?= $product['price']; ?></td>
              <td class="tr-product-stock"><?= $product['stock']; ?></td>
              <td class="text-right">
                <button data-product-id="<?= $product['product_id'] ?>" type="button" data-bs-toggle="modal" data-bs-target="#editProductModal" class="btn btn-primary badge-pill edit-modal-btn" style="width:80px;">EDIT</button>
                <button data-product-id="<?= $product['product_id'] ?>" type="button" data-bs-toggle="modal" data-bs-target="#deleteProductModal" class="btn btn-primary badge-pill delete-modal-btn" style="width:80px;">DELETE</button>
              </td>
            </tr>
          <?php endforeach ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

<!-- Edit Product Modal -->
<div class="modal fade" id="editProductModal" tabindex="-1" aria-labelledby="editProductModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Product</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <?= form_open('ProductController::editProduct') ?>

        <div class="mb-3">
          <label for="product_name" class="col-form-label">Product Name</label>
          <input type="text" class="form-control" id="product_name">
        </div>
        <div class="mb-3">
          <label for="description" class="col-form-label">Description</label>
          <textarea class="form-control" id="description"></textarea>
        </div>
        <div class="mb-3">
          <label for="price" class="col-form-label">Price</label>
          <div class="input-group">
            <div class="input-group-text">₱</div>
            <input type="number" id="price" class="form-control" />
          </div>
        </div>
        <div class="mb-3">
          <label for="stock" class="col-form-label">Stock</label>
          <input type="number" id="stock" class="form-control" />
        </div>

        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary" id="edit-product-btn">Save changes</button>
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
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Are you sure you want to delete this product?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <a>
          <button type="button" class="btn btn-danger" id="delete-product-btn">Delete</button>
        </a>
      </div>
    </div>
  </div>
</div>

<div class="toast align-items-center text-bg-primary border-0" role="alert" aria-live="assertive" aria-atomic="true">
  <div class="d-flex">
    <div class="toast-body tite">
      test
    </div>
    <button type="button" class="btn-close me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
  </div>
</div>

<script>
  let deleteProductId;
  let deleteProductEl;

  let editProductId;

  $(document).ready(function() {

    // Event listener for delete button click
    $('.delete-modal-btn').click(function() {
      deleteProductId = $(this).data('product-id');
    });

    // Event listener for edit button click
    $('.edit-modal-btn').click(function() {
      editProductId = $(this).data('product-id');

      let url = '<?= base_url() ?>' + `admin/product/${editProductId}`;

      $.ajax({
        url: url,
        type: 'GET',
        success: (product) => {
          if (product.product_name) $('#product_name').val(product.product_name);
          if (product.description) $('#description').val(product.description);
          if (product.price) $('#price').val(product.price);
          if (product.stock) $('#stock').val(product.stock);
        }
      })
    });

    $('#delete-product-btn').click(function() {
      let url = '<?= base_url() ?>' + `admin/product/${deleteProductId}`;

      $.ajax({
        url: url,
        type: 'DELETE',
        success: () => {
          console.log($('#delete-product-btn'))
          console.log($(`tr[data-product-id="${deleteProductId}"]`))
          $(`tr[data-product-id="${deleteProductId}"]`).remove();
          $('#deleteProductModal').modal('hide');
          generateInfoToast('Product Deleted');
        }
      })
    })

    $('#edit-product-btn').click(function() {
      let url = '<?= base_url() ?>' + `admin/product/${editProductId}`;

      const data = {
        product_name: $('#product_name').val(),
        description: $('#description').val(),
        price: $('#price').val(),
        stock: $('#stock').val(),
      }
      $.ajax({
        url: url,
        type: 'PUT',
        data: data,
        success: () => {
          const editedRow = $(`tr[data-product-id="${editProductId}"]`);

          editedRow.find('.tr-product-name').text(data.product_name);
          editedRow.find('.tr-product-description').text(data.description);
          editedRow.find('.tr-product-price').text(data.price);
          editedRow.find('.tr-product-stock').text(data.stock);
          generateInfoToast('Product Edited!');

          $('#editProductModal').modal('hide'); // Close modal
        },
        error: (jqXHR, textStatus, errorThrown) => {
          console.log("AJAX Error: ", textStatus, errorThrown)
        }
      })
    })

  });
</script>
<?= $this->endSection() ?>
<?php helper('form'); ?>

<?= $this->extend("layouts/adminDefault2") ?>

<?= $this->section("title") ?>Admin | Products<?= $this->endSection() ?>

<?= $this->section("content") ?>

<div class="row h-auto justify-content-between mt-2">
  <div class="col-3">
    <h1>Products</h1>
    <a href="<?= url_to("ProductController::viewCreateProduct") ?>" class="btn btn-primary align-self-center create-modal-btn w-75 mb-2">Create New Product</a>
  </div>
  <div class="col-6">

  </div>
  <div class="col-3">

    <label for="select-org" class="form-label">Filter by Organization</label>
    <select id="select-org" class="form-select">
      <option value="none">None</option>
      <?php foreach ($organizations as $org) : ?>
        <option value="<?= $org->organization_id ?>"><?= $org->name ?></option>
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
            <tr data-product-id="<?= $product->product_id ?>">
              <td class="tr-product-id"># <?= $product->product_id ?></td>
              <td class="tr-product-name"><?= $product->product_name ?></td>
              <td class="tr-product-price">₱<?= $product->price ?></td>
              <td class="tr-product-stock"><?= $product->stock ?></td>
              <td class="text-right">
                <a href="<?= url_to("ProductController::viewEditProduct", $product->product_id) ?>" type="button" class="btn btn-primary badge-pill edit-modal-btn" style="width:80px;">EDIT</a>
                <a href="<?= url_to("ProductController::deleteProduct", $product->product_id) ?>" data-product-id="<?= $product->product_id ?>" type="button" data-bs-toggle="modal" data-bs-target="#deleteProductModal" class="btn btn-primary badge-pill delete-modal-btn" style="width:80px;">DELETE</a>
              </td>
            </tr>
          <?php endforeach ?>
        </tbody>
      </table>
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
        <a>
          <button type="button" class="btn btn-danger" id="delete-product-btn">Delete</button>
        </a>
      </div>
    </div>
  </div>
</div>

<script>
  let deleteProductId;

  $(document).ready(function() {

    $('.delete-modal-btn').click(function() {
      deleteProductId = $(this).data('product-id');
    });

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
          $(this).attr("disabled", false); // disable button
        },
        error: (err) => {
          console.log(err);
          generateErrorToast('Error Deleting Product.');
          $('#delete-modal-btn-close').click();
          $(this).attr("disabled", false); // disable button
        }
      })
    })
  });
</script>
<?= $this->endSection() ?>
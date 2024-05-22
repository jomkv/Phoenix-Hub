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
        <tbody>
          <?php foreach ($products as $product) : ?>
            <tr>
              <td># <?= $product['product_id']; ?></td>
              <td><?= $product['product_name']; ?></td>
              <td>₱<?= $product['price']; ?></td>
              <td><?= $product['stock']; ?></td>
              <td class="text-right">
                <button class="btn btn-primary badge-pill" style="width:80px;">EDIT</button>
                <button class="btn btn-primary badge-pill" style="width:80px;">DELETE</button>
              </td>
            </tr>
          <?php endforeach ?>
        </tbody>
      </table>
    </div>
  </div>
</div>


<?= $this->endSection() ?>
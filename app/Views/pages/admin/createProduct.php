<?php helper('form'); ?>

<?= $this->extend("layouts/adminDefault2") ?>

<?= $this->section("title") ?>Add Product <?= $this->endSection() ?>

<?= $this->section("content") ?>

<div class="text-center">
  <div class="container mt-2  text-start">
    <div class="row">
      <div class="col-lg-5 col-md-8 ">
        <h1>Add Product</h1>
        <?= form_open('/admin/product/new', ['class' => 'custom_form_container p-4 shadow-lg']) ?>
        <div class="mb-3">
          <label for="organization_id">Organization</label>
          <select name="organization_id" id="organization_id" class="form-select" style="background-color: white;">
            <?php foreach ($organizations as $org) : ?>
              <option value="<?= $org->organization_id; ?>"><?= $org->name; ?></option>
            <?php endforeach ?>
          </select>
        </div>
        <div class="mb-3">
          <label for="product_name">Product Name</label>
          <input type="text" name="product_name" id="product_name" class="form-control" style="background-color: white;" value="<?= esc(old('product_name')) ?>">
        </div>
        <div class="mb-3">
          <label for="description">Description</label>
          <input type="text" name="description" id="description" class="form-control" style="background-color: white;" value="<?= esc(old('description')) ?>">
        </div>
        <div class="mb-3">
          <label for="price">Price</label>
          <input type="number" name="price" id="price" class="form-control" style="background-color: white;" value="<?= esc(old('price')) ?>">
        </div>
        <div class="mb-3">
          <label for="stock">Stock</label>
          <input type="number" name="stock" id="stock" class="form-control" style="background-color: white;" value="<?= esc(old('stock')) ?>">
        </div>
        <div class="mb-3">
          <label for="formFileMultiple" class="form-label">Product Image</label>
          <input class="form-control" type="file" name="upload" id="formFile">
        </div>

        <button type="submit" class="btn btn-primary w-100 mb-3">Add</button>

        <?php if (session()->has("errors")) : ?>
          <div class="bg-danger-subtle text-dark border-danger border-start border-4 rounded" style="padding: 10px; padding-left: 15px;">
            <h4 class="fw-bold">Something went wrong</h4>
            <ul>
              <?php foreach (session("errors") as $error) : ?>
                <li class="fw-medium">• <?= $error ?></li>
              <?php endforeach; ?>
            </ul>
          </div>
        <?php endif; ?>


        <?= form_close() ?>
      </div>
    </div>
  </div>
</div>

<style>
  .container .row .col-lg-5 {
    margin-left: auto !important;
    margin-right: auto !important;
  }

  .custom_form_container {
    background-color: #EEEEEE;
    border-radius: 5px;
  }
</style>

<?= $this->endSection() ?>
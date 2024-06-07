<?php helper('form'); ?>

<?= $this->extend("layouts/adminDefault2") ?>

<?= $this->section("title") ?>Add Product <?= $this->endSection() ?>

<?= $this->section("content") ?>

<div class="text-center">
  <div class="container mt-2  text-start">
    <div class="row">
      <div class="col-lg-5 col-md-8 ">
        <h1>Add Product</h1>
        <?= form_open('/admin/product/new', ['class' => 'custom_form_container p-4']) ?>
        <div class="mb-3">
          <label for="organization_id">Organization</label>
          <select name="organization_id" id="organization_id" class="form-select" style="background-color: white;">
            <?php foreach ($organizations as $org) : ?>
              <option value="<?= $org["organization_id"]; ?>"><?= $org["organization_name"]; ?></option>
            <?php endforeach ?>
          </select>
        </div>
        <div class="mb-3">
          <label for="product_name">Product Name</label>
          <input type="text" name="product_name" id="product_name" class="form-control" style="background-color: white;">
        </div>
        <div class="mb-3">
          <label for="description">Description</label>
          <input type="text" name="description" id="description" class="form-control" style="background-color: white;">
        </div>
        <div class="mb-3">
          <label for="price">Price</label>
          <input type="number" name="price" id="price" class="form-control" style="background-color: white;">
        </div>
        <div class="mb-3">
          <label for="stock">Stock</label>
          <input type="number" name="stock" id="stock" class="form-control" style="background-color: white;">
        </div>
        <div class="mb-3">
          <label for="formFileMultiple" class="form-label">Product Image</label>
          <input class="form-control" type="file" name="upload" id="formFile">
        </div>

        <button type="submit" class="btn btn-primary w-100">Add</button>
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
    box-shadow: 10px 10px 10px 20px rgba(0, 0, 0, 0.1);
    margin-bottom: 20px;
  }
</style>

<?= $this->endSection() ?>
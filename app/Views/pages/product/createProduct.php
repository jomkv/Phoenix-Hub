<?php helper('form'); ?>

<?= $this->extend("layouts/defaultDev") ?>

<?= $this->section("title") ?>Add Product <?= $this->endSection() ?>

<?= $this->section("content") ?>

<h1>Add Product</h1>

<?= form_open('/admin/product/new') ?>

<label for="organization_id">Organization</label>
<select name="organization_id" id="organization_id">
  <?php foreach ($organizations as $org) : ?>
    <option value="<?= $org["organization_id"]; ?>"><?= $org["organization_name"]; ?></option>
  <?php endforeach ?>
</select>


<label for="product_name">Product Name</label>
<input type="text" name="product_name" id="product_name">

<label for="description">Description</label>
<input type="text" name="description" id="description">

<label for="price">Price</label>
<input type="number" name="price" id="price">

<label for="stock">Stock</label>
<input type="number" name="stock" id="stock">

<button type="submit">Add</button>
</form>

<?= $this->endSection() ?>
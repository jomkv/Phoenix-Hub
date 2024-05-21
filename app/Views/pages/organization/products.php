<?php helper('form'); ?>

<?= $this->extend("layouts/defaultDev") ?>

<?= $this->section("title") ?>Organization Products<?= $this->endSection() ?>

<?= $this->section("content") ?>

<h1> <?= $organization['organization_name'] ?> </h1>

<h2>Products Offered: </h2>

<?php foreach ($products as $product) : ?>
  <h3><?= $product['product_name'] ?></h3>
  <h3><?= $product['price'] ?></h3>
  <br>
<?php endforeach ?>

<?= $this->endSection() ?>
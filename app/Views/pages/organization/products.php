<?php helper('form'); ?>

<?= $this->extend("layouts/defaultDev") ?>

<?= $this->section("title") ?>Organization Products<?= $this->endSection() ?>

<?= $this->section("content") ?>

<h1> <?= $organization['organization_name'] ?> </h1>

<h2>Products Offered: </h2>

<?php foreach ($products as $product) : ?>
  <h4>hehe product</h4>
<?php endforeach ?>

<?= $this->endSection() ?>
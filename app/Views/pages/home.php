<?= $this->extend("layouts/defaultDev") ?>

<?= $this->section("title") ?>Home <?= $this->endSection() ?>

<?= $this->section("content") ?>

<?php foreach ($organizations as $org) : ?>
  <h1>Org Name: <?= $org['organization_name'] ?> </h1>
  <h6>Description: <?= $org['description'] ?> </h4>
    <p>Contact Email: <?= $org['contact_email'] ?> </p>
    <p>Contact Person: <?= $org['contact_person'] ?> </p>
  <?php endforeach ?>

  <?= $this->endSection() ?>
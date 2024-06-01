<?= $this->extend("layouts/adminDefault") ?>

<?= $this->section("title") ?>Admin | Organizations <?= $this->endSection() ?>

<?= $this->section("content") ?>

<?php
$info = session()->getFlashdata('info');

$js_info = json_encode($info); // Encode info message for JS
?>

<script>
  const phpInfo = JSON.parse('<?= $js_info ?>'); // Decode info message

  if (phpInfo) {
    generateSuccessToast(phpInfo);
  }
</script>

<div class="row h-auto">
  <div class="col-6">
    <h1>Organizations</h1>
  </div>
  <div class="col-6 d-flex justify-content-end">
    <a href="<?= url_to('OrganizationController::viewCreateOrg') ?>" class="btn btn-primary">
      Create new
    </a>
  </div>
</div>
<div class="row row-cols-4 g-1 mt-4 overflow-auto">
  <?php foreach ($organizations as $org) : ?>
    <div class="col ">
      <div class="card " style="width: 18rem;">
        <img src="<?= base_url('organizationLogos/' . $org['logo_file_name'])  ?> " class="img-thumbnail mx-auto d-block " alt="..." style="width:250px; height: 250px;">

        <div class=" card-body">
          <h5 class="card-title"><?= $org['organization_name'] ?></h5>
          <div class="btn-group">
            <button type="button" class="btn btn-sm btn-outline-secondary">Edit</button>
            <button type="button" class="btn btn-sm btn-outline-danger">Delete</button>
          </div>
        </div>
      </div>
    </div>
  <?php endforeach ?>
</div>

<?= $this->endSection() ?>
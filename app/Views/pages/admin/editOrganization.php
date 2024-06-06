<?php helper('form'); ?>

<?= $this->extend("layouts/adminDefault2") ?>

<?= $this->section("title") ?>Create Organization <?= $this->endSection() ?>

<?= $this->section("content") ?>

<?php
$errors = session()->getFlashdata('error');

$js_errors = json_encode($errors ? $errors['errors'] : []);
?>

<script>
  const phpErrors = JSON.parse('<?= $js_errors ?>'); // Decode info message

  if (phpErrors && phpErrors instanceof Object) {
    const errors = Object.values(phpErrors);
    for (let i = 0; i < errors.length; i++) {
      generateErrorToast(errors[i]);
    }
  }
</script>

<div class="text-center">
  <div class="container mt-5 text-start">
    <div class="row">
      <div class="col-lg-5 col-md-8">
        <h1> Edit Organization </h1>
        <?= form_open_multipart('/admin/organization/new', ['class' => 'custom_form_container p-4']) ?>
        <div class="mb-3">
          <label for="organization_name">Organization Name</label>
          <input value="<?= $organization['organization_name'] ?>" class="form-control" type="text" name="organization_name" id="organization_name">
        </div>

        <div class="mb-3">
          <label for="description">Description</label>
          <textarea class="form-control" rows="3" name="description" id="description"><?= $organization['description'] ?></textarea>
        </div>

        <div class="mb-3">
          <label for="contact_email">Contact Email</label>
          <input value="<?= $organization['contact_email'] ?>" placeholder="sample@sample.com" class="form-control" type="text" name="contact_email" id="contact_email">
        </div>

        <div class="mb-3">
          <label for="contact_person">Contact Person</label>
          <input value="<?= $organization['contact_person'] ?>" class="form-control" type="text" name="contact_person" id="contact_person">
        </div>

        <div class="mb-3">
          <label for="formFileMultiple" class="form-label">Organization Logo</label>
          <input class="form-control" type="file" name="upload" id="formFile">
        </div>

        <button class="btn btn-primary w-100" type="submit">Create</button>
        </form>
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
    background-color: white;
    border-radius: 5px;
    box-shadow: 0px 5px 10px rgba(0, 0, 0, 0.1);
  }
</style>



<?= $this->endSection() ?>
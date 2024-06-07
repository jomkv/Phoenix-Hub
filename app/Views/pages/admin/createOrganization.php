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
  <div class="container mt-2 text-start">
    <div class="row">
      <div class="col-lg-5 col-md-8 ">
        <h1> Create Organization </h1>
        <?= form_open_multipart('/admin/organization/new', ['class' => 'custom_form_container p-4']) ?>
        <div class="mb-3">
          <label for="organization_name">Organization Name</label>
          <input class="form-control" type="text" name="organization_name" id="organization_name" style="background-color: white;">
        </div>

        <div class="mb-3">
          <label for="description">Description</label>
          <textarea class="form-control" rows="4" name="description" id="description" style="background-color: white; resize: none; "></textarea>
        </div>

        <div class="mb-3">
          <label for="contact_email">Contact Email</label>
          <input placeholder="sample@sample.com" class="form-control" type="text" name="contact_email" id="contact_email" style="background-color: white  ;">
        </div>

        <div class="mb-3">
          <label for="contact_person">Contact Person</label>
          <input class="form-control" type="text" name="contact_person" id="contact_person" style="background-color: white;">
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
    background-color: #EEEEEE;
    border-radius: 5px;
    box-shadow: 10px 10px 10px 20px rgba(0, 0, 0, 0.1);
    margin-bottom: 20px;
  }
</style>



<?= $this->endSection() ?>
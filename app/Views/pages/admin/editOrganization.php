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
        <?= form_open_multipart('/admin/organization/' . $organization->organization_id, ['class' => 'custom_form_container p-4']) ?>
        <div class="mb-3">
          <label for="organization_name">Organization Name</label>
          <input placeholder="CSG" class="form-control" type="text" name="name" id="name" style="background-color: white;" value="<?= esc(old('name', esc($organization->name))) ?>">
        </div>

        <div class="mb-3">
          <label for="description">Organization Full Name</label>
          <textarea placeholder="Central Student Government" class="form-control" rows="4" name="full_name" id="full_name" style="background-color: white; resize: none; "><?= esc(old('full_name', esc($organization->full_name))) ?></textarea>
        </div>

        <div class="mb-3">
          <label for="contact_email">Contact Email</label>
          <input placeholder="sample@sample.com" class="form-control" type="text" name="contact_email" id="contact_email" style="background-color: white  ;" value="<?= esc(old('contact_email', esc($organization->contact_email))) ?>">
        </div>

        <div class="mb-3">
          <label for="contact_person">Contact Person</label>
          <input class="form-control" type="text" name="contact_person" id="contact_person" style="background-color: white;" value="<?= esc(old('contact_person', esc($organization->contact_person))) ?>">
        </div>

        <div class="mb-3">
          <label for="formFileMultiple" class="form-label">Organization Logo</label>
          <input class="form-control" type="file" name="upload" id="formFile">
        </div>

        <button class="btn btn-primary w-100 mb-3" type="submit" id="submit-create-btn" onclick="this.disabled=true;this.value='Sending, please wait...';this.form.submit();">Edit</button>

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
        </form>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
  document.getElementById('submit-create-btn').addEventListener("click", () => {
    document.getElementById("submit-create-btn").disabled = true;
  })
</script>

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
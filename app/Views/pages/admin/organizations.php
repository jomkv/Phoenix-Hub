<?= $this->extend("layouts/adminDefault2") ?>

<?= $this->section("title") ?>Admin | Organizations <?= $this->endSection() ?>

<?= $this->section("content") ?>

<?php
$info = session()->getFlashdata('info');
$error = session()->getFlashdata('error');

$js_error = json_encode($error);
$js_info = json_encode($info);
?>

<script>
  const phpInfo = JSON.parse('<?= $js_info ?>');
  const phpError = JSON.parse('<?= $js_error ?>');

  if (phpInfo) {
    generateSuccessToast(phpInfo);
  }
  if (phpError) {
    generateErrorToast(phpError);
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
<div class="row row-cols-4 g-1 mt-4 overflow-auto" id="organizations-container">
  <?= $this->include('partials/admin/organizationCards') ?>
</div>

<script>
  let deleteOrganizationId;

  $(document).ready(function() {

    $('#organizations-container').on('click', '.delete-modal-btn', function() {
      deleteOrganizationId = $(this).data('organization-id');
      console.log(deleteOrganizationId)
    });

    $('#confirm-delete-btn').click(function() {
      let url = '<?= base_url() ?>' + `admin/organization/${deleteOrganizationId}`;

      $.ajax({
        url: url,
        type: 'DELETE',
        headers: {
          'x-reload': true,
        },
        success: (response) => {
          $('#confirmDeleteModal').modal('hide');
          $('#organizations-container').html(response);
          generateSuccessToast('Organization Deleted');
        },
        error: () => {
          generateErrorToast('Error Deleting Product.');
          $('#deleteOrganizationModal').modal('hide');
        }
      })
    })
  })
</script>

<?= $this->endSection() ?>
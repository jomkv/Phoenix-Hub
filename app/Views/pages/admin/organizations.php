<?= $this->extend("layouts/adminDefault") ?>

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

<div class="modal fade" id="deleteOrganizationModal" tabindex="-1" aria-labelledby="deleteOrganizationModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Confirm Delete</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Are you sure you want to delete this organization?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <a>
          <button type="button" class="btn btn-danger" id="delete-organization-btn">Delete</button>
        </a>
      </div>
    </div>
  </div>
</div>

<script>
  let deleteOrganizationId;

  $(document).ready(function() {

    $('.delete-modal-btn').click(function() {
      deleteOrganizationId = $(this).data('organization-id');
      console.log(deleteOrganizationId)
    });

    $('#delete-organization-btn').click(function() {
      let url = '<?= base_url() ?>' + `admin/organization/${deleteOrganizationId}`;

      $.ajax({
        url: url,
        type: 'DELETE',
        headers: {
          'x-reload': true,
        },
        success: (response) => {
          $('#organizations-container').html(response);
          $('#deleteOrganizationModal').modal('hide');
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
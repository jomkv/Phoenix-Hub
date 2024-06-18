<?= $this->extend("layouts/adminDefault2") ?>

<?= $this->section("title") ?>Admin | Organizations <?= $this->endSection() ?>

<?= $this->section("content") ?>

<div class="row h-auto mt-4 w-100">
  <div class="col-6">
    <h1>Organizations</h1>
  </div>
  <div class="col-6 d-flex justify-content-end">
    <a href="<?= url_to('OrganizationController::viewCreateOrg') ?>" class="btn btn-primary w-50 h-100" style="background-color: var(--primary);">
      Create new
    </a>
  </div>
</div>
<div class="row row-cols-sm-1 row-cols-md-1 row-cols-lg-2 row-cols-xl-3 row-cols-xxl-4 g-1 m-5 overflow-y-auto" id="organizations-container">
  <?= $this->include('partials/admin/organizationCards') ?>
</div>

<script>
  let deleteOrganizationId;

  $(document).ready(function() {

    $('#organizations-container').on('click', '.delete-modal-btn', function() {
      deleteOrganizationId = $(this).data('organization-id');
    });

    $('#confirm-delete-btn').click(function() {
      let url = '<?= base_url() ?>' + `admin/organization/${deleteOrganizationId}`;
      $(this).attr("disabled", true); // disable button

      $.ajax({
        url: url,
        type: 'DELETE',
        headers: {
          'x-reload': true,
        },
        success: (response) => {
          $('#delete-modal-btn-close').click();
          $('#organizations-container').html(response);
          generateSuccessToast('Organization Deleted');
          $(this).attr("disabled", false); // disable button
        },
        error: () => {
          $('#delete-modal-btn-close').click();
          generateErrorToast('Error Deleting Product.');
          $(this).attr("disabled", false); // disable button
        }
      })
    })
  })
</script>

<?= $this->endSection() ?>
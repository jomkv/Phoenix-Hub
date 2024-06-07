<?php foreach ($organizations as $org) : ?>
  <div class="col ">
    <div class="card " style="width: 18rem;">
      <img src="<?= base_url('organizationLogos/' . $org['logo_file_name'])  ?> " class="img-thumbnail mx-auto d-block " alt="..." style="width:250px; height: 250px;">

      <div class=" card-body">
        <h5 class="card-title"><?= $org['organization_name'] ?></h5>
        <div class="row">
          <div class="col">
            <a class="btn btn-sm btn-outline-secondary w-100" href="<?= url_to("OrganizationController::viewEditOrg", $org['organization_id']) ?>"><i class="bi bi-pencil-fill"></i>Edit</a>
          </div>
          <div class="col">
            <button data-organization-id="<?= $org['organization_id'] ?>" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal" type="button" class="btn btn-sm btn-outline-danger w-100 delete-modal-btn"><i class="bi bi-trash-fill"></i>Delete</button>
          </div>
        </div>
      </div>
    </div>
  </div>
<?php endforeach ?>
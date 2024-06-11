<?php foreach ($organizations as $org) : ?>
  <?php $logo_url = json_decode($org->logo)->url; ?>
  <div class="col">
    <div class="card pt-2 w-100">
      <img src="<?= $logo_url ?> " class="img-thumbnail mx-auto d-block " alt="..." style="width:250px; height: 250px;">
      <div class=" card-body">
        <h5 class="card-title"><?= esc($org->name) ?></h5>
        <div class="row">
          <div class="col">
            <a class="btn btn-sm btn-outline-secondary w-100" href="<?= url_to("OrganizationController::viewEditOrg", $org->organization_id) ?>"><i class="bi bi-pencil-fill"></i>Edit</a>
          </div>
          <div class="col">
            <button data-organization-id="<?= $org->organization_id ?>" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal" type="button" class="btn btn-sm btn-outline-danger w-100 delete-modal-btn"><i class="bi bi-trash-fill"></i>Delete</button>
          </div>
        </div>
      </div>
    </div>
  </div>
<?php endforeach ?>
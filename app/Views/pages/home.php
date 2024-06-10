<?= $this->extend("layouts/default") ?>

<?= $this->section("title") ?>Home <?= $this->endSection() ?>

<?= $this->section("content") ?>

<style>
  body {
    background-color: #1B1B1B;
  }
</style>

<div class="row">
  <div class="col-12 text-center shadow-lg p-5">
    <h1>Explore Organizations</h1>
    <div class="d-flex flex-row flex-nowrap overflow-auto">
      <?php foreach ($organizations as $organization) : ?>
        <div class="card m-2" style="min-height: 200px; min-width: 250px; margin-right: 5px;">
          <img src="<?= json_decode($organization->logo)->url ?>" class="img-thumbnail mx-auto d-block rounded-circle" alt="..." style="width:175px; height: 175px;">
          <div class="card-body">
            <h5 class="card-title"><?= esc($organization->name) ?></h5>
            <p><?= esc($organization->full_name) ?></p>
            <a href="#" class="btn btn-primary">View Products</a>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>

  <div class="col-12 text-center">
    <a href="<?= url_to("TestViewsController::viewBarter") ?>" class=" btn btn-primary mt-5 w-25 h-50" type="button">Barter</a>
  </div>
</div>

<?= $this->endSection() ?>
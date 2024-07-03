<?= $this->extend("layouts/defaultHome") ?>

<?= $this->section("title") ?>Home <?= $this->endSection() ?>

<?= $this->section("content") ?>

<style>
  body {
    background-color: #1B1B1B;
  }

  .card {
    min-height: 300px;
    min-width: 250px;
    max-width: 250px;
    margin-right: 5px;
    overflow: hidden;
  }

  .card-title,
  .card-body p {
    white-space: normal;
    overflow: visible;
    text-overflow: clip;
  }

  .card-body p {
    max-height: none;
    /* Allow full content to be displayed */
    line-height: 1.25em;
  }
</style>

<div class="row w-100 gy-5">
  <div class="col-12 text-center shadow-lg p-5" style="background-color:#faf9f6; border-radius:10px;">
    <h1>Affiliate Organizations</h1>
    <div class="d-flex flex-row flex-nowrap overflow-auto">
      <?php foreach ($organizations as $organization) : ?>
        <div class="card m-2 pt-3">
          <img src="<?= json_decode($organization->logo)->url ?>" class="img-thumbnail mx-auto d-block rounded-circle" alt="..." style="width:175px; height: 175px;">
          <div class="card-body">
            <h5 class="card-title"><?= esc($organization->name) ?></h5>
            <p class="organization-full-name"><?= esc($organization->full_name) ?></p>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
  <div class="col-12 text-center" style="height: 80px;">
    <a href="<?= url_to("BarterController::viewBarterHome") ?>" class="btn fw-semibold fs-5" type="button" style="background-color: #4f089a; color: white; width: 180px;">Barter</a>
  </div>
</div>

<script>
  document.addEventListener("DOMContentLoaded", function() {
    const fullNameElements = document.querySelectorAll(".organization-full-name");

    fullNameElements.forEach(function(element) {
      let fontSize = parseFloat(window.getComputedStyle(element).fontSize);
      while (element.scrollHeight > element.clientHeight && fontSize > 10) {
        fontSize -= 1;
        element.style.fontSize = fontSize + "px";
      }
    });
  });
</script>

<?= $this->endSection() ?>
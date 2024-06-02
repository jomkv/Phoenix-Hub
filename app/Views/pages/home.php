<?= $this->extend("layouts/default") ?>

<?= $this->section("title") ?>Home <?= $this->endSection() ?>

<?= $this->section("content") ?>

<style>
  body {
    background-color:#1B1B1B;
  }
</style>

<div class="row">
  <!-- 
    Carousel Mobile File Path: app/Views/partials/user/organizationCarouselMobile.php
  -->
  <?= $this->include('partials/user/organizationCarouselMobile.php'); ?>

  <!-- 
    Carousel File Path: app/Views/partials/user/organizationCarousel.php
  -->
  <?= $this->include('partials/user/organizationCarousel.php'); ?>
  <div class="col-12 text-center">
    <button class=" btn btn-primary mt-3 w-25 h-100" type="button">Barter</button>
  </div>
</div>

<?= $this->endSection() ?>
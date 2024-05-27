<?= $this->extend("layouts/default") ?>

<?= $this->section("title") ?>Home <?= $this->endSection() ?>

<?= $this->section("content") ?>

<style>
  body {
    background-image: url("<?= base_url() . 'CvSU Home page.jpg' ?>");
  }
</style>
<div class="container text-center p-5" style="margin-top: 150px; border-style:solid; background-color:violet;">

  <div class="row align-items-center">
    <div class="col" style="background-color:white; height: 300px;">
      <div class="card" style="width: 18rem;">
        <img src="<?= base_url() . 'White Tshirt.jpg'  ?>" class="img-thumbnail mx-auto d-block" alt="..." style="width:80%; ">
        <div class="card-body">

          <a href="#" class="btn btn-primary">Go somewhere</a>
        </div>
      </div>
    </div>
    <div class="col" style="background-color:white; height: 300px;">
      <div class="card" style="width: 18rem;">
        <img src="<?= base_url() . 'White Tshirt.jpg' ?>" class="img-thumbnail mx-auto d-block" alt="..." style="width:80%; ">
        <div class="card-body">

          <a href="#" class="btn btn-primary">Go somewhere</a>
        </div>
      </div>
    </div>
    <div class="col" style="background-color:white; height: 300px;">
      <div class="card" style="width: 18rem;">
        <img src="<?= base_url() . 'White Tshirt.jpg' ?>" class="img-thumbnail mx-auto d-block" alt="..." style="width:80%; ">
        <div class="card-body">

          <a href="#" class="btn btn-primary">Go somewhere</a>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="d-grid gap-2 col-6 mx-auto" style="padding:50px;">

  <button class="btn btn-primary mx-auto d-block" type="button" style="width:30%;">Barter</button>
</div>
<?= $this->endSection() ?>
<?= $this->extend("layouts/default") ?>

<?= $this->section("title") ?>Home <?= $this->endSection() ?>

<?= $this->section("content") ?>

<style>
  body {
    background-image: url("<?= base_url() . 'CvSU Home page.jpg' ?>");
  }
</style>

<div id="carouselExampleDark" class="carousel carousel-dark slide p-5 text-center bg-light mx-auto d-block" style="border: 1px solid black; margin-top: 120px;">
  <div class="carousel-indicators">
    <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
    <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="1" aria-label="Slide 2"></button>
    <button type="button" data-bs-target="#carouselExampleDark" data-bs-slide-to="2" aria-label="Slide 3"></button>
  </div>
  <div class="carousel-inner mx-auto d-block">
    <h1>Explore Organizations</h1>
    <div class="carousel-item active" data-bs-interval="2000">
      <div class="row align-items-center mb-3">
        <div class="col"></div>
        <div class="col">
          <div class="card">
            <img src="<?= base_url() . 'sampleOrg.png' ?>" class="img-thumbnail mx-auto d-block rounded-circle" alt="..." style="width:175px; height: 175px;">
            <div class="card-body">
              <h5 class="card-title">Org Name</h5>
              <a href="#" class="btn btn-primary">View Products</a>
            </div>
          </div>
        </div>
        <div class="col">
          <div class="card">
            <img src="<?= base_url() . 'WALTAR.png' ?>" class="img-thumbnail mx-auto d-block rounded-circle" alt="..." style="width:175px; height: 175px;">
            <div class="card-body">
              <h5 class="card-title">Org Name</h5>
              <a href="#" class="btn btn-primary">View Products</a>
            </div>
          </div>
        </div>
        <div class="col">
          <div class="card">
            <img src="<?= base_url() . 'sampleOrg.png' ?>" class="img-thumbnail mx-auto d-block rounded-circle" alt="..." style="width:175px; height: 175px;">
            <div class="card-body">
              <h5 class="card-title">Org Name</h5>
              <a href="#" class="btn btn-primary">View Products</a>
            </div>
          </div>
        </div>
        <div class="col"></div>
      </div>
    </div>
    <div class="carousel-item" data-bs-interval="2000">
      <div class="row align-items-center mb-3">
        <div class="col"></div>
        <div class="col">
          <div class="card">
            <img src="<?= base_url() . 'sampleOrg.png' ?>" class="img-thumbnail mx-auto d-block rounded-circle" alt="..." style="width:175px; height: 175px;">
            <div class="card-body">
              <h5 class="card-title">Org Name</h5>
              <a href="#" class="btn btn-primary">View Products</a>
            </div>
          </div>
        </div>
        <div class="col">
          <div class="card">
            <img src="<?= base_url() . 'sampleOrg.png' ?>" class="img-thumbnail mx-auto d-block rounded-circle" alt="..." style="width:175px; height: 175px;">
            <div class="card-body">
              <h5 class="card-title">Org Name</h5>
              <a href="#" class="btn btn-primary">View Products</a>
            </div>
          </div>
        </div>
        <div class="col">
          <div class="card">
            <img src="<?= base_url() . 'sampleOrg.png' ?>" class="img-thumbnail mx-auto d-block rounded-circle" alt="..." style="width:175px; height: 175px;">
            <div class="card-body">
              <h5 class="card-title">Org Name</h5>
              <a href="#" class="btn btn-primary">View Products</a>
            </div>
          </div>
        </div>
        <div class="col"></div>
      </div>
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>
<div class="container text-center p-5" style="margin-top: 50px;">

  <button class="btn btn-primary mx-auto d-block" type="button" style="width:30%;">Barter</button>
</div>
<?= $this->endSection() ?>
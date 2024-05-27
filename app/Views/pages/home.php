<?= $this->extend("layouts/default") ?>

<?= $this->section("title") ?>Home <?= $this->endSection() ?>

<?= $this->section("content") ?>

<style>
  body{
    background-image:url("<?= base_url() . 'CvSU Home page.jpg' ?>");
  }
</style>
                                <!-- NAVBAR -->
<nav class="navbar fixed-top" style="background-color: green;">
  <div class="container-fluid">
    <a class="navbar-brand text-center mx-auto d-block" href="#">Phoenix Shop</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Link</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Dropdown
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="#">Action</a></li>
            <li><a class="dropdown-item" href="#">Another action</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#">Something else here</a></li>
          </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link disabled" aria-disabled="true">Disabled</a>
        </li>
      </ul>
      <form class="d-flex" role="search">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form>
    </div>
  </div>
</nav>

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
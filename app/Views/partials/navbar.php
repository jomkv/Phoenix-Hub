<style>
  .collapse.navbar-collapse#navbarNav {
  display: flex;
  justify-content: flex-end;
  padding-right:50px;
}
.itlog{
  width: 30px;;
  height: 30px;
  margin-bottom:10px;
  margin-right:5px;
}
.nav-link {
  margin: 10px;
}
</style>
<nav class="navbar fixed-top navbar-expand-lg p-3" style="background-color:#FFA31A;">
  <div class="container-fluid">
    <a class="navbar-brand fs-5 fw-bold" href="#"><img class="itlog" src="<?= base_url() . 'phoenix.png' ?>" >Phoenix Hub</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active fs-5 fw-bold" aria-current="page" href="#">About</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active fs-5 fw-bold" href="#">Products</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active fs-5 fw-bold" href="#">Login</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
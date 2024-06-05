<?= $this->extend("layouts/default2") ?>

<?= $this->section("title") ?>Barter Home<?= $this->endSection() ?>

<?= $this->section("content") ?>

<style>
  .container {
    margin-top: 100px;
    /* Adjust the margin as needed */
  }

  .pictures {
    height: 300px;
  }

  .card {
    transition: transform 0.3s;
  }

  .card:hover {
    transform: translateY(-10px);
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
  }

  .profile {
    display: flex;
    align-items: center;
  }

  .profile img {
    width: 20px;
    height: 20px;
    border-radius: 50%;
    margin-right: 10px;
  }

  .profile-name {
    font-size: 12px;
    font-weight: bold;
    margin: 0;
  }

  .card-header {
    padding: 10px;
    background-color: #f9f9f9;
    border-top: 1px solid #ddd;
    text-align: center;
  }

  .button-footer {
    padding: 10px;
    background-color: #f9f9f9;
    border-top: 1px solid #ddd;
    display: flex;
    justify-content: space-between;
    align-items: center;
  }

  .button-footer i {
    font-size: 18px;
    margin: 0 10px;
    cursor: pointer;
  }

  .button-footer i:hover {
    color: #337ab7;
  }
</style>
<div class="container">
  <div class="row row-cols-1 row-cols-md-3 g-3 mt-5" style=" margin-top: 20px; border: radius 40px;">
    <div class="col">
      <div class="card h-100" style="text-decoration: none;">
        <div class="card-header">
          <div class="profile">
            <img src="<?= base_url() . 'phoenix.png' ?>" alt="Profile Image">
            <p class="profile-name">John Doe</p>
          </div>
        </div>
        <img src="<?= base_url() . 'CvSU Home page.jpg' ?>" class="card-img-top img-fluid mb-3 pictures" alt="...">
        <div class=" card-body">
          <h5 class="card-title">Card title</h5>
          <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
        </div>
        <div class="button-footer">
          <i class="bi bi-hand-thumbs-up"></i>
          <i class="bi bi-chat"></i>
          <a href="<?= url_to("TestViewsController::viewBarterPost")  ?>" class="btn btn-primary btn-sm float-right">View More</a>
        </div>
      </div>
    </div>
    <div class="col">
      <div class="card h-100">
        <div class="card-header">
          <div class="profile">
            <img src="<?= base_url() . 'phoenix.png' ?>" alt="Profile Image">
            <p class="profile-name">John Doe</p>
          </div>
        </div>
        <img src="<?= base_url() . 'phoenix.png' ?>" class="card-img-top img-fluid mb-3 pictures" alt="...">
        <div class="card-body">
          <h5 class="card-title">Card title</h5>
          <p class="card-text">This is a short card.</p>
        </div>

      </div>
    </div>
    <div class="col">
      <div class="card h-100">
        <div class="card-header">
          <div class="profile">
            <img src="<?= base_url() . 'phoenix.png' ?>" alt="Profile Image">
            <p class="profile-name">John Doe</p>
          </div>
        </div>
        <img src="<?= base_url() . 'CvSU Home page.jpg' ?>" class="card-img-top img-fluid mb-3 pictures" alt="...">
        <div class="card-body">
          <h5 class="card-title">Card title</h5>
          <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content.</p>
        </div>

      </div>
    </div>
    <div class="col">
      <div class="card h-100">
        <div class="card-header">
          <div class="profile">
            <img src="<?= base_url() . 'phoenix.png' ?>" alt="Profile Image">
            <p class="profile-name">John Doe</p>
          </div>
        </div>
        <img src="<?= base_url() . 'phoenix.png' ?>" class="card-img-top img-fluid mb-3 pictures" alt="...">
        <div class="card-body">
          <h5 class="card-title">Card title</h5>
          <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
        </div>

      </div>
    </div>
    <div class="col">
      <div class="card h-100">
        <div class="card-header">
          <div class="profile">
            <img src="<?= base_url() . 'phoenix.png' ?>" alt="Profile Image">
            <p class="profile-name">John Doe</p>
          </div>
        </div>
        <img src="<?= base_url() . 'phoenix.png' ?>" class="card-img-top img-fluid mb-3 pictures" alt="...">
        <div class="card-body">
          <h5 class="card-title">Card title</h5>
          <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
        </div>

      </div>
    </div>
    <div class="col">
      <div class="card h-100">
        <div class="card-header">
          <div class="profile">
            <img src="<?= base_url() . 'phoenix.png' ?>" alt="Profile Image">
            <p class="profile-name">John Doe</p>
          </div>
        </div>
        <img src="<?= base_url() . 'phoenix.png' ?>" class="card-img-top img-fluid mb-3 pictures" alt="...">
        <div class="card-body">
          <h5 class="card-title">Card title</h5>
          <p class="card-text">This is a short card.</p>
        </div>

      </div>
    </div>
    <div class="col">
      <div class="card h-100">
        <div class="card-header">
          <div class="profile">
            <img src="<?= base_url() . 'phoenix.png' ?>" alt="Profile Image">
            <p class="profile-name">John Doe</p>
          </div>
        </div>
        <img src="<?= base_url() . 'phoenix.png' ?>" class="card-img-top img-fluid mb-3 pictures" alt="...">
        <div class="card-body">
          <h5 class="card-title">Card title</h5>
          <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content.</p>
        </div>

      </div>
    </div>
    <div class="col">
      <div class="card h-100">
        <div class="card-header">
          <div class="profile">
            <img src="<?= base_url() . 'phoenix.png' ?>" alt="Profile Image">
            <p class="profile-name">John Doe</p>
          </div>
        </div>
        <img src="<?= base_url() . 'phoenix.png' ?>" class="card-img-top img-fluid mb-3 pictures" alt="...">
        <div class="card-body">
          <h5 class="card-title">Card title</h5>
          <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
        </div>

      </div>
    </div>
  </div>
</div>


<?= $this->endSection() ?>
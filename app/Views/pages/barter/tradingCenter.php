<?= $this->extend("layouts/default2") ?>

<?= $this->section("title") ?>Barter Home<?= $this->endSection() ?>

<?= $this->section("content") ?>
<style>
  body {
    overflow: auto;
    margin-bottom: 10px;
    background: #dee2e6;
  }

  .image-container {
    max-width: 100%;
    height: 400px;
    display: flex;
    justify-content: center;
    align-items: center;
    overflow: hidden;
    border-radius: 5px;
  }

  .image-container img {
    max-width: 100%;
    height: auto;
    display: block;
    object-fit: contain;
  }

  .profile-container {
    display: flex;
    align-items: center;
    justify-content: space-between;
    /* Adjusted to align items */
    margin-bottom: 10px;
  }

  .profile-container img {
    border-radius: 50%;
    width: 40px;
    height: 40px;
    object-fit: cover;
    margin-right: 10px;
  }

  .card-header .profile-name {
    font-weight: bold;
    color: black;
  }

  .description h5 {
    margin-bottom: 0px;
  }

  .card-footer {
    display: flex;
    align-items: center;
    gap: 10px;
  }

  .card-footer .icon-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 70px;
    height: 40px;
    background-color: #ced4da;
    color: black;
    text-align: center;
    transition: background-color 0.3s, transform 0.3s;
  }

  .card-footer .icon-btn:hover {
    background-color: #7532FA;
    transform: scale(1.1);
  }

  .card-footer .btn-primary {
    background-color: #007bff;
    border-color: #007bff;
    transition: background-color 0.3s, transform 0.3s;
  }

  .card-footer .btn-primary:hover {
    background-color: #0056b3;
    border-color: #0056b3;
    transform: scale(1.1);
  }

  .card {
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    /* Adding box-shadow */
  }

  /* Media query for smaller screens */
  @media (max-width: 768px) {
    .profile-container .profile-name {
      font-size: 0.7rem;
      /* Adjust font size for profile name */
    }

    .profile-container .text-muted {
      font-size: 0.6rem;
      /* Adjust font size for date */
    }

    .card {
      max-height: 450px;
    }
  }
</style>

<div class="container mb-3" style="margin-top: 110px;">
  <a type="button" class="btn btn-primary btn-lg" href="<?= url_to("BarterController::viewCreateBarter") ?>" style="border-radius:10px; background-color:#7532FA; border-color: #7532FA">
    <i class="bi bi-plus-circle-fill"></i> Add Post
  </a>

  <?php foreach ($payload as $post) : ?>
    <div class="card text-start" style="margin-top: 20px;">
      <div class="card-header">
        <div class="profile-container">
          <div>
            <img src="<?= base_url() . 'WALTAR.png' ?>" alt="Profile Picture" style="border: 3px solid #7532FA;">
            <a href="<?= url_to("TestViewsController::viewStudentBarter") ?>" class="profile-name">
              <?= esc($post["student"]->full_name) ?>
            </a>
            <small class="text-muted" style="margin-left: 10px;"><?= date('F j, Y') ?></small> <!-- Display current date -->
          </div>
        </div>
        <div class="product-title">
          <h5>
            <?= esc($post["post"]->title) ?>
          </h5>
        </div>
      </div>
      <div class="image-container mx-auto d-block">
        <img src="<?= json_decode($post["post"]->images)->url ?>" class="img-fluid" style="max-width: auto; height: 100%;" alt="...">
      </div>
      <div class="card-footer text-body-secondary">
        <a href="<?= url_to("TestViewsController::viewBarterPost") ?>" class="btn btn-primary rounded" style=" background-color:#7532FA; border-color: #7532FA">View More</a>
      </div>
    </div>
  <?php endforeach; ?>
</div>

<?= $this->endSection() ?>
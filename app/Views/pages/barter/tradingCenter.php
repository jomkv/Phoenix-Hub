<?= $this->extend("layouts/default2") ?>

<?= $this->section("title") ?>Barter Home<?= $this->endSection() ?>

<?= $this->section("content") ?>

<style>
  body {
    background-color: #f0f2f5;
    /* Light gray background similar to Facebook */
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
  }

  .container {
    margin-top: 50px;
    display: flex;
    flex-direction: column;
    align-items: flex-start;
    /* Align items to the start (left side) */
    /* Add left padding to align content away from left edge */
  }

  .pictures {
    height: 300px;
    /* Decreased the height to make posts shorter */
  }

  .card {
    background-color: white;
    border-radius: 8px;
    box-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s;
    margin-bottom: 20px;
    padding: 15px;
    width: 100%;
    min-height: 500px;
    /* Ensured a minimum height for each post */
  }

  .card:hover {
    transform: translateY(-5px);
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
  }

  .profile {
    display: flex;
    align-items: center;
  }

  .profile img {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    margin-right: 10px;
  }

  .profile-name {
    font-size: 14px;
    font-weight: bold;
    margin: 0;
  }

  .card-header {
    display: flex;
    align-items: center;
    padding: 10px;
    border-bottom: 1px solid #ddd;
  }

  .card-body {
    padding: 10px;

  }

  .button-footer {
    display: flex;
    justify-content: space-between;
    border-top: 1px solid #ddd;
    padding: 10px;
  }

  .button-footer .action-icons {
    display: flex;
    align-items: center;
    /* Align icons vertically in the center */
  }

  .button-footer .action-icons i {
    font-size: 18px;
    cursor: pointer;
    padding: 10px;
    border-radius: 50%;
    /* Circle shape */
    background-color: #ddd;
    margin-right: 10px;
    transition: background-color 0.3s, transform 0.3s;
  }

  .button-footer .action-icons i:last-child {
    margin-right: 0;
  }

  .button-footer .action-icons i.active {
    background-color: purple;
    color: #fff;
  }

  .button-footer .action-icons i:hover {
    transform: scale(1.1);
    background-color: #285e8e;
    color: white;
  }

  .btn-primary {
    background-color: #0079D3;
    border: 1px solid #0079D3;
    color: white;
    padding: 10px 16px;
    font-size: 14px;
    /* Changed to oval shape */
    cursor: pointer;
    transition: background-color 0.3s, border-color 0.3s, color 0.3s;
  }

  .btn-primary:hover {
    background-color: #005EA6;
    border-color: #005EA6;
  }

  .close {
    color: black;
    position: absolute;
    top: 10px;
    right: 10px;
    font-size: 28px;
    font-weight: bold;
    cursor: pointer;
  }

  .form-group {
    position: relative;
    margin-bottom: 20px;
  }

  .form-group label {
    display: block;
    margin-bottom: 5px;
    font-weight: bold;
  }

  .add-photo {
    display: flex;
    align-items: center;
    margin-bottom: 10px;
  }

  .add-photo label {
    margin-bottom: 0;
    margin-left: 5px;
    cursor: pointer;
    color: #4267B2;
  }

  .add-photo i {
    font-size: 24px;
    color: #4267B2;
    cursor: pointer;
  }

  .post-button {
    position: absolute;
    bottom: 20px;
    right: 20px;
  }
</style>

<div class="container w-100">
  <a id="openModalBtn" class="btn btn-primary bi bi-window-plus mt-1" style="margin-bottom: -50px;" href="<?= url_to("TestViewsController::viewCreateBarter") ?>">Create Post</a>
  <div class="row row-cols-1 row-cols-sm-1 row-cols-md-2 row-cols-lg-2 row-cols-xl-3 g-3 mt-5">
    <?php for ($i = 0; $i < 8; $i++) : ?>
      <div class="col">
        <div class="card h-100" style="text-decoration: none; padding: 10px; background-color: frost; width: 350px;">
          <div class="card-header">
            <div class="profile">
              <img src="<?= base_url() . 'WALTAR.png' ?>" alt="Profile Image">
              <p class="profile-name">John Doe</p>
            </div>
          </div>
          <img src="<?= base_url() . ($i % 2 == 0 ? 'CvSU Home page.jpg' : 'phoenix.png') ?>" class="card-img-top img-fluid mb-3 pictures" alt="...">
          <div class="card-body">
            <h5 class="card-title fs-6" style="margin: -10px 0px;">Card title</h5>

          </div>
          <div class="button-footer">
            <div class="action-icons" style="width:50px;">
              <i class="bi bi-hand-thumbs-up" style="border-radius:30px; padding:5px 20px 5px 20px"></i>
              <i class="bi bi-chat" style="border-radius:30px; padding:5px 20px 5px 20px"></i>
            </div>
            <a href="<?= url_to("TestViewsController::viewBarterPost") ?>" class="btn btn-primary btn-sm float-right">View More</a>
          </div>
        </div>
      </div>
    <?php endfor; ?>
  </div>
</div>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    const modal = document.getElementById("myModal");
    const btn = document.getElementById("openModalBtn");
    const span = document.getElementsByClassName("close")[0];

    btn.onclick = function() {
      modal.style.display = "block";
    }

    span.onclick = function() {
      modal.style.display = "none";
    }

    window.onclick = function(event) {
      if (event.target == modal) {
        modal.style.display = "none";
      }
    }
  });
</script>

<?= $this->endSection() ?>
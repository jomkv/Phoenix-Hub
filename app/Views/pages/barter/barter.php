  <?= $this->extend("layouts/default") ?>

  <?= $this->section("title") ?>Barter Item<?= $this->endSection() ?>

  <?= $this->section("content") ?>
  <style>
    /* Custom CSS for minimalist design */
    body {
      font-family: 'Noto Sans', 'Helvetica Neue', Helvetica, Arial, sans-serif;
      background-color: #f0f2f5;
      padding-top: 70px;
      margin-bottom: 50px;
    }

    .post-card {
      margin-top: 20px;
      margin-bottom: 20px;
      border-radius: 10px;
      background-color: #ffffff;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      overflow: hidden;
      position: relative;
    }

    .post-header {
      display: flex;
      align-items: center;
      padding: 15px;
      border-bottom: 1px solid #ddd;
    }

    .profile {
      display: flex;
      align-items: center;
    }

    .post-header img {
      width: 40px;
      height: 40px;
      border-radius: 50%;
      margin-right: 10px;
    }

    .post-header .profile-name {
      font-size: 16px;
      font-weight: bold;
      margin: 0;
    }

    .post-date {
      position: absolute;
      top: 15px;
      right: 15px;
      font-size: 14px;
      color: #666;
    }

    .post-body {
      padding: 15px;
    }

    .post-content {
      margin-bottom: 20px;
    }

    .comment-section {
      background-color: #f9f9f9;
      padding: 15px;
      border-radius: 8px;
      margin-top: 15px;
      margin-bottom: 20px;
    }

    .comment {
      margin-bottom: 10px;
      padding-bottom: 10px;
      border-bottom: 1px solid #ddd;
    }

    .comment .profile-img {
      width: 30px;
      height: 30px;
      border-radius: 50%;
      margin-right: 10px;
    }

    .comment .profile-name {
      font-size: 14px;
      font-weight: bold;
      margin: 0;
    }

    .comment .comment-text {
      margin: 5px 0;
    }

    .comment-form {
      margin-top: 15px;
    }

    .comment-form textarea {
      width: 100%;
      min-height: 80px;
      resize: vertical;
      padding: 10px;
      font-size: 14px;
      border: 1px solid #ccc;
      border-radius: 4px;
    }

    .comment-form .btn-primary {
      margin-top: 10px;
    }

    /* Carousel styles */
    .carousel-container {
      height: 400px;
      /* Set a fixed height for the carousel */
      overflow: hidden;
      /* Hide overflow to prevent image scaling */
    }

    .carousel-item img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      /* Maintain aspect ratio and cover container */
    }

    /* Back button style */
    .back-button {
      position: fixed;
      top: 100px;
      left: 10px;
      z-index: 1000;
      width: 50px;
      height: 50px;
      background-color: #007bff;
      color: white;
      border: none;
      border-radius: 10px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 24px;
      text-decoration: none;
    }

    /* Carousel control button fix */
    .carousel-control-prev,
    .carousel-control-next {
      position: absolute;
      top: 50%;
      transform: translateY(-50%);
      z-index: 10;
    }
  </style>

  <div class="container" style="margin-top: 550px;">
    <!-- Back button float -->
    <a href="<?= url_to("TestViewsController::viewBarter") ?>" class="back-button"><i class="bi bi-arrow-left"></i></a>
    <div class="row justify-content-center">
      <div class="col-md-9">
        <div class="card post-card" style="padding:20px; border-radius:10px;">
          <div class="post-header">
            <div class="profile">
              <img src="<?= base_url() . 'toyota-supra-mk4.png' ?>" alt="Profile Image">
              <p class="profile-name">Seller's Name</p>
            </div>
          </div>
          <div class="post-date">
            <p>Date Posted: March 14, 2024</p>
          </div>
          <div class="carousel-container" style="border-radius:10px;">
            <div id="carouselExampleFade" class="carousel slide carousel-fade">
              <div class="carousel-inner">
                <div class="carousel-item active">
                  <img src="<?= base_url() . 'toyota-supra-mk4.png' ?>" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                  <img src="<?= base_url() . 'WALTAR.png' ?>" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                  <img src="<?= base_url() . 'toyota-supra-mk4.png' ?>" class="d-block w-100" alt="...">
                </div>
              </div>
              <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
              </button>
              <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
              </button>
            </div>
          </div>
          <div class="post-content">
            <h2 class="card-title text-center">Product Title</h2>
            <p><strong>Product Details / Specs:</strong></p>
            <ul>
              <li>Lorem ipsum dolor, sit amet consectetur adipisicing elit.</li>
              <li>Lorem, ipsum dolor sit amet consectetur adipisicing elit.</li>
              <li>Lorem ipsum dolor sit amet consectetur adipisicing elit.</li>
              <!-- Add more details as needed -->
            </ul>
            <p><strong>Contact:</strong></p>
            <p>Contact Number: XXX-XXX-XXXX</p>
            <p>Email: example@example.com</p>
          </div>
          <div class="comment-section">
            <h3>Comments</h3>
            <div class="comment">
              <div class="profile">
                <img src="<?= base_url() . 'phoenix.png' ?>" class="profile-img" alt="Profile Image">
                <p class="profile-name">Commenter Name</p>
              </div>
              <p class="comment-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Laborum, modi.</p>
            </div>
            <!-- Add more comments as needed -->
            <div class="comment">
              <div class="profile">
                <img src="<?= base_url() . 'WALTAR.png' ?>" class="profile-img" alt="Profile Image">
                <p class="profile-name">Another Commenter</p>
              </div>
              <p class="comment-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Tempora, quaerat.</p>
            </div>
            <!-- Comment Form -->
            <form class="comment-form">
              <textarea class="form-control mb-3" placeholder="Write a comment..." rows="3"></textarea>
              <button type="submit" class="btn btn-primary">Post Comment</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Custom JavaScript to fix carousel behavior -->
  <script>
    document.addEventListener("DOMContentLoaded", function() {
      var carousel = document.querySelector('.carousel');
      var carouselInstance = new bootstrap.Carousel(carousel, {
        interval: false // Disable automatic cycling
      });
    });
  </script>

  <!-- Include Bootstrap JS -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>

  <?= $this->endSection() ?>
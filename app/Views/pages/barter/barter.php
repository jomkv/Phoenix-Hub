<?= $this->extend("layouts/default") ?>

<?= $this->section("title") ?>Barter Item<?= $this->endSection() ?>

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
  .card {
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
  }
  /* Media query for smaller screens */
  @media (max-width: 768px) {
    .profile-container .profile-name {
      font-size: 0.7rem;
    }
    .profile-container .text-muted {
      font-size: 0.6rem;
    }
    .card {
      max-height: 450px;
    }
    .back-button {
      top: 50px; /* Adjust the top position for smaller screens */
      left: 10px; /* Adjust the left position for smaller screens */
    }
  }
  /* Back button style */
  .back-button {
    position: fixed;
    top: 100px;
    left: 10px;
    z-index: 100;
    width: 50px;
    height: 50px;
    background-color: #7433FA;
    color: white;
    border: none;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 24px;
    text-decoration: none;
  }
  /* Divider style */
  .comment-divider {
    border: 0;
    height: 1px;
    background-color: #ddd;
    margin: 1rem 0;
  }
  /* Scrollable comments */
  .comments-container {
    max-height: 300px; /* Adjust the height as needed */
    overflow-y: auto;
  }
  /* Contact info style */
  .contact-info {
    margin-top: 10px;
    background-color: #f8f9fa;
    padding: 10px;
    border-radius: 5px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
  }
  .contact-info h6 {
    margin: 0;
    font-weight: bold;
  }
  .contact-info p {
    margin: 0;
  }
</style>
<div class="container mb-3" style="margin-top:380px;">
  <!-- Back button float -->
  <a href="<?= url_to("TestViewsController::viewBarter") ?>" class="back-button"><i class="bi bi-arrow-left"></i></a>
  <div class="card text-start" style="margin-top: 10px;">
    <div class="image-container mx-auto d-block">
      <img src="<?= base_url() . 'WALTAR.png'?>" class="img-fluid" style="max-width: auto; height: 100%;" alt="...">
    </div>
    <div class="card-header">
      <div class="profile-container">
        <div>
          <img src="<?= base_url() . 'WALTAR.png'?>" alt="Profile Picture" style="border: 3px solid #7532FA;">
          <a class="profile-name">Rhondel Divinasflores</a>
          <small class="text-muted" style="margin-left: 10px;"><?= date('F j, Y') ?></small>
        </div>
      </div>
      <div class="product-title">
        <h5>School Uniform</h5>
      </div>
      <div class="description">
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin sagittis, nisi vitae sollicitudin lobortis.</p>
      </div>
      <div class="contact-info">
        <h6>Contact Information</h6>
        <p>Email: rhondel@example.com</p>
        <p>Phone: (123) 456-7890</p>
      </div>
    </div>
  </div>

  <!-- Comments Section -->
  <div class="card mt-3">
    <div class="card-header">
      <h5>Comments</h5>
    </div>
    <div class="card-body comments-container">
      <!-- Individual comment -->
      <div class="media mb-3">
        <img src="<?= base_url() . 'WALTAR.png'?>" class="mr-3 rounded-circle" alt="User Profile Picture" style="width: 40px; height: 40px; object-fit: cover; border: 3px solid #7532FA;">
        <div class="media-body">
          <a class="mt-0 fw-bold" style="color: black;">John Doe</a>
          <p>Great post! I really enjoyed reading it.</p>
        </div>
      </div>
      <hr class="comment-divider">
      <!-- Add more comments here -->
      <div class="media mb-3">
        <img src="<?= base_url() . 'WALTAR.png'?>" class="mr-3 rounded-circle" alt="User Profile Picture" style="width: 40px; height: 40px; object-fit: cover; border: 3px solid #7532FA;">
        <div class="media-body">
          <a class="mt-0 fw-bold" style="color: black;">John Doe</a>
          <p>Great post! I really enjoyed reading it.</p>
        </div>
      </div>
      <hr class="comment-divider">
      <div class="media mb-3">
        <img src="<?= base_url() . 'WALTAR.png'?>" class="mr-3 rounded-circle" alt="User Profile Picture" style="width: 40px; height: 40px; object-fit: cover; border: 3px solid #7532FA;">
        <div class="media-body">
          <a class="mt-0 fw-bold" style="color: black;">John Doe</a>
          <p>Great post! I really enjoyed reading it.</p>
        </div>
      </div>
    </div>
    <!-- Comment input field -->
    <div class="card-footer">
      <form>
        <div class="form-group">
          <textarea class="form-control" id="comment" rows="2" placeholder="Write a comment..."></textarea>
        </div>
        <button type="submit" class="btn" style="background-color:#7433FA; color: white;">Submit</button>
      </form>
    </div>
  </div>
</div>
<?= $this->endSection() ?>

<?= $this->extend("layouts/default") ?>

<?= $this->section("title") ?>Barter Item<?= $this->endSection() ?>

<?= $this->section("content") ?>
<style>
  /* Custom CSS for minimalist design */
  body {
    font-family: 'Noto Sans', 'Helvetica Neue', Helvetica, Arial, sans-serif;
    /* Fallback fonts: Helvetica, Arial, sans-serif */
    background-color: #f0f2f5; /* Light gray background */
    padding-top: 70px; /* Ensure content is below the fixed navbar */
    margin-bottom: 50px; /* Ensure bottom space for footer or other elements */
  }

  .post-card {
    margin-top: 20px;
    margin-bottom: 20px; /* Add margin below the post card */
    border-radius: 10px;
    background-color: #ffffff;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    overflow: hidden;
  }

  .post-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 15px;
    border-bottom: 1px solid #ddd;
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

  .post-body {
    padding: 15px;
  }

  .post-img {
    text-align: center;
    margin-bottom: 15px;
  }

  .post-img img {
    max-width: 100%;
    border-radius: 8px;
  }

  .post-content {
    margin-bottom: 20px;
  }

  .comment-section {
    background-color: #f9f9f9;
    padding: 15px;
    border-radius: 8px;
    margin-top: 15px;
    margin-bottom: 20px; /* Add margin below the comment section */
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

  @media (max-width: 767px) {
    body {
      padding-top: 130px; /* Adjust padding for smaller screens */
    }
  }
</style>

<div class="container" style="margin-top:550px;">
  <!-- Back button float -->
  <a href="javascript:history.back()" class="back-button"><i class="bi bi-arrow-left"></i></a>
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card post-card">
        <div class="post-header">
          <div class="profile">
            <img src="<?= base_url() . 'toyota-supra-mk4.png' ?>" alt="Profile Image">
            <p class="profile-name">Seller's Name</p>
          </div>
          <div>
            <p>Date Posted: March 14, 2024</p>
          </div>
        </div>
        <div class="post-body">
          <div class="post-img">
            <img src="<?= base_url() . 'toyota-supra-mk4.png' ?>" class="img-fluid mb-3" alt="Post Image">
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
        </div>
        <div class="comment-section">
          <h3>Comments</h3>
          <div class="comment">
            <div class="profile">
              <img src="<?= base_url() . 'profile.jpg' ?>" class="profile-img" alt="Profile Image">
              <p class="profile-name">Commenter Name</p>
            </div>
            <p class="comment-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Laborum, modi.</p>
          </div>
          <!-- Add more comments as needed -->
          <div class="comment">
            <div class="profile">
              <img src="<?= base_url() . 'profile.jpg' ?>" class="profile-img" alt="Profile Image">
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

<!-- Include Bootstrap JS -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<?= $this->endSection() ?>

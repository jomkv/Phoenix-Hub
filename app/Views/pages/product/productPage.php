<?= $this->extend("layouts/default") ?>

<?= $this->section("title") ?>Product Menu <?= $this->endSection() ?>

<?= $this->section("content") ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Product Detail Page</title>
  <!-- Include Bootstrap CSS -->
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <style>
    /* Custom CSS for minimalist design */
    body {
      background-color: #f8f9fa;
      font-family: 'Noto Sans','Helvetica Neue', Helvetica, Arial, sans-serif;
    }
    .product-card {
      margin-top: 50px;
      border-radius: 10px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      overflow: hidden;
      max-width: 900px; /* Increase the max-width for a larger card */
      margin: auto; /* Center the card horizontally */
    }
    .product-img {
      text-align: center;
      position: relative;
    }
    .product-img img {
      width: 100%;
      height: auto;
      object-fit: cover;
      object-position: center;
    }
    .small-images {
      display: flex;
      justify-content: center;
      gap: 50px; /* Add some space between images */
    }
    .small-images img {
      width: 20%; /* Set width to 20% of the container */
      max-width: 100px; /* Limit max-width for smaller screens */
      height: auto;
      object-fit: cover;
      border: 1px solid #ddd; /* Optional: Add a border to the images */
      cursor: pointer; /* Change cursor to pointer */
    }
    .product-details {
      display: flex;
      flex-direction: column;
      justify-content: center;
      padding: 20px;
    }
    .product-details p {
      margin-bottom: 10px;
    }
    .back-button {
      position: fixed;
      top: 105px;
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
    .large-image-popup {
      display: none; /* Hidden by default */
      position: fixed;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      z-index: 1050;
      padding: 10px; /* Smaller padding */
      border-radius: 5px; /* Smaller border radius */
    }
    .large-image-popup img {
      max-width: 300px; /* Smaller max-width */
      max-height: 300px; /* Smaller max-height */
      object-fit: cover;
    }
    @media (max-width: 767px) {
      .back-button {
        width: 40px;
        height: 40px;
        font-size: 20px;
      }
      .product-card .card-body {
        flex-direction: column;
      }
      .small-images img {
        width: 30%; /* Adjust width for smaller screens */
      }
    }
  </style>
</head>
<body>
  <div class="container-fluid">
    <!-- Back button float -->
    <a href="javascript:history.back()" class="back-button"><i class="bi bi-arrow-left"></i></a>
    <div class="card product-card">
      <div class="card-body d-flex">
        <div class="col-md-6">
          <div class="product-img">
            <img src="<?= base_url() . 'toyota-supra-mk4.png' ?>" class="img-fluid mb-3" alt="Product Image">
          </div>
          <!-- Small images under the main image -->
          <div class="small-images">
            <img src="<?= base_url() . 'phoenix.png' ?>" alt="Small Image 1" onmouseover="showLargeImage(this)" onmouseout="hideLargeImage()">
            <img src="<?= base_url() . 'CVSU_LOGO.png' ?>" alt="Small Image 2" onmouseover="showLargeImage(this)" onmouseout="hideLargeImage()">
            <img src="<?= base_url() . 'CvSU Home page.jpg' ?>" alt="Small Image 3" onmouseover="showLargeImage(this)" onmouseout="hideLargeImage()">
          </div>
        </div>
        <div class="col-md-6 product-details">
          <h1 class="card-title text-center">Product Title</h1>
          <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ipsum, dolor Lorem ipsum dolor sit amet consectetur adipisicing elit. Natus facilis distinctio beatae deserunt consectetur? Nobis soluta quod id magni delectus corporis nulla molestias, ipsum expedita repellat modi dolorum porro quo!</p>
          <div class="d-flex justify-content-between mt-3">
            <button class="btn btn-primary btn-lg">Button 1</button>
            <button class="btn btn-secondary btn-lg">Button 2</button>
            <button class="btn btn-success btn-lg">Button 3</button>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Large Image Popup -->
  <div class="large-image-popup" id="largeImagePopup">
    <img id="largeImage" src="" alt="Large Image">
  </div>

  <!-- Include Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

  <script>
    function showLargeImage(img) {
      var popup = document.getElementById('largeImagePopup');
      var largeImage = document.getElementById('largeImage');
      largeImage.src = img.src;
      popup.style.display = 'block';
    }

    function hideLargeImage() {
      var popup = document.getElementById('largeImagePopup');
      popup.style.display = 'none';
    }
  </script>
</body>
</html>

<?= $this->endSection() ?>
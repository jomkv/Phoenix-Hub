<?= $this->extend("layouts/default") ?>

<?= $this->section("title") ?>Barter Item<?= $this->endSection() ?>

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
      /* Fallback fonts: Helvetica, Arial, sans-serif */
    }
    .product-card {
      margin-top: 50px;
      border-radius: 10px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      overflow: hidden; /* Ensure content doesn't overflow */
    }
    .product-img {
      text-align: center;
      position: relative;
      border-radius: 15px;
      padding-top: 56.25%; /* 16:9 Aspect Ratio */
      margin-bottom: 20px; /* Add space below the image */
    }
    .product-img img {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      object-fit: cover;
      object-position: center;
    }
    .product-card .card-body {
      display: flex;
      flex-direction: row;
      align-items: center;
    }
    .product-details {
      display: flex;
      flex-direction: column;
      justify-content: center;
      /* Set a max-width for the product details */
      max-width: 400px; /* Adjust this value as needed */
    }
    .product-details p {
      margin-bottom: 10px; /* Add space below paragraphs */
    }
    .product-details ul {
      padding-left: 20px; /* Indent the bullet points */
    }
    .product-details li {
      margin-bottom: 5px; /* Add space between list items */
    }
    @media (max-width: 767px) {
      .product-card .card-body {
        flex-direction: column;
      }
      .product-img {
        padding-top: 80%; /* 4:3 Aspect Ratio for smaller screens */
      }
    }
  </style>
</head>
<body>

  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card product-card">
          <div class="card-body">
            <div class="col-md-6 product-img">
              <img src="<?= base_url() . 'toyota-supra-mk4.png' ?>" class="img-fluid mb-3" alt="Product Image">
            </div>
            <div class="col-md-6 product-details">
              <h1 class="card-title text-center">Product Title</h1>
              <p><strong>Product Details / Specs:</strong></p>
              <ul>
                <li>Lorem ipsum dolor, sit amet consectetur adipisicing elit. </li>
                <li>Lorem, ipsum dolor sit amet consectetur adipisicing elit. </li>
                <li>Lorem ipsum dolor sit amet consectetur adipisicing elit.</li>
                <!-- Add more details as needed -->
              </ul>
              <p><strong>Contact:</strong></p>
              <p>Contact Number: XXX-XXX-XXXX</p>
              <p>Email: example@example.com</p>
              <button class="btn btn-primary btn-block">Contact Seller</button>
            </div>
          </div>
        </div>
      </div>
    </div>
    
  </div>

  <!-- Include Bootstrap JS -->
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

<?= $this->endSection() ?>
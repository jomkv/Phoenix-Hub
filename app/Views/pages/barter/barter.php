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
    }
    .product-card {
      margin-top: 50px;
      border-radius: 10px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
    .product-img {
      text-align: center;
    }
  </style>
</head>
<body>

  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card product-card">
          <div class="card-body">
            <div class="row">
              <div class="col-md-6 product-img">
                <img src="<?= base_url() . 'CvSU Home page.jpg' ?>" class="img-fluid mb-3" alt="Product Image" style="width: 100%; height: 100%;">
              </div>
              <div class="col-md-6">
                <h1 class="card-title text-center">Product Title</h1>
                <p><strong>Product Details / Specs:</strong></p>
                <ul>
                  <li>Detail 1</li>
                  <li>Detail 2</li>
                  <li>Detail 3</li>
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
  </div>

  <!-- Include Bootstrap JS -->
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>


<?= $this->endSection() ?>
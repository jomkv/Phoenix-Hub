<?= $this->extend("layouts/default") ?>

<?= $this->section("title") ?>Product Menu <?= $this->endSection() ?>

<?= $this->section("content") ?>

<style>
/* Container styling */
.container {
  margin: 50px auto; /* Center the container horizontally */
  width: 100%;
  max-width: 1200px; /* Ensure the container has a fixed max width */
  padding: 0 15px;
}

/* Card styling */
.custom-card-size {
  width: 100%;
  background-color: #f8f9fa; /* Light gray background for a minimalist look */
  border: 1px solid #ddd;
  border-radius: 10px; /* Increased border radius for a smoother look */
  padding: 15px;
  position: relative; /* To enable positioning of buttons */
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Subtle shadow for depth */
}

/* Main image container styling */
.main-image-container {
  width: 100%;
  height: 300px; /* Fixed height for the main image container */
  overflow: hidden;
  border-radius: 10px; /* Rounded corners for the main image container */
  margin-bottom: 10px; /* Space between main image and small images */
}

/* Main image styling */
.main-image {
  width: 100%;
  height: 100%;
  object-fit: cover; /* Ensure the image covers the container without stretching */
}

/* Small images container styling */
.small-images-container {
  width: 100%;
  display: flex;
  justify-content: center;
  margin-top: 10px;
}

/* Small images styling */
.small-img {
  width: 80px; /* Fixed width for small images */
  height: 80px; /* Fixed height for small images */
  border: 1px solid #ddd;
  border-radius: 5px; /* Rounded corners for small images */
  margin: 0 5px;
  transition: transform 0.3s ease-in-out;
}

.small-img:hover {
  transform: scale(1.1); /* Scale up on hover */
}

/* Button group styling */
.btn-group {
  display: flex;
}

.btn {
  margin: 0 5px;
}

/* Fancy button styling */
.fancy-button {
  background-color: #7532FA;
  color: white;
  border: none;
  padding: 10px 20px; /* Increased padding for better appearance */
  font-size: 1rem;
  border-radius: 5px; /* Rounded corners for buttons */
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
  transition: background-color 0.3s, box-shadow 0.3s;
}

.fancy-button:hover {
  background-color: #5a25c9; /* Darker shade on hover */
  box-shadow: 0 6px 12px rgba(0, 0, 0, 0.3);
}

/* Card body styling */
.card-body {
  padding: 1rem;
}

/* Back button styling */
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

/* Back button container styling */
.back-button-container {
  position: absolute;
  top: 20px;
  left: 20px;
}

/* Input group styling */
.input-group {
  display: flex;
  align-items: center;
  justify-content: flex-start; /* Align items to the left */
}

.input-group .btn {
  height: 38px;
}

.input-group .quantity-input {
  width: 70px;
  text-align: center;
}

/* Fixed bottom left button group styling */
.fixed-bottom-left {
  position: absolute;
  bottom: 15px;
  left: 15px;
}

/* Responsive styling */
@media (max-width: 1200px) {
  .custom-card-size {
    padding: 10px;
  }

  .main-image-container {
    height: 250px;
  }

  .small-img {
    width: 70px;
    height: 70px;
  }
}

@media (max-width: 992px) {
  .custom-card-size {
    padding: 10px;
  }

  .main-image-container {
    height: 200px;
  }

  .small-img {
    width: 60px;
    height: 60px;
  }
}

@media (max-width: 767px) {
  .row.no-gutters {
    flex-direction: column;
  }

  .small-images-container {
    flex-wrap: wrap;
    justify-content: center;
  }

  .small-img {
    width: 60px;
    height: 60px;
  }

  .btn-group-vertical .btn {
    width: 30%;
  }

  .back-button-container {
    position: relative;
    top: auto;
    left: auto;
  }

  .container {
    margin-top: 100px;
  }

  .custom-card-size {
    padding: 10px;
  }

  .main-image-container {
    height: 180px;
  }

  .small-img {
    width: 50px;
    height: 50px;
  }

  .fixed-bottom-left {
    position: static;
    display: flex;
    justify-content: center;
    margin-top: 10px;
  }

  .btn-group {
    flex-direction: column;
    width: 100%;
    margin-left: 15px;
  }

  .btn-group .btn {
    margin: 5px 0;
    width: 90%;
  }

  .me-2, .ms-2 {
    font-size: 12px;
  }
}
</style>

<div class="container">
  <!-- Back button float -->
  <div class="back-button-container">
    <a href="<?= base_url() . '#productsSection' ?>" class="back-button"><i class="bi bi-arrow-left"></i></a>
  </div>
  <div class="row justify-content-center">
    <div class="col-md-12">
      <div class="card custom-card-size">
        <div class="row no-gutters">
          <div class="col-md-4 d-flex flex-column align-items-center justify-content-center">
            <?php $images = json_decode($product->images) ?>
            <div class="main-image-container">
              <img src="<?= $images[0]->url ?>" class="img-fluid main-image mb-2" alt="Main Image">
            </div>
            <?php if (count($images) > 1) : ?>
              <div class="small-images-container">
                <?php for ($i = 1; $i < count($images); $i++) : ?>
                  <img src="<?= $images[$i]->url ?>" class="img-fluid small-img" alt="Small Image <?= $i + 1 ?>">
                <?php endfor; ?>
              </div>
            <?php endif; ?>
          </div>
          <div class="col-md-8 d-flex flex-column justify-content-center position-relative">
            <div class="card-body">
              <h1 class="card-title text-start">Product Title</h1>
              <p class="card-text text-start fs-3">Price:<span> ₱**.**</span></p>
              <p class="card-text text-start">Product Descriotion</p>
              <div class="input-group mb-3">
                <div class="input-group-prepend d-flex align-items-center">
                  <h5 class="me-2">Quantity:</h5>
                  <div class="item-quantity">
                    <input type="number" class="form-control quantity-input" value="1" min="1">
                  </div>
                  <span class="ms-2">available stocks</span>
                </div>
              </div>
            </div>
            <div class="btn-group fixed-bottom-left">
              <button class="btn fancy-button"><i class="bi bi-cart-plus"></i> Add to Cart</button>
              <button class="btn fancy-button"><i class="bi bi-cash-stack"></i> Check Out</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Include Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>

<script>
$(document).ready(function() {
  $('.small-img').hover(function() {
    var imgSrc = $(this).attr('src');
    $('.main-image').attr('src', imgSrc);
  }, function() {
    var originalImgSrc = '<?= json_decode($product->images)[0]->url ?>';
    $('.main-image').attr('src', originalImgSrc);
  });
});

$(document).ready(function() {
  $('#plusBtn').click(function() {
    var quantity = parseInt($('#quantityInput').val());
    $('#quantityInput').val(quantity + 1);
  });

  $('#minusBtn').click(function() {
    var quantity = parseInt($('#quantityInput').val());
    if (quantity > 1) {
      $('#quantityInput').val(quantity - 1);
    }
  });
});
</script>

<?= $this->endSection() ?>

<?= $this->extend("layouts/default") ?>

<?= $this->section("title") ?>Product Menu <?= $this->endSection() ?>

<?= $this->section("content") ?>

<style>
 .container {
  margin-top: 50px;
  width: 100%;
  max-width: 1800px;
  padding: 0 15px;
}

.custom-card-size {
  width: 100%;
  background-color: #fff;
  border: 1px solid #ddd;
  border-radius: 5px;
  padding: 15px;
  position: relative; /* To enable positioning of buttons */
}

.main-image-container {
  height: 300px;
  overflow: hidden;
}

.main-image {
  width: 100%;
  height: 100%;
  object-fit: cover;
}

.small-images-row {
  width: 100%;
  display: flex;
  justify-content: center;
}

.small-img {
  max-height: 80px;
  width: auto;
  border: 1px solid #ddd;
  transition: transform 0.3s ease-in-out;
}

.small-img:hover {
  transform: scale(1.1);
}

.btn-group {
  display: flex;
}

.btn {
  margin: 0 5px;
}

.fancy-button {
  background-color: #7532FA;
  color: white;
  border: none;
  padding: 8px 16px;
  font-size: 1rem;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
  transition: background-color 0.3s, box-shadow 0.3s;
}

.fancy-button:hover {
  background-color: #7532FA;
  box-shadow: 0 6px 12px rgba(0, 0, 0, 0.3);
}

.card-body {
  padding: 1rem;
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

.back-button-container {
  position: absolute;
  top: 20px;
  left: 20px;
}

.input-group {
  display: flex;
  align-items: center;
  justify-content: center;
}

.input-group .btn {
  height: 38px;
}

.input-group .quantity-input {
  width: 70px;
  text-align: center;
}

.fixed-bottom-right {
  position: absolute;
  bottom: 15px;
  right: 15px;
}

.btn-group .btn {
  width: auto;
  padding: 0.375rem 0.75rem;
}

@media (max-width: 1200px) {
  .custom-card-size {
    padding: 10px;
  }

  .main-image-container {
    height: 250px;
  }

  .small-img {
    max-height: 70px;
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
    max-height: 60px;
  }
}

@media (max-width: 767px) {
  .row.no-gutters {
    flex-direction: column;
  }

  .small-images-row {
    flex-direction: row;
    flex-wrap: wrap;
    justify-content: center;
  }

  .small-img {
    max-height: 60px;
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
    max-height: 50px;
  }

  .fixed-bottom-right {
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
  .me-2, .ms-2{
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
            <?php ?>
            <?php if (count($images) > 1) : ?>
              <div class="row">
                <?php for ($i = 1; $i < count($images); $i++) : ?>
                  <div class="col-auto p-1">
                    <img src="<?= $images[$i]->url ?>" class="img-fluid small-img" alt="Small Image 1">
                  </div>
                <?php endfor; ?>
              </div>
            <?php endif; ?>
          </div>
          <div class="col-md-8 d-flex flex-column justify-content-center position-relative">
            <div class="card-body">
              <h1 class="card-title text-start">Product Title</h1>
              <p class="card-text text-start fs-3">20 PESOS</p>
              <p class="card-text text-start">Lorem ipsum dolor sit amet consectetur adipisicing elit. Impedit dolorum consectetur pariatur? Animi quis eligendi harum, quae maxime impedit provident? Maiores repudiandae perferendis fugit dolor impedit soluta iure odit possimus!</p>
              <div class="input-group mb-3 justify-content-center">
                <div class="input-group-prepend d-flex align-items-center">
                  <h5 class="me-2">Quantity:</h5>
                  <button class="btn btn-outline-secondary" type="button" id="minusBtn">-</button>
                  <input type="text" class="form-control quantity-input mx-2" placeholder="Quantity" aria-label="Quantity" aria-describedby="basic-addon1" id="quantityInput" value="1" readonly>
                  <button class="btn btn-outline-secondary" type="button" id="plusBtn">+</button>
                  <span class="ms-2">available stocks</span>
                </div>
              </div>
            </div>
            <div class="btn-group fixed-bottom-right">
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
<?= $this->extend("layouts/default") ?>

<?= $this->section("title") ?>Product Menu <?= $this->endSection() ?>

<?= $this->section("content") ?>
<style>
 .custom-card-size {
  width: 100%;
  max-width: 1200px;
  background-color: #fff;
  border: 1px solid #ddd;
  border-radius: 5px;
  box-sizing: border-box;
  overflow: hidden;
  padding:15px;
}

.main-image-container {
  height: 300px; /* Set a fixed height for the main image container */
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
  max-height: 80px; /* Set a max height for the small images */
  width: auto;
  border: 1px solid #ddd;
}

.btn-group {
  display: flex;
  justify-content: center;
}

.btn {
  margin: 0 5px;
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
  top: 20px; /* Adjust as needed */
  left: 20px; /* Adjust as needed */
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
    width: 100%;
    margin: 5px;
  }
  .btn-group-vertical .btn {
    width: 100%;
  }
  .back-button-container {
    position: relative;
    top: auto;
    left: auto;
    margin-bottom: 20px;
  }
}

</style>
<!-- Back button float -->
<div class="back-button-container">
  <a href="javascript:history.back()" class="back-button"><i class="bi bi-arrow-left"></i></a>
</div>
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-10">
      <div class="card custom-card-size">
        <div class="row no-gutters">
          <div class="col-md-4 d-flex flex-column align-items-center justify-content-center">
            <div class="main-image-container">
              <img src="<?= base_url() . 'toyota-supra-mk4.png' ?>" class="img-fluid main-image mb-2" alt="Main Image">
            </div>
            <div class="row small-images-row">
              <div class="col-4 p-1">
                <img src="<?= base_url() . 'WALTAR.png' ?>" class="img-fluid small-img" alt="Small Image 1">
              </div>
              <div class="col-4 p-1">
                <img src="<?= base_url() . 'WALTAR.png' ?>" class="img-fluid small-img" alt="Small Image 2">
              </div>
              <div class="col-4 p-1">
                <img src="<?= base_url() . 'WALTAR.png' ?>" class="img-fluid small-img" alt="Small Image 3">
              </div>
            </div>
          </div>
          <div class="col-md-8 d-flex flex-column justify-content-center">
  <div class="card-body">
    <h1 class="card-title text-center">Product Title</h1>
    <p class="card-text text-center fs-3">20 PESOS</p>
    <p class="card-text">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Assumenda consectetur modi ea consequuntur dolores similique tempore numquam minus, aspernatur fugit, laboriosam pariatur nulla. Quas deserunt, nesciunt neque vero placeat ullam?.</p>
    <div class="input-group mb-3 align-items-center">
      <div class="input-group-prepend">
        <button class="btn btn-outline-secondary" type="button" id="minusBtn">-</button>
      </div>
      <input type="text" class="form-control" placeholder="Quantity" aria-label="Quantity" aria-describedby="basic-addon1" id="quantityInput" value="1" readonly>
      <div class="input-group-append">
        <button class="btn btn-outline-secondary" type="button" id="plusBtn">+</button>
      </div>
    </div>
    <div class="btn-group">
      <button class="btn btn-primary">Add to Cart</button>
      <button class="btn btn-primary">Check Out</button>
    </div>
  </div>
</div>

        </div>
      </div>
    </div>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
$(document).ready(function() {
  $('.small-img').hover(function() {
    // Get the source of the hovered small image
    var imgSrc = $(this).attr('src');
    // Set the main image source to the hovered small image source
    $('.main-image').attr('src', imgSrc);
  }, function() {
    // Restore the main image to its original source when not hovered
    var originalImgSrc = '<?= base_url() . 'toyota-supra-mk4.png' ?>'; // Change to the original image source
    $('.main-image').attr('src', originalImgSrc);
  });
});
$(document).ready(function() {
    // Increase quantity
    $('#plusBtn').click(function() {
      var quantity = parseInt($('#quantityInput').val());
      $('#quantityInput').val(quantity + 1);
    });

    // Decrease quantity
    $('#minusBtn').click(function() {
      var quantity = parseInt($('#quantityInput').val());
      if (quantity > 1) {
        $('#quantityInput').val(quantity - 1);
      }
    });
  });
</script>
<?= $this->endSection() ?>
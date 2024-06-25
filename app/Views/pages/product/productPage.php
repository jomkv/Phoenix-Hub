<?= $this->extend("layouts/default2") ?>

<?= $this->section("title") ?>Product Menu <?= $this->endSection() ?>

<?= $this->section("content") ?>

<style>
  /* Container styling */
  .container {
    margin: 50px auto;
    /* Center the container horizontally */
    width: 100%;
    max-width: 1200px;
    /* Ensure the container has a fixed max width */
    padding: 0 15px;
  }

  /* Card styling */
  .custom-card-size {
    width: 100%;
    background-color: #f8f9fa;
    /* Light gray background for a minimalist look */
    border: 1px solid #ddd;
    border-radius: 10px;
    /* Increased border radius for a smoother look */
    padding: 15px;
    padding-bottom: 0px;
    position: relative;
    /* To enable positioning of buttons */
  }

  /* Main image container styling */
  .main-image-container {
    width: 100%;
    height: 300px;
    /* Fixed height for the main image container */
    overflow: hidden;
    border-radius: 10px;
    /* Rounded corners for the main image container */
    margin-bottom: 10px;
    /* Space between main image and small images */
  }

  /* Main image styling */
  .main-image {
    width: 100%;
    height: 100%;
    object-fit: contain;
    /* Ensure the image covers the container without stretching */
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
    width: 80px;
    /* Fixed width for small images */
    height: 80px;
    /* Fixed height for small images */
    border: 1px solid #ddd;
    border-radius: 5px;
    /* Rounded corners for small images */
    margin: 0 5px;
    transition: transform 0.3s ease-in-out;
  }

  .small-img:hover {
    transform: scale(1.1);
    /* Scale up on hover */
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
    padding: 10px 20px;
    /* Increased padding for better appearance */
    font-size: 1rem;
    border-radius: 5px;
    /* Rounded corners for buttons */
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    transition: background-color 0.3s, box-shadow 0.3s;
  }

  .fancy-button:hover {
    background-color: #5a25c9;
    /* Darker shade on hover */
    box-shadow: 0 6px 12px rgba(0, 0, 0, 0.3);
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
    justify-content: flex-start;
    /* Align items to the left */
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

  #margin-top-moto {
    margin-top: 100px;
  }

  #card-custom-class {
    min-height: 500px;
  }

  /* Responsive styling */
  @media (max-width: 1200px) {
    .custom-card-size {
      padding: 10px;
      padding-bottom: 0px;
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
    #margin-top-moto {
      margin-top: 0px;
    }

    #organization-description {
      display: none;
    }

    #card-custom-class {
      min-height: 0px;
    }

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

    .me-2,
    .ms-2 {
      font-size: 12px;
    }

  }
</style>

<div class="container">
  <!-- Back button float -->
  <div class="back-button-container">
    <a href="<?= base_url() . '#productsSection' ?>" class="back-button"><i class="bi bi-arrow-left"></i></a>
  </div>

  <!-- Product Cards -->
  <div class="row justify-content-center gy-5">
    <div class="col-md-12">
      <div class="card custom-card-size shadow-lg" style="background-color: #FAF9F6;" id="margin-top-moto">
        <div class="row no-gutters pt-2">
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
            <div class="card-body" id="card-custom-class" style="padding-top: 0px; padding-bottom: 0px;">
              <div class="row pl-2 h-100">
                <div class="col-12">
                  <h1 class="card-text mb-0 pb-0"><?= esc($product->product_name) ?></h1>
                  <p style="color: #ee4d42;" class="card-text fs-3" id="prod-price">₱<?= esc($product->has_variations === "0" ? $product->price : $variants[0]->price) ?></p>
                </div>
                <div class="col-12 mb-2">
                  <p class="card-text text-start"><?= esc($product->description) ?></p>
                </div>
                <div class="col-12"></div>
                <div class="col-12 pb-3">
                  <?= form_open("/cart/add", ["name" => "product_page_form"]) ?>
                  <div class="row">
                    <input type="hidden" name="product_id" value="<?= $product->product_id ?>">
                    <input type="hidden" name="has_variants" value="<?= $product->has_variations ?>">
                    <!-- VARIATIONS (IF ANY) -->
                    <?php if ($product->has_variations === "1") : ?>
                      <div class="col-12">
                        <div class="input-group-prepend d-flex align-items-center mb-2">
                          <h5 class="me-2 mb-0"><?= esc($product->variation_name) ?>:</h5>

                          <?php $varCount = 1;
                          foreach ($variants as $variant) : ?>
                            <input name="variantId" value="<?= $variant->variation_id ?>" type="radio" <?= $varCount === 1 ? "checked" : "" ?> class="btn-check" name="options-base" id="variant_<?= $variant->variation_id ?>" autocomplete="off" style="border-color: #7532fa;">
                            <label class="btn" for="variant_<?= $variant->variation_id ?>"><?= esc($variant->option_name) ?></label>
                          <?php $varCount++;
                          endforeach; ?>
                        </div>
                      </div>
                    <?php endif; ?>

                    <!-- QUANTITY -->
                    <div class="col-12">
                      <div class="input-group-prepend d-flex align-items-center">
                        <h5 class="me-2 mb-0">Quantity:</h5>
                        <div class="item-quantity pl-2">
                          <input name="quantity" id="prod-quantity" type="number" class="form-control quantity-input" value="1" min="1" max="<?= $product->has_variations === "0" ? $product->stock : $variants[0]->stock ?>" style="width: 120px;">
                        </div>
                        <p class="card-text ml-1" id="prod-stocks"><?= esc($product->has_variations === "0" ? $product->stock : $variants[0]->stock) ?> available stock(s)</p>
                      </div>
                    </div>

                    <!-- ADD TO CART -->
                    <div class="col-12 col-md-6 mt-2 mb-0 pr-0 pr-md-1 pb-0 pl-0">
                      <button type="submit" class="btn fancy-button w-100 fs-6 fw-bold" id="add-to-cart-btn"><i class="bi bi-cart-plus-fill mr-2"></i>Add to Cart</button>
                    </div>

                    <!-- CHECKOUT -->
                    <div class="col-12 col-md-6 mt-2 mb-0 pl-0 pl-md-1 pb-0 pr-0">
                      <a href="#" class="btn fancy-button w-100 fs-6 fw-bold"><i class="bi bi-bag-fill mr-2"></i>Buy Now</a>
                    </div>
                  </div>
                  <?= form_close() ?>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-12 pl-5 pr-5 pt-4 pb-3 shadow-lg mb-5" style="background-color: #FAF9F6;">
      <div class="row">
        <div class="col-md-1 col-sm-2 d-flex">
          <div class="align-self-center">
            <img class="img-thumbnail mx-auto d-block rounded-circle p-0" src="<?= json_decode($organization->logo)->url ?>" style="width: 100%; height: 100%; object-fit: contain;">
          </div>
        </div>
        <div class="col-md-4 col-sm-8 d-flex">
          <div class="align-self-center">
            <h1 class="w-100"><?= esc($organization->name) ?></h1>
            <h6 class="w-100"><?= esc($organization->full_name) ?></h6>
          </div>
        </div>
        <div class="col-7 col-sm-0" id="organization-description">
          <div class="align-self-center border-start border-black">
            <p class="ml-4"><?= esc($organization->description) ?></p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Include Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<!-- Include Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>

<script>
  let quantityCount = 1;
  let variants = null;

  // * Map each variant's properties to a javascript array
  <?php if ($product->has_variations === "1") : ?>
    variants = new Map();
    <?php foreach ($variants as $var) : ?>
      variants.set(
        "<?= $var->variation_id ?>", {
          price: "<?= $var->price ?>",
          stock: "<?= $var->stock ?>",
        }
      )
    <?php endforeach; ?>
    console.log(variants)
  <?php endif; ?>

  if (variants) {
    var rad = document.product_page_form.variantId;
    var prev = null;
    for (var i = 0; i < rad.length; i++) {
      rad[i].addEventListener('change', function() {
        // (prev) ? console.log("PREV: " + prev.value): null;
        if (this !== prev) {
          prev = this;

          document.getElementById("prod-quantity").value = 1;
          document.getElementById("prod-quantity").setAttribute("max", variants.get(this.value).stock);
          document.getElementById("prod-stocks").innerText = `${variants.get(this.value).stock} available stock(s)`;
          document.getElementById("prod-price").innerText = `₱${variants.get(this.value).price}`;
        }
      });
    }
  }




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
      if (quantityCount < <?= $product->stock ?? $variants[0]->stock ?>) {
        quantityCount += 1;
        $('#quantityInput').val(quantityCount);
      }
    });

    $('#minusBtn').click(function() {
      if (quantityCount > 1) {
        quantityCount -= 1
        $('#quantityInput').val(quantityCount);
      }
    });
  });
</script>
<?= $this->endSection() ?>
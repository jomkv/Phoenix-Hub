<style>
  .dropdown {
    position: absolute;
    right: 100px;
    top: 30px;
    margin-top: 90px;
  }

  .card-prod {
    height: 300px;
    /* Set a fixed height for all cards */
    position: relative;
    overflow: hidden;
    opacity: 0;
    /* Start hidden */
    transform: translateY(100px);
    /* Start slightly below */
    transition: opacity 0.5s ease, transform 0.5s ease;
    /* Smooth transition */
    border-style: none;
    transition: transform 0.3s;
  }

  .card-img-prod {
    height: 100%;
    object-fit: cover;
    /* Ensure the image covers the entire card */
  }

  .card-img-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.6);
    /* Dark overlay */
    color: white;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    opacity: 0;
    transition: opacity 0.3s ease;
  }

  .card-prod:hover .card-img-overlay {
    opacity: 1;
  }

  .card-prod.show {
    opacity: 1;
    /* Show card */
    transform: translateY(0);
    /* Slide up */
  }

  .badge {
    position: absolute;
    top: 10px;
    right: 0;
    /* Position the badge in the upper right corner */
    font-size: 1rem;
    z-index: 10;
    /* Ensure the badge is on top of other elements */
  }

  .product-info {
    position: absolute;
    bottom: 10px;
    left: 1px;
    /* Position the product name and stock info in the bottom left corner */
    font-size: 1rem;
    z-index: 10;
    /* Ensure the text is on top of other elements */
    color: white;
    background-color: rgba(0, 0, 0, 0.6);
    /* Add a background to improve readability */
    padding: 5px;
    border-radius: 5px;
  }

  .stock-info {
    position: absolute;
    bottom: 10px;
    right: 1px;
    /* Position the stock info in the bottom right corner */
    font-size: 1rem;
    z-index: 10;
    /* Ensure the text is on top of other elements */
    color: white;
    background-color: rgba(0, 0, 0, 0.6);
    /* Add a background to improve readability */
    padding: 5px;
    border-radius: 5px;
  }

  .card-prod:hover {
    transform: translateY(-10px);
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
  }
</style>
<div class="row pb-5 gy-5 mt-0" id="productsSection">
  <div class="col-12 d-flex justify-content-end">
    <select class="form-select form-select-lg w-25" aria-label="Large select example">
      <option><a class="dropdown-item" href="#">None</a></option>
      <?php foreach ($organizations as $organization) : ?>
        <option><a class="dropdown-item" href="#"><?= $organization->name ?></a></option>
      <?php endforeach; ?>
    </select>
  </div>
  <?php foreach ($products as $product) : ?>
    <a href="<?= url_to("ProductController::viewProduct", $product->product_id) ?>" class="col-md-3">
      <div class="card text-bg-dark card-prod">
        <img src="<?= json_decode($product->images)[0]->url ?>" class="card-img card-img-prod" alt="...">
        <div class="badge text-bg-primary">₱ <?= $product->price ?></div>
        <div class="product-info">
          <?= $product->product_name ?>
        </div>
        <div class="stock-info">
          Stock: <?= $product->stock ?>
        </div>
        <div class="card-img-overlay">
          <p class="card-text"><?= $product->description ?></p>
        </div>
      </div>
    </a>
  <?php endforeach ?>
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const cards = document.querySelectorAll('.card');
      cards.forEach((card, index) => {
        setTimeout(() => {
          card.classList.add('show');
        }, index * 200); // Stagger the animation for each card
      });
    });
  </script>
</div>
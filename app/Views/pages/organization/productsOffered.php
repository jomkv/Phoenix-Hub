<style>
  .dropdown {
    position: absolute;
    right: 100px;
    top: 30px;
    margin-top: 90px;
  }

  .card-prod {
    height: 300px;
    position: relative;
    overflow: hidden;
    opacity: 0;
    transform: translateY(100px);
    transition: opacity 0.5s ease, transform 0.5s ease;
    border-style: none;
    transition: transform 0.3s;
    width: 100%;
    max-width: 350px;
    margin-bottom: 20px; /* Add margin between cards */
    border-bottom: 10px solid #7532FA; /* Add border at the bottom */
  }

  .card-img-prod {
    height: 100%;
    object-fit: cover;
  }

  .card-img-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.6);
    color: white;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    opacity: 0;
    transition: opacity 0.3s ease;
    font-size: 17px;
  }

  .card-prod:hover .card-img-overlay {
    opacity: 1;
  }

  .card-prod.show {
    opacity: 1;
    transform: translateY(0);
  }

  .product-price, .product-info, .stock-info {
    white-space: normal;
    word-wrap: break-word;
    padding: 5px;
    z-index: 10;
    max-width: 200px;
    transition: opacity 0.3s ease;
  }

  .product-price {
    position: absolute;
    top: 20px;
    right: 0;
    width: 100%;
    max-width: 120px;
    background-color: #7532FA;
    font-size: 20px;
  }

  .product-info {
    position: absolute;
    bottom: 10px;
    left: 1px;
    font-size: 20px;
    z-index: 10;
    color: white;
    background-color: rgba(0, 0, 0, 0.6);
    padding: 5px;
    border-radius: 5px;
  }

  .stock-info {
    position: absolute;
    bottom: 10px;
    right: 1px;
    font-size: 1rem;
    z-index: 10;
    color: white;
    background-color: rgba(0, 0, 0, 0.6);
    padding: 5px;
    border-radius: 5px;
  }

  .card-prod:hover {
    transform: translateY(-10px);
    box-shadow: 0 10px 20px rgba(117, 50, 250, 0.4); /* Adjusted shadow color */
  }

  .card-prod:hover .product-price,
  .card-prod:hover .product-info,
  .card-prod:hover .stock-info {
    opacity: 0;
  }

  .sold-out-overlay {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%) rotate(-45deg);
    background-color: rgba(255, 0, 0, 0.7);
    color: white;
    font-size: 24px;
    font-weight: bold;
    padding: 10px 20px;
    z-index: 20;
    display: none;
    pointer-events: none;
  }

  .card-prod.sold-out .sold-out-overlay {
    display: block;
  }
</style>



<div class="row pt-4 gy-5 mb-5" id="productsSection">
  <div class="col-12 d-flex justify-content-end">
    <select class="form-select form-select-lg w-25" aria-label="Large select example">
      <option><a class="dropdown-item" href="#">None</a></option>
      <?php foreach ($organizations as $organization) : ?>
        <option><a class="dropdown-item" href="#"><?= esc($organization->name) ?></a></option>
      <?php endforeach; ?>
    </select>
  </div>
  <?php foreach ($productPayload as $payload) : ?>
    <?php 
      $isSoldOut = false;
      if ($payload["product"]->has_variations === "0") {
        $isSoldOut = $payload["product"]->stock <= 0;
      } else {
        $isSoldOut = true;
        foreach ($payload["variants"] as $variant) {
          if ($variant->stock > 0) {
            $isSoldOut = false;
            break;
          }
        }
      }
    ?>
    <div class="col-md-4"> <!-- Adjust column size here -->
      <?php if (!$isSoldOut): ?>
        <a href="<?= url_to("ProductController::viewProduct", $payload["product"]->product_id) ?>">
      <?php endif; ?>
        <div class="card text-bg-dark card-prod <?= $isSoldOut ? 'sold-out' : '' ?>">
          <img src="<?= json_decode($payload["product"]->images)[0]->url ?>" class="card-img card-img-prod" alt="...">
          <div class="badge product-price">₱
            <?php if ($payload["product"]->has_variations === "0") : ?>
              <?= $payload["product"]->price ?>
            <?php else : ?>
              <?= $payload["variants"][0]->price ?>
            <?php endif; ?>
          </div>
          <div class="product-info fw-meduim">
            <?= strtoupper(esc($payload["product"]->product_name)) ?>
          </div>
          <div class="stock-info">
            Stocks:
            <?php if ($payload["product"]->has_variations === "0") : ?>
              <?= $payload["product"]->stock ?>
            <?php else : ?>
              <?php 
                $totalStock = 0;
                foreach ($payload["variants"] as $variant) {
                  $totalStock += $variant->stock;
                }
                echo $totalStock;
              ?>
            <?php endif; ?>
          </div>
          <div class="card-img-overlay fw-normal">
            <p class="card-text"><?= esc($payload["product"]->description) ?></p>
          </div>
          <div class="sold-out-overlay">Sold Out</div>
        </div>
      <?php if (!$isSoldOut): ?>
        </a>
      <?php endif; ?>
    </div>
  <?php endforeach ?>
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const cards = document.querySelectorAll('.card');
      cards.forEach((card, index) => {
        setTimeout(() => {
          card.classList.add('show');
        }, index * 200);
      });
    });
  </script>
</div>

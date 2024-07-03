<style>
  @keyframes fadeInUp {
    from {
      opacity: 0;
      transform: translateY(20px);
    }
    to {
      opacity: 1;
      transform: translateY(0);
    }
  }

  .custom-card {
    transition: box-shadow 0.3s ease, transform 0.3s ease;
    animation: fadeInUp 0.5s ease;
    opacity: 0; /* Start invisible */
  }

  .custom-card:hover {
    box-shadow: 0 4px 8px rgba(117, 50, 250, 0.6);
    transform: translateY(-5px);
  }

  .custom-card img {
    box-shadow: 0 4px 8px rgba(117, 50, 250, 0.6);
    transition: box-shadow 0.3s ease;
    border-radius: 50%; /* Make image circular */
    width: 250px; /* Ensure width and height are equal */
    height: 250px; /* Ensure width and height are equal */
  }

  .btn i {
    margin-right: 5px; /* Add margin to the right of the icon */
  }
</style>

<?php foreach ($organizations as $index => $org) : ?>
  <?php $logo_url = json_decode($org->logo)->url; ?>
  <div class="col">
    <div class="card pt-2 w-100 custom-card" style="animation-delay: <?= $index * 0.1 ?>s; background-color:#FAF8F7;">
      <img src="<?= $logo_url ?> " class="img-thumbnail mx-auto d-block " alt="...">
      <div class="card-body">
        <h5 class="card-title text-center"><?= esc($org->name) ?></h5>
        <div class="row">
          <div class="col">
            <a class="btn btn-sm btn-outline-success w-100" href="<?= url_to("OrganizationController::viewEditOrg", $org->organization_id) ?>"><i class="bi bi-pencil-fill"></i>Edit</a>
          </div>
          <div class="col">
            <button data-organization-id="<?= $org->organization_id ?>" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal" type="button" class="btn btn-sm btn-outline-danger w-100 delete-modal-btn"><i class="bi bi-trash-fill"></i>Delete</button>
          </div>
        </div>
      </div>
    </div>
  </div>
<?php endforeach ?>

<script>
  // Use JavaScript to trigger the animation after the DOM is fully loaded
  document.addEventListener('DOMContentLoaded', function() {
    const cards = document.querySelectorAll('.custom-card');
    cards.forEach((card, index) => {
      setTimeout(() => {
        card.style.opacity = '1';
      }, index * 100); // Delay based on index (100ms per card)
    });
  });
</script>

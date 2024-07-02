<aside id="sidebar">
  <div class="d-flex">
    <button class="toggle-btn" type="button">
      <i class="bi bi-arrow-right-square-fill"></i>
    </button>
    <div class="sidebar-logo">
      <a href="#">Admin</a>
    </div>
  </div>
  <ul class="sidebar-nav">
    <li class="sidebar-item">
      <a href="<?= url_to('AdminViewController::viewDashboard') ?>" class="sidebar-link">
        <i class="bi bi-grid-1x2-fill"></i>
        <span>Dashboard</span>
      </a>
    </li>
    <li class="sidebar-item">
      <a href="<?= url_to('AdminViewController::viewOrganizations') ?>" class="sidebar-link">
        <i class="bi bi-collection-fill"></i>
        <span>Organizations</span>
      </a>
    </li>
    <li class="sidebar-item">
      <a href="<?= url_to('AdminViewController::viewProducts') ?>" class="sidebar-link">
        <i class="bi bi-bag-dash-fill"></i>
        <span>Products</span>
      </a>
    </li>
    <li class="sidebar-item">
      <a href="<?= url_to('AdminViewController::viewPendingOrders') ?>" class="sidebar-link">
        <i class="bi bi-receipt"></i>
        <span>Pending Purchases</span>
      </a>
    </li>
    <li class="sidebar-item">
      <a href="<?= url_to('AdminViewController::viewReports') ?>" class="sidebar-link">
        <i class="bi bi-bar-chart-fill"></i>
        <span>Reports</span>
      </a>
    </li>
    <li class="sidebar-item">
      <a href="<?= url_to('AdminViewController::viewHistory') ?>" class="sidebar-link">
        <i class="bi bi-clock-history"></i>
        <span>History</span>
      </a>
    </li>
    <li class="sidebar-item">
      <a href="#" class="sidebar-link collapsed has-dropdown" data-bs-toggle="collapse" data-bs-target="#sample_nav" aria-expanded="false" aria-controls="multi">
        <i class="bi bi-receipt"></i>
        <span>Sample</span>
      </a>
      <ul id="sample_nav" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
        <li class="sidebar-item">
          <a href="#" class="sidebar-link">One</a>
        </li>
        <li class="sidebar-item">
          <a href="#" class="sidebar-link">Two</a>
        </li>
      </ul>
    </li>
  </ul>
  <div class="sidebar-footer">
    <a href="#" class="sidebar-link">
      <i class="bi bi-box-arrow-left"></i>
      <span>Logout</span>
    </a>
  </div>
</aside>

<script>
  const hamBurger = document.querySelector(".toggle-btn");

  hamBurger.addEventListener("click", function() {
    document.querySelector("#sidebar").classList.toggle("expand");
  });
</script>
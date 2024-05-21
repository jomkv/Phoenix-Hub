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
      <a href="#" class="sidebar-link">
        <i class="bi bi-grid-1x2-fill"></i>
        <span>Dashboard</span>
      </a>
    </li>
    <li class="sidebar-item">
      <a href="#" class="sidebar-link">
        <i class="bi bi-collection-fill"></i>
        <span>Organizations</span>
      </a>
    </li>
    <li class="sidebar-item">
      <a href="#" class="sidebar-link collapsed has-dropdown" data-bs-toggle="collapse" data-bs-target="#products_nav" aria-expanded="false" aria-controls="auth">
        <i class="bi bi-bag-dash-fill"></i>
        <span>Products</span>
      </a>
      <ul id="products_nav" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
        <li class="sidebar-item">
          <a href="#" class="sidebar-link">List</a>
        </li>
        <li class="sidebar-item">
          <a href="#" class="sidebar-link">Create</a>
        </li>
      </ul>
    </li>
    <li class="sidebar-item">
      <a href="#" class="sidebar-link collapsed has-dropdown" data-bs-toggle="collapse" data-bs-target="#pending_nav" aria-expanded="false" aria-controls="multi">
        <i class="bi bi-receipt"></i>
        <span>Pending Purchases</span>
      </a>
      <ul id="pending_nav" class="sidebar-dropdown list-unstyled collapse" data-bs-parent="#sidebar">
        <li class="sidebar-item">
          <a href="#" class="sidebar-link">Login</a>
        </li>
        <li class="sidebar-item">
          <a href="#" class="sidebar-link">Register</a>
        </li>
      </ul>
    </li>
    <li class="sidebar-item">
      <a href="#" class="sidebar-link">
        <i class="bi bi-bar-chart-fill"></i>
        <span>Reports</span>
      </a>
    </li>
    <li class="sidebar-item">
      <a href="#" class="sidebar-link">
        <i class="bi bi-clock-history"></i>
        <span>History</span>
      </a>
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
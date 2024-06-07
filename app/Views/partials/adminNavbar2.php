<aside id="sidebar" class="js-sidebar">
  <!-- Content For Sidebar -->
  <div class="h-100">
    <div class="sidebar-logo">
      <img src="<?= base_url() . 'phoenix.png' ?>" class="avatar img-fluid rounded" alt="">
      <a href="#">Phoenix Hub</a>
    </div>
    <ul class="sidebar-nav">
      <li class="sidebar-item">
        <a href="<?= url_to('AdminViewController::viewDashboard') ?>" class="sidebar-link">
          <i class="bi bi-grid-1x2-fill pe-2"></i>
          Dashboard
        </a>
      </li>
      <li class="sidebar-header">
        Organization
      </li>
      <li class="sidebar-item">
        <a href="<?= url_to('AdminViewController::viewOrganizations') ?>" class="sidebar-link">
          <i class="bi bi-collection-fill pe-2"></i>
          Organization Grid
        </a>
      </li>
      <li class="sidebar-item">
        <a href="<?= url_to('OrganizationController::createOrg') ?>" class="sidebar-link">
          <i class="bi bi-plus-square-fill pe-2"></i>
          Create Organization
        </a>
      </li>

      <li class="sidebar-header">
        Product
      </li>
      <li class="sidebar-item">
        <a href="<?= url_to('AdminViewController::viewProducts') ?>" class="sidebar-link">
          <i class="bi bi-basket3-fill pe-2"></i>
          Product List
        </a>
      </li>
      <li class="sidebar-item">
        <a href="<?= url_to('ProductController::viewCreateProduct') ?>" class="sidebar-link">
          <i class="bi bi-bag-plus-fill pe-2"></i>
          Add Product
        </a>
      </li>

      <li class="sidebar-header">
        Others
      </li>
      <li class="sidebar-item">
        <a href="<?= url_to('AdminViewController::viewPending') ?>" class="sidebar-link">
          <i class="bi bi-receipt pe-2"></i>
          Pending Purchases
        </a>
      </li>
      <li class="sidebar-item">
        <a href="<?= url_to('AdminViewController::viewReports') ?>" class="sidebar-link">
          <i class="bi bi-bar-chart-fill pe-2"></i>
          Reports
        </a>
      </li>
      <li class="sidebar-item">
        <a href="<?= url_to('AdminViewController::viewHistory') ?>" class="sidebar-link">
          <i class="bi bi-clock-history pe-2"></i>
          History
        </a>
      </li>

      <li class="sidebar-footer justify-self-end">
        <a href="#" id="logout-link" class="sidebar-link">
          <i class="bi bi-box-arrow-left pe-2"></i>
          Logout
        </a>
      </li>
    </ul>
  </div>
</aside>

<!-- Logout Confirmation Modal -->
<div id="logoutModal" class="modal">
  <div class="modal-content">
    <p>Are you sure you want to log out?</p>
    <div class="modal-actions">
      <button id="confirmLogout" class="btn btn-primary">Yes</button>
      <button id="cancelLogout" class="btn btn-secondary">No</button>
    </div>
  </div>
</div>


<!-- Logout Confirmation Modal -->
<div id="logoutModal" class="modal">
  <div class="modal-content">
    <p>Are you sure you want to log out?</p>
    <div class="modal-actions">
      <button id="confirmLogout" class="btn btn-primary">Yes</button>
      <button id="cancelLogout" class="btn btn-secondary">No</button>
    </div>
  </div>
</div>

<style>
  
  :root {
  --text: #0a090b;
  --background: #f7f6f9;
  --primary: #7532FA;
  --secondary: #6366F1;
  --accent: #ffe400;
}

.modal {
  display: none;
  position: fixed;
  z-index: 1000;
  left: 0;
  top: 0;
  width: 100%;
  height: 100%;
  overflow: auto;
  background-color: rgba(0, 0, 0, 0.4);
  justify-content: center;
  align-items: center;
}

.modal-content {
  background-color: white;
  border: 2px solid var(--secondary);
  padding: 20px;
  border-radius: 4px;
  text-align: center;
  width: 300px;
  margin: auto;
}

.modal-actions {
  display: flex;
  justify-content: space-between;
  margin-top: 20px;
}

/* Button Styles */
.btn {
  padding: 10px 20px;
  border: none;
  cursor: pointer;
  border-radius: 4px;
  transition: background-color 0.2s; /* Smooth transition for color change */
}

.btn-primary {
  background-color: var(--primary);
  color: white;
}

.btn-secondary {
  background-color: gray;
  color: white;
}

/* Change color when the button is hovered */
.btn-primary:hover,
.btn-primary:focus {
  background-color: var(--secondary); /* Hover color */
}

.btn-primary:active,
.btn-primary:focus:active {
  background-color: var(--primary); /* Active color */
}

.btn-secondary:hover,
.btn-secondary:focus {
  background-color: var(--secondary);/* Hover color */
}

.btn-secondary:active,
.btn-secondary:focus:active {
  background-color: var(--primary); /* Active color */
}

</style>

<script>
  document.getElementById('logout-link').addEventListener('click', function(event) {
  event.preventDefault();
  document.getElementById('logoutModal').style.display = 'flex';
});

document.getElementById('cancelLogout').addEventListener('click', function() {
  document.getElementById('logoutModal').style.display = 'none';
});

document.getElementById('confirmLogout').addEventListener('click', function() {
  window.location.href = "<?= url_to('AdminController::logout') ?>";
});

</script>
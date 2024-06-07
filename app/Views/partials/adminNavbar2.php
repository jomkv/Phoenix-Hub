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
        <a href="<?= url_to('AdminController::logout') ?>" class="sidebar-link">
          <i class="bi bi-box-arrow-left pe-2"></i>
          Logout
        </a>
      </li>
    </ul>
  </div>
</aside>
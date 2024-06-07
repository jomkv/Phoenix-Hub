<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= $this->renderSection("title") ?></title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  <link rel="stylesheet" href="<?= base_url() . 'global.css' ?>">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  <script src="<?= base_url() . 'jquery.js' ?>"></script>
  <script src="https://kit.fontawesome.com/ae360af17e.js" crossorigin="anonymous"></script>
</head>

<body>
  <script>
    function generateSuccessToast(message) {
      const toast = document.createElement('div');
      toast.classList.add('toast', 'align-items-center', 'text-bg-success', 'border-0');
      toast.innerHTML = `
        <div class="d-flex">
          <div class="toast-body">
            ${message}
          </div>
          <button type="button" class="btn-close me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
      `;
      const container = document.getElementById('custom-toast-container');
      if (container) {
        container.appendChild(toast);
      }

      const toastInstance = bootstrap.Toast.getOrCreateInstance(toast);
      toastInstance.show();
    }

    function generateInfoToast(message) {
      const toast = document.createElement('div');
      toast.classList.add('toast', 'align-items-center', 'text-bg-primary', 'border-0');
      toast.innerHTML = `
        <div class="d-flex">
          <div class="toast-body">
            ${message}
          </div>
          <button type="button" class="btn-close me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
      `;
      const container = document.getElementById('custom-toast-container');
      if (container) {
        container.appendChild(toast);
      }

      const toastInstance = bootstrap.Toast.getOrCreateInstance(toast);
      toastInstance.show();
    }

    function generateErrorToast(message) {
      const toast = document.createElement('div');
      toast.classList.add('toast', 'align-items-center', 'text-bg-danger', 'border-0');
      toast.innerHTML = `
        <div class="d-flex">
          <div class="toast-body">
            ${message}
          </div>
          <button type="button" class="btn-close me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
      `;
      const container = document.getElementById('custom-toast-container');
      if (container) {
        container.appendChild(toast);
      }

      const toastInstance = bootstrap.Toast.getOrCreateInstance(toast);
      toastInstance.show();
    }

    function generateErrorToasts(xhr) {
      const response = JSON.parse(xhr.responseText);
      if (response.errors && response.errors instanceof Object) {
        const errorsArr = Object.values(response.errors);

        errorsArr.forEach(
          error => {
            generateErrorToast(error);
          }
        )
      } else {
        generateErrorToast("Error, please try again later.");
      }
    }
  </script>

  <div class="wrapper">
    <?= $this->include('partials/adminNavbar2.php'); ?>

    <div class="main p-3">
      <nav class="navbar navbar-expand px-3 border-bottom border-dark">
        <div class="navbar-collapse navbar">
          <ul class="navbar-nav">
            <li class="nav-item dropdown">
              <a href="#" data-bs-toggle="dropdown" class="nav-icon pe-md-0">
                <img src="<?= base_url() . 'phoenix.png' ?>" class="avatar img-fluid rounded" alt="">
              </a>
              <div class="dropdown-menu dropdown-menu-end">
                <a href="#" class="dropdown-item">Profile</a>
                <a href="#" class="dropdown-item">Setting</a>
                <a href="#" class="dropdown-item">Logout</a>
              </div>
            </li>
          </ul>
        </div>
      </nav>

      <div class="toast-container bottom-0 end-0 p-3" id="custom-toast-container" style="z-index: 0;"></div>

      <?= $this->renderSection("content") ?>


    </div>
  </div>

  <div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Confirm Delete</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          Are you sure you want to perform this action?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <a>
            <button type="button" class="btn btn-danger" id="confirm-delete-btn">Delete</button>
          </a>
        </div>
      </div>
    </div>
  </div>

  <style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins&display=swap');

    *,
    ::after,
    ::before {
      box-sizing: border-box;
    }

    .modal {
      background: rgba(0, 0, 0, 0.5);
    }

    .modal-backdrop {
      display: none;
    }

    body {
      font-family: 'Poppins', sans-serif;
      font-size: 0.875rem;
      opacity: 1;
      overflow-y: scroll;
      margin: 0;
    }

    a {
      cursor: pointer;
      text-decoration: none;
      font-family: 'Poppins', sans-serif;
    }

    li {
      list-style: none;
    }

    h4 {
      font-family: 'Poppins', sans-serif;
      font-size: 1.275rem;
      color: var(--bs-emphasis-color);
    }

    /* Layout for admin dashboard skeleton */

    .wrapper {
      align-items: stretch;
      display: flex;
      width: 100%;
    }

    #sidebar {
      max-width: 264px;
      min-width: 264px;
      background: var(--bs-dark);
      transition: all 0.35s ease-in-out;
    }

    .main {
      display: flex;
      flex-direction: column;
      min-height: 100vh;
      min-width: 0;
      overflow: hidden;
      transition: all 0.35s ease-in-out;
      width: 100%;
      background: var(--bs-dark-bg-subtle);
    }

    /* Sidebar Elements Style */

    .sidebar-logo {
      padding: 1.15rem;
    }

    .sidebar-logo a {
      color: #e9ecef;
      font-size: 1.15rem;
      font-weight: 600;
    }

    .sidebar-nav {
      list-style: none;
      margin-bottom: 0;
      padding-left: 0;
      margin-left: 0;
    }

    .sidebar-header {
      color: #e9ecef;
      font-size: .75rem;
      padding: 1.5rem 1.5rem .375rem;
    }

    a.sidebar-link {
      padding: .625rem 1.625rem;
      color: #e9ecef;
      position: relative;
      display: block;
      font-size: 0.875rem;
    }

    .sidebar-link[data-bs-toggle="collapse"]::after {
      border: solid;
      border-width: 0 .075rem .075rem 0;
      content: "";
      display: inline-block;
      padding: 2px;
      position: absolute;
      right: 1.5rem;
      top: 1.4rem;
      transform: rotate(-135deg);
      transition: all .2s ease-out;
    }

    .sidebar-link[data-bs-toggle="collapse"].collapsed::after {
      transform: rotate(45deg);
      transition: all .2s ease-out;
    }

    .avatar {
      height: 40px;
      width: 40px;
    }

    .navbar-expand .navbar-nav {
      margin-left: auto;
    }

    .content {
      flex: 1;
      max-width: 100vw;
      width: 100vw;
    }

    @media (min-width:768px) {
      .content {
        max-width: auto;
        width: auto;
      }
    }

    .card {
      box-shadow: 0 0 .875rem 0 rgba(34, 46, 60, .05);
      margin-bottom: 24px;
    }

    .illustration {
      background-color: var(--bs-primary-bg-subtle);
      color: var(--bs-emphasis-color);
    }

    .illustration-img {
      max-width: 150px;
      width: 100%;
    }

    /* Sidebar Toggle */

    #sidebar.collapsed {
      margin-left: -264px;
    }

    /* Footer and Nav */

    @media (max-width:767.98px) {

      .js-sidebar {
        margin-left: -264px;
      }

      #sidebar.collapsed {
        margin-left: 0;
      }

      .navbar,
      footer {
        width: 100vw;
      }
    }

    /* Theme Toggler */

    .theme-toggle {
      position: fixed;
      top: 50%;
      transform: translateY(-65%);
      text-align: center;
      z-index: 10;
      right: 0;
      left: auto;
      border: none;
      background-color: var(--bs-body-color);
    }

    html[data-bs-theme="dark"] .theme-toggle .fa-sun,
    html[data-bs-theme="light"] .theme-toggle .fa-moon {
      cursor: pointer;
      padding: 10px;
      display: block;
      font-size: 1.25rem;
      color: #FFF;
    }

    html[data-bs-theme="dark"] .theme-toggle .fa-moon {
      display: none;
    }

    html[data-bs-theme="light"] .theme-toggle .fa-sun {
      display: none;
    }
  </style>
</body>

</html>
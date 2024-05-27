<!doctype html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= $this->renderSection("title") ?></title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  <link rel="stylesheet" href="<?= base_url() . 'global.css' ?>">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  <script src="<?= base_url() . 'jquery.js' ?>"></script>
</head>

<body>
  <div class="wrapper">
    <?= $this->include('partials/adminNavbar.php'); ?>

    <div class="main p-3">
      <div class="toast-container bottom-0 end-0 p-3" id="custom-toast-container" style="z-index: 1091;">

      </div>

      <?= $this->renderSection("content") ?>


    </div>
  </div>
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
</body>

</html>
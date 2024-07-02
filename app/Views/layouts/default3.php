<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $this->renderSection("title") ?></title>
    <script src="<?= base_url() . 'jquery.js' ?>"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
</head>

<body style="height: 100vh">
    <?php
    $error = session()->getFlashdata('error');
    $message = session()->getFlashdata('message');
    $info = session()->getFlashdata('info');

    $js_info = json_encode($info ? $info : "");
    $js_error = json_encode($error ? $error : "");
    $js_message = json_encode($message ? $message : "");
    ?>

    <div class="wrapper h-100 d-flex align-items-center justify-content-center">
        <?= $this->include('partials/navbar.php'); ?>

        <div class="w-100">
            <?= $this->renderSection("content") ?>
        </div>

        <div class="toast-container bottom-0 end-0 p-3 position-fixed" id="custom-toast-container" style="z-index: 0;"></div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

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
            toast.classList.add('toast', 'align-items-center', 'text-bg-secondary', 'border-0');
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

            console.log(container.innerHTML);

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

        const phpError = JSON.parse('<?= $js_error ?>');
        const phpMessage = JSON.parse('<?= $js_message ?>');
        const phpInfo = JSON.parse('<?= $js_info ?>');

        if (phpError && phpError !== "") {
            generateErrorToast(phpError);
        }
        if (phpMessage && phpMessage !== "") {
            generateSuccessToast(phpMessage);
        }
        if (phpInfo && phpInfo !== "") {
            generateInfoToast(phpInfo);
        }
    </script>

    <style>
        * {
            font-family: 'Poppins', sans-serif;
        }

        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            font-family: 'Poppins', sans-serif;
            background-color: #eee;
            margin: 0;
        }

        .mt-100 {
            margin-top: 100px;
        }

        .product-wrapper,
        .product-img {
            overflow: hidden;
            position: relative;
        }

        .mb-45 {
            margin-bottom: 45px;
        }

        .product-action {
            bottom: 0;
            left: 0;
            opacity: 0;
            position: absolute;
            right: 0;
            text-align: center;
            transition: all 0.6s ease;
        }

        .product-wrapper {
            border-radius: 10px;
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .product-img>span {
            background-color: #fff;
            box-shadow: 0 0 8px 1.7px rgba(0, 0, 0, 0.06);
            color: #333;
            display: inline-block;
            font-size: 12px;
            font-weight: 500;
            left: 20px;
            letter-spacing: 1px;
            padding: 3px 12px;
            position: absolute;
            text-align: center;
            text-transform: uppercase;
            top: 20px;
        }

        .product-action-style {
            background-color: #fff;
            box-shadow: 0 0 8px 1.7px rgba(0, 0, 0, 0.06);
            display: inline-block;
            padding: 16px 2px 12px;
        }

        .product-action-style>a {
            color: #979797;
            line-height: 1;
            padding: 0 21px;
            position: relative;
        }

        .product-action-style>a.action-plus {
            font-size: 18px;
        }

        .product-wrapper:hover .product-action {
            bottom: 20px;
            opacity: 1;
        }
    </style>
</body>

</html>
<!doctype html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= $this->renderSection("title") ?></title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <link href="<?= base_url() . "bootstrap/css/bootstrap.min.css" ?>" rel="stylesheet">
  <script src="<?= base_url() . "bootstrap/js/bootstrap.bundle.min.js" ?>"></script>
</head>

<body style="height: 100vh; background-color: #f7f6f6">
  <div class="container h-100 d-flex align-items-center justify-content-center">
    <div class="w-100">
      <?= $this->renderSection("content") ?>
    </div>
  </div>

</body>

</html>
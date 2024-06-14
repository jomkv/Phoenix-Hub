<!doctype html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= $this->renderSection("title") ?></title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <link href="<?= base_url() . "bootstrap/css/bootstrap.min.css" ?>" rel="stylesheet">
  <script src="<?= base_url() . "bootstrap/js/bootstrap.bundle.min.js" ?>"></script>

  <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
</head>

<body style="height: 100vh; background-color: #f7f6f6">
  <div class="container h-100 d-flex align-items-center justify-content-center">
    <div class="w-100">
      <?= $this->renderSection("content") ?>
    </div>
  </div>

</body>

</html>
<style>
  *{
        font-family: 'Poppins', sans-serif;
        }
</style>
<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $this->renderSection("title") ?></title>
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
</head>

<body style="height: 100vh">
   
        <?= $this->include('partials/navbar.php'); ?>

        <div class="w-100">
            <?= $this->renderSection("content") ?>
        </div>


    <style>
        *{
        font-family: 'Poppins', sans-serif;
        }

        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Responsive Navbar</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        .navbar-nav {
            margin-left: auto;
            padding-right: 50px;
        }

        .itlog {
            width: 30px;
            height: 30px;
            margin-bottom: 10px;
            margin-right: 5px;
        }

        .nav-link {
            margin: 10px;
        }

        .navbar-toggler-icon {
            background-color: transparent;
            border: 1px solid white;
            /* Add a border to make the icon visible */
            border-radius: 3px;
            /* Optional: Add border-radius for a rounded look */
            padding: 2px;
            /* Optional: Add padding for spacing around the icon */
        }
    </style>
</head>

<body>
    <nav class="navbar fixed-top navbar-expand-lg p-3" style="background-color:#FFA31A;">
        <div class="container-fluid">
            <a class="navbar-brand fs-5 fw-bold" href="#">
                <img class="itlog" src="<?= base_url() . 'phoenix.png' ?>" alt="Logo">Phoenix Hub
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <i class="bi bi-list"></i>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link active fs-5 fw-bold" aria-current="page" href="#">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active fs-5 fw-bold" href="#">Products</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active fs-5 fw-bold" href="<?= url_to("UsersController::viewLogin") ?>">Login</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
</body>

</html>
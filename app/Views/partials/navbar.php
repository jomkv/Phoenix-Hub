<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Responsive Navbar</title>
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        * {
            font-family: "Kanit", sans-serif;
            font-weight: 400;
            font-style: normal;
        }

        :root {
            --text: #0a090b;
            --background: #f7f6f9;
            --primary: #7532FA;
            --secondary: #6366F1;
            --accent: #ffe400;
        }

        .navbar-nav {
            margin-left: auto;
            padding-right: 50px;
        }

        .logo {
            height: 0.5rem; /* Adjusted height for logo */
            margin-right: 1.5rem;
            vertical-align: middle; /* Center the logo vertically */
        }

        .navbar-brand {
            display: flex;
            align-items: center;
            color: var(--accent); /* Ensure text is visible on the dark background */
        }

        .nav-link {
            margin: 10px;
            color: var(--accent) !important; /* Ensure links are visible on the dark background */
        }

        .navbar-toggler-icon {
            background-color: transparent;
            border: 1px solid white;
            border-radius: 3px;
            padding: 2px;
        }

        @media (min-width: 768px) {
            .logo {
                height: 1rem; /* Adjusted for larger screens */
            }
        }

        @media (min-width: 1200px) {
            .logo {
                height: 1.5rem; /* Further adjusted for extra-large screens */
            }
        }
    </style>
</head>

<body>
    <nav class="navbar fixed-top navbar-expand-lg p-3" style="background-color: var(--primary);">
        <div class="container-fluid">
            <a class="navbar-brand fs-5 fw-bold" href="#">
                <img class="logo" src="<?= base_url() . 'typographyLogo-white.png' ?>" alt="Phoenix Hub Logo">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <i class="bi bi-list"></i>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link active fs-5" aria-current="page" href="#">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fs-5" href="#">Products</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fs-5" href="<?= url_to("UsersController::viewLogin") ?>">Login</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
</body>

</html>

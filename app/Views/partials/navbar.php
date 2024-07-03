<style>
    * {
        font-family: 'Poppins', sans-serif;
    }

    :root {
        --text: #0a090b;
        --background: #f7f6f9;
        --darkbg: #00012E;
        --primary: #7532FA;
        --secondary: #6366F1;
        --accent: #ffe400;
        --lightgray: #edf5f1;
        --gray: #4d4c52;
        --black: #000000;
        --purple: #4f089a;
        --lightpurple: #D292FF;
        --yellow: #fbbd32;
        --navgray: #2A3144;
        --link-hover-color: #ffe400;
        --link-hover-underline: #ffffff;
    }

    .navbar-nav {
        margin-left: auto;
    }

    .logo {
        height: 1.1rem;
        margin-right: 1.5rem;
        vertical-align: middle;
        transition: transform 0.3s, filter 0.3s;
    }

    .navbar-brand {
        display: flex;
        align-items: center;
        transition: transform 0.3s;
    }

    .navbar-brand:hover .logo {
        transform: scale(1.1);
        filter: drop-shadow(0 0 10px var(--link-hover-color)) drop-shadow(0 0 20px var(--link-hover-color));
    }

    .nav-link {
        margin: 10px;
        color: var(--lightgray) !important;
        position: relative;
        transition: color 0.3s, transform 0.3s;
    }

    .nav-link::after {
        content: '';
        position: absolute;
        width: 0;
        height: 2px;
        display: block;
        margin-top: 5px;
        right: 0;
        background: var(--link-hover-underline);
        transition: width 0.4s ease, background-color 0.4s ease;
    }

    .nav-link:hover::after {
        width: 100%;
        left: 0;
        background: var(--link-hover-underline);
    }

    .nav-link:hover {
        color: var(--link-hover-color) !important;
        transform: translateY(-4px);
    }

    .navbar-toggler {
        border-color: var(--lightgray);
    }

    .navbar-toggler-icon {
        background-image: url('data:image/svg+xml;charset=utf8,%3Csvg viewBox="0 0 30 30" xmlns="http://www.w3.org/2000/svg"%3E%3Cpath stroke="rgba%28237, 245, 241, 1%29" stroke-width="2" stroke-linecap="round" stroke-miterlimit="10" d="M4 7h22M4 15h22M4 23h22"/%3E%3C/svg%3E');
    }

    @media (min-width: 768px) {
        .logo {
            height: 1rem;
        }
    }

    @media (min-width: 1200px) {
        .logo {
            height: 1.2rem;
        }
    }

    @media (max-width: 767.98px) {
        .logo {
            height: 0.5rem;
        }
    }
</style>

<nav class="navbar fixed-top navbar-expand-lg p-3" style="background-color: var(--purple);">
    <div class="container-fluid">
        <a class="navbar-brand fs-5 fw-bold" href="<?= url_to("/") ?>">
            <img class="logo" src="<?= base_url() . 'typo-logo-lightgray.png' ?>" alt="Phoenix Hub Logo">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link active fs-5" aria-current="page" href="<?= base_url() . "#" ?>">Organizations</a>
                </li>
                <li class=" nav-item">
                    <a class="nav-link fs-5" href="<?= base_url() . "#productsSection" ?>">Products</a>
                </li>
                <?php if (!auth()->loggedIn()) : ?>
                    <li class="nav-item">
                        <a class="nav-link fs-5" href="<?= base_url() . 'login' ?>">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fs-5" href="<?= base_url() . 'register' ?>">Signup</a>
                    </li>
                <?php else : ?>
                    <li class="nav-item">
                        <a class="nav-link fs-5" href="<?= base_url() . 'cart' ?>">Cart</a>
                    </li>
                    <li class="nav-item">
                        <button class="nav-link fs-5" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Logout</button>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>
<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to log out?</p>
            </div>
            <div class="modal-footer">
                <a type="button" class="btn" href="<?= base_url() . 'logout' ?>" style="background-color:#7532FA; color:white;">Yes</a>
                <a type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</a>
            </div>
        </div>
    </div>
</div>
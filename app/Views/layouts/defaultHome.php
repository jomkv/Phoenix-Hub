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

<body>
  <?= $this->include('partials/homeNavbar.php'); ?>

  <div class="container min-vh-100 d-flex align-items-center justify-content-center flex-column">
    <?= $this->renderSection("content") ?>
  </div>

  <!-- Our Vendible Section -->
  <div class="our-vendible">
    <video autoplay muted loop>
      <source src="<?= base_url() . '4K Space Starfield Background.mp4' ?>" type="video/mp4">
      Your browser does not support the video tag.
    </video>
    <div class="content">
    <img class="logo" src="<?= base_url() . 'circular-logo -combo6(11).png' ?>" style="height: 8rem; alt="Phoenix Hub Logo">
      <div class="divider-product"> PHOENIX HUB FOR ONE, MERCH FOR ALL.</div>
      <p>Discover the best merch with unbeatable quality and affordable price, made by our favorite Student Organizations.</p>
    </div>
  </div>

  <div class="container w-100 min-vh-100">
    <?= $this->include('pages/organization/productsOffered.php') ?>
  </div>

  <div class="w-100 bg-primary text-center" style="height: 150px;">
  <footer class="footer-section">
        <div class="container">
            <div class="footer-cta pt-5 pb-5">
                <div class="row">
                <div class="col-xl-4 col-md-4 mb-30">
                        <div class="single-cta">
                            <i class="fas fa-map-marker-alt" style="color: var(--lightpurple);"></i>
                            <div class="cta-text">
                                <h4>Find us</h4>
                                <span>CvSU - Silang, 4118 Cavite</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-md-4 mb-30">
                        <div class="single-cta">
                            <i class="fas fa-phone" style="color: var(--lightpurple);"></i>
                            <div class="cta-text">
                                <h4>Call us</h4>
                                <span>09999999999</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-md-4 mb-30">
                        <div class="single-cta">
                            <i class="far fa-envelope-open" style="color: var(--lightpurple);"></i>
                            <div class="cta-text">
                                <h4>Mail us</h4>
                                <span>sc.bscs2b@cvsu.edu.ph</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer-content pt-5 pb-5">
    <div class="row justify-content-center text-center">
        <div class="col-xl-4 col-lg-4 col-md-5 mb-30">
            <div class="footer-widget">
                <div class="footer-logo">
                    <a href="index.html"><img src="circular-logo-lightgray(1).png" class="img-fluid" alt="logo" height="200px" width="200px"></a>
                </div>
                <div class="footer-text">
                    <p>Lorem ipsum dolor sit amet, consec tetur adipisicing elit, sed do eiusmod tempor incididuntut consec tetur adipisicing elit,Lorem ipsum dolor sit amet.</p>
                </div>
                <div class="footer-social-icon">
                    <span>Follow us</span>
                    <a href="#"><i class="fab fa-facebook-f facebook-bg"></i></a>
                    <a href="#"><i class="fab fa-twitter twitter-bg"></i></a>
                    <a href="#"><i class="fab fa-google-plus-g google-bg"></i></a>
                </div>
            </div>
        </div>
    </div>
</div>

        </div>
        <div class="copyright-area">
            <div class="container">
                <div class="row">
                    <div class="col-xl-6 col-lg-6 text-center text-lg-left">
                        <div class="copyright-text">
                            <p>Copyright &copy; 2024, All Right Reserved Phoenix Hub.</p>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 d-none d-lg-block text-right">
                        <div class="footer-menu">
                            <ul>
                            <li class="nav-item">
            <a href="#">Organizations</a>
          </li>
          <li class="nav-item">
            <a  href="#productsSection">Products</a>
          </li>
          <?php if (!auth()->loggedIn()) : ?>
            <li >
              <a  href="<?= base_url() . 'login' ?>">Login</a>
            </li>
            <li >
              <a  href="<?= base_url() . 'register' ?>">Signup</a>
            </li>
          <?php else : ?>
            <li >
              <a  href="<?= base_url() . 'cart' ?>">Cart</a>
            </li>
            <li >
              <a  data-bs-toggle="modal" data-bs-target="#staticBackdrop">Logout</a>
            </li>
          <?php endif; ?>
                            </ul>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </footer>
  </div>

  <style>
    :root {
  --text: #0a090b;
  --background: #f7f6f9;
  --primary: #7532FA;
  --secondary: #6366F1;
  --accent: #ffe400;
  --lightgray: #edf5f1;
  --gray: #4d4c52;
  --black: #000000;
  --purple: #4f089a;
  --lightpurple: #6a5ac1;
  --yellow: #fbbd32;
  --navgray: #2A3144;
}
 /* Divider product styles */
.divider-product {
  font-family: "Poppins", sans-serif;
  font-weight: 900;
  font-size: 3rem;
  font-style: italic;
  text-shadow: 0 0 5px rgba(255, 255, 255, 0.5);
  transition: text-shadow 0.3s ease, color 0.3s ease;
}

.divider-product:hover {
  text-shadow: 0 0 15px rgba(255, 255, 255, 1);
  color: var(--accent);
}

/* Paragraph styles */
p {
  text-shadow: 0 0 5px rgba(255, 255, 255, 0.5);
  transition: text-shadow 0.3s ease, color 0.3s ease;
}

p:hover {
  text-shadow: 0 0 15px rgba(255, 255, 255, 1);
  color: var(--accent);
}

  .our-vendible {
      position: relative;
      width: 100%;
      height: 400px;
      display: flex;
      justify-content: center;
      align-items: center;
      color: white;
      font-size: 0.7rem;
      text-align: center;
      font-family: 'Poppins', sans-serif;
      overflow: hidden;
    }

    .our-vendible video {
      position: absolute;
      top: 0;
      left: 50%;
      transform: translateX(-50%);
      min-width: 100%;
      min-height: 100%;
      width: auto;
      height: auto;
      z-index: -1;
    }

    .our-vendible::after {
      content: "";
      position: absolute;
      bottom: 0;
      left: 0;
      width: 100%;
      height: 25%;
      background: linear-gradient(transparent, rgba(0, 0, 0, 0.7));
      z-index: -1;
    }
    body {
      /* display: flex; */
      /* justify-content: center;
        align-items: center; */
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

    ul {
    margin: 0;
    padding: 0;
}

.footer-section {
  background: var(--navgray);
  position: relative;
}
.footer-cta {
  border-bottom: 1px solid #373636;
}
.single-cta i {
  color: #ff5e14;
  font-size: 30px;
  float: left;
  margin-top: 8px;
}
.cta-text {
  padding-left: 15px;
  display: inline-block;
}
.cta-text h4 {
  color: var(--lightgray);
  font-size: 20px;
  font-weight: 600;
  margin-bottom: 2px;
}
.cta-text span {
  color: #757575;
  font-size: 15px;
}
.footer-content {
  position: relative;
  z-index: 2;
}
.footer-pattern img {
  position: absolute;
  top: 0;
  left: 0;
  height: 330px;
  background-size: cover;
  background-position: 100% 100%;
}
.footer-logo {
  margin-bottom: 30px;
}
.footer-logo img {
    max-width: 200px;
}
.footer-text p {
  margin-bottom: 14px;
  font-size: 14px;
      color: #7e7e7e;
  line-height: 28px;
}
.footer-social-icon span {
  color: #fff;
  display: block;
  font-size: 20px;
  font-weight: 700;
  font-family: 'Poppins', sans-serif;
  margin-bottom: 20px;
}
.footer-social-icon a {
  color: #fff;
  font-size: 16px;
  margin-right: 15px;
}
.footer-social-icon i {
  height: 40px;
  width: 40px;
  text-align: center;
  line-height: 38px;
  border-radius: 50%;
}
.facebook-bg{
  background: #3B5998;
}
.twitter-bg{
  background: #55ACEE;
}
.google-bg{
  background: #DD4B39;
}
.footer-widget-heading h3 {
  color: #fff;
  font-size: 20px;
  font-weight: 600;
  margin-bottom: 40px;
  position: relative;
}
.footer-widget-heading h3::before {
  content: "";
  position: absolute;
  left: 0;
  bottom: -15px;
  height: 2px;
  width: 50px;
  background: #ff5e14;
}
.footer-widget ul li {
  display: inline-block;
  float: left;
  width: 50%;
  margin-bottom: 12px;
}
.footer-widget ul li a:hover{
  color: #ff5e14;
}
.footer-widget ul li a {
  color: #878787;
  text-transform: capitalize;
}
.subscribe-form {
  position: relative;
  overflow: hidden;
}
.subscribe-form input {
  width: 100%;
  padding: 14px 28px;
  background: #2E2E2E;
  border: 1px solid #2E2E2E;
  color: #fff;
}
.subscribe-form button {
    position: absolute;
    right: 0;
    background: #ff5e14;
    padding: 13px 20px;
    border: 1px solid #ff5e14;
    top: 0;
}
.subscribe-form button i {
  color: #fff;
  font-size: 22px;
  transform: rotate(-6deg);
}
.copyright-area{
  background: var(--purple);
  padding: 25px 0;
}
.copyright-text p {
  margin: 0;
  font-size: 14px;
  color: var(--lightgray);
}
.copyright-text p a{
  color: #ff5e14;
}
.footer-menu li {
  display: inline-block;
  margin-left: 20px;
}
.footer-menu li:hover a{
  color: var(--accent);
}
.footer-menu li a {
  font-size: 14px;
  color: #878787;
}
  </style>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
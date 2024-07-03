<?= $this->extend("layouts/default2") ?>

<?= $this->section("title") ?>Student Barter Profile<?= $this->endSection() ?>

<?= $this->section("content") ?>
<style>
  body {
    font-family: 'Roboto', sans-serif;
    background-color: #f0f2f5;
    color: #1c1e21;
    margin-bottom: 10px; /* Added from the first style block */
  }
  .image-container {
    max-width: 100%;
    height: 400px;
    display: flex;
    justify-content: center;
    align-items: center;
    overflow: hidden;
    border-radius: 5px;
    margin-bottom: 10px; /* Added from the first style block */
  }
  .image-container img {
    max-width: 100%;
    height: auto;
    display: block;
    object-fit: contain;
  }
  .profile-container {
    display: flex;
    align-items: center;
    justify-content: space-between; /* Adjusted from the first style block */
    margin-bottom: 10px; /* Added from the first style block */
  }
  .profile-container img {
    border-radius: 50%;
    width: 40px;
    height: 40px;
    object-fit: cover;
    margin-right: 10px;
  }
  .card-header .profile-name {
    font-weight: bold;
    color: black;
  }
  .description h5 {
    margin-bottom: 0px;
    color: #555;
  }
  .card-footer-2 {
    display: flex;
    align-items: center;
    gap: 10px;
  }
  .card-footer-2 .icon-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 70px;
    height: 40px;
    background-color: #e4e6eb;
    color: #050505;
    text-align: center;
    transition: background-color 0.3s, transform 0.3s;
    border-radius: 5px;
  }
  .card-footer-2 .icon-btn:hover {
    background-color: #ced0d4;
    transform: scale(1.1);
    color: #050505;
  }
  .card-footer-2 .btn-primary {
    background-color: #1877f2;
    border-color: #1877f2;
    transition: background-color 0.3s, transform 0.3s;
    border-radius: 5px;
  }
  .card-footer-2 .btn-primary:hover {
    background-color: #165ebe;
    border-color: #165ebe;
    transform: scale(1.1);
  }
  .card {
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    margin-bottom: 20px;
  }
  .card-footer {
    background-color: #fff;
    padding: 20px;
    border-radius: 0 0 10px 10px;
    box-shadow: 0 -2px 4px rgba(0, 0, 0, 0.1);
  }
  .card-footer h5 {
    font-weight: bold;
    color: rgb(1,126,0);
    margin-bottom: 10px;
  }
  .card-footer p {
    margin-bottom: 5px;
    font-size: 1.1rem;
    color: #333;
  }
  .card-footer p span {
    font-weight: bold;
    color: #7532FA;
  }
  .card-footer .icon-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 70px;
    height: 40px;
    background-color: #ced4da; /* Adjusted from the first style block */
    color: black; /* Adjusted from the first style block */
    text-align: center; /* Adjusted from the first style block */
    transition: background-color 0.3s, transform 0.3s; /* Adjusted from the first style block */
  }
  .card-footer .icon-btn:hover {
    background-color: #7532FA; /* Adjusted from the first style block */
    transform: scale(1.1); /* Adjusted from the first style block */
  }
  .card-footer .btn-primary {
    background-color: #007bff;
    border-color: #007bff;
    transition: background-color 0.3s, transform 0.3s;
  }
  .card-footer .btn-primary:hover {
    background-color: #0056b3;
    border-color: #0056b3;
    transform: scale(1.1);
  }
  .student-info {
    display: flex;
    align-items: center;
    justify-content: space-between;
  }
  .student-info p {
    margin-right: 20px;
  }
  @media (max-width: 768px) {
    .profile-container .profile-name {
      font-size: 0.7rem; /* Adjust font size for profile name */
    }
    .profile-container .text-muted {
      font-size: 0.6rem; /* Adjust font size for date */
    }
    .card {
      max-height: 450px;
    }
    .student-info {
      flex-direction: column;
      align-items: center;
      text-align: center;
    }
    .card-title {
      flex-direction: column;
      align-items: center;
      text-align: center;
    }
    .student-info p {
      margin-right: 0;
      margin-bottom: 10px;
      font-size: 0.8rem; /* Adjust font size for student info */
    }
    .student-info p span {
      font-size: 0.8rem; /* Adjust font size for student info labels */
    }
    .card-footer-2 {
      align-items: center;
    }
  }

  .card-body {
    display: flex;
    justify-content: center; /* Center the content horizontally */
    align-items: center; /* Center the content vertically */
  }
  .student-profile {
    display: block;
    margin: 0 auto; /* Center the image */
    transform: translateY(20px); /* Move the image 20px down */
  }

</style>

<div class="container mt-5">
  <div class="card mb-3" style="margin-top:100px; border-radius:10px; max-height:500px;">
    <div class="row g-0">
      <div class="col-md-12">
        <div class="card-body position-relative" style="background-image:url('<?= base_url() . "barter-bg.jpeg"?>'); background-repeat: no-repeat; background-attachment: local; background-position:50% 50%;">
          <img src="<?= base_url() . "student (3).png"?>" class="rounded-circle student-profile" alt="..." style="width:200px; height:200px; border: 5px solid #7432FB; position: relative;">
        </div>
      </div>
      <div class="col-md-12">
        <div class="card-footer" style="background-color:#F7F6F6;">
          <h5 class="card-title text-center">Student Name</h5>
          <div class="student-info">
            <p><i class="bi bi-envelope-at-fill mr-2"></i><span>Email:</span> sc.rhondel.divinasflores@cvsu.edu.ph</p>
            <p><i class="bi bi-person-badge-fill mr-2"></i><span>Student number:</span> 202217426</p>
            <p><i class="bi bi-telephone-fill mr-2"></i><span>Contact number:</span> 09639045846</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="card text-start" style="margin-top: 10px;">
  <div class="card-header">
    <div class="profile-container">
      <div>
        <img src="<?= base_url() . 'student (3).png'?>" alt="Profile Picture" style="border: 3px solid #7532FA;">
        <span class="profile-name">Rhondel Divinasflores</span>
        <small class="text-muted" style="margin-left: 10px;"><?= date('F j, Y') ?></small> <!-- Display current date -->
      </div>
    </div>
    <div class="description">
      <h5>
        School Uniform
      </h5>
    </div>
  </div>
  <div class="image-container mx-auto d-block">
    <img src="<?= base_url() . 'WALTAR.png'?>" class="img-fluid" style="max-width: auto; height: 100%;" alt="...">
  </div>
  <div class="card-footer card-footer-2 text-body-secondary">
    <div class="icon-btn rounded-pill"><i class="bi bi-star"></i></div>
    <div class="icon-btn rounded-pill"><i class="bi bi-chat-square"></i></div>
    <a href="#" class="btn btn-primary rounded-pill" style="background-color:#7532FA;">View More</a>
  </div>
 </div>
</div>
<?= $this->endSection() ?>
